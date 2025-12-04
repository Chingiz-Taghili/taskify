<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserFilterRequest;
use App\Http\Requests\User\UserRoleRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function index(UserFilterRequest $request)
    {
        $perPage = $request->integer('per_page', 10);
        $sortBy = $request->query('sort_by', 'id');
        $sortOrder = $request->query('sort_order', 'asc');

        $users = User::with(['roles', 'tasks.assignment.assignedBy',
            'projects', 'clientsViaTask', 'clientsViaProject'])
            // Filters
            ->when($request->query('role'),
                fn($q, $role) => $q->whereHas('roles', fn($r) => $r->where('name', $role)))
            ->when($request->query('email_verified'), fn($q, $verified) => $verified === 'true'
                ? $q->whereNotNull('email_verified_at') : $q->whereNull('email_verified_at'))
            // Global search
            ->when($request->query('search'), fn($q, $search) => $q
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('surname', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('job_title', 'like', "%{$search}%")
                        ->orWhere('phone_number', 'like', "%{$search}%");
                }))
            // Sort
            ->orderBy($sortBy, $sortOrder)->paginate($perPage)->appends($request->query());

        return UserResource::collection($users)->additional(['success' => true]);
    }

    public function store(UserCreateRequest $request)
    {
        $user = User::create($request->validated());
        $user->assignRole('user');
        return UserResource::make($user->load(['roles',
            'tasks.assignment.assignedBy', 'projects', 'clientsViaTask', 'clientsViaProject']))
            ->additional(['success' => true, 'message'
            => __('api.created', ['resource' => __('resources.user')])])
            ->response()->setStatusCode(201);
    }

    public function show(User $user)
    {
        return UserResource::make($user->load(['roles', 'tasks.assignment.assignedBy',
            'projects', 'clientsViaTask', 'clientsViaProject']))->additional(['success' => true]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->update($request->validated());
        return UserResource::make($user->load(['roles',
            'tasks.assignment.assignedBy', 'projects', 'clientsViaTask', 'clientsViaProject']))
            ->additional(['success' => true, 'message'
            => __('api.updated', ['resource' => __('resources.user')])]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success' => true, 'message'
        => __('api.deleted', ['resource' => __('resources.user')])]);
    }

    public function assignRoles(UserRoleRequest $request, User $user)
    {
        if ($user->is_root) {
            return response()->json(['success' => false,
                'message' => __('api.root_role_immutable')], 403);
        }
        $user->assignRole($request->validated('roles'));
        return UserResource::make($user->load(['roles',
            'tasks.assignment.assignedBy', 'projects', 'clientsViaTask', 'clientsViaProject']))
            ->additional(['success' => true, 'message' => __('api.role_assigned')]);
    }

    public function removeRoles(UserRoleRequest $request, User $user)
    {
        if ($user->is_root) {
            return response()->json(['success' => false,
                'message' => __('api.root_role_immutable')], 403);
        }
        $user->removeRole($request->validated('roles'));
        return UserResource::make($user->load(['roles',
            'tasks.assignment.assignedBy', 'projects', 'clientsViaTask', 'clientsViaProject']))
            ->additional(['success' => true, 'message' => __('api.role_removed')]);
    }
}

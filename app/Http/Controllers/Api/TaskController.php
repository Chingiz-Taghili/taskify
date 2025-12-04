<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskCreateRequest;
use App\Http\Requests\Task\TaskFilterRequest;
use App\Http\Requests\Task\TaskStatusRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Http\Requests\Task\TaskUserRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(TaskFilterRequest $request)
    {
        $perPage = $request->integer('per_page', 10);
        $sortBy = $request->query('sort_by', 'id');
        $sortOrder = $request->query('sort_order', 'asc');

        $tasks = Task::with(['users.assignment.assignedBy', 'clientDirect',
            'clientViaProject', 'project', 'category', 'attachments', 'parent', 'children'])
            // Filters
            ->when($request->query('user_id'),
                fn($q, $user_id) => $q->whereHas('users', fn($u) => $u->where('id', $user_id)))
            ->when($request->query('client_id'),
                fn($q, $client_id) => $q->where('client_id', $client_id))
            ->when($request->query('project_id'),
                fn($q, $project_id) => $q->where('project_id', $project_id))
            ->when($request->query('category_id'),
                fn($q, $category_id) => $q->where('category_id', $category_id))
            ->when($request->query('parent_task_id'),
                fn($q, $parent_task_id) => $q->where('parent_task_id', $parent_task_id))
            ->when($request->query('status'),
                fn($q, $status) => $q->where('status', $status))
            // Date Filters
            ->when($request->query('due_date_from'),
                fn($q, $date) => $q->whereDate('due_date', '>=', $date))
            ->when($request->query('due_date_to'),
                fn($q, $date) => $q->whereDate('due_date', '<=', $date))
            // Global search
            ->when($request->query('search'), fn($q, $search) => $q
                ->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                }))
            // Sort
            ->orderBy($sortBy, $sortOrder)->paginate($perPage)->appends($request->query());

        return TaskResource::collection($tasks)->additional(['success' => true]);
    }

    public function store(TaskCreateRequest $request)
    {
        $task = Task::create($request->validated());
        return TaskResource::make($task->load(['users.assignment.assignedBy', 'clientDirect',
            'clientViaProject', 'project', 'category', 'attachments', 'parent', 'children']))
            ->additional(['success' => true, 'message'
            => __('api.created', ['resource' => __('resources.task')])])
            ->response()->setStatusCode(201);
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return TaskResource::make($task->load(['users.assignment.assignedBy', 'clientDirect',
            'clientViaProject', 'project', 'category', 'attachments', 'parent', 'children']))
            ->additional(['success' => true]);
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        $task->update($request->validated());
        return TaskResource::make($task->load(['users.assignment.assignedBy', 'clientDirect',
            'clientViaProject', 'project', 'category', 'attachments', 'parent', 'children']))
            ->additional(['success' => true, 'message'
            => __('api.updated', ['resource' => __('resources.task')])]);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['success' => true, 'message'
        => __('api.deleted', ['resource' => __('resources.task')])]);
    }

    public function assignUsers(TaskUserRequest $request, Task $task)
    {
        $task->users()->attach($request->validated('user_ids'));
        return TaskResource::make($task->load(['users.assignment.assignedBy', 'clientDirect',
            'clientViaProject', 'project', 'category', 'attachments', 'parent', 'children']))
            ->additional(['success' => true, 'message' => __('api.task_assigned')]);
    }

    public function unassignUsers(TaskUserRequest $request, Task $task)
    {
        $task->users()->detach($request->validated('user_ids'));
        return TaskResource::make($task->load(['users.assignment.assignedBy', 'clientDirect',
            'clientViaProject', 'project', 'category', 'attachments', 'parent', 'children']))
            ->additional(['success' => true, 'message' => __('api.task_unassigned')]);
    }

    public function changeStatus(TaskStatusRequest $request, Task $task)
    {
        $this->authorize('changeStatus', $task);

        $task->update($request->validated());
        return TaskResource::make($task->load(['users.assignment.assignedBy', 'clientDirect',
            'clientViaProject', 'project', 'category', 'attachments', 'parent', 'children']))
            ->additional(['success' => true, 'message'
            => __('api.status_updated', ['resource' => __('resources.task')])]);
    }
}

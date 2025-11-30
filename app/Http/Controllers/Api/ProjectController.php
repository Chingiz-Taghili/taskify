<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectCreateRequest;
use App\Http\Requests\ProjectFilterRequest;
use App\Http\Requests\ProjectStatusRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(ProjectFilterRequest $request)
    {
        $perPage = $request->integer('per_page', 10);
        $sortBy = $request->query('sort_by', 'id');
        $sortOrder = $request->query('sort_order', 'asc');

        $projects = Project::with(['client', 'tasks', 'users'])
            // Filters
            ->when($request->query('client_id'),
                fn($q, $client_id) => $q->where('client_id', $client_id))
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
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                }))
            // Sort
            ->orderBy($sortBy, $sortOrder)->paginate($perPage)->appends($request->query());

        return ProjectResource::collection($projects)->additional(['success' => true]);
    }

    public function store(ProjectCreateRequest $request)
    {
        $project = Project::create($request->validated());
        return ProjectResource::make($project->load(['client', 'tasks', 'users']))
            ->additional(['success' => true, 'message' => 'Project created successfully'])
            ->response()->setStatusCode(201);
    }

    public function show(Project $project)
    {
        return ProjectResource::make($project->load([
            'client', 'tasks', 'users']))->additional(['success' => true]);
    }

    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $project->update($request->validated());
        return ProjectResource::make($project->load(['client', 'tasks', 'users']))
            ->additional(['success' => true, 'message' => 'Project updated successfully']);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['success' => true, 'message' => 'Project deleted successfully']);
    }

    public function changeStatus(ProjectStatusRequest $request, Project $project)
    {
        $project->update($request->validated());
        return ProjectResource::make($project->load(['client', 'tasks', 'users']))
            ->additional(['success' => true, 'message' => 'Project status updated successfully']);
    }
}

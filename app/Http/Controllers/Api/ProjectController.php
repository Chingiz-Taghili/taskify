<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectCreateRequest;
use App\Http\Requests\ProjectStatusRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['client', 'tasks'])->get();
        return ProjectResource::collection($projects)->additional(['success' => true]);
    }

    public function store(ProjectCreateRequest $request)
    {
        $project = Project::create($request->validated());
        return (new ProjectResource($project->load(['client', 'tasks'])))
            ->additional(['success' => true, 'message' => 'Project created successfully'])
            ->response()->setStatusCode(201);
    }

    public function show(Project $project)
    {
        return (new ProjectResource($project->load(['client', 'tasks'])))->additional(['success' => true]);
    }

    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $project->update($request->validated());
        return (new ProjectResource($project->load(['client', 'tasks'])))
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
        return (new ProjectResource($project->load(['client', 'tasks'])))
            ->additional(['success' => true, 'message' => 'Project status updated successfully']);
    }
}

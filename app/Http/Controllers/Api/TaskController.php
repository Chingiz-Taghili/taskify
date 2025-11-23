<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskAssignRequest;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskStatusRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->integer('per_page', 10);
        $sortBy = $request->query('sort_by', 'id');
        $sortOrder = $request->query('sort_order', 'asc');

        $tasks = Task::with(['users', 'client', 'project',
            'category', 'attachments', 'parent', 'children'])
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
        return (new TaskResource($task->load(['users', 'client',
            'project', 'category', 'attachments', 'parent', 'children'])))
            ->additional(['success' => true, 'message' => 'Task created successfully'])
            ->response()->setStatusCode(201);
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return (new TaskResource($task->load(['users', 'client',
            'project', 'category', 'attachments', 'parent', 'children'])))
            ->additional(['success' => true]);
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        $task->update($request->validated());
        return (new TaskResource($task->load(['users', 'client',
            'project', 'category', 'attachments', 'parent', 'children'])))
            ->additional(['success' => true, 'message' => 'Task updated successfully']);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['success' => true, 'message' => 'Task deleted successfully']);
    }

    public function assign(TaskAssignRequest $request, Task $task)
    {
        $task->users()->attach($request->validated());
        return (new TaskResource($task->load(['users', 'client',
            'project', 'category', 'attachments', 'parent', 'children'])))
            ->additional(['success' => true, 'message' => 'Task assigned successfully']);
    }

    public function unassign(TaskAssignRequest $request, Task $task)
    {
        $task->users()->detach($request->validated());
        return (new TaskResource($task->load(['users', 'client',
            'project', 'category', 'attachments', 'parent', 'children'])))
            ->additional(['success' => true, 'message' => 'Task unassigned successfully']);
    }

    public function changeStatus(TaskStatusRequest $request, Task $task)
    {
        $this->authorize('changeStatus', $task);

        $task->update($request->validated());
        return (new TaskResource($task->load(['users', 'client',
            'project', 'category', 'attachments', 'parent', 'children'])))
            ->additional(['success' => true, 'message' => 'Task status updated successfully']);
    }
}

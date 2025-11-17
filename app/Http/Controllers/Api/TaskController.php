<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskStatusRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['user', 'client', 'project',
            'category', 'assignedBy', 'attachments', 'parent', 'children'])->get();
        return TaskResource::collection($tasks)->additional(['success' => true]);
    }

    public function store(TaskCreateRequest $request)
    {
        $task = Task::create($request->validated());
        return (new TaskResource($task->load(['user', 'client',
            'project', 'category', 'assignedBy', 'attachments', 'parent', 'children'])))
            ->additional(['success' => true, 'message' => 'Task created successfully'])
            ->response()->setStatusCode(201);
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return (new TaskResource($task->load(['user', 'client',
            'project', 'category', 'assignedBy', 'attachments', 'parent', 'children'])))
            ->additional(['success' => true]);
    }

    public function update(TaskUpdateRequest $request, Task $task)
    {
        $task->update($request->validated());
        return (new TaskResource($task->load(['user', 'client',
            'project', 'category', 'assignedBy', 'attachments', 'parent', 'children'])))
            ->additional(['success' => true, 'message' => 'Task updated successfully']);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['success' => true, 'message' => 'Task deleted successfully']);
    }

    public function changeStatus(TaskStatusRequest $request, Task $task)
    {
        $this->authorize('changeStatus', $task);

        $task->update($request->validated());
        return (new TaskResource($task->load(['user', 'client',
            'project', 'category', 'assignedBy', 'attachments', 'parent', 'children'])))
            ->additional(['success' => true, 'message' => 'Task status updated successfully']);
    }
}

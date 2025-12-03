<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskAttachmentCreateRequest;
use App\Http\Requests\Task\TaskAttachmentUpdateRequest;
use App\Http\Resources\TaskAttachmentResource;
use App\Models\Task;
use App\Models\TaskAttachment;

class TaskAttachmentController extends Controller
{
    public function index(Task $task)
    {
        $this->authorize('view', $task);
        $attachments = $task->attachments()->get();
        return TaskAttachmentResource::collection($attachments)->additional(['success' => true]);
    }

    public function store(TaskAttachmentCreateRequest $request, Task $task)
    {
        $attachment = $task->attachments()->create($request->validated());
        return TaskAttachmentResource::make($attachment)
            ->additional(['success' => true, 'message'
            => __('api.uploaded', ['resource' => __('resources.attachment')])])
            ->response()->setStatusCode(201);
    }

    public function show(Task $task, TaskAttachment $attachment)
    {
        $this->authorize('view', $task);

        if ($attachment->task_id !== $task->id) {
            abort(404, 'Attachment not found in this task.');
        }
        return TaskAttachmentResource::make($attachment)->additional(['success' => true]);
    }

    public function update(TaskAttachmentUpdateRequest $request, Task $task, TaskAttachment $attachment)
    {
        if ($attachment->task_id !== $task->id) {
            abort(404, 'Attachment not found in this task.');
        }
        $attachment->update($request->validated());
        return TaskAttachmentResource::make($attachment)
            ->additional(['success' => true, 'message'
            => __('api.updated', ['resource' => __('resources.attachment')])]);
    }

    public function destroy(Task $task, TaskAttachment $attachment)
    {
        if ($attachment->task_id !== $task->id) {
            abort(404, 'Attachment not found in this task.');
        }
        $attachment->delete();
        return response()->json(['success' => true, 'message'
        => __('api.deleted', ['resource' => __('resources.attachment')])]);
    }
}

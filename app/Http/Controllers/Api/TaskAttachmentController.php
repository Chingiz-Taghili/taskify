<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskAttachmentCreateRequest;
use App\Http\Requests\TaskAttachmentUpdateRequest;
use App\Models\Task;
use App\Models\TaskAttachment;
use Illuminate\Http\Request;

class TaskAttachmentController extends Controller
{
    public function index(Task $task)
    {
        //
    }

    public function store(TaskAttachmentCreateRequest $request, Task $task)
    {
        //
    }

    public function show(Task $task, TaskAttachment $attachment)
    {
        //
    }

    public function update(TaskAttachmentUpdateRequest $request, Task $task, TaskAttachment $attachment)
    {
        //
    }

    public function destroy(Task $task, TaskAttachment $attachment)
    {
        //
    }
}

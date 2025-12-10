<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->integer('per_page', 10);
        $sortBy = $request->query('sort_by', 'id');
        $sortOrder = $request->query('sort_order', 'asc');

        $categories = Activity::with(['tasks', 'users'])
            // Sort
            ->latest()->orderBy($sortBy, $sortOrder)->paginate($perPage)->appends($request->query());

        return ActivityResource::collection($categories)->additional(['success' => true]);
    }
}

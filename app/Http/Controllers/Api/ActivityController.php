<?php

namespace App\Http\Controllers\Api;

use App\Enums\SubjectType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Activity\ActivityFilterRequest;
use App\Http\Resources\ActivityResource;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function index(ActivityFilterRequest $request)
    {
        $perPage = $request->integer('per_page', 10);
        $sortBy = $request->query('sort_by', 'created_at');
        $sortOrder = $request->query('sort_order', 'desc');

        $activities = Activity::with(['causer', 'subject'])
            // Filters
            ->when($request->query('causer_id'),
                fn($q, $causer_id) => $q->where('causer_id', $causer_id))
            ->when($request->filled('subject_type'),
                function ($q) use ($request) {
                    $type = SubjectType::from($request->query('subject_type'))->toFullType();
                    $q->where('subject_type', $type);
                })
            ->when($request->filled('subject_id'),
                fn($q) => $q->where('subject_id', $request->subject_id))
            ->when($request->query('log_name'),
                fn($q, $log_name) => $q->where('log_name', $log_name))
            ->when($request->query('event'),
                fn($q, $event) => $q->where('event', $event))
            // Date Filters
            ->when($request->query('created_from'),
                fn($q, $date) => $q->whereDate('created_at', '>=', $date))
            ->when($request->query('created_to'),
                fn($q, $date) => $q->whereDate('created_at', '<=', $date))
            // Sort
            ->orderBy($sortBy, $sortOrder)->paginate($perPage)->appends($request->query());

        return ActivityResource::collection($activities)->additional(['success' => true]);
    }
}

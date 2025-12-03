<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryFilterRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(CategoryFilterRequest $request)
    {
        $perPage = $request->integer('per_page', 10);
        $sortBy = $request->query('sort_by', 'id');
        $sortOrder = $request->query('sort_order', 'asc');

        $categories = Category::with(['tasks', 'users'])
            // Global search
            ->when($request->query('search'), fn($q, $search) => $q
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                }))
            // Sort
            ->orderBy($sortBy, $sortOrder)->paginate($perPage)->appends($request->query());

        return CategoryResource::collection($categories)->additional(['success' => true]);
    }

    public function store(CategoryCreateRequest $request)
    {
        $category = Category::create($request->validated());
        return CategoryResource::make($category->load(['tasks', 'users']))
            ->additional(['success' => true, 'message'
            => __('api.created', ['resource' => __('resources.category')])])
            ->response()->setStatusCode(201);
    }

    public function show(Category $category)
    {
        return CategoryResource::make($category->load(['tasks', 'users']))->additional(['success' => true]);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->validated());
        return CategoryResource::make($category->load(['tasks', 'users']))
            ->additional(['success' => true, 'message'
            => __('api.updated', ['resource' => __('resources.category')])]);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['success' => true, 'message'
        => __('api.deleted', ['resource' => __('resources.category')])]);
    }
}

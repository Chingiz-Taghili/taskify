<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->integer('per_page', 10);
        $sortBy = $request->query('sort_by', 'id');
        $sortOrder = $request->query('sort_order', 'asc');

        $categories = Category::with(['tasks'])
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
        return (new CategoryResource($category->load(['tasks'])))
            ->additional(['success' => true, 'message' => 'Category created successfully'])
            ->response()->setStatusCode(201);
    }

    public function show(Category $category)
    {
        return (new CategoryResource($category->load(['tasks'])))->additional(['success' => true]);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->validated());
        return (new CategoryResource($category->load(['tasks'])))
            ->additional(['success' => true, 'message' => 'Category updated successfully']);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['success' => true, 'message' => 'Category deleted successfully']);
    }
}

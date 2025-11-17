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
    public function index()
    {
        $categories = Category::with(['tasks'])->get();
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

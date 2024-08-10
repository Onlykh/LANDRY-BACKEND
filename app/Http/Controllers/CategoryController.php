<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequests\CategoryStoreRequest;
use App\Http\Requests\CategoryRequests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResources\CategoryResource;
use App\Http\Resources\CategoryResources\CategoryCollection;
use App\Services\CategoryServices\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{

    public function __construct(private CategoryService $categoryService) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Gate::authorize('viewAny', Category::class);

        $categories = $this->categoryService->all($request->all());

        return response()->json(
            new CategoryCollection($categories)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function store(CategoryStoreRequest $request): JsonResponse
    {
        $category = $this->categoryService
            ->create($request->validated());

        return response()->json(
            [
                'message' => __('actions.success'),
                'data' => new CategoryResource($category)
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @return JsonResponse
     */
    public function show($id, Request $request): JsonResponse
    {
        $category = $this->categoryService->findById($id, $request->input('with', []));
        if (!$category) {
            return response()->json(['message' => 'category ' . __('Not Found')], 404);
        }
        // Gate::authorize('view', $category);

        return response()->json(new CategoryResource($category));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return JsonResponse
     */
    public function update(CategoryUpdateRequest $request, int $id): JsonResponse
    {
        $category = $this->categoryService->findById($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category = $this->categoryService->update($category, $request->validated());

        return response()->json([
            'message' => __('actions.success'),
            'data' => new CategoryResource($category)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $category = $this->categoryService->findById($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $this->categoryService->delete($category);

        return response()->json(['message' => __('actions.success')], 204);
    }
}

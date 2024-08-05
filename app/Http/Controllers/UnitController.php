<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Http\Requests\UnitRequests\UnitStoreRequest;
use App\Http\Requests\UnitRequests\UnitUpdateRequest;
use App\Http\Resources\UnitResources\UnitResource;
use App\Http\Resources\UnitResources\UnitCollection;
use App\Services\UnitServices\UnitService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UnitController extends Controller
{

    public function __construct(private UnitService $unitService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Gate::authorize('viewAny', Unit::class);

        $units = $this->unitService->all($request->all());

        return response()->json(
            new UnitCollection($units)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function store(UnitStoreRequest $request): JsonResponse
    {
        $unit = $this->unitService
            ->create($request->validated());

        return response()->json(
            [
                'message' => __('actions.success'),
                'data' => new UnitResource($unit)
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
        $unit = $this->unitService->findById($id, $request->input('with', []));
        if (!$unit) {
            return response()->json(['message' => 'unit ' . __('Not Found')], 404);
        }
        // Gate::authorize('view', $unit);

        return response()->json(new UnitResource($unit));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return JsonResponse
     */
    public function update(UnitUpdateRequest $request, int $id): JsonResponse
    {
        $unit = $this->unitService->findById($id);
        if (!$unit) {
            return response()->json(['message' => 'Unit not found'], 404);
        }

        $unit = $this->unitService->update($unit, $request->validated());

        return response()->json([
            'message' => __('actions.success'),
            'data' => new UnitResource($unit)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $unit = $this->unitService->findById($id);
        if (!$unit) {
            return response()->json(['message' => 'Unit not found'], 404);
        }

        $this->unitService->delete($unit);

        return response()->json(['message' => __('actions.success')], 204);
    }
}

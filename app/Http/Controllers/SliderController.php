<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Http\Requests\SliderRequests\SliderStoreRequest;
use App\Http\Requests\SliderRequests\SliderUpdateRequest;
use App\Http\Resources\SliderResources\SliderResource;
use App\Http\Resources\SliderResources\SliderCollection;
use App\Services\SliderServices\SliderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SliderController extends Controller
{

    public function __construct(private SliderService $sliderService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Gate::authorize('viewAny', Slider::class);

        $sliders = $this->sliderService->all($request->all());

        return response()->json(
            new SliderCollection($sliders)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function store(SliderStoreRequest $request): JsonResponse
    {
        $slider = $this->sliderService
            ->create($request->validated());

        return response()->json(
            [
                'message' => __('actions.success'),
                'data' => new SliderResource($slider)
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
        $slider = $this->sliderService->findById($id, $request->input('with', []));
        if (!$slider) {
            return response()->json(['message' => 'slider ' . __('Not Found')], 404);
        }
        // Gate::authorize('view', $slider);

        return response()->json(new SliderResource($slider));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return JsonResponse
     */
    public function update(SliderUpdateRequest $request, int $id): JsonResponse
    {
        $slider = $this->sliderService->findById($id);
        if (!$slider) {
            return response()->json(['message' => 'Slider not found'], 404);
        }

        $slider = $this->sliderService->update($slider, $request->validated());

        return response()->json([
            'message' => __('actions.success'),
            'data' => new SliderResource($slider)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $slider = $this->sliderService->findById($id);
        if (!$slider) {
            return response()->json(['message' => 'Slider not found'], 404);
        }

        $this->sliderService->delete($slider);

        return response()->json(['message' => __('actions.success')], 204);
    }
}

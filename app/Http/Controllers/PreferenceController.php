<?php

    namespace App\Http\Controllers;

    use App\Models\Preference;
    use App\Http\Requests\PreferenceRequests\PreferenceStoreRequest;
    use App\Http\Requests\PreferenceRequests\PreferenceUpdateRequest;
    use App\Http\Resources\PreferenceResources\PreferenceResource;
    use App\Http\Resources\PreferenceResources\PreferenceCollection;
    use App\Services\PreferenceServices\PreferenceService;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Gate;

    class PreferenceController extends Controller
    {

        public function __construct(private PreferenceService $preferenceService)
        {
        }

        /**
        * Display a listing of the resource.
        *
        * @return \Illuminate\Http\Response
        */
        public function index(Request $request)
        {
            Gate::authorize('viewAny', Preference::class);

            $preferences = $this->preferenceService->all($request->all());

            return response()->json(
                new PreferenceCollection($preferences)
            );
        }

        /**
        * Store a newly created resource in storage.
        *
        * @return JsonResponse
        */
        public function store(PreferenceStoreRequest $request): JsonResponse
        {
            $preference= $this->preferenceService
                ->create($request->validated());

            return response()->json(
                [
                    'message' => __('actions.success'),
                    'data' => new PreferenceResource($preference)
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
            $preference = $this->preferenceService->findById($id, $request->input('with',[]));
            if (!$preference) {
                return response()->json(['message' => 'preference '.__('Not Found')], 404);
            }
            Gate::authorize('view', $preference);

            return response()->json(new PreferenceResource ($preference));
        }

        /**
         * Update the specified resource in storage.
        *
        * @return JsonResponse
        */
        public function update(PreferenceUpdateRequest $request, int $id): JsonResponse
        {
            $preference = $this->preferenceService->findById($id);
            if (!$preference) {
                return response()->json(['message' => 'Preference not found'], 404);
            }

            $preference = $this->preferenceService->update($preference, $request->validated());

            return response()->json([
                'message' => __('actions.success'),
                'data' => new PreferenceResource($preference)
            ], 200);
        }

        /**
        * Remove the specified resource from storage.
        *
        * @return JsonResponse
        */
        public function destroy(int $id): JsonResponse
        {
            $preference = $this->preferenceService->findById($id);
            if (!$preference) {
                return response()->json(['message' => 'Preference not found'], 404);
            }

            $this->preferenceService->delete($preference);

            return response()->json(['message' => __('actions.success')], 204);
        }
    }

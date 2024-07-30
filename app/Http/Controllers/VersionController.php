<?php

    namespace App\Http\Controllers;

    use App\Models\Version;
    use App\Http\Requests\VersionRequests\VersionStoreRequest;
    use App\Http\Requests\VersionRequests\VersionUpdateRequest;
    use App\Http\Resources\VersionResources\VersionResource;
    use App\Http\Resources\VersionResources\VersionCollection;
    use App\Services\VersionServices\VersionService;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Gate;

    class VersionController extends Controller
    {

        public function __construct(private VersionService $versionService)
        {
        }

        /**
        * Display a listing of the resource.
        *
        * @return \Illuminate\Http\Response
        */
        public function index(Request $request)
        {
            Gate::authorize('viewAny', Version::class);

            $versions = $this->versionService->all($request->all());

            return response()->json(
                new VersionCollection($versions)
            );
        }

        /**
        * Store a newly created resource in storage.
        *
        * @return JsonResponse
        */
        public function store(VersionStoreRequest $request): JsonResponse
        {
            $version= $this->versionService
                ->create($request->validated());

            return response()->json(
                [
                    'message' => __('actions.success'),
                    'data' => new VersionResource($version)
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
            $version = $this->versionService->findById($id, $request->input('with',[]));
            if (!$version) {
                return response()->json(['message' => 'version '.__('Not Found')], 404);
            }
            Gate::authorize('view', $version);

            return response()->json(new VersionResource ($version));
        }

        /**
         * Update the specified resource in storage.
        *
        * @return JsonResponse
        */
        public function update(VersionUpdateRequest $request, int $id): JsonResponse
        {
            $version = $this->versionService->findById($id);
            if (!$version) {
                return response()->json(['message' => 'Version not found'], 404);
            }

            $version = $this->versionService->update($version, $request->validated());

            return response()->json([
                'message' => __('actions.success'),
                'data' => new VersionResource($version)
            ], 200);
        }

        /**
        * Remove the specified resource from storage.
        *
        * @return JsonResponse
        */
        public function destroy(int $id): JsonResponse
        {
            $version = $this->versionService->findById($id);
            if (!$version) {
                return response()->json(['message' => 'Version not found'], 404);
            }

            $this->versionService->delete($version);

            return response()->json(['message' => __('actions.success')], 204);
        }
    }

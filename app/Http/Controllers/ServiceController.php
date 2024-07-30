<?php

    namespace App\Http\Controllers;

    use App\Models\Service;
    use App\Http\Requests\ServiceRequests\ServiceStoreRequest;
    use App\Http\Requests\ServiceRequests\ServiceUpdateRequest;
    use App\Http\Resources\ServiceResources\ServiceResource;
    use App\Http\Resources\ServiceResources\ServiceCollection;
    use App\Services\ServiceServices\ServiceService;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Gate;

    class ServiceController extends Controller
    {

        public function __construct(private ServiceService $serviceService)
        {
        }

        /**
        * Display a listing of the resource.
        *
        * @return \Illuminate\Http\Response
        */
        public function index(Request $request)
        {
            Gate::authorize('viewAny', Service::class);

            $services = $this->serviceService->all($request->all());

            return response()->json(
                new ServiceCollection($services)
            );
        }

        /**
        * Store a newly created resource in storage.
        *
        * @return JsonResponse
        */
        public function store(ServiceStoreRequest $request): JsonResponse
        {
            $service= $this->serviceService
                ->create($request->validated());

            return response()->json(
                [
                    'message' => __('actions.success'),
                    'data' => new ServiceResource($service)
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
            $service = $this->serviceService->findById($id, $request->input('with',[]));
            if (!$service) {
                return response()->json(['message' => 'service '.__('Not Found')], 404);
            }
            Gate::authorize('view', $service);

            return response()->json(new ServiceResource ($service));
        }

        /**
         * Update the specified resource in storage.
        *
        * @return JsonResponse
        */
        public function update(ServiceUpdateRequest $request, int $id): JsonResponse
        {
            $service = $this->serviceService->findById($id);
            if (!$service) {
                return response()->json(['message' => 'Service not found'], 404);
            }

            $service = $this->serviceService->update($service, $request->validated());

            return response()->json([
                'message' => __('actions.success'),
                'data' => new ServiceResource($service)
            ], 200);
        }

        /**
        * Remove the specified resource from storage.
        *
        * @return JsonResponse
        */
        public function destroy(int $id): JsonResponse
        {
            $service = $this->serviceService->findById($id);
            if (!$service) {
                return response()->json(['message' => 'Service not found'], 404);
            }

            $this->serviceService->delete($service);

            return response()->json(['message' => __('actions.success')], 204);
        }
    }

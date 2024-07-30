<?php

    namespace App\Http\Controllers;

    use App\Models\OrderHeader;
    use App\Http\Requests\OrderHeaderRequests\OrderHeaderStoreRequest;
    use App\Http\Requests\OrderHeaderRequests\OrderHeaderUpdateRequest;
    use App\Http\Resources\OrderHeaderResources\OrderHeaderResource;
    use App\Http\Resources\OrderHeaderResources\OrderHeaderCollection;
    use App\Services\OrderHeaderServices\OrderHeaderService;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Gate;

    class OrderHeaderController extends Controller
    {

        public function __construct(private OrderHeaderService $orderHeaderService)
        {
        }

        /**
        * Display a listing of the resource.
        *
        * @return \Illuminate\Http\Response
        */
        public function index(Request $request)
        {
            Gate::authorize('viewAny', OrderHeader::class);

            $orderHeaders = $this->orderHeaderService->all($request->all());

            return response()->json(
                new OrderHeaderCollection($orderHeaders)
            );
        }

        /**
        * Store a newly created resource in storage.
        *
        * @return JsonResponse
        */
        public function store(OrderHeaderStoreRequest $request): JsonResponse
        {
            $orderHeader= $this->orderHeaderService
                ->create($request->validated());

            return response()->json(
                [
                    'message' => __('actions.success'),
                    'data' => new OrderHeaderResource($orderHeader)
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
            $orderHeader = $this->orderHeaderService->findById($id, $request->input('with',[]));
            if (!$orderHeader) {
                return response()->json(['message' => 'order header '.__('Not Found')], 404);
            }
            Gate::authorize('view', $orderHeader);

            return response()->json(new OrderHeaderResource ($orderHeader));
        }

        /**
         * Update the specified resource in storage.
        *
        * @return JsonResponse
        */
        public function update(OrderHeaderUpdateRequest $request, int $id): JsonResponse
        {
            $orderHeader = $this->orderHeaderService->findById($id);
            if (!$orderHeader) {
                return response()->json(['message' => 'OrderHeader not found'], 404);
            }

            $orderHeader = $this->orderHeaderService->update($orderHeader, $request->validated());

            return response()->json([
                'message' => __('actions.success'),
                'data' => new OrderHeaderResource($orderHeader)
            ], 200);
        }

        /**
        * Remove the specified resource from storage.
        *
        * @return JsonResponse
        */
        public function destroy(int $id): JsonResponse
        {
            $orderHeader = $this->orderHeaderService->findById($id);
            if (!$orderHeader) {
                return response()->json(['message' => 'OrderHeader not found'], 404);
            }

            $this->orderHeaderService->delete($orderHeader);

            return response()->json(['message' => __('actions.success')], 204);
        }
    }

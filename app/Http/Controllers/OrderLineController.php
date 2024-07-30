<?php

    namespace App\Http\Controllers;

    use App\Models\OrderLine;
    use App\Http\Requests\OrderLineRequests\OrderLineStoreRequest;
    use App\Http\Requests\OrderLineRequests\OrderLineUpdateRequest;
    use App\Http\Resources\OrderLineResources\OrderLineResource;
    use App\Http\Resources\OrderLineResources\OrderLineCollection;
    use App\Services\OrderLineServices\OrderLineService;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Gate;

    class OrderLineController extends Controller
    {

        public function __construct(private OrderLineService $orderLineService)
        {
        }

        /**
        * Display a listing of the resource.
        *
        * @return \Illuminate\Http\Response
        */
        public function index(Request $request)
        {
            Gate::authorize('viewAny', OrderLine::class);

            $orderLines = $this->orderLineService->all($request->all());

            return response()->json(
                new OrderLineCollection($orderLines)
            );
        }

        /**
        * Store a newly created resource in storage.
        *
        * @return JsonResponse
        */
        public function store(OrderLineStoreRequest $request): JsonResponse
        {
            $orderLine= $this->orderLineService
                ->create($request->validated());

            return response()->json(
                [
                    'message' => __('actions.success'),
                    'data' => new OrderLineResource($orderLine)
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
            $orderLine = $this->orderLineService->findById($id, $request->input('with',[]));
            if (!$orderLine) {
                return response()->json(['message' => 'order line '.__('Not Found')], 404);
            }
            Gate::authorize('view', $orderLine);

            return response()->json(new OrderLineResource ($orderLine));
        }

        /**
         * Update the specified resource in storage.
        *
        * @return JsonResponse
        */
        public function update(OrderLineUpdateRequest $request, int $id): JsonResponse
        {
            $orderLine = $this->orderLineService->findById($id);
            if (!$orderLine) {
                return response()->json(['message' => 'OrderLine not found'], 404);
            }

            $orderLine = $this->orderLineService->update($orderLine, $request->validated());

            return response()->json([
                'message' => __('actions.success'),
                'data' => new OrderLineResource($orderLine)
            ], 200);
        }

        /**
        * Remove the specified resource from storage.
        *
        * @return JsonResponse
        */
        public function destroy(int $id): JsonResponse
        {
            $orderLine = $this->orderLineService->findById($id);
            if (!$orderLine) {
                return response()->json(['message' => 'OrderLine not found'], 404);
            }

            $this->orderLineService->delete($orderLine);

            return response()->json(['message' => __('actions.success')], 204);
        }
    }

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequests\UserStoreRequest;
use App\Http\Requests\UserRequests\UserUpdateRequest;
use App\Http\Resources\UserResources\UserResource;
use App\Http\Resources\UserResources\UserCollection;
use App\Services\UserServices\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function __construct(private UserService $userService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Gate::authorize('viewAny', User::class);

        $users = $this->userService->all($request->all());

        return response()->json(
            new UserCollection($users)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        $user = $this->userService
            ->create($request->validated());

        return response()->json(
            [
                'message' => __('actions.success'),
                'data' => new UserResource($user)
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
        $user = $this->userService->findById($id, $request->input('with', []));
        if (!$user) {
            return response()->json(['message' => 'user ' . __('Not Found')], 404);
        }
        // Gate::authorize('view', $user);

        return response()->json(new UserResource($user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return JsonResponse
     */
    public function update(UserUpdateRequest $request, int $id): JsonResponse
    {
        $user = $this->userService->findById($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user = $this->userService->update($user, $request->validated());

        return response()->json([
            'message' => __('actions.success'),
            'data' => new UserResource($user)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $user = $this->userService->findById($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $this->userService->delete($user);

        return response()->json(['message' => __('actions.success')], 204);
    }
}

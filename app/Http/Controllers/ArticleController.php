<?php

    namespace App\Http\Controllers;

    use App\Models\Article;
    use App\Http\Requests\ArticleRequests\ArticleStoreRequest;
    use App\Http\Requests\ArticleRequests\ArticleUpdateRequest;
    use App\Http\Resources\ArticleResources\ArticleResource;
    use App\Http\Resources\ArticleResources\ArticleCollection;
    use App\Services\ArticleServices\ArticleService;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Gate;

    class ArticleController extends Controller
    {

        public function __construct(private ArticleService $articleService)
        {
        }

        /**
        * Display a listing of the resource.
        *
        * @return \Illuminate\Http\Response
        */
        public function index(Request $request)
        {
            Gate::authorize('viewAny', Article::class);

            $articles = $this->articleService->all($request->all());

            return response()->json(
                new ArticleCollection($articles)
            );
        }

        /**
        * Store a newly created resource in storage.
        *
        * @return JsonResponse
        */
        public function store(ArticleStoreRequest $request): JsonResponse
        {
            $article= $this->articleService
                ->create($request->validated());

            return response()->json(
                [
                    'message' => __('actions.success'),
                    'data' => new ArticleResource($article)
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
            $article = $this->articleService->findById($id, $request->input('with',[]));
            if (!$article) {
                return response()->json(['message' => 'article '.__('Not Found')], 404);
            }
            Gate::authorize('view', $article);

            return response()->json(new ArticleResource ($article));
        }

        /**
         * Update the specified resource in storage.
        *
        * @return JsonResponse
        */
        public function update(ArticleUpdateRequest $request, int $id): JsonResponse
        {
            $article = $this->articleService->findById($id);
            if (!$article) {
                return response()->json(['message' => 'Article not found'], 404);
            }

            $article = $this->articleService->update($article, $request->validated());

            return response()->json([
                'message' => __('actions.success'),
                'data' => new ArticleResource($article)
            ], 200);
        }

        /**
        * Remove the specified resource from storage.
        *
        * @return JsonResponse
        */
        public function destroy(int $id): JsonResponse
        {
            $article = $this->articleService->findById($id);
            if (!$article) {
                return response()->json(['message' => 'Article not found'], 404);
            }

            $this->articleService->delete($article);

            return response()->json(['message' => __('actions.success')], 204);
        }
    }

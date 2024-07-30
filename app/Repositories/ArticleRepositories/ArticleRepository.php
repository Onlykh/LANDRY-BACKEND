<?php

    namespace App\Repositories\ArticleRepositories;

    use App\Models\Article;
    use App\Repositories\ArticleRepositories\ArticleRepositoryInterface;

    class ArticleRepository implements ArticleRepositoryInterface {

        public function __construct(private Article $article)
        {
        }

        public function all($filters = [])
        {
            $article = $this->article->filter($filters);

            if (isset($filters['select'])) {
                $article->select($filters['select']);
            }

            if (isset($filters['order_by'])) {
                $article->orderBy($filters['order_by'], $filters['order'] ?? 'asc');
            }

            if (isset($filters['with'])) {
                $article->with($filters['with']);
            }

            return $filters['paginated'] ?? false
                ? $article->paginate($filters['page_size'] ?? 10)
                : $article->get();
        }

        public function findById($id, $with)
        {
            return $this->article->with($with)->find($id);
        }

        public function create(array $data)
        {
            return $this->article->create($data);
        }

        public function update(Article $article, array $data)
        {
            $article->update($data);
            return $article;
        }

        public function delete(Article $article)
        {
            $article->delete();
        }
    }

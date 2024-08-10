<?php

namespace App\Services\ArticleServices;

use App\Services\ArticleServices\ArticleServiceInterface;
use App\Repositories\ArticleRepositories\ArticleRepository;
use App\Models\Article;

class ArticleService implements ArticleServiceInterface
{

    public function __construct(private ArticleRepository $articleRepository) {}

    public function all($filters = [])
    {
        return $this->articleRepository->all($filters);
    }

    public function findById($id, $with = [])
    {
        return $this->articleRepository->findById($id, $with);
    }

    public function create(array $data)
    {
        try {
            if (isset($data['image'])) {
                $filePath = uploadFile($data['image'], 'articles');
                $data['image'] = $filePath;
            }
            if (isset($data['icon'])) {
                $filePath = uploadFile($data['icon'], 'articles');
                $data['icon'] = $filePath;
            }
            return $this->articleRepository->create($data);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function update(Article $article, array $data)
    {
        return $this->articleRepository->update($article, $data);
    }

    public function delete(Article $article)
    {
        return $this->articleRepository->delete($article);
    }
}

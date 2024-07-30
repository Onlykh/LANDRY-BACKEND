<?php

    namespace App\Services\ArticleServices;

    use App\Models\Article;

    interface ArticleServiceInterface {
        public function all($filters = []);
        public function findById($id, $with = []);
        public function create(array $data);
        public function update(Article $article, array $data);
        public function delete(Article $article);
    }

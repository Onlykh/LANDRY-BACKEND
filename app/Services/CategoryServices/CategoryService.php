<?php

    namespace App\Services\CategoryServices;

    use App\Services\CategoryServices\CategoryServiceInterface;
    use App\Repositories\CategoryRepositories\CategoryRepository;
    use App\Models\Category;

    class CategoryService implements CategoryServiceInterface {

        public function __construct(private CategoryRepository $categoryRepository)
        {
        }

        public function all($filters = [])
        {
            return $this->categoryRepository->all($filters);
        }

        public function findById($id, $with= [])
        {
            return $this->categoryRepository->findById($id, $with);
        }

        public function create(array $data)
        {
            return $this->categoryRepository->create($data);
        }

        public function update(Category $category, array $data)
        {
            return $this->categoryRepository->update($category, $data);
        }

        public function delete(Category $category)
        {
            return $this->categoryRepository->delete($category);
        }
    }

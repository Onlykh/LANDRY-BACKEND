<?php

    namespace App\Repositories\CategoryRepositories;

    use App\Models\Category;
    use App\Repositories\CategoryRepositories\CategoryRepositoryInterface;

    class CategoryRepository implements CategoryRepositoryInterface {

        public function __construct(private Category $category)
        {
        }

        public function all($filters = [])
        {
            $category = $this->category->filter($filters);

            if (isset($filters['select'])) {
                $category->select($filters['select']);
            }

            if (isset($filters['order_by'])) {
                $category->orderBy($filters['order_by'], $filters['order'] ?? 'asc');
            }

            if (isset($filters['with'])) {
                $category->with($filters['with']);
            }

            return $filters['paginated'] ?? false
                ? $category->paginate($filters['page_size'] ?? 10)
                : $category->get();
        }

        public function findById($id, $with)
        {
            return $this->category->with($with)->find($id);
        }

        public function create(array $data)
        {
            return $this->category->create($data);
        }

        public function update(Category $category, array $data)
        {
            $category->update($data);
            return $category;
        }

        public function delete(Category $category)
        {
            $category->delete();
        }
    }

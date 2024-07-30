<?php

    namespace App\Repositories\PreferenceRepositories;

    use App\Models\Preference;
    use App\Repositories\PreferenceRepositories\PreferenceRepositoryInterface;

    class PreferenceRepository implements PreferenceRepositoryInterface {

        public function __construct(private Preference $preference)
        {
        }

        public function all($filters = [])
        {
            $preference = $this->preference->filter($filters);

            if (isset($filters['select'])) {
                $preference->select($filters['select']);
            }

            if (isset($filters['order_by'])) {
                $preference->orderBy($filters['order_by'], $filters['order'] ?? 'asc');
            }

            if (isset($filters['with'])) {
                $preference->with($filters['with']);
            }

            return $filters['paginated'] ?? false
                ? $preference->paginate($filters['page_size'] ?? 10)
                : $preference->get();
        }

        public function findById($id, $with)
        {
            return $this->preference->with($with)->find($id);
        }

        public function create(array $data)
        {
            return $this->preference->create($data);
        }

        public function update(Preference $preference, array $data)
        {
            $preference->update($data);
            return $preference;
        }

        public function delete(Preference $preference)
        {
            $preference->delete();
        }
    }

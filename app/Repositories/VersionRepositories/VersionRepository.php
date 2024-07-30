<?php

    namespace App\Repositories\VersionRepositories;

    use App\Models\Version;
    use App\Repositories\VersionRepositories\VersionRepositoryInterface;

    class VersionRepository implements VersionRepositoryInterface {

        public function __construct(private Version $version)
        {
        }

        public function all($filters = [])
        {
            $version = $this->version->filter($filters);

            if (isset($filters['select'])) {
                $version->select($filters['select']);
            }

            if (isset($filters['order_by'])) {
                $version->orderBy($filters['order_by'], $filters['order'] ?? 'asc');
            }

            if (isset($filters['with'])) {
                $version->with($filters['with']);
            }

            return $filters['paginated'] ?? false
                ? $version->paginate($filters['page_size'] ?? 10)
                : $version->get();
        }

        public function findById($id, $with)
        {
            return $this->version->with($with)->find($id);
        }

        public function create(array $data)
        {
            return $this->version->create($data);
        }

        public function update(Version $version, array $data)
        {
            $version->update($data);
            return $version;
        }

        public function delete(Version $version)
        {
            $version->delete();
        }
    }

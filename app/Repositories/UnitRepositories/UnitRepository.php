<?php

    namespace App\Repositories\UnitRepositories;

    use App\Models\Unit;
    use App\Repositories\UnitRepositories\UnitRepositoryInterface;

    class UnitRepository implements UnitRepositoryInterface {

        public function __construct(private Unit $unit)
        {
        }

        public function all($filters = [])
        {
            $unit = $this->unit->filter($filters);

            if (isset($filters['select'])) {
                $unit->select($filters['select']);
            }

            if (isset($filters['order_by'])) {
                $unit->orderBy($filters['order_by'], $filters['order'] ?? 'asc');
            }

            if (isset($filters['with'])) {
                $unit->with($filters['with']);
            }

            return $filters['paginated'] ?? false
                ? $unit->paginate($filters['page_size'] ?? 10)
                : $unit->get();
        }

        public function findById($id, $with)
        {
            return $this->unit->with($with)->find($id);
        }

        public function create(array $data)
        {
            return $this->unit->create($data);
        }

        public function update(Unit $unit, array $data)
        {
            $unit->update($data);
            return $unit;
        }

        public function delete(Unit $unit)
        {
            $unit->delete();
        }
    }

<?php

    namespace App\Repositories\OrderHeaderRepositories;

    use App\Models\OrderHeader;
    use App\Repositories\OrderHeaderRepositories\OrderHeaderRepositoryInterface;

    class OrderHeaderRepository implements OrderHeaderRepositoryInterface {

        public function __construct(private OrderHeader $orderHeader)
        {
        }

        public function all($filters = [])
        {
            $orderHeader = $this->orderHeader->filter($filters);

            if (isset($filters['select'])) {
                $orderHeader->select($filters['select']);
            }

            if (isset($filters['order_by'])) {
                $orderHeader->orderBy($filters['order_by'], $filters['order'] ?? 'asc');
            }

            if (isset($filters['with'])) {
                $orderHeader->with($filters['with']);
            }

            return $filters['paginated'] ?? false
                ? $orderHeader->paginate($filters['page_size'] ?? 10)
                : $orderHeader->get();
        }

        public function findById($id, $with)
        {
            return $this->orderHeader->with($with)->find($id);
        }

        public function create(array $data)
        {
            return $this->orderHeader->create($data);
        }

        public function update(OrderHeader $orderHeader, array $data)
        {
            $orderHeader->update($data);
            return $orderHeader;
        }

        public function delete(OrderHeader $orderHeader)
        {
            $orderHeader->delete();
        }
    }

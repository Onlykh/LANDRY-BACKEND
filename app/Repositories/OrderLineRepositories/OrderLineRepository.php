<?php

    namespace App\Repositories\OrderLineRepositories;

    use App\Models\OrderLine;
    use App\Repositories\OrderLineRepositories\OrderLineRepositoryInterface;

    class OrderLineRepository implements OrderLineRepositoryInterface {

        public function __construct(private OrderLine $orderLine)
        {
        }

        public function all($filters = [])
        {
            $orderLine = $this->orderLine->filter($filters);

            if (isset($filters['select'])) {
                $orderLine->select($filters['select']);
            }

            if (isset($filters['order_by'])) {
                $orderLine->orderBy($filters['order_by'], $filters['order'] ?? 'asc');
            }

            if (isset($filters['with'])) {
                $orderLine->with($filters['with']);
            }

            return $filters['paginated'] ?? false
                ? $orderLine->paginate($filters['page_size'] ?? 10)
                : $orderLine->get();
        }

        public function findById($id, $with)
        {
            return $this->orderLine->with($with)->find($id);
        }

        public function create(array $data)
        {
            return $this->orderLine->create($data);
        }

        public function update(OrderLine $orderLine, array $data)
        {
            $orderLine->update($data);
            return $orderLine;
        }

        public function delete(OrderLine $orderLine)
        {
            $orderLine->delete();
        }
    }

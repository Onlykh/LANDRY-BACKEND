<?php

    namespace App\Services\OrderLineServices;

    use App\Services\OrderLineServices\OrderLineServiceInterface;
    use App\Repositories\OrderLineRepositories\OrderLineRepository;
    use App\Models\OrderLine;

    class OrderLineService implements OrderLineServiceInterface {

        public function __construct(private OrderLineRepository $orderLineRepository)
        {
        }

        public function all($filters = [])
        {
            return $this->orderLineRepository->all($filters);
        }

        public function findById($id, $with= [])
        {
            return $this->orderLineRepository->findById($id, $with);
        }

        public function create(array $data)
        {
            return $this->orderLineRepository->create($data);
        }

        public function update(OrderLine $orderLine, array $data)
        {
            return $this->orderLineRepository->update($orderLine, $data);
        }

        public function delete(OrderLine $orderLine)
        {
            return $this->orderLineRepository->delete($orderLine);
        }
    }

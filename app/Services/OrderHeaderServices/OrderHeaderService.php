<?php

    namespace App\Services\OrderHeaderServices;

    use App\Services\OrderHeaderServices\OrderHeaderServiceInterface;
    use App\Repositories\OrderHeaderRepositories\OrderHeaderRepository;
    use App\Models\OrderHeader;

    class OrderHeaderService implements OrderHeaderServiceInterface {

        public function __construct(private OrderHeaderRepository $orderHeaderRepository)
        {
        }

        public function all($filters = [])
        {
            return $this->orderHeaderRepository->all($filters);
        }

        public function findById($id, $with= [])
        {
            return $this->orderHeaderRepository->findById($id, $with);
        }

        public function create(array $data)
        {
            return $this->orderHeaderRepository->create($data);
        }

        public function update(OrderHeader $orderHeader, array $data)
        {
            return $this->orderHeaderRepository->update($orderHeader, $data);
        }

        public function delete(OrderHeader $orderHeader)
        {
            return $this->orderHeaderRepository->delete($orderHeader);
        }
    }

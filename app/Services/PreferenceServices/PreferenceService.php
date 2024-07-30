<?php

    namespace App\Services\PreferenceServices;

    use App\Services\PreferenceServices\PreferenceServiceInterface;
    use App\Repositories\PreferenceRepositories\PreferenceRepository;
    use App\Models\Preference;

    class PreferenceService implements PreferenceServiceInterface {

        public function __construct(private PreferenceRepository $preferenceRepository)
        {
        }

        public function all($filters = [])
        {
            return $this->preferenceRepository->all($filters);
        }

        public function findById($id, $with= [])
        {
            return $this->preferenceRepository->findById($id, $with);
        }

        public function create(array $data)
        {
            return $this->preferenceRepository->create($data);
        }

        public function update(Preference $preference, array $data)
        {
            return $this->preferenceRepository->update($preference, $data);
        }

        public function delete(Preference $preference)
        {
            return $this->preferenceRepository->delete($preference);
        }
    }

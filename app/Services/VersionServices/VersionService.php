<?php

    namespace App\Services\VersionServices;

    use App\Services\VersionServices\VersionServiceInterface;
    use App\Repositories\VersionRepositories\VersionRepository;
    use App\Models\Version;

    class VersionService implements VersionServiceInterface {

        public function __construct(private VersionRepository $versionRepository)
        {
        }

        public function all($filters = [])
        {
            return $this->versionRepository->all($filters);
        }

        public function findById($id, $with= [])
        {
            return $this->versionRepository->findById($id, $with);
        }

        public function create(array $data)
        {
            return $this->versionRepository->create($data);
        }

        public function update(Version $version, array $data)
        {
            return $this->versionRepository->update($version, $data);
        }

        public function delete(Version $version)
        {
            return $this->versionRepository->delete($version);
        }
    }

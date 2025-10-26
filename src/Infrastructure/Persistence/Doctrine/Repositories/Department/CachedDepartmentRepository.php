<?php

namespace Infrastructure\Persistence\Doctrine\Repositories\Department;

use Domain\Department\Collections\DepartmentCollection;
use Domain\Department\Entities\Department;
use Domain\Department\Repositories\DepartmentRepositoryInterface;
use Domain\SeedWork\Id\Uuid;
use Psr\Cache\CacheItemPoolInterface;

final readonly class CachedDepartmentRepository implements DepartmentRepositoryInterface
{
    private const string CACHE_KEY_FIND_ALL = 'app.department.find_all';

    public function __construct(
        private DepartmentRepositoryInterface $decorated,
        private CacheItemPoolInterface $cache,
        private int $cacheTtl = 2_628_000,
    ) {
    }

    public function save(Department $department): void
    {
        $this->decorated->save($department);
        $this->invalidateCache();
    }

    /**
     * @param list<Department> $departments
     */
    public function saveAll(array $departments): void
    {
        $this->decorated->saveAll($departments);
        $this->invalidateCache();
    }

    public function delete(Department $department): void
    {
        $this->decorated->delete($department);
        $this->invalidateCache();
    }

    public function findById(Uuid $id): ?Department
    {
        return $this->decorated->findById($id);
    }

    public function findAll(): DepartmentCollection
    {
        $cacheItem = $this->cache->getItem(self::CACHE_KEY_FIND_ALL);

        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }

        $result = $this->decorated->findAll();

        $cacheItem->set($result);
        $cacheItem->expiresAfter($this->cacheTtl);
        $this->cache->save($cacheItem);

        return $result;
    }

    public function findByCity(string $city): ?Department
    {
        return $this->decorated->findByCity($city);
    }

    private function invalidateCache(): void
    {
        $this->cache->deleteItems([
            self::CACHE_KEY_FIND_ALL,
        ]);
    }
}

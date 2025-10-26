<?php

namespace Domain\Department\Services;

use Psr\Cache\CacheItemPoolInterface;

final readonly class DepartmentCacheInvalidator
{
    private const string CACHE_KEY = 'departments.all';

    public function __construct(
        private CacheItemPoolInterface $cache,
    ) {
    }

    public function invalidateAllDepartments(): void
    {
        $this->cache->deleteItem(self::CACHE_KEY);
    }
}

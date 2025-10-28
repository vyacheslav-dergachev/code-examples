<?php

namespace Infrastructure\Geo;

use Application\Geo\GeoLocationServiceInterface;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Serializer\SerializerInterface;

final readonly class CachedGeoLocationService implements GeoLocationServiceInterface
{
    private const string CACHE_KEY_PREFIX = 'app.geo.get_city_by_ip--';
    private const int CACHE_TTL_NULL = 3_600;

    public function __construct(
        private GeoLocationServiceInterface $geoLocationService,
        private CacheItemPoolInterface $cache,
        private SerializerInterface $serializer,
        private int $cacheTtl = 86_400,
    ) {
    }

    public function getCityByIp(string $ip): ?string
    {
        $cacheKey = self::CACHE_KEY_PREFIX . md5($this->serializer->serialize($ip, 'json'));

        $cachedItem = $this->cache->getItem($cacheKey);

        if ($cachedItem->isHit()) {
            return $cachedItem->get();
        }

        $city = $this->geoLocationService->getCityByIp($ip);

        $cacheTtl = $city !== null ? $this->cacheTtl : self::CACHE_TTL_NULL;

        $cachedItem->set($city);
        $cachedItem->expiresAfter($cacheTtl);
        $this->cache->save($cachedItem);

        return $city;
    }
}

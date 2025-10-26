<?php

namespace Infrastructure\Geo;

use Application\Geo\GeoLocationServiceInterface;

class GeoLocationService implements GeoLocationServiceInterface
{
    public function getCityByIp(string $ip): ?string
    {
        $url = 'http://ip-api.com/json/' . urlencode($ip) . '?fields=status,city';
        $response = @file_get_contents($url);

        if (!$response) {
            return null;
        }

        $data = json_decode($response, true);

        return ($data['status'] ?? '') === 'success' ? ($data['city'] ?? null) : null;
    }
}

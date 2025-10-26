<?php

namespace Application\Geo;

interface GeoLocationServiceInterface
{
    public function getCityByIp(string $ip): ?string;
}

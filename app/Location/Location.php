<?php

namespace App\Location;

final class Location
{
    private const EARTH_RADIUS_KILOMETERS = 6371;
    private const EARTH_RADIUS_MILES = 3958.8;

    public function __construct(public readonly float $lat, public readonly float $lon) {}

    public function distance(self $location): float
    {
        $latFrom = deg2rad($this->lat);
        $lonFrom = deg2rad($this->lon);
        $latTo = deg2rad($location->lat);
        $lonTo = deg2rad($location->lon);

        $lonDelta = $lonTo - $lonFrom;

        return atan2(
            sqrt($this->calcYAxis($latTo, $latFrom, $lonDelta)),
            $this->calcXAxis($latFrom, $latTo, $lonDelta)
        ) * $this->earthRadius();
    }

    private function calcYAxis(float $latTo, float $latFrom, float $lonDelta) : float|int
    {
        return ((cos($latTo) * sin($lonDelta)) ** 2) + ((cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta)) ** 2);
    }

    private function calcXAxis($latFrom, $latTo, $lonDelta) : float|int
    {
        return sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
    }

    private function earthRadius(): float|int
    {
        return config('affiliates.unit') === 'miles' ? self::EARTH_RADIUS_MILES : self::EARTH_RADIUS_KILOMETERS;
    }
}

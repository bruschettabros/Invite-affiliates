<?php

namespace Location;

use App\Location\Location;
use Tests\TestCase;
use \Config;

class LocationTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->location = new Location(50, -1);
        Config::set('affiliates.unit', 'km');
    }

    public function testDistance() : void
    {
        /*
         * Tests are checked against this site:
         * https://www.sunearthtools.com/tools/distance.php
         */
        $this->assertEquals(0, $this->location->distance(new Location(50, -1)));
        $this->assertEquals(131.78, round($this->location->distance(new Location(51, 0)), 2));
        $this->assertEquals(6750.9, round($this->location->distance(new Location(37.851356, -88.8389391)), 2));
        $this->assertEquals(815.68, round($this->location->distance(new Location(51.4677, 10.36855)), 2));
    }

    public function testDistanceMiles(): void
    {
        Config::set('affiliates.unit', 'miles');

        $this->assertEquals(0, $this->location->distance(new Location(50, -1)));
        $this->assertEquals(81.89, round($this->location->distance(new Location(51, 0)), 2));
        $this->assertEquals(4194.86, round($this->location->distance(new Location(37.851356, -88.8389391)), 2));
        $this->assertEquals(506.85, round($this->location->distance(new Location(51.4677, 10.36855)), 2));
    }
}

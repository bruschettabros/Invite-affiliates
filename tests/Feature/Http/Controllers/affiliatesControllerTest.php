<?php

namespace Http\Controllers;

use App\Models\Affiliate;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;
use \Config;

class affiliatesControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Config::set('affiliates.unit', 'km');
        Config::set('affiliates.distance', 100);
    }

    public function testLatAndLonRequired(): void
    {
        $response = $this->Json('GET', '/api/affiliates');

        $response->assertStatus(422);
        $response->assertJsonCount(2, 'errors');
        $response->assertJson([
            'errors' => [
                'lat' => ['The lat field is required.'],
                'lon' => ['The lon field is required.'],
            ],
        ]);
    }

    public function testControllerReturnsData(): void
    {
        $response = $this->Json('GET', '/api/affiliates', [
            'lat' => 50,
            'lon' => -1,
        ]);

        $response->assertStatus(200);
        $response->assertJsonCount(0, 'data');
    }

    public function testAffiliateWithRange(): void
    {
        Affiliate::factory([
            'lat' => 53.3340285,
            'lon' => -6.2535495,
            'name' => 'Test Affiliate 1',
            'affiliate_id' => 1,
        ])->create();

        Affiliate::factory([
            'lat' => 52.986375,
            'lon' => -6.043701,
            'name' => 'Test Affiliate 2',
            'affiliate_id' => 2,
        ])->create();

        $this->assertDatabaseCount(Affiliate::class, 2);

        $response = $this->Json('GET', '/api/affiliates', [
            'lat' => 53.3340285,
            'lon' => -6.2535495,
        ]);

        $response->assertStatus(200);
        $response->assertJsonCount(2, 'data');
        $response->assertJson([
            'data' => [
                [
                    'name' => 'Test Affiliate 1',
                    'lat'  => 53.3340285,
                    'lon'  => -6.2535495,
                    'affiliate_id' => 1,
                ],
                [
                    'name' => 'Test Affiliate 2',
                    'lat'  => 52.986375,
                    'lon'  => -6.043701,
                    'affiliate_id' => 2,
                ],
            ],
        ]);
    }

    public function testAffiliateOutOfRange(): void
    {
        Affiliate::factory([
            'lat' => 55.3340285,
            'lon' => -10.2535495,
            'name' => 'Test Affiliate 1',
            'affiliate_id' => 1,
        ])->create();

        Affiliate::factory([
            'lat' => 52.986375,
            'lon' => -6.043701,
            'name' => 'Test Affiliate 2',
            'affiliate_id' => 2,
        ])->create();

        $this->assertDatabaseCount(Affiliate::class, 2);

        $response = $this->Json('GET', '/api/affiliates', [
            'lat' => 53.3340285,
            'lon' => -6.2535495,
        ]);

        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        $response->assertJson([
            'data' => [
                [
                    'name' => 'Test Affiliate 2',
                    'lat'  => 52.986375,
                    'lon'  => -6.043701,
                    'affiliate_id' => 2,
                ],
            ],
        ]);
    }
}

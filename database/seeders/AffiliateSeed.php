<?php

namespace Database\Seeders;

use App\Models\Affiliate;
use Illuminate\Database\Seeder;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AffiliateSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        $affiliates = $this->getAffiliates();
        foreach (explode(PHP_EOL, $affiliates) as $affiliate) {
            $affiliate = json_decode($affiliate, true);


            if ($affiliate) {
                Affiliate::factory([
                    'lat' => (float) $affiliate['latitude'],
                    'lon' => (float) $affiliate['longitude'],
                    'name' => $affiliate['name'],
                    'affiliate_id' => (int) $affiliate['affiliate_id'],
                ])->create();
            }
        }
    }

    private function getAffiliates() : Response|string
    {
        $method = config('affiliates.local') ? Storage::class : Http::class;
        return $method::get(config('affiliates.file'));
    }
}

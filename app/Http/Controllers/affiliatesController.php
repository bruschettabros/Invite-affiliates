<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetAffiliateRequest;
use App\Http\Resources\AffiliateResource;
use App\Location\Location;
use App\Models\Affiliate;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class affiliatesController extends Controller
{
    public function get(GetAffiliateRequest $request) : AnonymousResourceCollection
    {
        $location = new Location($request->lat, $request->lon);

        return AffiliateResource::collection(Affiliate::all()->filter(function (Affiliate $affiliate) use ($location) {
            return  $location->distance(new Location($affiliate->lat, $affiliate->lon)) <= config('affiliates.distance');
        }));
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LocationController extends Controller
{
    /**
     * Get state by country id
     *
     * @param int $country_id
     * @return Response
     */
    function getState(string $country_id): Response
    {
        $states = State::select(['id', 'name', 'country_id'])->where('country_id', $country_id)->get();
        return response($states);
    }

    /**
     * Get city by state id
     *
     * @param int $state_id
     * @return Response
     */
    function getCity(string $state_id): Response
    {
        $cities = City::select(['id', 'name', 'state_id', 'country_id'])->where('state_id', $state_id)->get();
        return response($cities);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Location;

class HomePageController extends Controller
{
    public function index()
    {

        $deals = \App\Models\Deal::where('end_date', '>', now())
            ->where('is_hidden', false)
            ->orderBy('end_date', 'asc')
            ->take(3)
            ->get();

        // get the top 3 popular services using most bookings in the last 30 days
        $popularServices = \App\Models\Service::withCount('appointments')
            ->orderBy('appointments_count', 'desc')
            ->take(3)
            ->where('is_hidden', false)
            ->get();

        $locations = Location::all();

        return view('web.home', compact('deals', 'popularServices', 'locations'));
    }
}

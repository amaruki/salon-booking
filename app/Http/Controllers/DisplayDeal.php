<?php

namespace App\Http\Controllers;

use App\Models\Deal;

class DisplayDeal extends Controller
{
    public function index()
    {
        $deals = Deal::all();

        return view('web.deals', compact('deals'));
    }

    public function show(Deal $deal)
    {
        return view('web.view-deal', compact('deal'));
    }
}

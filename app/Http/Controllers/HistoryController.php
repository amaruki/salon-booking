<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = Appointment::where('user_id', Auth::id())->get();
        return view('history.index', compact('histories'));
    }
}
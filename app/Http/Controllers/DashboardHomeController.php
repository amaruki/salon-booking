<?php

namespace App\Http\Controllers;

class DashboardHomeController extends Controller
{
    public function index()
    {
        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2) {
            $adminDashboardHomeController = new AdminDashboardHomeController();

            return $adminDashboardHomeController->index();
        } elseif (auth()->user()->role_id == 3) {
            return view('dashboard.customer');
        } else {
            return redirect()->route('home')->with('error', 'You are not authorized to perform this action.');
        }
    }
}

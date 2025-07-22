<?php

nnamespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Appointment;

class CashierTransactionHistoryController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['user', 'services.locations'])->latest()->get();

        return view('dashboard.cashier-transaction-history', compact('appointments'));
    }
}
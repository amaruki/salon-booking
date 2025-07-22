<?php

namespace App\Http\Controllers;

use App\Models\Appointment;

class CashierTransactionHistoryController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['user', 'service.locations'])->latest()->get();

        return view('dashboard.cashier-transaction-history', compact('appointments'));
    }
}
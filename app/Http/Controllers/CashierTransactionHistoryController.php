<?php

namespace App\Http\Controllers;

use App\Models\Appointment;

class CashierTransactionHistoryController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['user', 'service.locations'])->latest()->paginate(10);

        return view('dashboard.cashier-transaction-history', compact('appointments'));
    }
}
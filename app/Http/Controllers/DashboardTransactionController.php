<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardTransactionController extends Controller
{
    public function transactions(): View
    {
        return view('pages.dashboard-transactions');
    }
    public function details(): View
    {
        return view('pages.dashboard-transaction-details');
    }
}

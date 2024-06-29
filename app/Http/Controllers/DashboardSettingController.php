<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardSettingController extends Controller
{
    public function store(): View
    {
        return view('pages.dashboard-setting');
    }

    public function account(): View
    {
        return view('pages.dashboard-account');
    }
}

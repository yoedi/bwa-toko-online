<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardProductController extends Controller
{
    public function index(): View
    {
        return view('pages.dashboard-products');
    }

    public function detail(): View
    {
        return view('pages.dashboard-product-details');
    }

    public function create(): View
    {
        return view('pages.dashboard-product-create');
    }
}

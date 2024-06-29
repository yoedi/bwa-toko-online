<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DetailController extends Controller
{
    public function index(): View
    {
        return view('pages.detail');
    }
}

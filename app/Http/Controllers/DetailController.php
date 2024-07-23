<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DetailController extends Controller
{
    public function index(Request $request, $id): View
    {
        $product = Product::with(['galleries', 'user'])->where('slug', $id)->firstOrFail();

        return view('pages.detail', [
            'product' => $product
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        $products = Product::with('galleries')->paginate(32);
        
        return view('pages.category', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function detail(Request $request, $slug): View
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with('galleries')->where('category_id', $category->id)->paginate(32);
        
        return view('pages.category', [
            'categories' => $categories,
            'products' => $products
        ]);
    }
}

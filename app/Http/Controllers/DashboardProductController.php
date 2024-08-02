<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with(['galleries','category'])
                        ->where('user_id', Auth::user()->id)
                        ->get();
        return view('pages.dashboard-products', [
            'products' => $products
        ]);
    }

    public function detail(Request $request, $id): View
    {
        $product = Product::with(['galleries','user','category'])->findOrFail($id);
        $categories = Category::all();

        return view('pages.dashboard-product-details', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();

        $data['photo'] = $request->file('photo')->store('assets/product', 'public');

        ProductGallery::create($data);

        return redirect()->route('dashboard-product-detail', $request->product_id);
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard-product-detail', $item->product_id);
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('pages.dashboard-product-create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $product = Product::create($data);

        $gallery = [
            'product_id' => $product->id,
            'photo' => $request->file('photo')->store('assets/product','public'),
        ];

        ProductGallery::create($gallery);

        return redirect()->route('dashboard-product');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->all();
        $item = Product::findOrFail($id);

        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('dashboard-product');
    }
}

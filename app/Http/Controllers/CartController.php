<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $carts = Cart::with(['product.galleries', 'user'])
                ->where('user_id', Auth::user()->id)
                ->get();

        return view('pages.cart', ['carts' => $carts]);
    }

    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('cart');
    }

    public function success(): View
    {
        return view('pages.success');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $transaction = TransactionDetail::with(['transaction.user','product.galleries'])
                                    ->whereHas('product', function($product){
                                        $product->where('user_id', Auth::user()->id);
                                    });

        $revenue = $transaction->get()->reduce(function($carry, $item){
            return $carry + $item->price;
        });

        $customer = User::count();
                                    
        return view('pages.dashboard', [
            'transaction_count' => $transaction->count(),
            'transaction_data' => $transaction->get(),
            'revenue' => $revenue,
            'customer' => $customer,
        ]);
    }
}

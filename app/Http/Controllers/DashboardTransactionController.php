<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardTransactionController extends Controller
{
    public function transactions(): View
    {
        $sellTransactions = TransactionDetail::with(['transaction.user','product.galleries'])
                            ->whereHas('product', function($product){
                                $product->where('user_id', Auth::user()->id);
                            })->get();

        $buyTransactions = TransactionDetail::with(['transaction.user','product.galleries'])
                            ->whereHas('transaction', function($transaction){
                                $transaction->where('user_id', Auth::user()->id);
                            })->get();

        return view('pages.dashboard-transactions', [
            'sellTransactions' => $sellTransactions,
            'buyTransactions' => $buyTransactions,
        ]);
    }
    public function details(Request $requset, $id): View
    {
        $transaction = TransactionDetail::with(['transaction.user','product.galleries'])
                                ->findOrFail($id);

        return view('pages.dashboard-transaction-details', [
            'transaction' => $transaction,
        ]);
    }

    public function update(Request $requset, $id)
    {
        $data = $requset->all();

        $item = TransactionDetail::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard-transaction-details', $id);
    }
}

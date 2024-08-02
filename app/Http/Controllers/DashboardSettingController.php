<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardSettingController extends Controller
{
    public function store(): View
    {
        $user = Auth::user();
        $categories = Category::all();

        return view('pages.dashboard-setting', [
            'user' => $user,
            'categories' => $categories,
        ]);
    }

    public function account(): View
    {
        $user = Auth::user();

        return view('pages.dashboard-account', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, $redirect)
    {
        $data = $request->all();
        $item = Auth::user();
        // dd($data);
        $item->update($data);

        return redirect()->route($redirect);
    }
}

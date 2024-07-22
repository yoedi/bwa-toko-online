<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('pages.admin.user.index');
    }

    public function list() {
        $query = User::query();

        return DataTables::of($query)
            ->addColumn('action', function($item) {
                return '
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1"
                                    type="button"
                                    data-toggle="dropdown">
                                    Aksi
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="' . route('user.edit', $item->id) . '">
                                    Sunting
                                </a>
                                <form action="'. route('user.destroy', $item->id) .'" method="POST">
                                    '. method_field('delete') . csrf_field() .'
                                    <button type="submit" class="dropdown-item text-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                ';
            })
            ->rawColumns(['action'])
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['password'] = bcrypt($request->password);
        
        User::create($data);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = User::findOrFail($id);

        return view('pages.admin.user.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $data = $request->all();
        $item = User::findOrFail($id);

        if($request->password)
        {
            $data['password'] = bcrypt($request->password);
        }
        else
        {
            unset($data['password']);
        }

        $item->update($data);

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = User::findOrFail($id);
        $item->delete();

        return redirect()->route('user.index');
    }
}

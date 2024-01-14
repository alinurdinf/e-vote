<?php

namespace App\Http\Controllers;

use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index_view()
    {
        if (request()->ajax()) {
            $query = User::all();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '<a href="#" class="btn btn-outline-primary "> Edit</a><a href="#" class="btn btn-outline-primary "> Edit</a>';
                })
                ->addColumn('password', function ($item) {
                    return $item->password;
                })
                ->rawColumns(['action', 'password'])
                ->make();
        }

        return view('pages.user.user-data');
    }
}

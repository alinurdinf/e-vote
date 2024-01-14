<?php

namespace App\Http\Controllers;

use App\Models\BatchUser;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class VoterController extends Controller
{
    public function index()
    {
        $query = BatchUser::with('user', 'batch')->get();
        if (request()->ajax()) {
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '<a href="#" class="btn btn-outline-primary "> Edit</a><a href="#" class="btn btn-outline-primary "> Edit</a>';
                })
                ->addColumn('name', function ($item) {
                    return $item->user->name;
                })
                ->addColumn('username', function ($item) {
                    return $item->user->username;
                })
                ->addColumn('access_password', function ($item) {
                    return $item->user->access_password;
                })
                ->addColumn('batch', function ($item) {
                    return $item->batch->name;
                })
                ->addColumn('time', function ($item) {
                    return $item->batch->start . ' - ' . $item->batch->finish;
                })
                ->addColumn('status', function ($item) {
                    $today = date('Y-m-d H:i:s');
                    if ($today >= $item->batch->start && $today <= $item->batch->finish) {
                        return '<span class="badge badge-success">Active</span>';
                    } else {
                        return '<span class="badge badge-danger">Inactive</span>';
                    }
                })
                ->rawColumns(['action', 'access_password', 'status'])
                ->make();
        }
        return view('pages.voter.index');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'excelFile' => 'required|mimes:xls,xlsx'
        ]);

        $excelFile = $request->File('excelFile');
        $excelFilename = rand() . '.' . $excelFile->getClientOriginalExtension();
        $excelFile->move('excel', $excelFilename);

        $excel = Excel::import(new \App\Imports\VoterImport, public_path('/excel/' . $excelFilename));

        return redirect()->back()->with('success', 'Data Berhasil Diimport');
    }

    public function export()
    {
        return Excel::download(new \App\Imports\VoterExport, 'voter.xlsx');
    }
}

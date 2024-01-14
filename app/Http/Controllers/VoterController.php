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
                    return '<div class="text-center"><a  href="' . route('voter.show', base64_encode($item->id)) . '" class="btn btn-primary">Edit</a></div>';
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

    public function show($id)
    {
        $id = base64_decode($id);
        $data = BatchUser::with('user', 'batch')->findOrFail($id);
        return view('pages.voter.show', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $id = base64_decode($id);
        $data = BatchUser::findOrFail($id);
        $data->update([
            'batch_id' => $request->batch
        ]);
        return redirect()->route('voter')->with('success', 'Voter updated successfully');
    }
}

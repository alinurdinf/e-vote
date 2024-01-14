<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\BatchUser;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Batch::all();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '<a href="' . route('batch.edit', ['id' => base64_encode($item->id)]) . '" class="btn btn-primary">Edit</a>                    <form action="' . route('batch.destroy', base64_encode($item->id)) . '" method="POST" class="d-inline">' .
                        method_field('delete') . csrf_field() .
                        '<button type="submit" class="btn btn-danger mx-3">Delete</button>' .
                        '</form>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.batch.index');
    }

    public function destroy($id)
    {
        $id = base64_decode($id);
        $batch = Batch::findOrFail($id);
        $batchUser = BatchUser::where('batch_id', $id)->get();
        foreach ($batchUser as $item) {
            $item->delete();
        }
        $batch->delete();
        return redirect()->route('batch')->with('success', 'Batch deleted successfully');
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $data = Batch::findOrFail($id);
        return view('pages.batch.show', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $id = base64_decode($id);
        $data = Batch::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('batch')->with('success', 'Batch updated successfully');
    }
}

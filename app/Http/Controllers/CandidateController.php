<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Candidate::with('misi')->get();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '<center>
                    <a href="' . route('candidate.show', base64_encode($item->id)) . '" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"> Edit</a>
                    </center>';
                })
                ->addColumn('misi', function ($item) {
                    return $item->misi->map(function ($misi, $index) {
                        return ($index + 1) . '. ' . $misi->misi;
                    })->implode('<br>');
                })
                ->editColumn('image', function ($item) {
                    return $item->image ? '<img src="' . route('candidate.getimage', base64_encode($item->id)) . '" style="max-height: 200px;max-width:200%" />' : '';
                })
                ->rawColumns(['action', 'image', 'misi'])
                ->make();
        }
        return view('pages.candidate.index');
    }


    public function showImage($id)
    {
        $id = base64_decode($id);
        $data = Candidate::findOrFail($id);
        $path = $data->image;
        $content = file_get_contents(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $path));
        $url = url($path) . '#toolbar=0';
        return response()->make($content, 200, [
            'Content-Type' => 'image/jpeg',
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = base64_decode($id);
        $data = Candidate::with('misi')->find($id);
        return view('pages.candidate.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = base64_decode($id);
        $candidate = Candidate::findOrFail($id);
        $candidate->update($request->except('image'));
        if ($request->hasFile('image')) {
            $candidate->image = $request->image->store('file', 'public');
        }
        $candidate->save();
        return redirect()->route('candidate.show', base64_encode($id))->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

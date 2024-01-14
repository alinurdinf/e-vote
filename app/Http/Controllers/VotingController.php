<?php

namespace App\Http\Controllers;

use App\Models\BatchUser;
use App\Models\Candidate;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Candidate::orderby('id', 'asc')->get();
        $userData = BatchUser::with('user', 'batch')->where('user_id', auth()->user()->id)->first();
        $message = 'Sila pilih calon yang kamu inginkan';
        $status  = 'valid';
        if ($userData->batch->start > date('Y-m-d H:i:s') || $userData->batch->finish < date('Y-m-d H:i:s')) {
            $message = 'Kamu tidak bisa melakukan voting karena waktu voting kamu belum dimulai atau sudah selesai';
            $status  = 'invalid';
        }
        return view('pages.voting.index', compact('data', 'message', 'userData', 'status'));
    }

    public function getCandidate($id)
    {
        $id = base64_decode($id);
        $data = Candidate::with('misi')->where('id', $id)->first();
        return response()->json($data);
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
        //
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
        //
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

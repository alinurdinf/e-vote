<?php

namespace App\Http\Controllers;

use App\Models\BatchUser;
use App\Models\Candidate;
use App\Models\MongoVoting;
use App\Models\Voting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        if (Voting::where('user_id', auth()->user()->id)->first()) {
            $message = 'Kamu sudah melakukan voting';
            $status  = 'invalid';
        }
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

    public function vote($id)
    {
        $id = decrypt($id);
        if (Voting::where('user_id', auth()->user()->id)->first()) {
            return redirect()->back()->with('error', 'Kamu sudah melakukan voting');
        }

        $userData = BatchUser::with('user', 'batch')->where('user_id', auth()->user()->id)->first();
        if ($userData->batch->start > date('Y-m-d H:i:s') || $userData->batch->finish < date('Y-m-d H:i:s')) {
            return redirect()->back()->with('error', 'Kamu tidak bisa melakukan voting karena waktu voting kamu belum dimulai atau sudah selesai');
        }
        try {
            DB::beginTransaction();
            Voting::create([
                'batch_id' => $userData->batch_id,
                'candidate_id' => $id,
                'user_id' => auth()->user()->id,
                'voted_at' => date('Y-m-d H:i:s'),
                'ip_address' => request()->ip()
            ]);
            MongoVoting::create([
                'batch_id' => $userData->batch_id,
                'candidate_id' => $id,
                'user_id' => auth()->user()->id,
                'voted_at' => date('Y-m-d H:i:s'),
                'ip_address' => request()->ip()
            ]);
            DB::commit();
            return redirect()->route('voting')->with('success', 'Berhasil melakukan voting');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

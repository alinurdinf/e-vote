<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\BatchUser;
use App\Models\Candidate;
use App\Models\Voting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $voter = BatchUser::count();
        $batch = Batch::count();
        $candidate = Candidate::count();
        $voting = Voting::count();

        $activityRecent = Voting::orderBy('created_at', 'desc')->with('user', 'batch', 'candidate')->take(5)->get();
        $batchData = Batch::orderby('id', 'asc')->get();
        foreach ($batchData as $key => $value) {
            $batchData[$key]['voter'] = BatchUser::where('batch_id', $value->id)->count();
            $batchData[$key]['voting'] = Voting::where('batch_id', $value->id)->count();
            $batchData[$key]['batch_name'] = $value->name;
            $batchData[$key]['status'] = $value->start > date('Y-m-d H:i:s') || $value->finish < date('Y-m-d H:i:s') ? 'inActive' : 'Active';
        }

        $resultVoting = DB::table('candidates')
            ->leftJoin('votings', 'votings.candidate_id', '=', 'candidates.id')
            ->select('candidates.id as candidate_id', 'candidates.name as candidate_name')
            ->selectRaw('COUNT(votings.id) as total_votes')
            ->selectRaw('CASE WHEN COUNT(votings.id) > 0 THEN ROUND((COUNT(votings.id) * 100.0 / SUM(COUNT(votings.id)) OVER ()), 2) ELSE 0 END as vote_percentage')
            ->groupBy('candidates.id', 'candidates.name')
            ->orderBy('candidates.id', 'asc')
            ->get();

        $chartData = [];
        foreach ($resultVoting as $result) {
            $chartData[] = [
                'name' => $result->candidate_name,
                'y' => $result->total_votes,
                'z' => $result->vote_percentage,
            ];
        }


        $data = [
            'voter' => $voter,
            'batch' => $batch,
            'candidate' => $candidate,
            'voting' => $voting,
        ];


        return view('dashboard', compact('data', 'activityRecent', 'batchData', 'chartData', 'resultVoting'));
    }
}

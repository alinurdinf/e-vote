<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\VotingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(["middleware" => ['auth:sanctum', config('jetstream.auth_session'), 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/user', [UserController::class, "index_view"])->name('user');
    Route::view('/user/new', "pages.user.user-new")->name('user.new');
    Route::view('/user/edit/{userId}', "pages.user.user-edit")->name('user.edit');

    Route::get('/voting', [VotingController::class, 'index'])->name('voting');
    Route::get('/voting/vote/{id}', [VotingController::class, 'vote'])->name('voting.vote');
    Route::get('/voting/result', [VotingController::class, 'current_voting_index'])->name('voting.result');

    Route::get('/candidate/get/{id}', [VotingController::class, 'getCandidate'])->name('candidate.get');

    Route::get('/candidate', [CandidateController::class, 'index'])->name('candidate');
    Route::get('/candidate/show/{id}', [CandidateController::class, 'show'])->name('candidate.show');
    Route::post('/candidate/update/{id}', [CandidateController::class, 'update'])->name('candidate.update');
    Route::get('/candidate/getimage/{id}', [CandidateController::class, 'showImage'])->name('candidate.getimage');

    Route::get('/voter', [VoterController::class, 'index'])->name('voter');
    Route::post('/voter/import', [VoterController::class, 'import'])->name('voter.import');
    Route::get('/voter/export', [VoterController::class, 'export'])->name('voter.export');
    Route::get('/voter/show/{id}', [VoterController::class, 'show'])->name('voter.show');
    Route::post('/voter/update/{id}', [VoterController::class, 'update'])->name('voter.update');

    Route::get('/batch', [BatchController::class, 'index'])->name('batch');
    Route::delete('/batch/delete/{id}', [BatchController::class, 'destroy'])->name('batch.destroy');
    Route::get('/batch/edit/{id}', [BatchController::class, 'edit'])->name('batch.edit');
    Route::post('/batch/update/{id}', [BatchController::class, 'update'])->name('batch.update');

    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');
});

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    use HasFactory;
    protected $fillable = [
        'batch_id',
        'candidate_id',
        'user_id',
        'vote_at',
        'ip_address'
    ];
}

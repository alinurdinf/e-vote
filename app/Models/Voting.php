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
        'voted_at',
        'ip_address'
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

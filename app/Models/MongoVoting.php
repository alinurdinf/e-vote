<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as EloquentModel;

class MongoVoting extends EloquentModel
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'evote';
    protected $fillable = [
        'batch_id',
        'candidate_id',
        'user_id',
        'voted_at',
        'ip_address',
    ];
}

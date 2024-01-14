<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'start',
        'finish',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'batch_users', 'batch_id', 'user_id');
    }
}

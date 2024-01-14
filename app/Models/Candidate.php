<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'no_urut',
        'description',
        'tagline',
        'visi',
        'misi',
        'image',
    ];

    public function misi()
    {
        return $this->hasMany(Misi::class, 'candidate_id', 'id');
    }
}

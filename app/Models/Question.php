<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'segment_id',
        'index',
        'question',
        'type'
    ];

    public function segment()
    {
        return $this->belongsTo(Segment::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
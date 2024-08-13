<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'response_id',
        'segment_id',
        'question_id',
        'answer'
    ];

    public function response()
    {
        return $this->belongsTo(Response::class);
    }

    public function segment()
    {
        return $this->belongsTo(Segment::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
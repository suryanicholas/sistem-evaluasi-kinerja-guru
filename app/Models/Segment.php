<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluation_id',
        'index',
        'label'
    ];

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function question()
    {
        return $this->hasMany(Question::class);
    }
}
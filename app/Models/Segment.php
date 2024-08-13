<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function getRouteKeyName()
    {
        return 'index';
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function getResults()
    {
        $counts = $this->answers()
            ->select('answer', DB::raw('count(*) as count'))
            ->groupBy('answer')
            ->get()
            ->pluck('count', 'answer')
            ->toArray();

        $completeCounts = [
            0 => 0,
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
        ];

        $answerCounts = array_replace($completeCounts, $counts);

        return $answerCounts;
    }
}
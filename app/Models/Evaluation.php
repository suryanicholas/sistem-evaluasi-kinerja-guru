<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'periode'
    ];

    protected $casts = [
        'periode' => 'json'
    ];

    public function segments()
    {
        return $this->hasMany(Segment::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function respondent(){
        return $this->hasMany(Response::class);
    }

    public function getResults()
    {
        $answerCounts = [
            0 => 0,
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
        ];

        foreach ($this->segments as $segment) {
            $segmentAnswerCounts = $segment->answers()
                ->select('answer', DB::raw('count(*) as count'))
                ->groupBy('answer')
                ->get()
                ->pluck('count', 'answer')
                ->toArray();

            foreach ($segmentAnswerCounts as $answer => $count) {
                if (array_key_exists($answer, $answerCounts)) {
                    $answerCounts[$answer] += $count;
                }
            }
        }

        return $answerCounts;
    }
}

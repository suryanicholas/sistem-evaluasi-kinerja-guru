<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'evaluation_id',
        'type',
        'respondent_id',
        'answers'
    ];

    protected $casts = [
        'respondent' => 'json',
        'answers' => 'json'
    ];

    public function identified()
    {
        if($this->type === "teacher"){
            return $this->belongsTo(Teacher::class, 'respondent');
        } elseif ($this->type === "student"){
            return $this->belongsTo(Student::class, 'respondent');
        }

        return null;
    }

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function getRouteKeyName()
    {
        return 'token';
    }
}
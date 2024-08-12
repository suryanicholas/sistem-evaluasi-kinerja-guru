<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

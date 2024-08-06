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

    public function segment()
    {
        return $this->hasMany(Segment::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

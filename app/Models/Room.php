<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'name',
        'code',
        'periode'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function getRouteKeyName()
    {
        return 'code';
    }
}

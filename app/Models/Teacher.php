<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'alias',
        'gender',
        'teaching',
        'email',
        'phone',
        'address',
        'image'
    ];

    public function getRouteKeyName()
    {
        return 'code';
    }
}

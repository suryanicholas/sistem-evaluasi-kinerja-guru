<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'room_id',
        'gender',
        'birth',
        'parents',
        'address',
        'image'
    ];

    protected $casts = [
        'birth' => 'json',
        'parents' => 'json'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function getRouteKeyName()
    {
        return 'code';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'gender',
        'age',
        'nationality',
        'address',
        'skills',
        'experience',
        'education_level',
        'availability',
        'preferred_roles',
        'languages',
        'emergency_contact',
        'status',
    ];
}

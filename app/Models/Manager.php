<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Manager extends Authenticatable
{
    use Notifiable;

    protected $table = 'managers';

    protected $fillable = [
        'username',
        'email',
        'password',
        'full_name',
        'phone',
        'manager_type',
        'status',
        'created_by'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}

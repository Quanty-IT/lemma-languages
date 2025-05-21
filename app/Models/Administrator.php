<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrator extends Authenticatable
{
    use Notifiable;

    protected $table = 'administrators';

    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;

class Teacher extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

    protected $table = 'teachers';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'languages',
        'availability',
        'hourly_rate',
        'commission',
        'pix',
        'notes',
        'password',
        'reset_code',
        'reset_code_expires_at',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'languages' => 'array',
        'availability' => 'array',
        'reset_code_expires_at' => 'datetime',
    ];

    public $timestamps = true;

    // Relacionamento com os alunos
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}

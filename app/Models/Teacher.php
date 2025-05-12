<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'custom_password',
    ];

    protected $hidden = [
        'custom_password',
        'password',
        'remember_token',
    ];

    protected $casts = [
        'availability' => 'array',
    ];

    // Se necessário personalizar a chave primária e outros atributos:
    // protected $primaryKey = 'id';
    public $timestamps = true;

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}

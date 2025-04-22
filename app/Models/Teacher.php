<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

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
    ];

    protected $casts = [
        'availability' => 'array',
    ];

    // Se necessário personalizar a chave primária e outros atributos:
    // protected $primaryKey = 'id';
    public $timestamps = true;
}

?>
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    // Tabela associada ao model, se diferente do padrão
    protected $table = 'teachers';

    // Campos preenchíveis
    protected $fillable = [
        'name',
        'phone',
        'email',
        'availability',
        'hourly',
        'percentage',
        'pix',
        'notes',
    ];

    // Se necessário, você pode personalizar a chave primária e outros atributos:
    // protected $primaryKey = 'id';
    // public $timestamps = false; // Se não estiver usando created_at e updated_at
}
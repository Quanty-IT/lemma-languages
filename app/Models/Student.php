<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'language',
        'availability',
        'goal',
        'notes',
        'teacher_id',
    ];

    protected $casts = [
        'availability' => 'array',
    ];

    // Relacionamento com os professores
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // Relacionamento com as aulas
    public function lessons()
    {
        return $this->hasMany(\App\Models\Lesson::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'language',
        'month',
        'hours',
        'content',
        'student_id',
        'teacher_id',
    ];

    // Relacionamento com os alunos
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relacionamento com os professores
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}

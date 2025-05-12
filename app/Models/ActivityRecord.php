<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityRecord extends Model
{
    protected $fillable = [
        'month',
        'hours',
        'content',
        'student_id',
        'teacher_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}

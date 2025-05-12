<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    protected $fillable = [
        'name', 'phone', 'email', 'availability', 'languages', 'goal', 'observation', 'teacher_id',
    ];

    protected $casts = [
        'availability' => 'array',
        'languages' => 'array',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function activityRecords()
{
    return $this->hasMany(\App\Models\ActivityRecord::class);
}
}

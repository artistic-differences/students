<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subjects');
    }

    public function classes()
    {
        return $this->belongsToMany(TeacherClass::class, 'student_classes', 'student_id', 'class_id', 'id', 'id');
    }

}

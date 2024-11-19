<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'exam_teacher', 'exam_id', 'teacher_id')->withTimestamps();
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'exam_student', 'exam_id', 'student_id')->withPivot('status')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function isAssignedTo($userId)
    {
        return $this->teachers()->get()->pluck('id')->contains($userId);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}

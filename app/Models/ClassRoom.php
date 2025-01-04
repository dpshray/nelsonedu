<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'class_room_teacher', 'class_room_id', 'teacher_id')->withTimestamps();
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'class_room_student', 'class_room_id', 'student_id')->withTimestamps();
    }

    public function class_meetings()
    {
        return $this->hasMany(ClassMeeting::class);
    }

    public function study_materials()
    {
        return $this->hasMany(StudyMaterial::class);
    }

    public function lecture_videos()
    {
        return $this->hasMany(LectureVideo::class);
    }
}

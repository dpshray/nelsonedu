<?php

namespace App\Models;

use App\Constants\Constants;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->hasRole(Constants::ROLE_ADMIN);
    }

    public function isTeacher()
    {
        return $this->hasRole(Constants::ROLE_TEACHER);
    }

    public function isStudent()
    {
        return $this->hasRole(Constants::ROLE_STUDENT);
    }

    public function classrooms()
    {
        return $this->belongsToMany(ClassRoom::class, 'class_room_teacher', 'teacher_id', 'class_room_id')->withTimestamps();
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_teacher', 'teacher_id', 'exam_id')->withTimestamps();
    }

    public function studentExams()
    {
        return $this->belongsToMany(Exam::class, 'exam_student', 'student_id', 'exam_id')->withPivot(['status', 'exam_finished'])->withTimestamps();
    }

    public function studentClassrooms()
    {
        return $this->belongsToMany(ClassRoom::class, 'class_room_student', 'student_id', 'class_room_id')->withPivot('status')->withTimestamps();
    }
}

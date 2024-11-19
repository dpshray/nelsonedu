<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoomStudent extends Model
{
    use HasFactory;

    protected $table = 'class_room_student';

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function classroom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_room_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyMaterial extends Model
{
    use HasFactory;

    public function getFileName($filepath)
    {
        $fileList = explode('_', $filepath);
        $fullName = end($fileList);
        $fileName = explode('.', $fullName)[0];

        return $fileName;
    }

    public function lectureVideo()
{
    return $this->belongsTo(LectureVideo::class);
}
}

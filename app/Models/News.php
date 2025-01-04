<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getFileName($filepath)
    {
        $fileList = explode('_', $filepath);
        $fullName = end($fileList);
        $fileName = explode('.', $fullName)[0];

        return $fileName;
    }
}

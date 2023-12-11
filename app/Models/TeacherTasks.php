<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherTasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_url',
        'description',
        'student_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}

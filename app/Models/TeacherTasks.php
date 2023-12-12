<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    protected $appends = ["secureURL"];

    public function getSecureURLAttribute()
    {
        if (is_null($this->image_url)) {
            return null;
        }

        if (Storage::disk('task-images')->exists($this->image_url)) {
            return Storage::disk('task-images')->temporaryUrl($this->image_url, now()->addMinutes(30));
        } else {
            return null;
        }
    }
}

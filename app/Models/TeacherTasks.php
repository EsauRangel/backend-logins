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

    protected $appends = ["secureURL"];

    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        return $query
            ->where("description", "LIKE", "%$search%")
            ->orWhereHas("student", function ($q) use ($search) {
                $q->where("name", "LIKE", "%$search%");
            });
    }

    public function scopeActive($query)
    {
        return $query->where("active", true);
    }

    //Relations
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    //Appends
    public function getSecureURLAttribute()
    {
        if (is_null($this->image_url)) {
            return null;
        }
        if (Storage::disk('s3-disk')->exists($this->image_url)) {
            return Storage::disk('s3-disk')->temporaryUrl($this->image_url, now()->addMinutes(30));
        } else {
            return null;
        }
    }
}

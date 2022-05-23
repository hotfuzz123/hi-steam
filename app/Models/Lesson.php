<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'tool', 'description', 'thumbnail', 'public_id', 'video_link', 'view', 'status', 'course_id', 'admin_id'
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function admin() {
        return $this->belongsTo(Admin::class);
    }

    public function mission() {
        return $this->hasMany(Mission::class);
    }

    public function comment() {
        return $this->hasMany(Comment::class);
    }

    public function homework() {
        return $this->hasMany(Homework::class);
    }

    public function document() {
        return $this->hasMany(Document::class);
    }
}

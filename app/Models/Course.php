<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'category_id', 'admin_id'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function admin() {
        return $this->belongsTo(Admin::class);
    }

    public function lesson() {
        return $this->hasMany(Lesson::class);
    }

    public function user() {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')->withTimestamps();
    }
}

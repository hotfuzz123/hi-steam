<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'star', 'lesson_id', 'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function lesson() {
        return $this->belongsTo(Lesson::class);
    }

    public function admin() {
        return $this->belongsToMany(Admin::class, 'admin_review', 'review_id', 'admin_id')->withPivot('content')->withTimestamps();
    }
}

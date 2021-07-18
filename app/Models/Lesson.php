<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lesson';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'material', 'image', 'public_id', 'video_link', 'view_count', 'status', 'course_id', 'admin_id'
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

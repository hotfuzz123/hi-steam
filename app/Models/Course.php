<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course';

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
        'name', 'material', 'description', 'image', 'public_id', 'video_link', 'view_count', 'status', 'category_id', 'admin_id'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
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

    public function admin() {
        return $this->belongsTo(Admin::class);
    }
}

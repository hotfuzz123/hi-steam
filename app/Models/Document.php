<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'public_id', 'link', 'status', 'admin_id', 'lesson_id'
    ];

    public function lesson() {
        return $this->belongsTo(Lesson::class);
    }

    public function admin() {
        return $this->belongsTo(Admin::class);
    }
}



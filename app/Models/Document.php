<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

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



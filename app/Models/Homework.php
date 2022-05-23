<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Homework extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'homeworks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'public_id', 'user_id', 'lesson_id',
    ];

    public function lesson() {
        return $this->belongsTo(Lesson::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function grade() {
        return $this->belongsTo(Grade::class);
    }
}

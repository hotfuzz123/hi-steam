<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'score', 'comment', 'user_id',
    ];

    public function homework() {
        return $this->belongsTo('App\Models\Homework');
    }
}

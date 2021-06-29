<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'homework';

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
        'name', 'image', 'public_id', 'course_id',
    ];

    public function course() {
        return $this->belongsTo('App\Models\Course');
    }
}

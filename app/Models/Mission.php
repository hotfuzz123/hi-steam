<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mission';

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
        'name', 'image', 'user_id', 'description', 'course_id', 'grade_id'
    ];

    public function course() {
        return $this->belongsTo('App\Models\Course');
    }

    public function grade() {
        return $this->belongsTo('App\Models\Grade');
    }
}

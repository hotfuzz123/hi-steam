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
        'name', 'image', 'public_id', 'status', 'category_id', 'admin_id'
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
}

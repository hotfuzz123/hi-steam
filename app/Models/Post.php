<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'public_id', 'content', 'description', 'status', 'admin_id'
    ];

    public function admin() {
        return $this->belongsTo(Admin::class);
    }
}

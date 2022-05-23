<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

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

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use PHPUnit\Framework\Constraint\Count;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'image', 'dateOfBirth', 'address', 'grade', 'schoolName', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['dateOfBirth'];

    /**
     * Bcrypt the password of user
     *
     * @var array
     */
    public function setPasswordAttribute($value) {
        if($value != ""){
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function course() {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id')->withPivot('id')->withTimestamps();
    }
}

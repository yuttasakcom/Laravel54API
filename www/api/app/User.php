<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Transformers\UserTransformer;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';
    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    public $transformer = UserTransformer::class;
    protected $table = 'users';
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    public function setNameAttribute($name) {
        $this->attributes['name'] = $name;
    }

    public function getNameAttribute($name) {
        return ucwords($name);
    }

    public function setEmailAttribute($email) {
        $this->attributes['email'] = strtolower($email);
    }

    public function isVerified() {
        return $this->verified == User::VERIFIED_USER;
    }

    public function isAdmin() {
        return $this->admin == User::ADMIN_USER;
    }

    public static function generateVerificationCode() {
        return str_random(40);
    }

    // public function post() {
    //   return $this->hasOne('App\Post');
    // }

    // public function posts() {
    //   return $this->hasMany('App\Post');
    // }

    // public function roles() {
    //   return $this->belongsToMany('App\Role')->withPivot('created_at');
    // }

    // public function photos() {
    //   return $this->morphMany('App\Photo', 'imageable');
    // }
}

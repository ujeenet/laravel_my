<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Project;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id','id');

    }
    public function resources()
    {
        return $this->hasMany(Resource::class, 'owner_id','id');

    }
    public function projects()
    {
        return $this->hasMany(Project::class, 'user_id','id');

    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable=['name','middlename','lastname','title','user_id','birthdate','email','phone'];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

}
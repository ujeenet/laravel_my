<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $fillable=['user_id','title','description','duration','status','type', 'resource_id', 'starts_at', 'exp_duration'];

    public function checkpoints(){

        return $this->hasMany(Checkpoint::class, 'project_id', 'id');
    }
}

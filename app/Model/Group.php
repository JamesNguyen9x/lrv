<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'group_users';

    public function users(){
        return $this->hasMany('App\Model\User', 'id');
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['username', 'email', 'password', 'avatar', 'group_id'];
    protected $hidden = ['password', 'remember_token'];
    
    public function groups(){
        return $this->belongsTo('App\Model\Group', 'group_id');
    }
    public function groupName(){
        $item = $this->groups()->first(['name']);
        if(is_null($item)){
            return 'Nothing';
        }
        return $item->name;
    }

    public function isAdmin()
    {
        if ($this->type == 1) {
            return true;
        }
        return false;
    }
}

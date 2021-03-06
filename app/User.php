<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
        // this looks for an admin column in your users table
    }
}

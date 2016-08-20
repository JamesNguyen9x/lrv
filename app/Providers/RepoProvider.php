<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Model\User;
use App\Model\Group;
use App\Model\Overtime;

class RepoProvider extends ServiceProvider
{

    public function boot()
    {
        //
    }

    public function register()
    {
        $app = $this->app;

        $app->bind('\App\Repositories\Users\UsersInterface', function(){
            return new \App\Repositories\Users\UsersRepository(new User);
        });

        $app->bind('\App\Repositories\Group\GroupInterface', function(){
            return new \App\Repositories\Group\GroupRepository(new Group, new User);
        });

        $app->bind('\App\Repositories\Mail\MailInterface', function(){
            return new \App\Repositories\Mail\MailRepository;
        });

        $app->bind('\App\Repositories\Config\ConfigInterface', function(){
            return new \App\Repositories\Config\ConfigRepository(new Overtime);
        });
    }
}

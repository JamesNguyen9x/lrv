<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;

use App\Repositories\Users\UsersInterface;

class MainController extends Controller
{
    protected $user;
    protected $mail;


    public function __construct(UsersInterface $user) {
        $this->user = $user;
    }

    public function index()
    {
        $data = [
          'title' => 'User Manage'
        ];
        return view('index', $data);
    }
}

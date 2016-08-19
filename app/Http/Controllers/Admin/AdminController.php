<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;

use App\Repositories\Users\UsersInterface;

class AdminController extends Controller
{
    protected $user;
    protected $mail;


    public function __construct(UsersInterface $user) {
        $this->user = $user;
    }

    public function index()
    {
        $data = [
          'title' => 'Admin Manage'
        ];
        return view('admin.index', $data);
    }

    public function getLogin(){
        if(auth()->check()){
            return view('errors.logon')->with('mess', 'You are Logged in');
        }
        return view('auth.login');
    }

    public function postLogin(Request $request){
        $valid = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        if (auth()->attempt($data)) {
            return redirect()->route('admin');
        }
        return redirect()->back()->withInput()->with('errorMess', trans('Incorrect email or password !'));
    }

    public function getLogout(){
        if(!auth()->check()){
            return view('errors.logon')->with('mess', 'You are not login !');
        }
        auth()->logout();
        return view('auth.login');
    }
    
    public function lostPassword(){
        if(auth()->check()){
            return view('errors.logon')->with('mess', 'You are Logged in');
        }
        return view('auth.resetpassword');
    }
    
    public function resetPassword(Request $request){
        $valid = Validator::make($request->all(), [
            'email' => 'email|required'
        ]);
        if($valid->fails()){
            return redirect()->back()->withInput()->withErrors($valid->errors());
        }
        $user = $this->user->getByEmail($request->input('email'));
        
        $this->mail->send('auth.resetmail', [], 'admin@gmail.com', 'member@gmail.com', 'Reset Email');
        
    }
}

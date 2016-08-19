<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Validator;
use App\Exceptions\ValidateException;
use App\Exceptions\NullException;
use App\Exceptions\ExcuteException;
use App\Repositories\Users\UsersInterface;
use App\Repositories\Group\GroupInterface;

use App\Repositories\Mail\MailInterface as MailInterface;

class UsersController extends Controller
{

    protected $user;
    protected $group;
    protected $mail;

    public function __construct(UsersInterface $user, GroupInterface $group, MailInterface $mail) {
        $this->user = $user;
        $this->group = $group;
        $this->mail = $mail;
    }

    public function index() {
        $data = [
            'title' => 'List Users',
            'items' => $this->user->getAll(['*']),
            'groups' => $this->group->listAll(true)
        ];

        return view('admin.users.index', $data);
    }

    public function create() {
        $data = [
            'title' => 'Create User',
            'items' => $this->group->listAll(true)
        ];
        return view('admin.users.create', $data);
    }

    public function store(Request $request) {
        //authorize('create_users');
        try {
            $user = $this->user->create($request);
            $data['link'] = $request->root().'/users/active?id='.$user->id.'&token='.$user->token;

            $this->mail->send('admin.users.email_create', $data, 'admin@gmail.com', $user->email, 'Active Account');
            return redirect()->route('admin.users.index')->with('Mess', 'Create sucsess');
        } catch (ValidateException $e) {
            return redirect()->back()->withInput()->withErrors($e->getErrors());
        }
    }

    public function edit($id) {
        $data = [
            'title' => 'Edit User',
            'item' => $this->user->find($id),
            'groups' => $this->group->listAll(true)
        ];
        return view('admin.users.edit', $data);
    }

    public function update($id, Request $request) {
        try {
            $this->user->update($id, $request);
            return redirect()->route('admin.users.index')->with('Mess', 'Update Success');
        } catch (ValidateException $ex) {
            return redirect()->back()->withInput()->withErrors($ex->getError());
        }
    }

    public function getLogin(){
        if(auth()->check()){
            return view('errors.logon')->with('mess', 'You are Logged in');
        }
        return view('user.login');
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
            if (auth()->user()->isAdmin()) {
                return redirect()->route('admin');
            } else {
                if(auth()->user()->active == 1) {
                    return redirect()->route('main');
                }
                auth()->logout();
            }
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

    public function active() {
        try {
            $id = Input::get('id', false);
            $token = Input::get('token', false);
            $user = $this->user->checkActive($id, $token);
            if(count($user) == 0) {
                return redirect()->route('user.login');
            }
            $data = [
                'title' => 'Active User',
                'item' => $user
            ];
            return view('admin.users.active', $data);
        } catch (ValidateException $e) {
            return redirect()->back()->withInput()->withErrors($e->getErrors());
        }

    }

    public function activeUser(Request $request) {
        try {
            $this->user->activeUser($request);
            return redirect()->route('user.login');
        } catch (ValidateException $e) {
            return redirect()->back()->withInput()->withErrors($e->getErrors());
        }
    }

}
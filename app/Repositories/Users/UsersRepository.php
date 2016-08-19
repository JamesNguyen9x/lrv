<?php

namespace App\Repositories\Users;

use App\Exceptions\ValidateException;
use App\Exceptions\NullException;
use App\Exceptions\ExcuteException;

use App\Repositories\BaseRepository;
use App\Repositories\Users\UsersInterface;

class UsersRepository extends BaseRepository implements UsersInterface {

    protected $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function rules($id=null) {
        return [
            'user_name' => 'required|unique:users,user_name,'.$id,
            'email' => 'required|email|unique:users,email,'.$id
        ];
    }

    public function rulesActive() {
        return [
            'id' => 'required',
            'token' => 'required|min:32',
            'user_name' => 'required',
            'password' => 'required|min:5|confirmed'
        ];
    }

    public function getAll($columns = ['*'], $orderby = "created_at", $order = "DESC") {
        return $this->model->where('type', 0)->orderBy($orderby, $order)->paginate(10, $columns);
    }

    public function checkActive($id, $token) {
        $user = $this->model->where('id', $id)->where('token', $token)->get();
        if(count($user) == 0) {
            throw new NullException('Not found');
        }
        return $user[0];
    }

    public function create($request) {
        if ($this->valid($request->all(), $this->rules())) {
            $user = new $this->model;
            $user->user_name = $request->get('user_name');
            $user->email = $request->get('email');
            $password = $this->getToken(8);
            $user->password = bcrypt($password);
            $user->active = 0;
            $user->group_id = $request->get('group_id');
            $user->token = $this->getToken(32);
            if($user->save()) {
                return $user;
            } else {
                throw new ExcuteException('Cant save data!');
            }
        } else {
            throw new ValidateException($this->getError());
        }
    }

    public function update($id, $request) {
        if ($this->valid($request->all(), $this->rules($id))) {
            $user = $this->find($id);
            $user->user_name = $request->get('user_name');
            $user->email = $request->get('email');
            $user->group_id = $request->get('group_id');
            if (!$user->update()) {
                throw new ExcuteException('Cant update data!');
            }
        } else {
            throw new ValidateException($this->getError());
        }
    }

    public function delete($id) {
        $user = $this->find($id);
        $user->deleted = 1;
        $user->deleted_at = date('Y-m-d H:i:s');
        if(!$user->update()){
            throw new ExcuteException('Cant delete data!');
        }
    }

    public function activeUser($request) {
        if ($this->valid($request->all(), $this->rulesActive())) {
            $user = $this->model->where('id', $request->get('id'))->where('token', $request->get('token'))->get();
            if (count($user) == 0) {
                throw new NullException('Not found');
            }
            $user = $user[0];
            $user->user_name = $request->get('user_name');
            $user->password = bcrypt($request->get('password'));
            $user->token = "";
            $user->active = 1;
            $user->update();
        } else {
            throw new ValidateException($this->getError());
        }
    }

    private function cryptoRandSecure($min, $max) {
        $range = $max - $min;
        if ($range < 1) return $min;
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1;
        $bits = (int) $log + 1;
        $filter = (int) (1 << $bits) - 1;
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    }

    private function getToken($length) {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet) - 1;
        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[$this->cryptoRandSecure(0, $max)];
        }
        return $token;
    }
    public function massdel($request) {
        $ids = $request->get('massdel');
        if($ids){
            foreach ($ids as $id){
                $this->delete($id);
            }
        }
    }
}

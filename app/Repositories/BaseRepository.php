<?php

namespace App\Repositories;

use Validator;
use App\Exceptions\ValidateException;
use App\Exceptions\NullException;
use App\Exceptions\ExcuteException;

abstract class BaseRepository {

    protected $error;

    public function valid(array $attrs, array $rules = null, array $mess = null) {
        $valid = Validator::make($attrs, ($rules) ? $rules : static::$rules);
        if ($valid->fails()) {
            $this->setError($valid->messages());
            return false;
        }
        return true;
    }

    public function setError($error) {
        $this->error = $error;
    }

    public function getError() {
        return $this->error;
    }

    public function getAll($columns = ['*'], $orderby = "created_at", $order = "DESC") {
        return $this->model->where('deleted','!=', 1)->orderBy($orderby, $order)->paginate(10, $columns);
    }

    public function find($id, $columns=['*']) {
        $item = $this->model->find($id);
        if (is_null($item)) {
            throw new NullException('Notfound');
        } else {
            return $item;
        }
    }

}

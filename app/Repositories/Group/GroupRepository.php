<?php

namespace App\Repositories\Group;

use App\Exceptions\ValidateException;
use App\Exceptions\NullException;
use App\Exceptions\ExcuteException;

use App\Repositories\BaseRepository;
use App\Repositories\Group\GroupInterface;

use DB;

class GroupRepository extends BaseRepository implements GroupInterface {

    protected $model;
    protected $user;

    public function rules($id = null) {
        $result = [];
        $result['name'] = 'required';
        $result['start_time'] = 'required';
        $result['end_time'] = 'required';
        return $result;
    }


    public function __construct($model, $user) {
        $this->model = $model;
        $this->user = $user;
    }

    public function listAll($name=false){
        if($name==true){
            return $this->model->lists('name', 'id')->toArray();
        }
        return $this->model->lists('id')->toArray();
    }

    public function create($request) {
        if($this->valid($request->all(), $this->rules())) {
            $group = new $this->model;
            $group->name = $request->input('name');;
            $group->start_time = $request->input('start_time');
            $group->end_time = $request->input('end_time');
            if (!$group->save()) {
                throw new ExcuteException('Cant save data!');
            }
        } else {
            throw new ValidateException($this->getError());
        }
    }

    public function update($id, $request) {
        if(!$this->valid($request->all(), $this->rules())){
            throw new ValidateException($this->getError());
        }
        $group = $this->find($id);
        $group->name = $request->input('name');;
        $group->start_time = $request->input('start_time');
        $group->end_time = $request->input('end_time');
        if(!$group->update()){
            throw new ExcuteException('Cant save data!');
        }
    }

    public function delete($id) {
        DB::beginTransaction();
        $group = $this->find($id);
        $this->user->where('group_id', $id)->update(['group_id' => 0]);
        $group->deleted = 1;
        $group->deleted_at = date('Y-m-d H:i:s');
        if(!$group->update()){
            DB::rollBack();
            throw new ExcuteException('Cant delete data!');
        }
        DB::commit();
    }

    public function massdel($request) {
        $ids = $request->get('massdel');
        if($ids){
            foreach ($ids as $id){
                $this->delete($id);
            }
        }else{
            throw new NullException('No data!');
        }
    }

}

<?php

namespace App\Repositories\Config;

use App\Repositories\BaseRepository;
use App\Repositories\Config\ConfigInterface;

use DB;


class ConfigRepository implements ConfigInterface{

    protected $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function getAll($type) {
        return $this->model->where('type', $type)->where('deleted', '!=', 1)->get();
    }

    public function updateOvertime($request) {
        $data = $request->all();
        $items = $this->getAll(0);
        $special = $this->getAll(1);
        DB::beginTransaction();
        if (count($special) > 0) {
            $special[0]->value = $data['holiday'];
            $special[0]->update();
        } else {
            $special = new $this->model;
            $special->type = 1;
            $special->value = $data['holiday'];
            $special->save();
        }
        if (isset($data['data_old'])) {
            foreach($items as $item) {
                if (isset($data['data_old'][$item->id])) {
                    $item->hours = $data['data_old'][$item->id]['hours'];
                    $item->value = $data['data_old'][$item->id]['value'];
                } else {
                    $item->deleted = 1;
                }
                $item->update();
            }
        } else {
            foreach($items as $item) {
                $item->deleted = 1;
                $item->update();
            }
        }
        if (isset($data['data_new'])) {
            foreach($data['data_new'] as $item) {
                $overtime = new $this->model;
                $overtime->type = 0;
                $overtime->hours = $item['hours'];
                $overtime->value = $item['value'];
                $overtime->save();
            }
        }

        DB::commit();
    }
}


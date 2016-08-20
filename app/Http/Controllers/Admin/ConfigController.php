<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use App\Exceptions\ValidateException;
use App\Exceptions\NullException;
use App\Exceptions\ExcuteException;

use App\Repositories\Config\ConfigInterface;

class ConfigController extends Controller
{
    protected $config;

    public function __construct(ConfigInterface $config) {
        $this->config = $config;
    }

    public function overtime() {
        $data = [
            'title' => 'Config Overtime',
            'items' => $this->config->getAll(0),
            'special' => $this->config->getAll(1),
        ];
        return view('admin.config.overtime', $data);
    }

    public function updateOvertime(Request $request) {
        try {
            $this->config->updateOvertime($request);
            return redirect()->back()->with('Mess', 'Update Success');
        } catch (ValidateException $e) {
            return redirect()->back()->withInput()->withErrors($e->getErrors());
        }
    }


}
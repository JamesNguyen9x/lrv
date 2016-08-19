<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use App\Exceptions\ValidateException;
use App\Exceptions\NullException;
use App\Exceptions\ExcuteException;

use App\Repositories\Group\GroupInterface;

class GroupsController extends Controller
{
    protected $group;

    public function __construct(GroupInterface $group) {
        $this->group = $group;
    }

    public function index(Request $request) {
        $items = $this->group->getAll(['*']);
        $data = [
            'title' => 'List group',
            'items' => $items
        ];
        return view('admin.group.index', $data);
    }

    public function create() {
        $data = [
            'title' => 'Create Group'
        ];
        return view('admin.group.create', $data);
    }

    public function edit($id) {
        try {
            $data = [
                'title' => 'Update group info',
                'item' => $this->group->find($id)
            ];
            return view('admin.group.edit', $data);
        } catch (App\Exceptions\ValidateException $e) {
            return redirect()->back()->withInput()->withErrors($e->getErrors());
        }
    }

    public function update($id, Request $request) {
        try {
            $this->group->update($id, $request);
            return redirect()->route('admin.groups.index')->with('Mess', 'Update Success!');
        } catch (ValidateException $e) {
            return redirect()->back()->withInput()->withErrors($e->getErrors());
        }
    }

    public function store(Request $request) {
        //authorize('create_users');
        try {
            $this->group->create($request);
            return redirect()->route('admin.groups.index')->with('Mess', 'Create Sucsess!');
        } catch (App\Exceptions\ValidateException $e) {
            return redirect()->back()->withInput()->withErrors($e->getErrors());
        }
    }

    public function destroy($id) {
        try {
            $this->group->delete($id);
            return redirect()->back()->with('Mess', 'Delete Success!');
        } catch (App\Exceptions\ValidateException $e) {
            return redirect()->back()->withInput()->withErrors($e->getErrors());
        }
    }


}
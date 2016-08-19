@extends('layouts.admin')

@section('content')
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit User</h3>
            </div>
            {!! show_errors($errors) !!}
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::model($item, ['method' => 'put', 'route'=>['admin.users.update', $item->id]]) !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" value="{{ $item->email }}" name="email" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">User name</label>
                        <input type="text" value="{{ $item->user_name }}" name="user_name" class="form-control" placeholder="Enter user name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Group</label>
                        {!! Form::select('group_id', $groups, $item->group_id, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            {!! Form::close() !!}
        </div>
        <!-- /.box -->
    </div>

@stop


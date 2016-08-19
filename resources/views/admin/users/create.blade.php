@extends('layouts.admin')

@section('content')
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create User</h3>
            </div>
            {!! show_errors($errors) !!}
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['method' => 'post', 'route'=>'admin.users.store']) !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input required type="email" name="email" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">User name</label>
                        <input required type="text" name="user_name" class="form-control" placeholder="Enter user name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input required type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Group</label>
                        {!! Form::select('group_id', $items, null, ['class' => 'form-control']) !!}
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


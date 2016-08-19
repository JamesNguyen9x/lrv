@extends('layouts.admin')

@section('content')
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create Group User</h3>
            </div>
            {!! show_errors($errors) !!}
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['method' => 'post', 'route'=>'admin.groups.store']) !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Gourp name</label>
                        <input required type="text" name="name" class="form-control" placeholder="Enter group name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Start Time</label>
                        <input required type="time" name="start_time" class="form-control" placeholder="Enter start time">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">End Time</label>
                        <input required type="time" name="end_time" class="form-control" placeholder="Enter end time">
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


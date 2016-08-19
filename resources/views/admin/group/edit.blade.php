@extends('layouts.admin')

@section('content')
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Update Group User</h3>
            </div>
            {!! show_errors($errors) !!}
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::model($item, ['method' => 'put', 'route'=>['admin.groups.update', $item->id]]) !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Gourp name</label>
                        <input required value="{{ $item->name }}" type="text" name="name" class="form-control" placeholder="Enter group name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Start Time</label>
                        <input required value="{{ $item->start_time }}" type="time" name="start_time" class="form-control" placeholder="Enter start time">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">End Time</label>
                        <input required value="{{ $item->end_time }}" type="time" name="end_time" class="form-control" placeholder="Enter end time">
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


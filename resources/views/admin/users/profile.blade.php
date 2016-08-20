@extends('layouts.user')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ auth()->user()->avartar }}" alt="User profile picture">

                    <h3 class="profile-username text-center">{{ auth()->user()->user_name }}</h3>

                    <p class="text-muted text-center">{{ auth()->user()->groupName() }}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Created At</b> <a class="pull-right">{{ auth()->user()->created_at->format('d/m/Y') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Following</b> <a class="pull-right">543</a>
                        </li>
                        <li class="list-group-item">
                            <b>Friends</b> <a class="pull-right">13,287</a>
                        </li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-9">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Infomation</h3>
                </div>
                {!! show_errors($errors) !!}
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($item, ['method' => 'put', 'route'=>['user.updateProfile'], 'files'=>true, 'class' => 'form-horizontal']) !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-9">
                                <input disabled type="email" name="email" value="{{ $item->email }}" class="form-control" id="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user_name" class="col-sm-2 control-label">User Name</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $item->user_name }}" class="form-control" name="user_name" placeholder="User Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="avartar" class="col-sm-2 control-label">Select Avartar</label>
                            <div class="col-sm-9">
                                <input type="file" name="avartar" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-default">Cancel</button>
                        <button type="submit" class="btn btn-info pull-right">Sign in</button>
                    </div>
                    <!-- /.box-footer -->
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@stop


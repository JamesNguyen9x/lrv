@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List Group User</h3>
                </div>
                {!! show_errors($errors) !!}
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>User Name</th>
                            <th>Group</th>
                            <th>Active</th>
                            <th>Created At</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->user_name }}</td>
                                <td>{{ $item->groupName() }}</td>
                                <td>{{ $item->active }}</td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a type="button" href="{{ route('admin.users.edit', $item->id) }}" class="btn btn-block btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['admin.users.destroy', $item->id], 'onsubmit' => 'return ConfirmDelete()']) !!}
                                    <button type="submit" class="btn btn-block btn-danger btn-sm"><i class="fa fa-remove"></i> Delete</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>User Name</th>
                            <th>Group</th>
                            <th>Active</th>
                            <th>Created At</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
<script type="text/javascript">
    function ConfirmDelete() {
        var del = confirm("Are you sure ?");
        return del;
    }
</script>

@stop


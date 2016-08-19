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
                            <th>Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->start_time }}</td>
                                <td>{{ $item->end_time }}</td>
                                <td>
                                    <a type="button" href="{{ route('admin.groups.edit', $item->id) }}" class="btn btn-block btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['admin.groups.destroy', $item->id], 'onsubmit' => 'return ConfirmDelete()']) !!}
                                    <button type="submit" class="btn btn-block btn-danger btn-sm"><i class="fa fa-remove"></i> Delete</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
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


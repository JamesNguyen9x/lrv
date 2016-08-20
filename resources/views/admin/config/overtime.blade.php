@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Config Overtime</h3>
                </div>
                {!! show_errors($errors) !!}
                        <!-- /.box-header -->
                <div class="box-body">
                    {!! Form::open(['method' => 'post', 'route'=>'config.updateOvertime']) !!}
                    <table id="overtime" class="table table-bordered table-hover">
                        <?php $num = 0; ?>
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Hours</th>
                            <th>Coefficient</th>
                            <th>
                                <button type="button" count=@if(count($items) > 0) "{{ count($items) }}" @else "1" @endif id="addRow" class="btn btn-block btn-primary btn-sm"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Add Config</button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($items) > 0)
                            @foreach($items as $item)
                                <?php $num++; ?>
                                <tr>
                                    <td>{{ $num }}</td>
                                    <td>
                                        <input name="data_old[{{ $item->id }}][hours]" value="{{ $item->hours }}" class="form-control input-sm" type="text" placeholder="hours">
                                    </td>
                                    <td>
                                        <input name="data_old[{{ $item->id }}][value]" value="{{ $item->value }}" class="form-control input-sm" type="text" placeholder="Coefficient">
                                    </td>
                                    <td>
                                        <button type="button" count="{{ $num }}" class="remove_row btn btn-block btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;&nbsp;Delete</button>
                                    </td>
                                </tr>
                        @endforeach
                        @else
                            <?php $num++; ?>
                            <tr>
                                <td>{{ $num }}</td>
                                <td>
                                    <input name="data_new[1][hours]" value="" class="form-control input-sm" type="text" placeholder="hours">
                                </td>
                                <td>
                                    <input name="data_new[1][value]" value="" class="form-control input-sm" type="text" placeholder="Coefficient">
                                </td>
                                <td>
                                    <button type="button" count="{{ $num }}" class="remove_row btn btn-block btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;&nbsp;Delete</button>
                                </td>
                            </tr>
                        @endif
                    </table>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="holiday" class="col-sm-2 control-label">Holiday</label>
                            <div class="col-sm-4">
                                <input required type="text" @if(count($special) > 0) value="{{ $special[0]->value }}" @endif class="form-control" name="holiday" placeholder="Coefficient">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"> </i>&nbsp;&nbsp;Save</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@stop
@section('footer')
    <script src="/js/overtime.js"></script>
@stop

@extends('layouts.base')

@section('content')

    <div class="row">
        <div class="col-xs-12" style="text-align: center">
            <h2>Update exposition spot</h2>
            <br>
        </div>
    </div>

    @include ('handlers/error', ["errors" => $errors])

    <form class="form-horizontal" role="form" method="POST" action="{!! $target !!}">
        {!! csrf_field() !!}

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <div class="form-group label-floating">
                                <div class="col-md-10 col-md-offset-1">
                                    <label for="i5" class="control-label">type</label>
                                    <select name="type" class="form-control" id="spot-type-select">
                                        <?php $options = ["floor", "wall", "ceiling"] ?>
                                        @foreach ($options as $option)
                                            @if ($option == $selected[0]->type)
                                                <option value="{!! $option !!}" selected>{!! $option !!}</option>
                                            @else
                                                <option value="{!! $option !!}">{!! $option !!}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group label-floating">
                                <div class="col-md-10 col-md-offset-1">
                                    <label for="i5" class="control-label">size</label>
                                    <input type="text" class="form-control" name="size"
                                           value="{!! $selected[0]->size !!}">
                                </div>
                            </div>

                            <div class="form-group label-floating">
                                <div class="col-md-10 col-md-offset-1">
                                    <label for="i5" class="control-label">cost</label>
                                    <input type="text" class="form-control" name="cost"
                                           value="{!! $selected[0]->cost !!}">
                                </div>
                            </div>

                            <div class="form-group label-floating">
                                <div class="col-md-10 col-md-offset-1">
                                    <label for="i5" class="control-label">room</label>
                                    <select name="room" class="form-control" id="spot-room-select">
                                        @foreach($rooms as $room)
                                            @if ($room->id == $selected[0]->roomid)
                                                <option value="{!! $room->id !!}" selected>{!! $room->id !!}</option>
                                            @else
                                                <option value="{!! $room->id !!}">{!! $room->id !!}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @if(isset($employees))
                                <div class="form-group label-floating">
                                    <div class="col-md-10 col-md-offset-1">
                                        <label for="i5" class="control-label">responsible</label>
                                        <select name="employee" class="form-control" id="spot-employee-select">
                                            <option value="empty">Not set</option>
                                            @foreach($employees as $employee)
                                                @if ($employee->id == $selected[0]->responsibility)
                                                    <option value="{!! $employee->id !!}" selected>
                                                        {!! $employee->name !!} {!! $employee->surname !!}
                                                    </option>
                                                @else
                                                    <option value="{!! $employee->id !!}">
                                                        {!! $employee->name !!} {!! $employee->surname !!}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-1">
                                    <button type="submit" class="btn btn-primary">edit</button>
                                    <input type="hidden" class="form-control" name="requesttype" value="1">
                                    <input type="hidden" class="form-control" name="id" value="{!! $selected[0]->id !!}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <form class="form-horizontal" role="form" method="POST" action="{!! $target !!}">
        {!! csrf_field() !!}

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <div class="form-group label-floating">
                                <div class="col-md-10 col-md-offset-1">
                                    <label for="i5" class="control-label">count</label>
                                    <input type="text" class="form-control" name="count"
                                           value="1">
                                </div>
                            </div>

                            <div class="form-group label-floating">
                                <div class="col-md-10 col-md-offset-1">
                                    <label for="i5" class="control-label">equipment type</label>
                                    <select name="equipment" class="form-control" id="equipment-select">
                                        @foreach($equipments as $equipment)
                                            <option value="{!! $equipment->id !!}">
                                                {!! $equipment->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-1">
                                    <button type="submit" class="btn btn-primary">add equipment</button>
                                    <input type="hidden" class="form-control" name="requesttype" value="2">
                                    <input type="hidden" class="form-control" name="id" value="{!! $selected[0]->id !!}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @include("layouts.select", [
        "table" => $table,
        "header" => $header,
        "target" => $target,
        "returnvalue" => $selected[0]->id,
        "action" => "delete"
    ])

@stop

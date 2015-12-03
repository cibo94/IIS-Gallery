@extends('layouts.base')

@section('content')


    <div class="row">
        <div class="col-xs-12" style="text-align: center">
            <h2>Select exposition</h2>
            <br>
    </div>
    </div>

    <form class="form-horizontal" role="form" method="POST" action="{!! $target !!}">
        {!! csrf_field() !!}

        @include ('handlers/error', ["errors" => $errors])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <div class="form-group label-floating">
                                <div class="col-md-10 col-md-offset-1">
                                    <label for="i5" class="control-label">Exposition</label>
                                    <select name="id" class="form-control" id="artwork-select">
                                        @foreach($expositions as $exposition)
                                            <option value="{!! $exposition->id !!}">
                                                {!! $exposition->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-1">
                                    <button type="submit" class="btn btn-primary">Select exposition</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @include('layouts/table', ['table' => $table, 'header' => $header])

@stop
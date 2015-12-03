@extends('layouts.base')

@section('content')


    <div class="row">
        <div class="col-xs-12" style="text-align: center">
            <h1>Create new exposition</h1>
            <br>
            <p>Please insert dates in <b>DD-MM-YYYY</b> (day-month-year) format.</p>
            <br>
        </div>
    </div>

    @include("layouts.insert", [
        "table" => $table,
        "header" => $header,
        "target" => $target
    ])
@stop
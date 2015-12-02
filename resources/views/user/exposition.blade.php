@extends('layouts.base')

@section('content')


    <div class="row">
        <div class="col-xs-12" style="text-align: center">
            <h1>Exposition management</h1>
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

    @include ('handlers/error', ["errors" => $errors])
@stop
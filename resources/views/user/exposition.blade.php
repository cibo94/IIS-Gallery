@extends('layouts.base')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <h1>Exposition management</h1>

            <p>Following table displays your expositions. You can create new exposition by
                filling table header and pressing insert button below.</p>
            <p>Please insert dates in <b>DD-MM-YYYY</b> (day-month-year) format.</p>
        </div>
    </div>

    @include("layouts.insert", [
        "table" => $table,
        "header" => $header,
        "target" => $target
    ])

    @include ('handlers/error', ["errors" => $errors])
@stop
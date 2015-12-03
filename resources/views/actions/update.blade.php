@extends('layouts.base')

@section('content')

    @include("layouts.update", [
        "table" => $table,
        "header" => $header,
        "target" => $target
    ])
@stop

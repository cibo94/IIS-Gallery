@extends('layouts.base')

@section('content')

    @include("layouts.select", [
        "table" => $table,
        "header" => $header,
        "target" => $target,
        "action" => "delete"
    ])
@stop

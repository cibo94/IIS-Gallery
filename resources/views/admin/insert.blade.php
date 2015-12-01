@extends('layouts.base')

@section('content')

    @include("layouts.insert", [
        "table" => $table,
        "header" => $header,
        "target" => $target
    ])

@stop

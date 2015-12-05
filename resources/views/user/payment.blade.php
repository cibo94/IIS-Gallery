@extends('layouts.base')

@section('content')

    @include("layouts.select", [
        "table" => $table,
        "header" => $header,
        "target" => $target,
        "action" => "pay"
    ])
    
@stop
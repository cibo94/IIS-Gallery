@extends('layouts.base')

@section('content')

    <div class="row">
        <h1>ADMIN Your exhibitions</h1>

        @include('table', ['table' => $table, 'header' => $header])
    </div>

@stop

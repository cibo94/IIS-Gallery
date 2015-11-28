@extends('layouts.base')

@section('content')

    <div class="row">
        <h1>Your exhibitions</h1>

        @include('layouts/table', ['table' => $table, 'header' => $header])
    </div>

@stop

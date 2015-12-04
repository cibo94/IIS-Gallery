@extends('layouts.base')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <h1>Gallery</h1>
            <p>Best unreal gallery in the world</p>
            <h2>Current exhibitions</h2>
        </div>
    </div>

    @include('layouts/table', ['table' => $table, 'header' => $header])
@stop

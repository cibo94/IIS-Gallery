@extends('layouts.base')

@section('content')

    <div class="row">
        <div class="col-xs-12" style="text-align: center">
            <h1>Gallery</h1>
            <p>Best unreal gallery in the world</p>
            <h2>Currently presenting</h2>
        </div>
    </div>

    @include('layouts/table', ['table' => $table, 'header' => $header])

    <div class="row">
        <div class="col-xs-12" style="text-align: center">
            <h2>Preparing</h2>
        </div>
    </div>

    @include('layouts/table', ['table' => $planned, 'header' => $header])
@stop

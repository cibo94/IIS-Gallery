@extends('layouts.base')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <h1>Galéria</h1>

            <p>Najlepšia neexistujúca galéria na svete</p>

            <h2>Práve vystavujeme</h2>
        </div>
    </div>

    @include('table', ['table' => $table, 'header' => $header])
@stop

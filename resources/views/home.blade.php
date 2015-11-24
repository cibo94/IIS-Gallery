@extends('layouts.base')

@section('content')

    <div class="row">
        <h1>Galéria</h1>
        <p>Najlepšia neexistujúca galéria na svete</p>
        <h2>Práve vystavujeme</h2>

    </div>

    @include('table', ['table' => $table, 'header' => $header])

@stop

@extends('layouts.base')

@section('content')

    <div class="row">
        <div class="text-center">
            <h2>Pending transactions</h2>
        </div>
    </div>
    @include('layouts/table', ['table' => $unpayed, 'header' => $header])

    <div class="row">
        <div class="text-center">
            <h2>Finished transactions</h2>
        </div>
    </div>
    @include('layouts/table', ['table' => $payed, 'header' => $header])

@stop
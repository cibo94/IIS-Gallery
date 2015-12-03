@extends('layouts.base')

@section('content')


    <div class="row">
        <div class="col-xs-12">
            <h1>Update existing exposition</h1>
            <br>
            <h2> Vybrana expo </h2>
            @include('layouts/table', ['table' => $exposition, 'header' => ["odCas", "doCas", "nazov"]])
            <br>
            <h2> Vhodne expozicne miesta </h2>
            @include('layouts/table', ['table' => $spots, 'header' => ["IDmiesta", "typ", "velkost", "cena"]])
            <br>
            <h2> Vhodne diela na vlozenie do expozicie </h2>
            @include('layouts/table', ['table' => $artworks, 'header' => ["IDdiela", "nazov", "autor", "typ"]])

        </div>
    </div>

    @include ('handlers/error', ["errors" => $errors])
@stop
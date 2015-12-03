@extends('layouts.base')

@section('content')


    <div class="row">
        <div class="text-center">
            <h1>Update existing exposition</h1>
        </div>
    </div>

    <div class="col-md-8 col-md-offset-2">
        <table class="display table table-striped table-hover table-bordered table-condensed">
            <tbody>
                <tr>
                    <td><strong>exposition name</strong></td>
                    <td>{!! $exposition[0]->nazov !!}</td>
                </tr>
                <tr>
                    <td><strong>from</strong></td>
                    <td>{!! $exposition[0]->odCas !!}</td>
                </tr>
                <tr>
                    <td><strong>until</strong></td>
                    <td>{!! $exposition[0]->doCas !!}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <form class="form-horizontal" role="form" method="POST" action="{!! $target !!}">
        {!! csrf_field() !!}

        <input type="hidden" class="form-control" name="id" value="{!! $exposition[0]->id !!}">

        @include ('handlers/error', ["errors" => $errors])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <div class="form-group label-floating">
                                <div class="col-md-10 col-md-offset-1">
                                    <label for="i5" class="control-label">Exposition spot</label>
                                    <select name="spot" class="form-control" id="spot-select">
                                        @foreach($spots as $spot)
                                            <option value="{!! $spot->id !!}">
                                                Type: {!! $spot->type !!}, Size: {!! $spot->size !!}, Cost:{!! $spot->cost !!}€
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group label-floating">
                                <div class="col-md-10 col-md-offset-1">
                                    <label for="i5" class="control-label">Artwork</label>
                                    <select name="artwork" class="form-control" id="artwork-select">
                                        @foreach($artworks as $artwork)
                                            <option value="{!! $artwork->id !!}">
                                                Name: {!! $artwork->name !!}, Author: {!! $artwork->author !!}, Type: {!! $artwork->type !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-1">
                                    <button type="submit" class="btn btn-primary">Commit reservation</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @include('layouts/table', ['table' => $table, 'header' => $header])
@stop
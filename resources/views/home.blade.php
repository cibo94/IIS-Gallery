@extends('layouts.base')

@section('content')

    <div class="row">
        <h1>Welcome to my website</h1>
        <p>We are creating something beautiful today.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

    </div>

    @include('table', ['table' => DB::select('select * from Autor'), 'header' => Schema::getColumnListing('Autor')])

    <div class="form-group label-static">
        <label for="i2" class="control-label">label-static</label>
        <input type="email" class="form-control" id="i2" placeholder="placeholder attribute">
        <p class="help-block">This is a hint as a <code>p.help-block.hint</code></p>
    </div>

    <div class="form-group label-floating">
        <label for="i5" class="control-label">label-floating</label>
        <input type="email" class="form-control" id="i5">
        <span class="help-block">This is a hint as a <code>span.help-block.hint</code></span>
    </div>

    <div class="form-group label-placeholder">
        <label for="i5p" class="control-label">label-placeholder</label>
        <input type="email" class="form-control" id="i5p">
        <span class="help-block">This is a hint as a <code>span.help-block.hint</code></span>
    </div>

@stop

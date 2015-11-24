@extends('layouts.base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>

                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
                            {!! csrf_field() !!}

                            <div class="form-group label-floating">
                                <div class="col-md-8 col-md-offset-2">
                                    <label for="i5" class="control-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="form-group label-floating">
                                <div class="col-md-8 col-md-offset-2">
                                    <label for="i5" class="control-label">E-mail</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group label-floating">
                                <div class="col-md-8 col-md-offset-2">
                                    <label for="i5" class="control-label">Password</label>
                                    <input type="password" class="form-control" name="password">
                                    <span class="help-block">With more than 6 characters.</span>
                                </div>
                            </div>

                            <div class="form-group label-floating">
                                <div class="col-md-8 col-md-offset-2">
                                    <label for="i5" class="control-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-1">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
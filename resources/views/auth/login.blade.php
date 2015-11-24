@extends('layouts.base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
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

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                            {!! csrf_field() !!}

                            <div class="form-group label-floating">
                                <div class="col-md-8 col-md-offset-2">
                                    <label for="i5" class="control-label">E-mail</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" >
                                </div>
                            </div>

                            <div class="form-group label-floating">
                                <div class="col-md-8 col-md-offset-2">
                                    <label for="i5" class="control-label">Password</label>
                                    <input type="password" class="form-control" name="password" >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-1">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                                    <a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
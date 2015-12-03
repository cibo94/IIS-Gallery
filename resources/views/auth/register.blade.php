@extends('layouts.base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="/auth/register">
                            {!! csrf_field() !!}

                            <div class="form-group label-floating">
                                <div class="col-md-8 col-md-offset-2">
                                    <label for="i5" class="control-label">user name</label>
                                    <input type="text" class="form-control" name="name" value="{!! old("name") !!}">
                                </div>
                            </div>

                            <div class="form-group label-floating">
                                <div class="col-md-8 col-md-offset-2">
                                    <label for="i5" class="control-label">e-mail</label>
                                    <input type="email" class="form-control" name="email" value="{!! old("email") !!}">
                                </div>
                            </div>

                            <div class="form-group label-floating">
                                <div class="col-md-8 col-md-offset-2">
                                    <label for="i5" class="control-label">password</label>
                                    <input type="password" class="form-control" name="password" value="">
                                </div>
                            </div>

                            <div class="form-group label-floating">
                                <div class="col-md-8 col-md-offset-2">
                                    <label for="i5" class="control-label">confirm password</label>
                                    <input type="password" class="form-control" name="password_confirmation" value="">
                                </div>
                            </div>

                            <div class="form-group label-floating">
                                <div class="col-md-8 col-md-offset-2">
                                    <label for="i5" class="control-label">role</label>
                                    <select name="role" class="form-control" id="role-select">
                                        <option value="agency">agency</option>
                                        <option value="artist">artist</option>
                                    </select>
                                </div>
                            </div>

                            <div id="agency">
                                <div class="form-group label-floating">
                                    <div class="col-md-8 col-md-offset-2">
                                        <label for="i5" class="control-label">agency name</label>
                                        <input type="text" class="form-control" name="agency-name" value="{!! old("agency-name") !!}">
                                    </div>
                                </div>

                                <div class="form-group label-floating">
                                    <div class="col-md-8 col-md-offset-2">
                                        <label for="i5" class="control-label">web</label>
                                        <input type="text" class="form-control" name="web" value="{!! old("web") !!}">
                                    </div>
                                </div>
                            </div>

                            <div id="artist" style="display: none">
                                <div class="form-group label-floating">
                                    <div class="col-md-8 col-md-offset-2">
                                        <label for="i5" class="control-label">first name</label>
                                        <input type="text" class="form-control" name="first-name" value="{!! old("first-name") !!}">
                                    </div>
                                </div>

                                <div class="form-group label-floating">
                                    <div class="col-md-8 col-md-offset-2">
                                        <label for="i5" class="control-label">last name</label>
                                        <input type="text" class="form-control" name="last-name" value="{!! old("last-name") !!}">
                                    </div>
                                </div>

                                <div class="form-group label-floating">
                                    <div class="col-md-8 col-md-offset-2">
                                        <label for="i5" class="control-label">contact</label>
                                        <input type="text" class="form-control" name="contact" value="{!! old("contact") !!}">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-1">
                                    <button type="submit" class="btn btn-primary">register</button>
                                </div>
                            </div>
                        </form>

                        {!! Html::script('js/jquery.min.js') !!}

                        <script>
                            $( document ).ready(function () {
                                $("#role-select").change(function (e) {
                                    console.log($(this).val());
                                    if ($(this).val() == 'agency') {
                                        $("#agency").css("display", "block");
                                        $("#artist").css("display", "none");
                                    } else {
                                        $("#agency").css("display", "none");
                                        $("#artist").css("display", "block");
                                    }
                                });
                            });
                        </script>
                        @include ('handlers/error', ["errors" => $errors])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>

                    <div class="panel-body">
                        @include ('layouts/form', [
                            "fields" => [
                                [
                                    "label" => "name",
                                    "name" => "name",
                                    "type" => "text"
                                ],
                                [
                                    "label" => "e-mail",
                                    "name" => "email",
                                    "type" => "email"
                                ],
                                [
                                    "label" => "password",
                                    "name" => "password",
                                    "type" => "password"
                                ],
                                [
                                    "label" => "confirm password",
                                    "name" => "password_confirmation",
                                    "type" => "password"
                                ]
                            ],
                            "checkboxes" => [ ],
                            "target" => "/auth/register",
                            "buttons" => [
                                [
                                    "type" => "submit",
                                    "label" => "register"
                                ]
                            ],
                            "referencies" => [ ],
                            "errors" => $errors
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
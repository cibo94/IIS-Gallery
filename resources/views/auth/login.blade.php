@extends('layouts.base')

@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">

                        @include ('layouts/form', [
                            "fields" => [
                                [
                                    "label" => "e-mail",
                                    "name" => "email",
                                    "type" => "email"
                                ],
                                [
                                    "label" => "password",
                                    "name" => "password",
                                    "type" => "password"
                                ]
                            ],
                            "checkboxes" => [
                                [
                                    "label" => "remember me",
                                    "name" => "remember"
                                ]
                            ],
                            "target" => "/auth/login",
                            "buttons" => [
                                [
                                    "type" => "submit",
                                    "label" => "submit"
                                ]
                            ],
                            "referencies" => [
                                [
                                    "url" => "/password/email",
                                    "label" => "forgot password?"
                                ]
                            ],
                            "errors" => $errors
                        ])

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
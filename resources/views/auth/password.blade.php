@extends('layouts.base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Reset Password</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                            @include ('layouts/form', [
                                "fields" => [
                                    [
                                        "label" => "e-mail",
                                        "name" => "email",
                                        "type" => "email"
                                    ]
                                ],
                                "target" => "/password/email",
                                "checkboxes" => [],
                                "buttons" => [
                                    [
                                        "type" => "submit",
                                        "label" => "send password reset link"
                                    ]
                                ],
                                "referencies" => [],
                                "errors" => null
                            ])

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
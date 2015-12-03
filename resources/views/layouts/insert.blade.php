<form class="form-horizontal" role="form" method="POST" action="{!! $target !!}">
    {!! csrf_field() !!}

    @include ('handlers/error', ["errors" => $errors])

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @foreach($header as $head)
                            <div class="form-group label-floating">
                                <div class="col-md-10 col-md-offset-1">

                                    <label for="i5" class="control-label">{!! $head !!}</label>
                                    @if ($head == "password")
                                        <input type="password" class="form-control" name="{!! $head !!}"
                                               value="{!! old($head) !!}">
                                    @elseif ($head == "email")
                                        <input type="email" class="form-control" name="{!! $head !!}"
                                               value="{!! old($head) !!}">
                                    @else
                                        <input type="text" class="form-control" name="{!! $head !!}"
                                               value="{!! old($head) !!}">
                                    @endif

                                </div>
                            </div>
                        @endforeach

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-1">
                                <button type="submit" class="btn btn-primary">create new</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts/table', ['table' => $table, 'header' => $header])
</form>
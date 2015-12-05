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
                                    @elseif ($head == "role")
                                        Employee
                                    @elseif ($head == "room")
                                        <select name={!! $head !!} class="form-control" id="room-select">
                                            @foreach($rooms as $room)
                                                <option value="{!! $room->id !!}">{!! $room->id !!}</option>
                                            @endforeach
                                        </select>
                                    @elseif ($head == "responsibility")
                                        <select name={!! $head !!} class="form-control" id="employee-select">
                                            @foreach($employees as $employee)
                                                <option value="{!! $employee->id !!}">
                                                    {!! $employee->name !!} {!! $employee->surname !!}
                                                </option>
                                            @endforeach
                                        </select>
                                    @elseif ($head == "spot type")
                                        <select name="spottype" class="form-control" id="spot-type-select">
                                            <option value="floor">floor</option>
                                            <option value="wall">wall</option>
                                            <option value="ceiling">ceiling</option>
                                        </select>
                                    @elseif ($head == "artwork type")
                                        <select name="artworktype" class="form-control" id="artwork-type-select">
                                            <option value="charcoal drawing">charcoal drawing</option>
                                            <option value="chalk drawing">chalk drawing</option>
                                            <option value="pastel drawing">pastel drawing</option>
                                            <option value="pencil drawing">pencil drawing</option>
                                            <option value="pen and ink drawing">pen and ink drawing</option>
                                            <option value="caricature drawing">caricature drawing</option>
                                            <option value="encaustic painting">encaustic painting</option>
                                            <option value="tempera painting">tempera painting</option>
                                            <option value="ink and wash painting">ink and wash painting</option>
                                            <option value="oil painting">oil painting</option>
                                            <option value="watercolour painting">watercolour painting</option>
                                            <option value="acrylics painting">acrylics painting</option>
                                            <option value="bronze sculpture">bronze sculpture</option>
                                            <option value="stone sculpture">stone sculpture</option>
                                            <option value="iron sculpture">iron sculpture</option>
                                            <option value="wood-carving">wood-carving</option>
                                            <option value="photography">photography</option>
                                            <option value="other">other</option>
                                        </select>
                                    @elseif ($head == "exposition")
                                        <select name={!! $head !!} class="form-control" id="exposition-select">
                                            @foreach($expositions as $exposition)
                                                <option value="{!! $exposition->id !!}">
                                                    {!! $exposition->nazov !!}
                                                </option>
                                            @endforeach
                                        </select>
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
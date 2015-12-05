<form class="form-horizontal" role="form" method="POST" action="{!! $target !!}">
    {!! csrf_field() !!}

    @include ('handlers/error', ["errors" => $errors])

    <div class="form-group">
        <div class="">
            <button type="submit" class="btn btn-primary">submit</button>
        </div>
    </div>

    <table class="display table table-hover data-table compact">
        <thead>
        <tr>
            @foreach($header as $head)
                <th>{!! $head !!}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($table as $row)
            <tr>
                @foreach($row as $key => $item)
                    @if ($item == "")
                        <?php $item = "Not set" ?>
                    @endif
                    @if ($key != "id")
                        <td>
                            <div class="form-group label-floating">
                                <div class="col-md-12">
                                    @if ($key == "password")
                                        <label for="i5" class="control-label">
                                            ******
                                        </label>
                                        <input class="form-control" type="password"
                                               name="{!! $row->id !!}-{!! $key !!}"/>
                                    @elseif ($key == "arttype")
                                        <label for="i5" class="control-label">
                                            {!! $item !!}
                                        </label>
                                        <select name="{!! $row->id !!}-{!! $key !!}" class="form-control select">
                                            <?php $options = ["charcoal drawing", "chalk drawing", "pastel drawing",
                                                    "pencil drawing", "pen and ink drawing", "caricature drawing",
                                                    "encaustic painting", "tempera painting", "ink and wash painting",
                                                    "oil painting", "watercolour painting", "acrylics painting",
                                                    "bronze sculpture", "stone sculpture", "iron sculpture",
                                                    "wood-carving", "photography", "other"] ?>
                                            <option value=""></option>
                                            @foreach ($options as $option)
                                                <option value="{!! $option !!}">{!! $option !!}</option>
                                            @endforeach
                                        </select>
                                    @elseif ($key == "spottype")
                                        <label for="i5" class="control-label">
                                            {!! $item !!}
                                        </label>
                                        <select name="{!! $row->id !!}-{!! $key !!}" class="form-control select"
                                                id="spotselect">
                                            <?php $options = ["floor", "wall", "ceiling"] ?>
                                            <option value=""></option>
                                            @foreach ($options as $option)
                                                <option value="{!! $option !!}">{!! $option !!}</option>
                                            @endforeach
                                        </select>
                                    @elseif ($key == "roomid")
                                        <label for="i5" class="control-label">
                                            {!! $item !!}
                                        </label>
                                        <select name="{!! $row->id !!}-{!! $key !!}" class="form-control select">
                                            <option value=""></option>
                                            @foreach($rooms as $room)
                                                <option value="{!! $room->id !!}">{!! $room->id !!}</option>
                                            @endforeach
                                        </select>
                                    @elseif ($key == "employeeid")
                                        <label for="i5" class="control-label">
                                            employee
                                        </label>
                                        <select name="{!! $row->id !!}-{!! $key !!}" class="form-control select">
                                            <option value=""></option>
                                            @foreach($employees as $employee)
                                                <option value="{!! $employee->id !!}">
                                                    {!! $employee->name !!} {!! $employee->surname !!}
                                                </option>
                                            @endforeach
                                        </select>
                                    @else
                                        <label for="i5" class="control-label"
                                               style="max-width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                            {!! $item !!}
                                        </label>
                                        <input class="form-control" type="text" name="{!! $row->id !!}-{!! $key !!}"/>
                                    @endif
                                </div>
                            </div>
                        </td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</form>
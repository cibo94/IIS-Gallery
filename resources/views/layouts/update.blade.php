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
                    @if ($key != "id")
                        <td>
                            <div class="form-group label-floating">
                                <div class="col-md-12">
                                    @if ($key == "password")
                                        <label for="i5" class="control-label">
                                            ******
                                        </label>
                                        <input class="form-control" type="password" name="{!! $row->id !!}-{!! $key !!}" />
                                    @else
                                        <label for="i5" class="control-label" style="max-width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                            {!! $item !!}
                                        </label>
                                        <input class="form-control" type="text" name="{!! $row->id !!}-{!! $key !!}" />
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
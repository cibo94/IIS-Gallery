<form class="form-horizontal" role="form" method="POST" action="{!! $target !!}">
    {!! csrf_field() !!}

    @include ('handlers/error', ["errors" => $errors])

    <div class="form-group">
        <div class="">
            <button type="submit" class="btn btn-primary">{!! $action !!} selected</button>
        </div>
    </div>

    <table class="display table table-hover data-table compact">
        <thead>
        <tr>
            <th>{!! $action !!}?</th>
            @foreach($header as $head)
                <th>{!! $head !!}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($table as $row)
            <tr>
                <td>
                    <div class="checkbox">
                        <label>
                            <input value="{!! $action !!}" name="{!! $row->id !!}" type="checkbox"/>
                        </label>
                    </div>
                </td>
                @foreach($row as $key => $item)
                    @if ($key != "id")
                        <td>{!! $item !!}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    @if(isset($returnvalue))
        <input type="hidden" class="form-control" name="returnvalue" value="{!! $returnvalue !!}">
    @endif
</form>
<form class="form-horizontal" role="form" method="POST" action="{!! $target !!}">
    {!! csrf_field() !!}

    <div class="form-group">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary">insert</button>
        </div>
    </div>

    <table class="display table table-hover">
        <thead>
            <tr>
                @foreach($header as $head)
                    <th>{!! $head !!}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach($header as $head)
                    <td>
                        <div class="form-group" style="padding: 15px; padding-top: 0px; margin-top: 0px;">
                            @if ($head == "password")
                                <input type="password" class="form-control" name="{!! $head !!}"
                                       value="{!! old($head) !!}">
                            @else
                                @if ($head == "email")
                                    <input type="email" class="form-control" name="{!! $head !!}"
                                           value="{!! old($head) !!}">
                                @else
                                    <input type="text" class="form-control" name="{!! $head !!}"
                                           value="{!! old($head) !!}">
                                @endif
                            @endif
                        </div>
                    </td>
                @endforeach
            </tr>
            @foreach($table as $row)
                <tr>
                    @foreach($row as $item)
                        <div class="col-md-1">
                            <td style="max-width: 100px; overflow: hidden; white-space: nowrap;">{!! $item !!}</td>
                        </div>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
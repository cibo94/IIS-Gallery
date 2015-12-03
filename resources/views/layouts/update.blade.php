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
                                        <input class="form-control" type="password"
                                               name="{!! $row->id !!}-{!! $key !!}"/>
                                    @elseif ($key == "typ")
                                        <label for="i5" class="control-label">
                                            {!! $item !!}
                                        </label>
                                        <select name="{!! $row->id !!}-{!! $key !!}" class="form-control select"
                                                selected="{!! $item !!}">
                                            <option value=""></option>
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
<form class="form-horizontal" role="form" method="POST" action="{{ url($target) }}">
    {!! csrf_field() !!}

    @foreach($fields as $field)

        <div class="form-group label-floating">
            <div class="col-md-8 col-md-offset-2">

                @if (array_key_exists('label', $field))
                    <label for="i5" class="control-label">{!! $field["label"] !!}</label>
                @endif

                @if (array_key_exists('type', $field))
                    <input type="{!! $field["type"] !!}" class="form-control"
                           name="{!! $field["name"] !!}"

                        @if ($field["name"] != "password")
                           value="{!! old($field["name"]) !!}"
                        @endif
                    >
                @endif

            </div>
        </div>

    @endforeach

    @foreach($checkboxes as $chbx)

        <div class="form-group">
            <div class="col-md-6 col-md-offset-2">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="{!! $chbx["name"] !!}"> {!! $chbx["label"] !!}
                    </label>
                </div>
            </div>
        </div>

    @endforeach


    <div class="form-group">

        <div class="col-md-6 col-md-offset-1">
            @foreach($buttons as $btn)
                <button type="{!! $btn["type"] !!}" class="btn btn-primary">{!! $btn["label"] !!}</button>
            @endforeach
        </div>

        @foreach($referencies as $refs)
            <a class="btn btn-link" href="{!!  url($refs["url"])  !!}">{!! $refs["label"] !!}</a>
        @endforeach

    </div>
</form>

@include ('handlers/error', ["errors" => $errors])
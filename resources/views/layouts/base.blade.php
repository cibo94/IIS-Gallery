<!DOCTYPE html>
<html>
<head>
    <title>Laravel is awesome</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    {!! Html::style('css/app.css') !!}
    {!! Html::style('css/bootstrap.min.css') !!}

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.4.4/css/roboto.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.4.4/css/ripples.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.4.4/css/material.min.css" />

    <!-- Dropdown.js -->
    <link href="//cdn.rawgit.com/FezVrasta/dropdown.js/master/jquery.dropdown.css" rel="stylesheet">


</head>

<nav class="navbar navbar-default navbar-fixed-top navbar-material-blue-grey">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Gallery</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/">home</a></li>
                <li><a href="/exhibition">exhibition</a></li>
                <li><a href="/about">about</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    @if (Auth::user()->role == "user")
                        <li><a href="/user/account">
                    @else
                        <li><a href="/admin/account">
                    @endif
                                <span class="glyphicon glyphicon-user"></span> {!! Auth::user()->name !!}
                            </a>
                        </li>
                    <li><a href="/auth/logout"><span class="glyphicon glyphicon-off"></span> log-out</a></li>
                @else
                    <li><a href="/auth/login"><span class="glyphicon glyphicon-log-in"></span> log-in</a></li>
                    <li><a href="/auth/register"><span class="glyphicon glyphicon-plus"></span> sign-in</a></li>
                @endif
            </ul>
        </div><!--/collapse navbar-collapse -->
    </div><!--/container-fluid -->
</nav>

<body>

<div class="container" style="padding-top: 100px; padding-bottom: 50px;">
    @yield('content')
</div><!-- /.container -->



{!! Html::script('js/jquery.min.js') !!}


{!! Html::script('js/bootstrap.min.js') !!}
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.4.4/js/material.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.4.4/js/ripples.min.js"></script>


<script src="//cdn.rawgit.com/FezVrasta/dropdown.js/master/jquery.dropdown.js"></script>
<script>
    $.material.init();
    $(document).ready(function() {
        $(".select").dropdown({"optionClass": "withripple"});
    });
    $().dropdown({autoinit: "select"});
</script>


</body>
</html>

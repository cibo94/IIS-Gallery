<!DOCTYPE html>
<html>
<head>
    <title>Laravel is awesome</title>

    {!! Html::style('css/app.css') !!}
    {!! Html::style('css/bootstrap.min.css') !!}

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.4.4/css/material.min.css" />


    <style>
        body { padding-top: 60px; }
        @media (max-width: 979px) {
            body { padding-top: 0px; }
        }
    </style>
</head>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">IIS Gallery</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/home">Home</a></li>
                <li><a href="/#about">About</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li><a href="/">Logged in as '{!! Auth::user()->name !!}'</a></li>
                    <li><a href="/auth/logout">Logout</a></li>
                @else
                    <li><a href="/auth/login">Login</a></li>
                    <li><a href="/auth/register">Sign in</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<body>
<div class="container" style="padding-top: 50px;">
    @yield('content')
</div><!-- /.container -->



{!! Html::script('js/jquery.min.js') !!}
{!! Html::script('js/bootstrap-theme.min.js') !!}
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.4.4/js/material.min.js"></script>
<script>
    $.material.init();
</script>

</body>
</html>

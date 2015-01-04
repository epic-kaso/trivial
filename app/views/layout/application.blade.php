<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <title>Cloud Service</title>
    @yield('stylesheets')
</head>
<body>
@yield('content')

@yield('scripts')
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js')  }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')  }}" type="text/javascript"></script>
</body>
</html>

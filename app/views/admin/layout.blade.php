<!DOCTYPE html>
<html ng-app="AdminApp">
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <title>Admin | Cloud Service</title>
    @yield('stylesheets')
</head>
<body style="position: relative;">
@include('pages.partials.notifications')
@yield('content')

<footer>
    <div class="container">
        <div class="row text-center">
            <a href="#">about us</a>
            <a href="#">privacy</a>
            <a href="#">copyright</a>
            <a href="#">terms & condition</a>
            <a href="#">blog</a>
        </div>
        <div class="row text-center">
            <p class="text-muted">&copy; copyright of landar studio limited, RC 1230157 </p>
        </div>
    </div>
</footer>
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js')  }}" type="text/javascript"></script>
<script src="{{asset('js/jquery-ujs.js')}}" type="text/javascript"></script>
<script src="{{ asset('bower_components/angular/angular.js')  }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/angular-bootstrap/ui-bootstrap-tpls.js')  }}"
        type="text/javascript"></script>
<script src="{{ asset('bower_components/angular-ui-router/release/angular-ui-router.js')  }}"
        type="text/javascript"></script>
@include('admin.partials.js_users')
@include('admin.partials.js_user_files')
<script src="{{ asset('admin/start.js')  }}" type="text/javascript"></script>
@yield('scripts')
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-58300906-1', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>

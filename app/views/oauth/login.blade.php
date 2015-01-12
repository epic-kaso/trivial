<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <title></title>
</head>
<body>
<div class="container">
    <div class="col-md-4 col-md-offset-4">
        {{ Form::open(['url' => route('oauth-login.post')]) }}
        {{ Form::hidden('client_id',1) }}
        {{ Form::hidden('grant_type','password') }}
        {{ Form::hidden('client_secret','johnbull') }}
        <div class="form-group">
            <input class="form-control" type="text" name="username" placeholder="Email"/>
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Password"/>
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Login"/>
        </div>
        {{ Form::close() }}
    </div>
</div>
</body>
</html>
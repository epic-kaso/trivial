@extends('layout.application')
@section('content')
    <div class="container">
        <div class="space" style="height: 120px;">
        </div>
        <div class="col-md-12 text-center" style="margin-bottom: 25px">
            <div class="form-group">
                <h2>Register. Share File. Make Money</h2>

                <p class="text-muted">Make money sharing your files with your unique link</p>
            </div>
        </div>

        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-md-5">
                    {{ Form::open(['url' => route('user.process-register')]) }}
                    <div class="form-group">
                        <input class="form-control" type="text" name="email" placeholder="Email"/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password"/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password_confirmation"
                               placeholder="Password Confirmation"/>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary btn-block" type="submit" value="Register"/>
                    </div>
                    {{ Form::close() }}
                    <div class="form-group">
                        <a href="{{ route('user.show-login') }}" class="pull-right">Login</a>
                    </div>
                </div>

                <div class="col-md-2">
                    <span></span>
                </div>

                <div class="col-md-5">
                    <a href="{{ route('user.facebook-login') }}" class="btn btn-facebook btn-block">
                        <span class="fa fa-facebook pull-left"></span> SignUp with Facebook
                    </a>
                    <a href="{{ route('user.google-login') }}" class="btn btn-google-plus btn-block">
                        <span class="fa fa-google-plus pull-left"></span> SignUp with Google
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
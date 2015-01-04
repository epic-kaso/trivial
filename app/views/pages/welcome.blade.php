@extends('layout.application')
@section('content')
    <div class="navbar navbar-white navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="" class="navbar-brand">
                    CloudBox
                </a>
            </div>

            <ul class="nav navbar-nav">
                <li><a href="">Home</a></li>
                <li><a href="">Features</a></li>
                <li><a href="">Pricing</a></li>

            </ul>

            @if(Auth::check())
                <ul class="navbar-right navbar-nav nav">
                    <li><a href="{{ route('user.logout') }}">Logout</a></li>
                </ul>
            @else
                <ul class="navbar-right navbar-nav nav">
                    <li><a href="">Register</a></li>
                    <li><a href="">Login</a></li>
                </ul>
            @endif
        </div>
    </div>

    <div class="container">
        <div class="col-md-12">
            <div class="row">
                {{ Form::open(['url' => route('files.store'),'files'=> true]) }}
                <div class="uk-form-file upload-icon">
                    <span class="glyphicon glyphicon-cloud-upload"></span> Upload
                    <input type="file" name="file"/>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="upload"/>
                </div>
                {{Form::close()}}
            </div>

            <div class="row">
                <table class="table">
                    <thead>
                    <tr>
                        <td>..</td>
                        <td>Name</td>
                        <td>Sell</td>
                        <td>Edit</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($files as $file)
                        <tr>
                            <td>..</td>
                            <td>
                                <h4>{{ $file->name }}</h4>

                                <p>
                                    <span class="text-muted">{{$file->created_at->toDayDateTimeString() }}</span>
                                    &nbsp;&nbsp;
                                    <span class="doc-type">{{ $file->type }}</span>
                                    <a class="btn" href="{{ route('user.files.download',[$file->id]) }}"
                                       title="download file"><span class="glyphicon glyphicon-download"></span></a>
                                </p>
                            </td>

                            <td><a href="{{ route('sell.show',[$file->hashcode]) }}" title="Share & Sale"><span
                                            class="glyphicon glyphicon-share-alt"></span></a></td>
                            <td><a href=""><span class="glyphicon glyphicon-edit"></span></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="navbar navbar-fixed-bottom">
        <div class="container">
            <div class="progress">
                <div class="progress-bar" style="width: {{ Auth::user()->storage->getPercentageUsed() }}%"></div>
            </div>
            <div>
                <p>{{ Auth::user()->storage->getFormattedUsedStorage() }}
                    /{{ Auth::user()->storage->getFormattedTotalStorage() }}</p>
            </div>
        </div>
    </div>
@stop
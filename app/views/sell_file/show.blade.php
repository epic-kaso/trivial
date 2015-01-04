@extends('layout.application')
@section('content')

    <div class="container">

        <div class="row" style="height: 150px;">

        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="file-details">
                            <span class="glyphicon glyphicon-file pull-left"></span>
                            <span class="file-name">{{ $file->name }}</span>

                            <p>
                                <span class="text-muted">{{$file->created_at->toDayDateTimeString() }}</span>
                                &nbsp;&nbsp;
                                <span class="doc-type label label-success">{{ $file->type }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <a class="btn btn-info" href="">₦{{ $file->price || '0.00' }} BUY NOW</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
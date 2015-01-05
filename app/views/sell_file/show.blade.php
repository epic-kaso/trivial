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
                        <h3>₦{{ $file->sell_price }}</h3>
                    </div>

                    <div class="panel-footer">
                        <div class="form-group">
                            <p class="alert alert-danger">Make sure to give your correct <strong>Email</strong> at the
                                purchase page, The file will be sent to your email.</p>
                        </div>
                        <form method="post" action="http://gpayexpress.com/gpay/gpayexpress.php">
                            <input type="hidden" name="merchantID" value="141101"/>
                            <input type="hidden" name="itemName" value="{{ $file->name }}"/>
                            <input type="hidden" name="itemPrice" value="{{ $file->sell_price }}"/>
                            <input type="hidden" name="itemDesc" value="MEDIAHUBB -- Purchase of {{ $file->name }}"/>
                            <input type="hidden" name="itemImageURL" value=""/>
                            <input type="hidden" name="successURL"
                                   value="{{ route('user.sell-success',['_token' => csrf_token(),'hashcode' => $file->hashcode]) }}"/>
                            <input type="hidden" name="failURL"
                                   value="{{ route('user.sell-failure',['_token' => csrf_token(),'hashcode' => $file->hashcode]) }}"/>
                            <input type="submit" class="btn btn-info" value="BUY NOW"/>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
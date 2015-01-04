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
            <div class="row">
                <div class="col-md-3">

                    <div class="">
                        <div class="progress" data-toggle="tooltip" data-placement="top"
                             style="margin-bottom: 4px;margin-top: 4px"
                             title="Used {{ Auth::user()->storage->getFormattedUsedStorage() }} of {{ Auth::user()->storage->getFormattedTotalStorage() }}">
                            <div class="progress-bar"
                                 style="width: {{ Auth::user()->storage->getPercentageUsed() }}%"></div>
                        </div>
                        <p>
                            {{ Auth::user()->storage->getFormattedUsedStorage() }}
                            /{{ Auth::user()->storage->getFormattedTotalStorage() }}
                        </p>
                    </div>

                    <div class="form-group">
                        {{ Form::open(['url' => route('files.store'),'files'=> true]) }}
                        <div class="form-group">
                            <input type="file" name="file"/>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="upload"/>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>

                <div class="col-md-9">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>My Files</h4>
                        </div>

                        <table class="table table-striped">
                            @foreach($files as $file)
                                <tr>
                                    <td>
                                        <div class="pull-right">
                                            <a class="btn btn-xs btn-default"
                                               href="{{ route('user.files.download',[$file->id]) }}"
                                               title="download file" data-placement="top" data-toggle="tooltip">
                                                <span class="glyphicon glyphicon-download"></span>
                                            </a>
                                            @if($file->isSellable())
                                                <a class="btn btn-xs btn-default"
                                                   href="{{ route('sell.show',[$file->hashcode]) }}"
                                                   title="Share & Sale"
                                                   data-placement="top" data-toggle="tooltip">
                                                    <span class="glyphicon glyphicon-share-alt"></span>
                                                </a>
                                            @else
                                                <a title="Share & Sale" data-placement="top" data-toggle="tooltip"
                                                   class="btn btn-xs btn-default modal-toggle" href="#shareSellModal"
                                                   data-action="{{ route('user.files.enable-share-sell',[$file->id]) }}">
                                                    <span class="glyphicon glyphicon-share-alt"></span>
                                                </a>
                                            @endif
                                            <a href="" class="btn btn-xs btn-default"><span
                                                        class="glyphicon glyphicon-edit"></span></a>
                                        </div>
                                        <h4><span class="glyphicon glyphicon-file pull-left"></span> {{ $file->name }}
                                        </h4>

                                        <p>
                                            <span class="text-muted">{{$file->created_at->toDayDateTimeString() }}</span>
                                            &nbsp;&nbsp;
                                            <span class="label label-default">{{ strtoupper($file->type) }}</span>
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                </div>
            </div>
        </div>
    <div class="modal fade" id="shareSellModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Sell File</h3>
                </div>
                <div class="modal-body">
                    <p>File is currently not enabled for share and sell.</p>
                    <label>
                        Enable for share and sell <input type="checkbox" name="enableShareSell"/>
                    </label>

                    <form name="enableShareSellForm" action="" method="post">
                        <input class="form-control" type="text" name="price" placeholder="Sell Price"/>

                        <div class="form-group">
                            <input class="btn" type="submit" value="Save"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(function () {
            $('form[name="enableShareSellForm"]').hide();

            $('[data-toggle="tooltip"]').tooltip();


            $('input[name=enableShareSell]').change(function () {
                $('form[name="enableShareSellForm"]').toggle();
            });

            ///modal toggle
            $('a.modal-toggle').click(function (e) {
                var id = $(this).attr('href');
                var modalView = $(id);
                modalView.find('form[name="enableShareSellForm"]').attr('action', $(this).data('action'));
                modalView.modal();
                e.preventDefault();
            })
        })
    </script>
@stop
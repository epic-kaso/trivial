@extends('layout.application')
@section('content')
    <div class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="" class="navbar-brand">
                    CloudBox
                </a>
            </div>

            <ul class="nav navbar-nav">
                <li><a href="">Home</a></li>
                <li><a href="{{ route('user.storage') }}">Storage</a></li>
                <li><a href="">Wallet <span class="badge">0</span></a></li>
                <li><a href="">Profile</a></li>

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

    <div class="container" style="padding-bottom: 50px">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="uk-form-file upload-icon">
                            <span class="glyphicon glyphicon-cloud-upload"></span> Upload
                            <input type="file" data-url="{{ route('files.store') }}" name="file" id="documentUpload"/>
                        </div>
                    </div>
                    <div class="progress file-upload-progress" style="display: none">
                        <div class="progress-bar" id="file-upload"></div>
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
                                               title="Download file" data-placement="top" data-toggle="tooltip">
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
                                            <a href="" class="btn btn-xs btn-default" title="Rename file"
                                               data-placement="top" data-toggle="tooltip">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                            <a data-placement="top"
                                               data-toggle="tooltip"
                                               title="Delete file"
                                               href="{{ route('files.destroy',[$file->id]) }}"
                                               data-method="delete"
                                               rel="nofollow" data-confirm="Are you sure?"
                                               class="btn btn-xs btn-danger">
                                                <span class="glyphicon glyphicon-remove-sign"></span></a>
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

    <div class="navbar navbar-fixed-bottom navbar-inverse" style="min-height: 10px">
        <div class="container">
            <div class="col-md-4">
                <div class="">
                    <div class="progress" data-toggle="tooltip" data-placement="top"
                         style="margin-bottom: 4px;margin-top: 4px"
                         title="Used {{ Auth::user()->storage->getFormattedUsedStorage() }} of {{ Auth::user()->storage->getFormattedTotalStorage() }}">
                        <div class="progress-bar progress-bar-success"
                             style="width: {{ Auth::user()->storage->getPercentageUsed() }}%"></div>
                    </div>
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
    <script src="{{asset('js/jquery-ujs.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/vendor/jquery.ui.widget.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.iframe-transport.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.fileupload.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            $('.file-upload-progress').hide();

            $('#documentUpload').fileupload({
                start: function (e, data) {
                    $('.file-upload-progress').fadeIn();
                },
                done: function (e, data) {
                    location.reload();
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#file-upload').css('width', progress + '%');
                }
            });

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
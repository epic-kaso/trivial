@extends('layout.application')
@section('content')
    @include('pages.partials.navigation')
    <div class="container main-content">
            <div class="row">
                <div class="col-md-3" style="position: relative">

                    <div class="side-menu">
                        <ul class="nav nav-stacked">
                            <li>
                                <a href="{{ route('user.storage') }}">
                                    <span class="fa fa-cloud pull-left"></span> Buy Storage Space
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.storage') }}">
                                    <span class="fa fa-cc pull-left"></span> Files For Sale
                                </a>
                            </li>
                        </ul>
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
                                        <span class="fa {{ getFileIconCssClass(strtolower($file->type)) }}"
                                              style="margin-right: 15px;font-size: 30px;"></span>
                                         <span style="display: inline-block;">
                                             <span>{{ $file->name }}</span>
                                             <p style="font-weight: 200;font-size: 12px;">
                                                 <span class="text-muted">{{$file->created_at->toDayDateTimeString() }}</span>
                                                 &nbsp;&nbsp;
                                                 {{ strtoupper($file->type) }}
                                             </p>
                                        </span>

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

@stop
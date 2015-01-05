@extends('layout.application')
@section('content')
    @include('pages.partials.navigation')
    <div class="container" style="padding-bottom: 50px">
            <div class="row">
                <div class="col-md-3" style="position: relative">
                    <div class="form-group">
                        <div class="uk-form-file upload-icon">
                            <span class="glyphicon glyphicon-cloud-upload"></span> Upload
                            <input type="file" data-url="{{ route('files.store') }}" name="file" id="documentUpload"/>
                        </div>
                    </div>
                    <div class="text-center" style="position: absolute;top: 0;left: 0;width: 100%;">
                        <canvas id="uploadProgress" width="150" height="150"
                                style="margin-left: auto;margin-right: auto;"></canvas>
                    </div>

                    <div class="text-center">
                        <canvas id="myChart" width="150" height="150"></canvas>
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
    <script src="{{asset('js/jquery-ujs.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/vendor/jquery.ui.widget.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.iframe-transport.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.fileupload.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/vendor/Chart.min.js') }}" type="text/javascript"></script>
    <script>
        var data = [
                    {
                        value: {{ Auth::user()->storage->getPercentageFreeSpace() }},
                        color: "#8e44ad",
                        highlight: "#9b59b6",
                        label: "Free Space - {{ Auth::user()->storage->getFormattedFreeStorage() }}"
                    },
                    {
                        value: {{ Auth::user()->storage->getPercentageUsed() }},
                        color: "#F7464A",
                        highlight: "#FF5A5E",
                        label: "Used Space - {{ Auth::user()->storage->getFormattedUsedStorage() }}"
                    }
                ],
                options = {
                    tooltipTemplate: "<%if (label){%><%=label%> <%}%>",
                    animationEasing: "easeOut"
                };

        var ctx = $("#myChart").get(0).getContext("2d");
        var myDoughnutChart = new Chart(ctx).Doughnut(data, options);


    </script>
    <script>
        $(function () {
            var progressChart = "empty";

            $('#documentUpload').fileupload({
                start: function (e, data) {
                    setUploadState();
                },
                done: function (e, data) {
                    location.reload();
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    setProgressChart(progress);
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
            });

            function setUploadState() {
                $('.upload-icon').css('opacity', 0);
                $('#uploadProgress').fadeIn();
            }

            function setProgressChart(value) {
                if (progressChart == "empty") {
                    var data = [
                                {
                                    value: 20,
                                    color: "#f39c12",
                                    highlight: "#f1c40f",
                                    label: "Progress"
                                }
                            ],
                            options = {animationEasing: "easeOut"};

                    var ctx = $('#uploadProgress').get(0).getContext("2d");
                    progressChart = new Chart(ctx).Doughnut(data, options);
                }
                progressChart.segments[0].value = value;
                progressChart.update();
            }
        })
    </script>
@stop
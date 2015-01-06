<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/jasny-bootstrap/css/jasny-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <title>Cloud Service</title>
    @yield('stylesheets')
</head>
<body style="position: relative;">
@include('pages.partials.notifications')

@yield('content')

<div class="modal fade" id="UploadModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title">Upload File</h3>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="col-md-4 col-md-offset-1 text-center" style="position: relative">

                        <div class="form-group">
                            <div class="uk-form-file upload-icon">
                                <span class="glyphicon glyphicon-cloud-upload"></span> Upload
                                <input type="file" data-url="{{ route('files.store') }}" name="file"
                                       id="documentUpload"/>
                            </div>
                        </div>
                        <div class="text-center" style="position: absolute;top: 0;left: 0;width: 100%;">
                            <canvas id="uploadProgress" width="150" height="150"
                                    style="margin-left: auto;margin-right: auto;"></canvas>
                        </div>
                        <div class="form-group">
                            <div id="successAlert" style="display: none;" class="alert alert-success">
                                <p>Uploaded successfully, Reloading page...</p>
                            </div>
                            <div id="errorAlert" style="display: none;" class="alert alert-danger">
                                <p>Uploaded failed, Try again</p>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-muted text-center">Upload From PC</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('bower_components/jquery/dist/jquery.min.js')  }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')  }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/jasny-bootstrap/js/jasny-bootstrap.min.js')  }}"
        type="text/javascript"></script>
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

    var chartNode = $("#myChart").get(0);
    if (typeof chartNode === 'undefined') {

    } else {
        var ctx = chartNode.getContext("2d");
        var myDoughnutChart = new Chart(ctx).Doughnut(data, options);
    }


</script>
<script>
    $(function () {
        setTimeout(function () {
            $('.alert').fadeOut();
        }, 3000);

        var progressChart = "empty";

        $('form[name="enableShareSellForm"]').hide();

        $('[data-toggle="tooltip"]').tooltip();


        $('input[name=enableShareSell]').change(function () {
            $('form[name="enableShareSellForm"]').toggle();
        });

        ///modal toggle
        $('a.modal-toggle').click(function (e) {
            var id = $(this).attr('href');
            var modalView = $(id);
            var form = modalView.find('form[name="enableShareSellForm"]');
            form.attr('action', $(this).data('action'));
            modalView.find('button#enableShareSaleBtn').click(function (e) {
                var t = $(this);
                t.button('loading');
                form.submit();
            });

            modalView.modal();
            e.preventDefault();
        });

        $('#documentUpload').fileupload({
            start: function (e, data) {
                setUploadState(true);
            },
            done: function (e, data) {
                uploadStatus('success');
            },
            fail: function (e, data) {
                uploadStatus('fail');
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                setProgressChart(progress);
            }
        });

        function uploadStatus(response) {
            var modal = $('#UploadModal');
            var successAlert = modal.find('#successAlert'),
                    errorAlert = modal.find('#errorAlert');

            if (response == 'success') {
                successAlert.fadeIn(100);
                location.reload();
            } else {
                errorAlert.fadeIn(100);
                setUploadState(false);
            }
        }

        function setUploadState(state) {
            if (state == true) {
                $('.upload-icon').css('opacity', 0);
                $('#uploadProgress').fadeIn();
            } else {
                $('#uploadProgress').fadeOut();
                $('.upload-icon').css('opacity', 1);
            }
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

                var chartNode = $('#uploadProgress').get(0);
                if (typeof chartNode === 'undefined') {

                } else {
                    var ctx = chartNode.getContext("2d");
                    progressChart = new Chart(ctx).Doughnut(data, options);
                }

            }
            progressChart.segments[0].value = value;
            progressChart.update();
        }
    })
</script>
@yield('scripts')
</body>
</html>

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
    <link href="{{ asset('bower_components/dropzone/css/basic.css') }}" rel="stylesheet">
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
                            <form action="{{ route('files.store') }}" class="dropzone square" id="my-upload-button">
                                <div class="fallback">
                                    <input type="file" name="file" id="documentUpload"/>
                                </div>
                                <div class="uk-form-file upload-icon dz-message">
                                    <span class="glyphicon glyphicon-cloud-upload"></span> Upload
                                </div>
                            </form>
                        </div>
                        <div class="form-group">
                            <div id="infoAlert" style="display: none;" class="alert alert-info">
                                <p>100%</p>
                            </div>
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
<script src="{{ asset('bower_components/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
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


        //fileupload config
        Dropzone.options.myUploadButton = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 50, // MB
            init: function () {
                this.on("uploadprogress", function (file, progress) {
                    setProgressChart(progress)
                });
                this.on("error", function (file, error) {
                    uploadStatus("error");
                });
                this.on("success", function (file) {
                    uploadStatus("success");
                })
            }
        };


        function uploadStatus(response) {
            var modal = $('#UploadModal');
            var successAlert = modal.find('#successAlert'),
                    errorAlert = modal.find('#errorAlert');
            var progressAlert = modal.find('#infoAlert');
            progressAlert.fadeOut(100);

            if (response == 'success') {
                successAlert.fadeIn(100);
                location.reload();
            } else {
                errorAlert.fadeIn(100);
                setTimeout(function () {
                    errorAlert.fadeOut(300);
                }, 2000);
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
            var modal = $('#UploadModal');
            var progressAlert = modal.find('#infoAlert');
            if (progressAlert.css('display') == 'none') {
                progressAlert.fadeIn();
            }
            progressAlert.find('p').text("Uploading " + value + "%");
        }
    })
</script>
@yield('scripts')
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-58300906-1', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>

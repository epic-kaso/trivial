@extends('layout.application')

@section('content')
    @include('pages.partials.navigation')
    <div class="container main-content">
        <div class="col-md-2" style="position: relative">
            @include('pages.partials.side-nav')
        </div>

        <div class="col-md-8">
            <div class="row">
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="center-item">
                            <canvas id="myChart" width="150" height="150"
                                    style="display: block;margin-left: auto;margin-right: auto;width: 300px;height: 300px;"></canvas>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <p>Current Storage Used <strong>{{ Auth::user()->storage->getFormattedUsedStorage() }}</strong>
                            of <strong>{{ Auth::user()->storage->getFormattedTotalStorage() }}</strong>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Buy Additional Storage</h4>
                    </div>
                    <table class="table">
                        @foreach($storageSpaces as $space)
                            <tr>
                                <td>
                                    <h4>{{ $space->name }}</h4>

                                    <p>{{ $space->description }}</p>
                                </td>
                                <td><h4 class="label label-success">₦{{ number_format($space->price,0) }}</h4></td>
                                <td>
                                    <form method="post" action="http://gpayexpress.com/gpay/gpayexpress.php">
                                        <input type="hidden" name="merchantID" value="141101"/>
                                        <input type="hidden" name="itemName" value="MediaHubb -- {{ $space->name }}"/>
                                        <input type="hidden" name="itemPrice" value="{{ $space->price }}"/>
                                        <input type="hidden" name="itemDesc"
                                               value="MEDIAHUBB -- {{ $space->description }}"/>
                                        <input type="hidden" name="itemImageURL" value=""/>
                                        <input type="hidden" name="successURL"
                                               value="{{ route('user.buy-storage-success',['_token' => csrf_token(),'data' => base64_encode(json_encode(['hashcode' => $space->hashcode])) ]) }}"/>
                                        <input type="hidden" name="failURL"
                                               value="{{ route('user.buy-storage-failure',['_token' => csrf_token(),'data' => base64_encode(json_encode(['hashcode' => $space->hashcode])) ]) }}"/>
                                        <input type="submit" class="btn btn-info" value="BUY NOW"/>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{ asset('js/vendor/Chart.min.js') }}" type="text/javascript"></script>
    <script>
        Chart.defaults.global.tooltipTemplate = "<%if (label){%><%=label%> <%}%>";
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
                options = {};

        var ctx = $("#myChart").get(0).getContext("2d");
        var myDoughnutChart = new Chart(ctx).Doughnut(data, options);


    </script>
@stop
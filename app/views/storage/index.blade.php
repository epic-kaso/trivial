@extends('layout.application')

@section('content')
    @include('pages.partials.navigation')
    <div class="container" style="padding-bottom: 50px">
        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                    <div class="panel-footer">
                        <h4>Current Storage Used <strong>{{ Auth::user()->storage->getFormattedUsedStorage() }}</strong>
                            of <strong>{{ Auth::user()->storage->getFormattedTotalStorage() }}</strong>
                        </h4>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Buy Additional Storage</h4>
                    </div>
                    <table class="table">
                        <tr>
                            <td>1</td>
                            <td>1 Gigabyte</td>
                            <td>N1,000</td>
                            <td>
                                <form method="post" action="http://gpayexpress.com/gpay/gpayexpress.php">
                                    <input type="hidden" name="merchantID" value="141101"/>
                                    <input type="hidden" name="itemName" value="MediaHubb -- 1 Gig Storage Space"/>
                                    <input type="hidden" name="itemPrice" value="1"/>
                                    <input type="hidden" name="itemDesc"
                                           value="MEDIAHUBB -- Purchase of 1 Gig Storage Space"/>
                                    <input type="hidden" name="itemImageURL" value=""/>
                                    <input type="hidden" name="data" value="{{ base64_encode('{size: 1}') }}"/>
                                    <input type="hidden" name="successURL"
                                           value="{{ route('user.buy-storage-success',['_token' => csrf_token(),'data' => base64_encode(json_encode(['size' => 1])) ]) }}"/>
                                    <input type="hidden" name="failURL"
                                           value="{{ route('user.buy-storage-failure',['_token' => csrf_token(),'data' => base64_encode(json_encode(['size' => 1])) ]) }}"/>
                                    <input type="submit" class="btn btn-info" value="BUY NOW"/>
                                </form>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>2 Gigabytes</td>
                            <td>N1,500</td>
                            <td>
                                <form method="post" action="http://gpayexpress.com/gpay/gpayexpress.php">
                                    <input type="hidden" name="merchantID" value="141101"/>
                                    <input type="hidden" name="itemName" value="MediaHubb -- 2 Gig Storage Space"/>
                                    <input type="hidden" name="itemPrice" value="1500"/>
                                    <input type="hidden" name="itemDesc"
                                           value="MEDIAHUBB -- Purchase of 2 Gig Storage Space"/>
                                    <input type="hidden" name="itemImageURL" value=""/>
                                    <input type="hidden" name="successURL"
                                           value="{{ route('user.buy-storage-success',['_token' => csrf_token(),'data' => base64_encode(json_encode(['size' => 2])) ]) }}"/>
                                    <input type="hidden" name="failURL"
                                           value="{{ route('user.buy-storage-failure',['_token' => csrf_token(),'data' => base64_encode(json_encode(['size' => 2])) ]) }}"/>
                                    <input type="submit" class="btn btn-info" value="BUY NOW"/>
                                </form>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>4 Gigabytes</td>
                            <td>N2,500</td>
                            <td>
                                <form method="post" action="http://gpayexpress.com/gpay/gpayexpress.php">
                                    <input type="hidden" name="merchantID" value="141101"/>
                                    <input type="hidden" name="itemName" value="MediaHubb -- 4 Gig Storage Space"/>
                                    <input type="hidden" name="itemPrice" value="2500"/>
                                    <input type="hidden" name="itemDesc"
                                           value="MEDIAHUBB -- Purchase of 4 Gig Storage Space"/>
                                    <input type="hidden" name="itemImageURL" value=""/>
                                    <input type="hidden" name="successURL"
                                           value="{{ route('user.buy-storage-success',['_token' => csrf_token(),'data' => base64_encode(json_encode(['size' => 4])) ]) }}"/>
                                    <input type="hidden" name="failURL"
                                           value="{{ route('user.buy-storage-failure',['_token' => csrf_token(),'data' => base64_encode(json_encode(['size' => 4])) ]) }}"/>
                                    <input type="submit" class="btn btn-info" value="BUY NOW"/>
                                </form>
                            </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>8 Gigabytes</td>
                            <td>N4,000</td>
                            <td>
                                <form method="post" action="http://gpayexpress.com/gpay/gpayexpress.php">
                                    <input type="hidden" name="merchantID" value="141101"/>
                                    <input type="hidden" name="itemName" value="MediaHubb -- 8 Gig Storage Space"/>
                                    <input type="hidden" name="itemPrice" value="4000"/>
                                    <input type="hidden" name="itemDesc"
                                           value="MEDIAHUBB -- Purchase of 8 Gig Storage Space"/>
                                    <input type="hidden" name="itemImageURL" value=""/>
                                    <input type="hidden" name="successURL"
                                           value="{{ route('user.buy-storage-success',['_token' => csrf_token(),'data' => base64_encode(json_encode(['size' => 8])) ]) }}"/>
                                    <input type="hidden" name="failURL"
                                           value="{{ route('user.buy-storage-failure',['_token' => csrf_token(),'data' => base64_encode(json_encode(['size' => 8])) ]) }}"/>
                                    <input type="submit" class="btn btn-info" value="BUY NOW"/>
                                </form>
                            </td>
                        </tr>
                    </table>
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
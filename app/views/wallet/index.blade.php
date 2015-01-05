@extends('layout.application')

@section('content')
    @include('pages.partials.navigation')
    <div class="container main-content">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2>Wallet Balance: N10,000</h2>
                    <a class="btn btn-success" href="/">Request Fund</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5>Transactions</h5>
                </div>
                <table class="table">
                    <tr>
                        <td>1</td>
                        <td>1 Gigabyte</td>
                        <td>N1,000</td>
                        <td><a class="btn btn-info">BUY</a></td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>2 Gigabytes</td>
                        <td>N1,500</td>
                        <td><a class="btn btn-info">BUY</a></td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>4 Gigabytes</td>
                        <td>N2,500</td>
                        <td><a class="btn btn-info">BUY</a></td>
                    </tr>

                    <tr>
                        <td>4</td>
                        <td>8 Gigabytes</td>
                        <td>N4,000</td>
                        <td><a class="btn btn-info">BUY</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@stop
@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        @include('admin.partials.navigation')
        <div class="row" style="padding-top: 100px;">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" class="active"><a href="#">Analytics</a></li>
                    <li role="presentation"><a href="#">Users <span class="badge pull-right">100</span></a></li>
                    <li role="presentation"><a href="#">Files <span class="badge pull-right">300k+</span></a></li>
                    <li role="presentation"><a href="#">Storage <span class="badge pull-right">1TB</span></a></li>
                </ul>
            </div>

            <div class="col-md-9 admin-dashboard">
                <div>
                    <ui-view>
                        <div class="text-center"
                             style="width: 100px;height: 100px;margin-left: auto;margin-right: auto;">
                            <img src="{{ asset('img/ajax-loader.gif') }}" class="img-responsive"/>
                        </div>
                    </ui-view>
                </div>
            </div>
        </div>

    </div>
@stop

@section('stylesheets')
    <script>
        window.application = {};
        window.application.user_base_url = "{{ route('users-api.index') }}";
    </script>
@stop

@section('scripts')
    <script id="usersTable.html" type="text/ng-template">
        <table>
            <tr ng-repeat="user in users">
                <td>1</td>
                <td><span><% user.email %></span></td>
                <td><span><% user.created_at %></span></td>
            </tr>
        </table>
    </script>
@stop
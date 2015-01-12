@extends('admin.layout')
@section('content')
    <div class="container-fluid">
        @include('admin.partials.navigation')
        <div class="row" style="padding-top: 100px;">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation" ui-sref="analytics" ui-sref-active="active"><a href="#">Analytics</a></li>
                    <li role="presentation" ui-sref="users" ui-sref-active="active"><a href="#">Users <span
                                    class="badge pull-right" ng-bind="count.users">100</span></a></li>
                    <li role="presentation" ui-sref="files" ui-sref-active="active"><a href="#">Files <span
                                    class="badge pull-right" ng-bind="count.files">300k+</span></a></li>
                    <li role="presentation" ui-sref="storages" ui-sref-active="active"><a href="#">Storage <span
                                    class="badge pull-right" ng-bind="count.storages">1TB</span></a></li>
                </ul>

                <ul class="nav nav-pills nav-stacked">
                    <li><a href="{{ route('user.logout') }}">Logout</a></li>
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
        window.application.user_files_base_url = "{{ route('files-api.index') }}";
    </script>
@stop

@section('scripts')
    <script id="usersTable.html" type="text/ng-template">
        <div ng-if="users.length > 0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Users</h3>
                </div>
                <table class="table table-striped">
                    <tr ng-repeat="user in users">
                        <td><span ng-bind="$index"></span></td>
                        <td><span ng-bind="user.email"></span></td>
                        <td><span ng-bind="user.created_at"></span></td>
                    </tr>
                </table>
            </div>
        </div>

        <div ng-if="!users || users.length == 0">
            <p>No Users.</p>
        </div>

    </script>
    <script id="userFilesTable.html" type="text/ng-template">
        <div ng-if="files.length > 0">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Files</h3>
                </div>
                <table class="table table-striped">
                    <tr ng-repeat="file in files">
                        <td><span ng-bind="$index"></span></td>
                        <td>
                            <span ng-bind="file.name"></span>

                            <p>owner: <span ng-bind="file.user.email"></span></p>
                        </td>
                        <td><span ng-bind="file.created_at"></span></td>
                    </tr>
                </table>
            </div>
        </div>

        <div ng-if="!users || users.length == 0">
            <p>No Users.</p>
        </div>
    </script>
@stop
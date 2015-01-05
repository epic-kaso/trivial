@extends('layout.application')
<div class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a href="" class="navbar-brand">
                CloudBox
            </a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="">Home</a></li>
            <li><a href="">Storage</a></li>
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
        <div class="panel panel-default">
            <div class="panel-body">
                <h4>Current Storage: Used {{ Auth::user()->storage->getFormattedUsedStorage() }}
                    of {{ Auth::user()->storage->getFormattedTotalStorage() }}</h4>

                <div class="progress" data-toggle="tooltip" data-placement="top"
                     style="margin-bottom: 4px;margin-top: 4px"
                     title="Used {{ Auth::user()->storage->getFormattedUsedStorage() }} of {{ Auth::user()->storage->getFormattedTotalStorage() }}">
                    <div class="progress-bar progress-bar-success"
                         style="width: {{ Auth::user()->storage->getPercentageUsed() }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Buy Additional Storage</h4>
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
@extends('layout.basic')
@section('content')
    <div class="container">
        @include('pages.partials.navigation',['title' => 'Policies'])

        <div role="tabpanel" class="main-content">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Terms of Service</a></li>
                <li role="presentation">
                    <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Privacy Policy</a></li>
                <li role="presentation">
                    <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Business Agreement</a>
                </li>
                <li role="presentation">
                    <a href="#acceptable-use" aria-controls="acceptable-use" role="tab" data-toggle="tab">Acceptable
                        Use</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    @include('pages.partials.terms-of-service')
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    @include('pages.partials.privacy-policy')
                </div>
                <div role="tabpanel" class="tab-pane" id="messages">
                    @include('pages.partials.business-agreement')
                </div>
                <div role="tabpanel" class="tab-pane" id="acceptable-use">
                    @include('pages.partials.acceptable-use')
                </div>
            </div>

        </div>
    </div>
@stop
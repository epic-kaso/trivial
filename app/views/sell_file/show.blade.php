@extends('layout.basic')
@section('content')

    <div class="container">

        @if(Auth::check())
            @include('pages.partials.navigation')
        @endif
        <div class="row" style="height: 150px;">

        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default panel-sale">
                    <div class="panel-body">
                        <div class="file-details">
                            <span class="fa {{ getFileIconCssClass(strtolower($file->type)) }} pull-left"
                                  style="margin-right: 15px;font-size: 30px;"></span>
                            <span class="file-name">{{ $file->name }}</span>

                            <p>
                                <span class="text-muted">{{$file->created_at->toDayDateTimeString() }}</span>
                                &nbsp;&nbsp;
                                <span class="doc-type label label-info">{{ $file->type }}</span>
                            </p>
                        </div>
                        <div style="margin-top: 20px">
                            @if(!$file->isFree())
                                <p>Please be informed that You about to buy this file</p>
                                <h3>Costs ₦{{ $file->sell_price }}</h3>
                                <p class="text-muted tiny-text">by clicking on the "buy now" button you agree with our
                                    <a>terms of service</a>, our <a>privacy policy</a> and our <a>business agreement</a>
                                </p>
                            @else
                                <p>Download this file by clicking in the download button below</p>
                                <p class="text-muted tiny-text">by clicking on the download button you agree with our
                                    <a>terms of service</a> and our <a>privacy policy</a>
                                </p>

                            @endif
                        </div>

                    </div>

                    <div class="panel-footer">

                        <div class="d-count">
                            <span class="badge">{{ $file->getDownloadCount() }}</span> downloads
                        </div>

                    @if( $file->sell_price > 0)
                            <form name="buyFile" method="post" action="http://gpayexpress.com/gpay/gpayexpress.php">
                            <input type="hidden" name="merchantID" value="141101"/>
                            <input type="hidden" name="itemName" value="{{ $file->name }}"/>
                            <input type="hidden" name="itemPrice" value="{{ $file->sell_price }}"/>
                            <input type="hidden" name="itemDesc" value="MEDIAHUBB -- Purchase of {{ $file->name }}"/>
                            <input type="hidden" name="itemImageURL" value=""/>
                            <input type="hidden" name="successURL"
                                   value="{{ route('user.sell-success',['_token' => csrf_token(),'user_file' => $file->hashcode]) }}"/>
                            <input type="hidden" name="failURL"
                                   value="{{ route('user.sell-failure',['_token' => csrf_token(),'user_file' => $file->hashcode]) }}"/>
                            <input type="submit" id="fileActionBtn" class="btn btn-success btn-lg" value="BUY NOW"
                                   data-force-submit="0" data-authenticated="{{ Auth::check() }}"/>
                        </form>
                        @else
                            <form action="{{ $file->downloadUrl() }}">
                                {{ Form::captcha() }}
                                <div class="form-group" style="margin-top: 5px">
                                    <input class="btn btn-success btn-lg" value="Download" type="submit"/>
                                </div>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="warnUserModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Important, Please Read</h3>
                </div>
                <div class="modal-body">
                    <p>If you choose to continue file download without logining in, you will have to pay again to
                        download file.</p>

                    <p>Please login below so we can remeber your purchase, and you can redownload this file if
                        downloading fails.</p>

                    <div class="form-group">
                        <a href="{{ route('user.facebook-login') }}" class="btn btn-facebook">
                            <span class="fa fa-facebook pull-left"></span> Login with Facebook
                        </a>

                        <a href="{{ route('user.google-login') }}" class="btn btn-google-plus">
                            <span class="fa fa-google-plus pull-left"></span> Login with Google
                        </a>
                    </div>

                    <div class="form-group">
                        <a href="#" id="skipWarning">No, Thanks. Skip >></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(function () {

            var modalWindow;
            var $fileActionBtn = $('#fileActionBtn');
            var $form = $('form[name="buyFile"]');

            $('#warnUserModal').find('.form-group #skipWarning').click(function (e) {
                console.log('Skipp');
                skipWarning();
                e.preventDefault();
            });

            $form.submit(function (e) {
                checkCurrentUserState(e);
            });

            $fileActionBtn.click(function (e) {
                checkCurrentUserState(e);
            });

            function checkCurrentUserState(event) {
                var isUserAuthenticated = $fileActionBtn.attr('data-authenticated');
                var forceSubmit = $fileActionBtn.attr('data-force-submit');

                if (forceSubmit == '0' && isUserAuthenticated != '1') {
                    modalWindow = $('#warnUserModal').modal();
                    event.preventDefault();
                }
            }

            function skipWarning() {
                $fileActionBtn.attr('data-force-submit', '1');
                $form.submit();
            }
        });
    </script>
@stop
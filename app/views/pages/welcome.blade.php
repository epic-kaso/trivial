@extends('layout.application')
@section('content')
    @include('pages.partials.navigation')
    <div class="container-fluid main-content">
            <div class="row">
                <div style="position: relative">
                    @include('pages.partials.side-nav')
                </div>

                <div class="display-table" style="display: inline-block;min-width: 100%;">

                    <div class="panel panel-default">
                        @if(count($files) > 0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>
                                    <a href="" class="btn btn-xs btn-default"><span
                                                class="fa fa-sort-alpha-asc"> </span> Name</a>
                                    <a href="" class="btn btn-xs btn-default"><span
                                                class="fa fa-sort-numeric-desc"></span> Date</a>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($files as $file)
                                <tr id="file-{{$file->hashcode}}">
                                    <td>
                                        <span class="fa {{ getFileIconCssClass(strtolower($file->type)) }}"
                                              style="margin-left: 10px; margin-right: 15px;font-size: 30px;"></span>
                                         <span style="display: inline-block;">
                                             <span style="display: inline-block;margin-bottom: 5px;"
                                                   class="name-span {{ $file->active ? '' : 'text-muted' }}"
                                                   data-toggle="tooltip"
                                                   title="{{ $file->name }}">{{ Str::limit($file->name ,30)}}</span>
                                             <p style="font-weight: 200;font-size: 12px;">
                                                 <span class="text-muted">{{$file->created_at->toDayDateTimeString() }}</span>
                                                 &nbsp;&nbsp;
                                                 <span class="text-muted">{{ strtoupper($file->getFormattedSize()) }}</span>
                                                 &nbsp;&nbsp;
                                                 <span class="text-muted text-info">{{ strtoupper($file->type) }}</span>
                                             </p>
                                        </span>

                                        <div class="pull-right dropdown">
                                            <button class="flyout-btn btn btn-default btn-xs dropdown-toggle {{ $file->active ? '' : 'disabled' }}"
                                                    data-toggle="dropdown" {{ $file->active ? '' : 'disabled' }}>
                                                <span class="glyphicon glyphicon-chevron-down"></span>
                                            </button>

                                            <div class="dropdown-menu">
                                                <div class="list-group flyoutmenu">
                                                    {{ $file->downloadLink(
                                                    "Download file",
                                                    [
                                                    "class" => "list-group-item",
                                                        "data-placement"=>"top",
                                                         "data-toggle"=>"tooltip"
                                                    ])
                                                    }}
                                                    @if($file->isSellable())
                                                        <a class="list-group-item"
                                                           href="#shareFileModal"
                                                           data-toggle="modal"
                                                           data-share-url="{{ route('sell.show',[$file->hashcode]) }}"
                                                           data-placement="top">
                                                            <span class="glyphicon glyphicon-link"></span>
                                                            {{ $file->isFree() ? "Share Download Link" : "Share Sale Link" }}
                                                        </a>
                                                    @else
                                                        <a data-placement="top" data-toggle="tooltip"
                                                           class="list-group-item modal-toggle" href="#shareSellModal"
                                                           data-action="{{ route('user.files.enable-share-sell',[$file->id]) }}">
                                                            <span class="glyphicon glyphicon-share-alt"></span>
                                                            Sale File
                                                        </a>
                                                    @endif
                                                    <a href="" class="list-group-item"
                                                       data-current-name="{{ $file->name }}"
                                                       data-hashcode="{{ $file->hashcode }}"
                                                       data-target="#renameFileModal" data-toggle="modal">
                                                        <span class="glyphicon glyphicon-edit"></span>
                                                        Rename file
                                                    </a>
                                                    <a data-placement="top"
                                                       data-toggle="tooltip"
                                                       href="{{ route('files.destroy',[$file->id]) }}"
                                                       data-method="delete"
                                                       rel="nofollow" data-confirm="Are you sure?"
                                                       class="list-group-item">
                                                        <span class="glyphicon glyphicon-remove-sign"></span>
                                                        Delete file
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="text-center text-muted">
                                <h1><span class="fa fa-file-o"></span></h1>

                                <p>you don't have any files yet, <a href="#UploadModal" data-toggle="modal">click
                                        here</a> to get started</p>
                            </div>
                        @endif
                        @if(method_exists($files,'links'))
                            {{ $files->links() }}
                        @endif
                    </div>

                </div>
            </div>
        </div>
    <div class="modal fade" id="shareSellModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title">Sell File</h3>
                </div>
                <div class="modal-body">
                    <p>File is currently not enabled for share and sell.</p>

                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default active">
                            <input type="radio" name="enableShareSell" id="option1" autocomplete="off" checked> Share
                            File
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" name="enableShareSell" id="option2" autocomplete="off"> Sale File
                        </label>
                    </div>

                    <div class="form-group">
                        <form name="enableShareSellForm" action="" method="post">
                            <div class="form-group" style="margin-top: 10px;">
                                <label>Enter selling price</label>

                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">₦</span>
                                    <input type="text" name="price" value="0" class="form-control" placeholder="100"
                                           aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success" data-loading-text="Saving..." id="enableShareSaleBtn" type="button">
                        Share
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="renameFileModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title">Rename File</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Rename file</label>
                        <input class="form-control" type="text" name="renameFileInput" placeholder="Rename File"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-loading-text="Saving..." type="button" class="btn btn-success" id="saveButton">Save
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="shareFileModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title">Share File Link</h3>
                </div>
                <div class="modal-body">
                    <p>To Share file simply Copy the Link in the textbox below</p>

                    <div class="form-group">
                        <textarea class="form-control" id="shareUrlTxtBox"></textarea>
                    </div>
                    <button class="btn btn-xs btn-default preview-btn">Preview <span class="fa fa-external-link"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>


@stop

@section('scripts')
    <script>
        var fileRenameUrl = "{{ route('user.file-rename',['user_file' => '']) }}";
        $(function () {
            var $renameFileModal = $('#renameFileModal');
            var $shareFileModal = $('#shareFileModal');

            $renameFileModal.on('shown.bs.modal', function (event) {
                var input = $(this).find('input[name=renameFileInput]');
                var saveButton = $(this).find('#saveButton');

                var button = $(event.relatedTarget);
                var currentName = button.attr('data-current-name');
                var hashcode = button.attr('data-hashcode');
                var data = stripExtention(currentName);

                input.attr('data-file-extension', data.ext);
                input.attr('data-file-hashcode', hashcode);
                input.val(data.name).focus();

                saveButton.click(function (e) {
                    var t = $(this);
                    t.button('loading');


                    var filename = input.val().trim();
                    if (filename == "") {
                        alert("Input can not be empty");
                        t.button('reset');
                        e.preventDefault();
                    } else {
                        var ext = input.attr('data-file-extension');
                        var hashcode = input.attr('data-file-hashcode');
                        renameFile(fileRenameUrl, hashcode, filename + "." + ext, t);
                    }


                })
            });

            $shareFileModal.on('shown.bs.modal', function (event) {
                var input = $(this).find('textarea#shareUrlTxtBox');
                var previewBtn = $(this).find('button.preview-btn');

                var button = $(event.relatedTarget);
                var shareUrl = button.attr('data-share-url');

                input.val(shareUrl).focus();

                previewBtn.click(function (e) {
                    OpenInNewTab(shareUrl);
                });
            });

            function OpenInNewTab(url) {
                var win = window.open(url, '_blank');
                win.focus();
            }

            function stripExtention(filename) {
                var ex = filename.split('.').pop();
                return {name: filename.replace("." + ex, ""), ext: ex};
            }


            function renameFile(serverUrl, fileHashCode, newName, saveButton) {

                $.post(serverUrl + "/" + fileHashCode,
                        {
                            newName: newName
                        },
                        function (data, status) {
                            if (status == "success") {
                                //$renameFileModal.modal('close');
                                saveButton.button('reset');
                                window.location.reload();
                            }
                        }
                );
            }
        })
    </script>
@stop
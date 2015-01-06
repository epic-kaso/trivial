@extends('layout.application')
@section('content')
    @include('pages.partials.navigation')
    <div class="container main-content">
            <div class="row">
                <div class="col-md-2" style="position: relative">
                    @include('pages.partials.side-nav')
                </div>

                <div class="col-md-8">

                    <div class="panel panel-default">
                        <table class="table table-striped">
                            @foreach($files as $file)
                                <tr>
                                    <td>
                                        <span class="fa {{ getFileIconCssClass(strtolower($file->type)) }}"
                                              style="margin-right: 15px;font-size: 30px;"></span>
                                         <span style="display: inline-block;">
                                             <span style="display: inline-block;margin-bottom: 5px;"
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
                                            <button class="btn btn-default btn-xs dropdown-toggle"
                                                    data-toggle="dropdown">
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
                                                           href="{{ route('sell.show',[$file->hashcode]) }}"
                                                           data-placement="top" data-toggle="tooltip">
                                                            <span class="glyphicon glyphicon-link"></span>
                                                            {{ $file->isFree() ? "Share Link" : "Sale Link" }}
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
                        </table>

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
                    <h3 class="modal-title">Sell File</h3>
                </div>
                <div class="modal-body">
                    <p>File is currently not enabled for share and sell.</p>
                    <label>
                        Enable for share and sell <input type="checkbox" name="enableShareSell"/>
                    </label>

                    <form name="enableShareSellForm" action="" method="post">
                        <input class="form-control" type="text" name="price" placeholder="Sell Price"/>

                        <div class="form-group">
                            <input class="btn" type="submit" value="Save"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="renameFileModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
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


@stop

@section('scripts')
    <script>
        var fileRenameUrl = "{{ route('user.file-rename',['user_file' => '']) }}";
        $(function () {
            var $renameFileModal = $('#renameFileModal');

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
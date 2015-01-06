<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" style="margin-left: 4px;"
                    class="pull-left clean-btn navbar-toggle collapsed"
                    data-target="#sideMenu"
                    data-toggle="offcanvas"
                    data-canvas="body"
                    >
                <span class="fa fa-navicon"></span>
            </button>
            @if(isset($title))
                <a href="" class="navbar-brand display-table">{{ $title }}</a>
            @else
                <a href="" class="navbar-brand">CloudBox</a>
            @endif
            <a href="#UploadModal" class="pull-right navbar-toggle collapsed" data-toggle="modal">
                <span class="fa fa-cloud-upload"></span> Upload
            </a>
        </div>
    </div>
</div>
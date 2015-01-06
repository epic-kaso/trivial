@if(!empty(Session::get('message')))
    <div class="alert alert-info alert-fixed-top text-center alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ Session::get('message') }}</p>
    </div>
@endif

@if(!empty(Session::get('status')))
    <div class="alert alert-info alert-fixed-top text-center alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ Session::get('status') }}</p>
    </div>
@endif


@if(!empty(Session::get('success')))
    <div class="alert alert-success alert-fixed-top text-center alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ Session::get('success') }}</p>
    </div>
@endif

@if(!empty(Session::get('error')))
    <div class="alert alert-danger alert-fixed-top text-center alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>{{ Session::get('error')}}</p>
    </div>
@endif

@if(count($errors->all()) > 0)
    <div class="alert alert-danger alert-fixed-top text-center alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @foreach($errors->all() as $error)
            @if(isset($error))
                <p>{{ $error }}</p>
            @endif
        @endforeach
    </div>
@endif

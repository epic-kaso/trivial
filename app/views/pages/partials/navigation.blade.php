<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="" class="navbar-brand">
                CloudBox
            </a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href=" {{ route('user.wallet') }}">Wallet <span class="badge">0</span></a></li>
            <li><a href="">Profile</a></li>
        </ul>

        @if(Auth::check())
            <ul class="navbar-right navbar-nav nav">
                <li><a href="#UploadModal" data-toggle="modal">
                        <span class="glyphicon glyphicon-upload"></span> Upload
                    </a>
                </li>

                <li>
                    <a href="">{{ Auth::user()->email }}</a>
                </li>

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
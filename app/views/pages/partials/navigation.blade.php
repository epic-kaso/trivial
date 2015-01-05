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
        </ul>

        @if(Auth::check())
            <ul class="navbar-right navbar-nav nav">
                <li><a href="#UploadModal" data-toggle="modal">
                        <span class="glyphicon glyphicon-upload"></span> Upload
                    </a>
                </li>

                <li>
                    <a href="" class="dropdown-toggle" id="dropdownMenu1"
                       data-toggle="dropdown">{{ Auth::user()->email }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation">
                            <span><p style="font-size: 10px;font-weight: 200;text-align: center;padding-bottom: 0;margin-bottom: 0;">{{ Auth::user()->storage->getFormattedUsedStorage() }}
                                    of {{ Auth::user()->storage->getFormattedTotalStorage() }}</p></span>

                            <div class="progress-bar" style="width: 20%;height: 5px;margin: 4px;"></div>
                        </li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Profile</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Settings</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('user.logout') }}">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        @else
            <ul class="navbar-right navbar-nav nav">
                <li><a href="">Register</a></li>
                <li><a href="">Login</a></li>
            </ul>
        @endif

    </div>
</div>
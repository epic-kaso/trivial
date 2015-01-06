<div id="sideMenu" class="offcanvas-sm side-menu navmenu navmenu-custom navmenu-fixed-left">
    <a class="navmenu-brand" href="#">CloudBox</a>
    <ul class="nav nav-stacked">
        <li>
            <a href="" class="dropdown-toggle" id="dropdownMenu1"
               data-toggle="dropdown">{{ Auth::user()->email }} <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <li role="presentation">
                            <span><p style="font-size: 10px;font-weight: 200;text-align: center;padding-bottom: 0;margin-bottom: 0;">{{ Auth::user()->storage->getFormattedUsedStorage() }}
                                    of {{ Auth::user()->storage->getFormattedTotalStorage() }}</p></span>

                    <div class="progress-bar"
                         style="width: {{ Auth::user()->storage->getPercentageUsed() }}%;height: 5px;margin: 4px;"></div>
                </li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Profile</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Settings</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('user.logout') }}">Logout</a>
                </li>
            </ul>
        </li>
    </ul>

    <ul class="nav  nav-stacked">
        <li><a href="#UploadModal" class="hide-mobile" data-toggle="modal">
                <span class="fa fa-cloud-upload"></span> Upload
            </a>
        </li>
        <li>
            <a href="{{ route('home') }}" class="{{ $active == 'all-files' ? 'active' : '' }} ">
                <span class="fa fa-folder pull-left"></span> All Files
            </a>
        </li>
        <li>
            <a href="{{ route('home-files-for-sale') }}"
               class="{{ $active == 'files-for-sale' ? 'active' : '' }}">
                <span class="fa fa-cc pull-left"></span> Files For Sale
            </a>
        </li>
        <li>
            <a href="{{ route('home-purchased-files') }}"
               class="{{ $active == 'purchased-files' ? 'active' : '' }}">
                <span class="fa fa-files-o pull-left"></span> Purchased Files
            </a>
        </li>
    </ul>

    <div style="margin-top: 50px;"></div>

    <ul class="nav nav-stacked">
        <li>
            <a href="{{ route('user.storage') }}"
               class="{{ $active == 'storage' ? 'active' : '' }}">
                <span class="fa fa-cloud pull-left"></span> Buy Storage Space
            </a>
        </li>

        <li>
            <a href="{{ route('user.wallet') }}"
               class="{{ $active == 'wallet' ? 'active' : '' }}">
                <span class="fa fa-briefcase pull-left"></span> Wallet
            </a>
        </li>
    </ul>

    <footer>
        <div class="text-center">
            <a href="#">about us</a>
            <a href="#">privacy</a>
            <a href="#">copyright</a>
            <a href="#">terms & condition</a>
            <a href="#">blog</a>

            <p class="text-muted">&copy; copyright of landar studio limited, RC 1230157 </p>
        </div>
    </footer>
</div>
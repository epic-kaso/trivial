<div id="sideMenu" class="side-menu offcanvas-sm navmenu navmenu-custom navmenu-fixed-left">
    <ul class="nav nav-stacked">
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
</div>
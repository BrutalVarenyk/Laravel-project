<nav class="navba navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('lang.account.edit', Auth()->user()) }}">{{ __('Edit Profile') }}</a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="{{ route('lang.account.wishlist') }}">{{ __('WishList') }}</a>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>
</nav>

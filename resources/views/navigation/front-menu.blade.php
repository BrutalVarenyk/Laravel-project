<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <a onclick="goBack()" class="btn btn-default">< {{ __('Back') }}</a>
    <div class="container">
        <a class="navbar-brand" href="{{ route('lang.home') }}">
            {{ __('Home') }}
        </a>
        <a class="navbar-brand" href="{{ route('lang.products')  }}">
            {{ __('Products') }}
        </a>
        <div class="dropdown">
            <a class="navbar-brand dropdown" href="#" data-toggle="dropdown">
                {{ __('Categories') }}
            </a>
            <div class="dropdown-menu">
                <a href="{{ route('lang.categories') }}" class="dropdown-item">{{ __('All Categories') }}</a>
                <div class="dropdown-divider"></div>
                @foreach($all_categories as $category)
                    <a href="{{ route('lang.categories.show', $category->id) }}"
                       class="dropdown-item">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Right Side Of Navbar -->
        {{--            <ul class="navbar-nav mr-auto">--}}

        {{--            </ul>--}}
        <!-- Left Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item mr-5">
                    <span class="navbar-text"> {{ __('Language') }}:</span>
                    <a class="navbar-text"
                       href="{{ url(preg_replace('/\/[a-z]{2}\//', '/en/', url()->current() . '/', )) }}">
                        {{ __('en') }}
                    </a>
                    <a class="navbar-text"
                       href="{{ url(preg_replace('/\/[a-z]{2}\//', '/ru/', url()->current() . '/', )) }}">
                        {{ __('ru') }}
                    </a>
                    <a class="navbar-text"
                       href="{{ url(preg_replace('/\/[a-z]{2}\//', '/ua/', url()->current() . '/', )) }}">
                        {{ __('ua') }}
                    </a>
                </li>
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('lang.login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('lang.login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('lang.register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('lang.register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('lang.cart') }}">
                            {{ __('Cart') }} @if(Cart::instance('cart')->count() > 0) - <strong>{{ Cart::instance('cart')->count() }}</strong> @endif
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if(is_admin(Auth::user()))
                                <a class="dropdown-item" href="{{ route('lang.admin.home') }}">
                                    {{ __('Admin') }}
                                </a>
                                <div class="dropdown-divider"></div>
                            @endif
                            <a class="dropdown-item" href="{{ route('lang.logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('lang.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

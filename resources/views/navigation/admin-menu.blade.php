<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <a onclick="goBack()" class="btn btn-default">< {{ __('Back') }}</a>
    <div class="container">
        <div class="collapse navbar-collapse">
            <a class="navbar-brand" href="{{ route('lang.admin.home') }}">{{ __('Admin Panel') }}</a>
            <ul class="navbar-nav mr-auto">

                <li class="nav-item dropdown">
                    <a id="adminDropdownOrders" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="">
                        {{ __('Categories') }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                        <a href="{{ route('lang.categories') }}" class="dropdown-item">{{__('All Categories')}}</a>
                        <div class="dropdown-divider"></div>
                        @foreach($all_categories as $category)
                            <a href="{{ route('lang.categories.show', $category->id) }}"
                               class="dropdown-item">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a id="adminDropdownOrders" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="">
                        {{ __('Orders') }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left">
                        <a class="dropdown-item" href="{{route('lang.admin.orders')}}">{{ __('Orders List') }}</a>
                        <a class="dropdown-item" href="{{route('lang.admin.orders')}}">{{ __('New Order') }}</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a id="adminDropdownProducts" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="">
                        {{ __('Products') }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left">
                        <a class="dropdown-item" href="{{ route('lang.admin.products') }}">{{ __('Products List') }}</a>
                        <a class="dropdown-item"
                           href="{{ route('lang.admin.products.create') }}">{{ __('New Product') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('lang.products')  }}">
                            {{ __('Products') }}
                        </a>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li class="nav-item mr-5">
                    <span class="navbar-text"> {{ __('Language') }}:</span>
                    <a class="navbar-text"
                       href="{{ url(preg_replace('/\/[a-z]{2}\//', '/en/', url()->current(). '/', )) }}">
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

                <li class="nav-item dropdown">

                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('lang.admin.home') }}">
                            {{ __('Admin') }}
                        </a>
                        <div class="dropdown-divider"></div>
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
            </ul>
        </div>
    </div>
</nav>

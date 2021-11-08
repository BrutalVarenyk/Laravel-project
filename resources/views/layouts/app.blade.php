@inject('get_all_categories', 'App\Services\GetAllCategories\GetAllCategoriesService')
@inject('get_all_categories', 'App\Services\GetAllCategories\GetAllCategoriesService')
@php($all_categories = $get_all_categories::getAllCategories())
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.js" type="text/javascript"></script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</head>
<body>
<div id="app">
    @if(!Auth::user())
        @include('navigation.front-menu')
    @else
        @if(is_admin(Auth::user()) && (request()->segment(2) === 'admin'))
            @include('navigation.admin-menu')
        @else
            @include('navigation.front-menu')
        @endif
    @endif
    <main class="py-4">
        <div class="row">
            <div class="col-md-12">
                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
    </main>
    @yield('content')
</div>
</body>
</html>

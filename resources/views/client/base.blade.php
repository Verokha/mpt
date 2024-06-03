<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    @vite('resources/scss/client/bootstrap.scss')
    @yield('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
<head>
<body>
    <header class="p-3 mb-3 text-white" style="background-color: rgba(45, 45, 68, 1)">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-5 col-sm-4"><a href="{{route('page.home')}}"><img src="{{Vite::asset('resources/images/logo_reu.png')}}" /></a></div>
                <div class="col-2 col-sm-2"><img src="{{Vite::asset('resources/images/logo_mpt.png')}}" /></div>
                <div class="col-5 col-sm-6 text-block text-center"><p>Сервис для заказа справок в Московском Приборостоительном Техникуме</p></div>
            </div>
        </div>
    </header>
    <div class="container h-100">
        @yield('content')
    </div>
@vite('resources/js/client/bootstrap.js')
@yield('script')
</body>
</html>
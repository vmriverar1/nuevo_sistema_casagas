<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.theme.meta')
    @include('layouts.theme.styles')
</head>


<body class="form">

    @include('layouts.theme.loader')

    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <div id="content" class="main-content" style="margin-top:0px;">
            @yield('content-void')
        </div>

    </div>

    @include('layouts.theme.footer')
    @include('layouts.theme.scripts')

</body>

</html>

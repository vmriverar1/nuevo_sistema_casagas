<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.theme.meta')
    @include('layouts.theme.styles')
</head>


<body class="form">

    @include('layouts.theme.loader')
    @include('layouts.theme.head')

    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('layouts.theme.aside')

        <div id="content" class="main-content">
            @yield('content')
        </div>
        
    </div>

    @include('layouts.theme.footer')
    @include('layouts.theme.scripts')

</body>

</html>
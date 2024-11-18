<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.css_js.metaCharset')
        @yield('extra-css')
        @include('layouts.css_js.cssadmin')
    </head>

    <body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="" l>
        @include('layouts.admins-head-menu-footer.header')
        @include('layouts.admins-head-menu-footer.mainmenu')
        @yield('content')
        <input type="hidden" class="token" value="{{ csrf_token() }}">
        @include('layouts.admins-head-menu-footer.footer')
        @include('layouts.css_js.jsadmin')
        @yield('extraJS')
        <script src="{{ asset('admin-assets/js/scripts/ui/ui-feather.js') }}"></script>
        <script>
            $(window).on("load", function () {
                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14,
                    });
                }
            });
        </script>
    </body>
</html>

@php $footJquery=false; @endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="no-js">
<head>
    @include('admin.layouts.commons.meta')
    @yield('uncommonMeta')

    <title>{{$page_name}} | {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @include('admin.layouts.commons.exCss')
    @yield('uncommonExCss')

    @include('admin.layouts.commons.inCss')
    @yield('uncommonInCss')

    @yield('headJS')



</head>
<body style="font-size: 13px;" class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed accent-gray text-sm">
<div class="wrapper">
    @include('admin.layouts.commons.topNav')
    @include('admin.layouts.commons.sidebarMenu')

    <div class="content-wrapper">

        @include('admin.layouts.commons.contentHeader')
        <!-- Main content -->
        <section class="content">
             @include('admin.layouts.commons.flash')
             @yield('content')
        </section>

         @include('admin.layouts.commons.controlSidebar')
         @include('admin.layouts.commons.footer')

    </div>

</div>



{{--    </div>--}}

    <!-- Scripts -->
    @include('admin.layouts.commons.exJs')
    @yield('uncommonExJs')

    @include('admin.layouts.commons.inJs')
    @yield('uncommonInJs')
</body>
</html>

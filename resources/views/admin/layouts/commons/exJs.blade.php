@if($footJquery)
    <script src="{{asset('js/jquery/dist/jquery.min.js')}}"></script>
{{--<script src="{{asset('js/jquery_3.4.1/dist/jquery.min.js')}}"></script>--}}

@endif

<script src="{{asset('bower/select2/dist/js/select2.full.js')}}"></script>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
{{--<script src="plugins/jquery/jquery.min.js"></script>--}}
<!-- Bootstrap -->
<script src="{{asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('template/dist/js/adminlte.js')}}"></script>
<script src="{{asset('bower/alertifyjs/alertify.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<!-- Websocket -->
{{--<script>--}}
{{--    window.laravel_echo_port='{{env("LARAVEL_ECHO_PORT",6001)}}';--}}
{{--</script>--}}
{{--<script src="//{{ Request::getHost() }}:{{env('LARAVEL_ECHO_PORT',6001)}}/socket.io/socket.io.js"></script>--}}
{{--<script src="{{ url('/js/laravel-echo-setup.js') }}" type="text/javascript"></script>--}}

<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ config('app.name', 'Laravel') }} Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" href="{{asset('images/logos/police_logo.png')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template/login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template/login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template/login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
{{--    <link rel="stylesheet" type="text/css" href="emplate/login/vendor/select2/select2.min.css">--}}
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="template/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="template/login/css/main.css">
    <!--===============================================================================================-->
{{--    <link rel="stylesheet" href="{{asset('login/vendor/bootstrap/css/bootstrap.min.css')}}">--}}
{{--    <!--===============================================================================================-->--}}
{{--    <link rel="stylesheet" href="{{asset('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">--}}
{{--    <!--===============================================================================================-->--}}
{{--    <link rel="stylesheet" href="{{asset('login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">--}}
{{--    <!--===============================================================================================-->--}}
{{--    <link rel="stylesheet" href="{{asset('login/vendor/animate/animate.css')}}">--}}
{{--    <!--===============================================================================================-->--}}
{{--    <link rel="stylesheet" href="{{asset('login/vendor/css-hamburgers/hamburgers.min.css')}}">--}}
{{--    <!--===============================================================================================-->--}}
{{--    <link rel="stylesheet" href="{{asset('login/vendor/select2/select2.min.css')}}">--}}
{{--    <!--===============================================================================================-->--}}
{{--    <link rel="stylesheet" href="{{asset('login/css/util.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('login/css/main.css')}}">--}}

    <!--===============================================================================================-->
    <style>
        /*.container-login100::before {*/
        /*   background:  -webkit-linear-gradient(bottom, #0678f3, #07315f) !important;*/
        /*   background: linear-gradient(bottom, #0678f3, #07315f) !important;*/
        /*}*/

        /*.login100-form-btn::before {*/
        /*    background:-webkit-linear-gradient(top, #2f89e2, #1840f3, #0651a2)!important;*/
        /*    background: linear-gradient(top, #2f89e2, #1840f3, #0651a2) !important;*/
        /*}*/
    </style>
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url({{asset('images/defaults/login_back.jpg')}});">
        <div class="wrap-login100 p-t-40 p-b-40">
            <form method="POST" action="{{ route('login') }}"  class="login100-form validate-form">
                @csrf
                <div class="login100-form-avatar" style="height: 150px; width:auto;">
                    <img src="{{asset('images/logos/police_logo.png')}}" alt="Bangladesh Police Logo" style="height: 150px; width:auto;">
                </div>

                <span class="login100-form-title p-t-20 p-b-45" style="font-size: 20px;">
						{{ config('app.full_name', 'Laravel') }}
					</span>

                <div class="wrap-input100 validate-input m-b-10" data-validate = "ইউজারনেম লিখুন">
{{--                    <input class="input100" type="text" name="username" >--}}
                    <input id="login" type="text"
                           class="input100{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                           name="login" value="{{ old('username') ?: old('email') }}" required autofocus placeholder="ইউজারনেম">
{{--                    <span class="focus-input100"></span>--}}
                        <span class="focus-input100">
                            @if ($errors->has('username') || $errors->has('email'))
                                        <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                            @endif
                        </span>
                    <span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input m-b-10" data-validate = "পাসওয়ার্ড লিখুন।">
{{--                    <input class="input100" type="password" name="pass" placeholder="পাসওয়ার্ড">--}}
                    <input id="password" type="password" placeholder="পাসওয়ার্ড" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    <span class="focus-input100" role="alert">
                         @error('password')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </span>
                    <span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
                </div>

                <div class="container-login100-form-btn p-t-10">
                    <button type="submit" class="login100-form-btn">
                        লগইন করুন
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>


<script src="template/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="template/login/vendor/bootstrap/js/popper.js"></script>
<script src="template/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
{{--<script src="template/login/vendor/select2/select2.min.js"></script>--}}
<!--===============================================================================================-->
<script src="template/login/js/main.js"></script>


<!--===============================================================================================-->
{{--<script src="{{asset('login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>--}}
{{--<!--===============================================================================================-->--}}
{{--<script src="{{asset('login/vendor/bootstrap/js/popper.js')}}"></script>--}}
{{--<script src="{{asset('login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>--}}
{{--<!--===============================================================================================-->--}}
{{--<script src="{{asset('login/vendor/select2/select2.min.js')}}"></script>--}}
{{--<!--===============================================================================================-->--}}
{{--<script src="{{asset('login/js/main.js')}}"></script>--}}

</body>
</html>

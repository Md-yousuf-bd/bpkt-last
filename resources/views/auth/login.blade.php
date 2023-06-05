<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ config('app.name', 'Laravel') }} Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('images/logos/logo.png')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/template/login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/template/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/template/login/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/template/login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/template/login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/template/login/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/template/login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/template/login/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/template/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="public/template/login/css/main.css">
    <!--===============================================================================================-->
    <style>
        .login100-more::before {
            background: #000000;
            background: -webkit-linear-gradient(bottom, #262626, #000000);
            background: -o-linear-gradient(bottom, #262626, #000000);
            background: -moz-linear-gradient(bottom, #262626, #000000);
            background: linear-gradient(bottom, #262626, #000000);
        }
        .login100-form-bgbtn {
            background: #050b73;
            background: -webkit-linear-gradient(top, #162a73, #09215b, #4854c1, #0a104e);
            background: -o-linear-gradient(top, #162a73, #09215b, #4854c1, #0a104e);
            background: -moz-linear-gradient(top, #162a73, #09215b, #4854c1, #0a104e);
            background: linear-gradient(top, #162a73, #09215b, #4854c1, #0a104e);
        }

        .focus-input100::before {

            background: #000000;
            background: -webkit-linear-gradient(bottom, #262626, #000000);
            background: -o-linear-gradient(bottom, #262626, #000000);
            background: -moz-linear-gradient(bottom, #262626, #000000);
            background: linear-gradient(bottom, #262626, #000000);
        }
    </style>
</head>
<body style="background-color: #999999;">

<div class="limiter">
    <div class="container-login100" style="background-image: url('public/template/login/images/background.jpg');">
        <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
            <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                @csrf
{{--                <div class="login100-form-avatar" style="text-align:center; height: 150px; width:100%;">--}}
{{--                    <img src="{{asset('images/logos/police_logo.png')}}" alt="Bangladesh Police Logo" style="height: 150px; width:auto;">--}}
{{--                </div>--}}
					<span class="login100-form-logo">
                    <img src="{{asset('images/logos/logo.png')}}" alt="Bangladesh Police Logo" style="height: 150px; width:auto; border-radius: 50%;">
					</span>
                <span class="login100-form-title p-t-20 p-b-45" style="font-size: 20px; margin-top: 8px;">
						{{ config('app.full_name', 'Laravel') }}
                </span>
                <div class="wrap-input100 validate-input" data-validate = "Input Username">
                    <input id="username" type="text" class="input100{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                           name="login" value="{{ old('username') ?: old('email') }}" placeholder="Username" autocomplete="off">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Input Password">
                    <input placeholder="Password" id="password" type="password" class="input100 @error('password') is-invalid @enderror" name="password" autocomplete="off">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>

                <div>
                      <span class="focus-input100 text-danger">
                        @if ($errors->has('username') || $errors->has('email'))
                              <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                          @endif
                    </span>
                </div>

{{--                <div class="contact100-form-checkbox">--}}
{{--                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">--}}
{{--                    <label class="label-checkbox100" for="ckb1">--}}
{{--                        Remember me--}}
{{--                    </label>--}}
{{--                </div>--}}

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="public/template/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="public/template/login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="public/template/login/vendor/bootstrap/js/popper.js"></script>
<script src="public/template/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="public/template/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="public/template/login/vendor/daterangepicker/moment.min.js"></script>
<script src="public/template/login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="public/template/login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="public/template/login/js/main.js"></script>



</body>
</html>

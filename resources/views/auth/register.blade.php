<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register | Smart Exam</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="{{ asset('login_register/images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login_register/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
{{--     <link rel="stylesheet" type="text/css" href="{{ asset('login_register/fonts/font-awesome-4.7.0/css') }}/font-awesome.min.css"> --}}
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login_register/vendor/animate/animate.css') }}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{ asset('login_register/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login_register/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login_register/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login_register/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{ asset('login_register/images/img-01.png') }}" alt="Smart Exam logo">
                </div>
                <form class="login100-form validate-form" method="POST" action="{{ url('register') }}">
                    @csrf
                    <span class="login100-form-title">
                        Create your account
                    </span>
                    @if ($errors->has('email'))
                        <div class="alert alert-danger text-center" role="alert">
                            <h6 style="font-size: 12px">{!! $errors->first('email') !!}</h6>
                        </div>
                    @endif
                    @if ($errors->has('kode'))
                        <div class="alert alert-danger text-center" role="alert">
                            <h6 style="font-size: 12px">{!! $errors->first('kode') !!}</h6>
                        </div>
                    @endif
                    @if ($errors->has('password'))
                        <div class="alert alert-danger text-center" role="alert">
                            <h6 style="font-size: 12px">{!! $errors->first('password') !!}</h6>
                        </div>
                    @endif
                    <div class="wrap-input100 validate-input">
                        <input id="name" type="name" class="input100" value="{{ old('name') }}" required placeholder="Name" name="name">

                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fas fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input id="email" type="email" class="input100" value="{{ old('email') }}" required placeholder="Email" name="email">

                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fas fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input id="kode" type="kode" class="input100" value="{{ old('kode') }}" required placeholder="NRP / NIP" name="kode">

                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fas fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input id="password" type="password" class="input100" required placeholder="Password" name="password">

                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fas fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input id="password-confirm" type="password" class="input100" required placeholder="Password Confirm" name="password_confirmation">

                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fas fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Create
                        </button>
                    </div>

                    <div class="text-center p-t-136 txt2">
                        Already have your account? Login by
                        <a class="txt2" href="{{ url('login')}}">
                            Click here
                            <i class="fas fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    

    
<!--===============================================================================================-->  
    <script src="{{ asset('login_register/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('login_register/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('login_register/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('login_register/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('login_register/vendor/tilt/tilt.jquery.min.js') }}"></script>
    <script >
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
<!--===============================================================================================-->
    <script src="{{ asset('login_register/js/main.js') }}"></script>

</body>
</html>
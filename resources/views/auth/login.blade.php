<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login | Smart Exam</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="{{ asset('login_register/images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
                <form class="login100-form validate-form" method="POST" action="{{ url('login') }}">
                    @csrf
                    <span class="login100-form-title">
                        Login to Smart Exam
                    </span>
                    @if (\Session::has('message'))
                        <div class="alert alert-danger text-center" role="alert">
                            <h6 style="font-size: 12px">{!! \Session::get('message') !!}</h6>
                        </div>
                    @endif
                    @if (\Session::has('success'))
                        <div class="alert alert-success text-center" role="alert" >
                            <h6 style="font-size: 12px">{!! \Session::get('success') !!}</h6>
                        </div>
                    @endif
                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@gmail.com">
                        <input id="email" type="email" class="input100" name="email" value="{{ old('email') }}" required placeholder="Email" name="email">

                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fas fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <input id="password" type="password" class="input100" name="password" required placeholder="Password" name="password">

                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fas fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>
                    
                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Login
                        </button>
                    </div>

<!--                     <div class="text-center p-t-12">
                        @if (Route::has('password.request'))
                        <span class="txt1">
                            Forgot
                        </span>
                        <a class="txt2" href="{{ route('password.request') }}">
                            Username / Password?
                        </a>
                        @endif
                    </div> -->

                    <div class="text-center p-t-136 txt2">

                    </div>
                </form>
            </div>
        </div>
    </div>
    
    

    
<!--===============================================================================================-->  
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
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
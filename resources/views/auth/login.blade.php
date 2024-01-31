
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Wieldy - A fully responsive, HTML5 based admin template">
    <meta name="keywords" content="Responsive, HTML5, admin theme, business, professional, jQuery, web design, CSS3, sass">
    <!-- /meta tags -->
    <title>Wieldy - Admin login</title>

    <!-- Site favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- /site favicon -->
    @vite(['resources/sass/app.scss','resources/js/app.js'])
    

</head>
<body class="dt-sidebar--fixed dt-header--fixed">

<!-- Root -->
<div class="dt-root">

    <!-- Login Container -->
    <div class="dt-login--container dt-app-login--container">

        <!-- Login Content -->
        <div class="dt-login__content-wrapper">

            <!-- Login Background Section -->
            <div class="dt-login__bg-section">

                <div class="dt-login__bg-content">
                    <!-- Login Title -->
                    <h1 class="dt-login__title">Sign In</h1>
                    <!-- /login title -->

                    <p class="f-16 font-weight-bold">Get an account !!</p>
                </div>


                <!-- Brand logo -->
                <div class="dt-login__logo">
                    <a class="dt-brand__logo-link" href="index.html">
                        <img class="dt-brand__logo-img" src="{{ asset('assets/images/logo-white.png') }}" alt="Wieldy">
                    </a>
                </div>
                <!-- /brand logo -->

            </div>
            <!-- /login background section -->

            <!-- Login Content Section -->
            <div class="dt-login__content">

                <!-- Login Content Inner -->
                <div class="dt-login__content-inner">

                    <!-- Form -->
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <!-- Form Group -->
                        <div class="form-group">
                            <label class="sr-only" for="email">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="email" placeholder="Enter email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <!-- /form group -->

                        <!-- Form Group -->
                        <div class="form-group">
                            <label class="sr-only" for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <!-- /form group -->

                        <!-- Form Group -->
                        <div class="custom-control custom-checkbox mb-6 mb-lg-8">
                            <input class="custom-control-input" type="checkbox" id="remember" {{ old('remember') ? 'checked' : '' }} name="remember">
                            <label class="custom-control-label" for="remember">Remember Me 
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="px-2">Forget Password
                                </a>
                                @endif
                            </label>
                        </div>
                        <!-- /form group -->

                        <!-- Form Group -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary text-uppercase">Sign In</button>
                            <span class="d-inline-block ml-4">Or
              <a class="d-inline-block font-weight-medium ml-3" href="page-signup-2.html">Sign Up</a>
            </span>
                        </div>
                        <!-- /form group -->

                        <!-- Form Group -->
                        <div class="d-flex flex-wrap align-items-center mb-3 mb-md-4">
                            <span class="d-inline-block mr-2">Or connect with</span>

                            <!-- List -->
                            <ul class="dt-list dt-list-sm dt-list-cm-0 ml-auto">
                                <li class="dt-list__item">
                                    <!-- Fab Button -->
                                    <a href="javascript:void(0)" class="btn btn-outline-primary dt-fab-btn size-30">
                                        <i class="icon icon-facebook icon-xl"></i>
                                    </a>
                                    <!-- /fab button -->
                                </li>

                                <li class="dt-list__item">
                                    <!-- Fab Button -->
                                    <a href="javascript:void(0)" class="btn btn-outline-primary dt-fab-btn size-30">
                                        <i class="icon icon-google-plus icon-xl"></i>
                                    </a>
                                    <!-- /fab button -->
                                </li>

                                <li class="dt-list__item">
                                    <!-- Fab Button -->
                                    <a href="javascript:void(0)" class="btn btn-outline-primary dt-fab-btn size-30">
                                        <i class="icon icon-github icon-xl"></i>
                                    </a>
                                    <!-- /fab button -->
                                </li>

                                <li class="dt-list__item">
                                    <!-- Fab Button -->
                                    <a href="javascript:void(0)" class="btn btn-outline-primary dt-fab-btn size-30">
                                        <i class="icon icon-twitter icon-xl"></i>
                                    </a>
                                    <!-- /fab button -->
                                </li>
                            </ul>
                            <!-- /list -->
                        </div>
                        <!-- /form group -->


                    </form>
                    <!-- /form -->

                </div>
                <!-- /login content inner -->

            </div>
            <!-- /login content section -->

        </div>
        <!-- /login content -->

    </div>
    <!-- /login container -->

</div>
<!-- /root -->

<!-- Optional JavaScript -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<!-- Perfect Scrollbar jQuery -->
<script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>
<!-- /perfect scrollbar jQuery -->
<!-- Custom JavaScript -->
<script src="{{ asset('assets/js/script.js') }}"></script>

</body>
</html>

<!DOCTYPE html>
<html lang="en" data-topbar-color="dark">

<head>
    <meta charset="utf-8" />
    <title>Mall UKM | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}assets/images/logoMall.png">

    <!-- Theme Config Js -->
    <script src="{{ asset('/') }}assets/js/head.js"></script>

    <!-- Bootstrap css -->
    <link href="{{ asset('/') }}assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- App css -->
    <link href="{{ asset('/') }}assets/css/app.min.css" rel="stylesheet" type="text/css" />

    <!-- Icons css -->
    <link href="{{ asset('/') }}assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="auth-brand">
                                <a href="#" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="{{ asset('/') }}assets/images/logoMall.png" alt=""
                                            height="100">
                                    </span>
                                </a>

                                <a href="#" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="{{ asset('/') }}assets/images/logoMall.png" alt=""
                                            height="100">
                                    </span>
                                </a>
                            </div>

                            <div class="text-center mt-4">
                                <h1 class="text-error">500</h1>
                                <h3 class="mt-3 mb-2">Silahkan Coba Kembali !</h3>
                            </div>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->


    <footer class="footer footer-alt">
        2023
    </footer>

    <!-- Authentication js -->
    {{-- <script src="/assets/js/pages/authentication.init.js"></script> --}}

</body>

</html>

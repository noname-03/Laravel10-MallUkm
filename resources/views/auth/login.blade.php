<!DOCTYPE html>
<html lang="en" data-topbar-color="dark">

<head>
    <meta charset="utf-8" />
    <title>Mall UKM | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}assets/images/favicon.ico">

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

                            <div class="text-center w-75 m-auto">
                                <div class="auth-brand">
                                    <a href="/" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            {{-- <img src="assets/images/logo-dark.png" alt="" height="22"> --}}
                                            {{-- <img src="{{ asset('/') }}assets/images/HITAM-SILAPAK.png" alt="PAK"
                                                width="100"> --}}
                                            <h2>MALL UKM</h2>
                                        </span>
                                    </a>

                                    <a href="/" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            {{-- <img src="assets/images/logo-light.png" alt="" height="22"> --}}
                                            <h2>MALL UKM</h2>
                                            {{-- <img src="{{ asset('/') }}assets/images/PUTIH-SILAPAK.png" alt="PAK"
                                                width="100"> --}}
                                        </span>
                                    </a>
                                </div>
                                <p class="text-muted mb-4 mt-3">Masukan alamat email dan password untuk akses panel
                                    admin.</p>
                            </div>

                            <form action="{{route('login')}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Email address</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email"
                                        id="emailaddress" required placeholder="Enter your email" name="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Enter your password" name="password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center d-grid">
                                    <button class="btn btn-primary" type="submit"> Log In </button>
                                </div>

                            </form>


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
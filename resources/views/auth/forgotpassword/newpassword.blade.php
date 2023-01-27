<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{asset ('assets/admin')}}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Forget Password Pages</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset ('assets/admin/img/favicon/icon-asabri.png')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset ('../assets/admin/vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset ('../assets/admin/vendor/css/core.css')}}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset ('../assets/admin/vendor/css/theme-default.css')}}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset ('../assets/admin/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset ('../assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{asset ('../assets/admin/vendor/css/pages/page-auth.css')}}" />
    <!-- Helpers -->
    <script src="{{asset ('../assets/admin/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset ('../assets/admin/js/config.js')}}"></script>
    <style>
        .bd-callout {
    padding: 1.25rem;
    margin-top: 1.25rem;
    margin-bottom: 1.25rem;
    background-color: var(--bd-callout-bg, var(--bs-gray-100));
    border-left: 0.25rem solid var(--bd-callout-border, var(--bs-gray-300));
        }

        .bd-callout-info {
            --bd-callout-bg: rgba(var(--bs-info-rgb), .075);
            --bd-callout-border: rgba(var(--bs-info-rgb), .5);
        }

        .bd-callout-warning {
            --bd-callout-bg: rgba(var(--bs-warning-rgb), .075);
            --bd-callout-border: rgba(var(--bs-warning-rgb), .5);
        }
    </style>
</head>

<body>
    <!-- Content -->

    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Forgot Password -->
                @if ($status == '400')
                <div class="col-md-12">
                    <a href="{{ route ('loginpage') }}" type="button" class="btn btn-primary fw-bold"><i class='bx bxs-chevrons-left'></i> Back to login</a>
                </div>
                <div class="col-md-12 p-5">
                    <div class="col-md-12 row bd-callout bd-callout-warning rounded-2 my-2 p-4">
                        <div class="col-1">
                            <h1><i style="font-size: 32px;" class='bx bx-info-circle bx-flashing text-danger'></i></h1>
                        </div>
                        <div class="col-11 text-dark">
                            <p class="fw-bold fs-2 text-danger">Code confirmation is not valid</p>
                            <p class="fs-4 text-uppercase">{{ $invalid }}</p>
                        </div>
                    </div>
                </div>                    
                @else
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="#" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{asset('assets/admin/img/favicon/icon-asabri.png')}}" alt="" width="50">
                                </span>
                                <span class="app-brand-text demo text-body fw-bolder">ASABRI</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Change Forgot Password? 🔒</h4>
                        <p class="mb-4">Enter your new password to reset your password</p>
                        <form class="mb-3" action="{{ route ('resetpassword') }}" method="POST">
                            @csrf
                            <input type="hidden" name="confirmation" value="{{ $confirmation }}">
                            <div class="mb-3">
                                <div class="col-md-12 form-password-toggle  @error('firstname') is-invalid @enderror">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="password">Enter New Password</label>
                                    </div>
                                    <div class="input-group input-group-merge">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" required autocomplete="new-password" />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-password-toggle  @error('newpassword') is-invalid @enderror">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="newpassword">Confirm Password</label>
                                    </div>
                                    <div class="input-group input-group-merge">
                                        <input type="password" class="form-control @error('newpassword') is-invalid @enderror"
                                            id="newpassword" name="newpassword"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="newpassword" required autocomplete="newpassword" />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        @error('newpassword')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary d-grid w-100">Reset Password</button>
                        </form>
                    </div>
                </div>
                @endif
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>

    <!-- / Content -->

    @include('sweetalert::alert')
    <!-- / Content -->
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset ('../assets/admin/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset ('../assets/admin/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset ('../assets/admin/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset ('../assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{asset ('../assets/admin/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{asset ('../assets/admin/js/main.js')}}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>

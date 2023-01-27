<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="{{asset ('assets/admin')}}"
    data-template="vertical-menu-template-free">
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
    <link rel="stylesheet" href="{{asset ('../assets/admin/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset ('../assets/admin/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
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
</head>
<body>
    <!-- Content -->
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
          <div class="authentication-inner py-4">
            <!-- Forgot Password -->
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
                <h4 class="mb-2">Forgot Password? 🔒</h4>
                <p class="mb-4">Enter your username and we'll send you email to reset your password</p>
                <form class="mb-3" action="{{ route ('sendmail') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="email" class="form-label">Username</label>
                    <input
                      type="text"
                      class="form-control"
                      name="username"
                      placeholder="Enter your username"
                    />
                  </div>
                  <button type="submit" class="btn btn-primary d-grid w-100">Send Reset Link</button>
                </form>
                <div class="text-center">
                  <a href="{{route('loginpage')}}" class="d-flex align-items-center justify-content-center">
                    <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                    Back to login
                  </a>
                </div>
              </div>
            </div>
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

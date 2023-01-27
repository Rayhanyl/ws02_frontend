<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="{{asset ('assets/admin')}}"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Password Reset</title>

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
    <table align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%">
        <tbody>
            <tr>
                <td>
                <table border="0" cellpadding="0" cellspacing="0" style="margin:auto; max-width:650px; width:100%">
                    <tbody>
                        <tr>
                            <td colspan="2" style="background-color:rgba(51, 51, 51, 1)">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                            <h1 style="margin-left:0; margin-right:0; text-align:left">Password Reset</h1>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; vertical-align:top">
                            <p style="margin-left:0; margin-right:0; text-align:left">Hi {{ $mailData['name'] }},</p>
    
                            <p style="margin-left:0; margin-right:0; text-align:left">We received a request to reset the password for the <strong>{{ $mailData['name'] }}</strong> account that is associated with this email address.<br />
                            If you made this request, please click the button below to securely reset your password.</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:left">
                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="background-color:rgba(255, 80, 0, 1); border-radius:4px">
                                <tbody>
                                    <tr>
                                        <td class="p-2" style="border-radius:6px;"><a href="http://127.0.0.1:8000/newpassword?confirmation={{ $mailData['code'] }}&amp;userstoredomain=PRIMARY&amp;username={{ $mailData['name'] }}&amp;tenantdomain=carbon.super&amp;callback=http://127.0.0.1:8000/loginpage" style="width: 230px; border-radius:10px; font-family: &quot;Nunito Sans&quot;, Arial, Verdana, Helvetica, sans-serif; font-size: 18px; line-height: 21px; font-weight: 600; color: rgba(255, 255, 255, 1); text-decoration: none; background-color: rgba(255, 80, 0, 1); text-align: center; display: inline-block; cursor: pointer">Reset Password</a></td>
                                    </tr>
                                </tbody>
                            </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; vertical-align:top">
                            <p style="margin-left:0; margin-right:0; text-align:left">If clicking the button doesn&#39;t seem to work, you can copy and paste the following link into your browser.<br />
                            <a href="http://127.0.0.1:8000/newpassword?confirmation={{ $mailData['code'] }}&amp;userstoredomain=PRIMARY&amp;username={{ $mailData['name'] }}&amp;tenantdomain=carbon.super&amp;callback=http://127.0.0.1:8000/loginpage" style="word-break: break-all; color: rgba(255, 80, 0, 1); font-size: 14px">http://127.0.0.1:8000/newpassword?confirmation={{ $mailData['code'] }}&amp;userstoredomain=PRIMARY&amp;username={{ $mailData['name'] }}&amp;tenantdomain=carbon.super&amp;callback=http://127.0.0.1:8000/loginpage</a></p>
                            &nbsp;
    
                            <p style="margin-left:0; margin-right:0; text-align:left">If you did not request to have your {{ $mailData['name'] }} password reset, disregard this email and no changes to your account will be made.</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:left; vertical-align:top">
                            <p style="margin-left:0; margin-right:0; text-align:left">Thanks,<br />
                            WSO2 API Manager Team</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                            <p style="margin-left:0; margin-right:0">&copy; 2023 PT.&nbsp;<a href="http://wso2.com/" style="color: rgba(119, 119, 119, 1); text-decoration: none">S</a>WAMEDIA INFORMATIKA<br />
                            Jl. Sido Mulyo No.29, 40123, Sadang Serang, Jawa Barat</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
            </tr>
        </tbody>
    </table>
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
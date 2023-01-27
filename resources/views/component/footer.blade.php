  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>Asabri</h3>
              <p>
                Menara ASABRI,Grand Indonesia,JL. MH Thamrin No.1<br>
                Jakarta 10310, INA<br><br>
                <strong>Phone:</strong> (021) 765 3421<br>
                {{-- <strong>Email:</strong> info@example.com<br> --}}
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#about">Benefits</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#services">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#clients">Our Partners</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          {{-- <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div> --}}

          {{-- <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div> --}}

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>PT ASABRI</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/scaffold-bootstrap-metro-style-template/ -->
        {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


  <!-- Vendor JS Files -->
  <script src="{{asset ('assets/landingpage/js/jquery-3.6.1.js')}}"></script>
  <script>
  
    $(document).ready(function() {
      $(document).on('click', '.toggleChangepassword', function (e) {
        e.preventDefault();
          var currentPass = $("#currentpassword");
          var newPass = $("#newpassword");

          if (currentPass.attr('type') === 'password') {
              currentPass.attr('type', 'text');
              $(this).html('<i class="bi bi-eye-slash-fill"></i>');
  
          } else {
              currentPass.attr('type', 'password');
              $(this).html('<i class="bi bi-eye-fill"></i>');
          }
      });
      $(document).on('click', '.toggleNewpassword', function (e) {
        e.preventDefault();
          var newPass = $("#newpassword");
          if (newPass.attr('type') === 'password') {
              newPass.attr('type', 'text');
              $(this).html('<i class="bi bi-eye-slash-fill"></i>');
  
          } else {
              newPass.attr('type', 'password');
              $(this).html('<i class="bi bi-eye-fill"></i>');
          }
      });
    });
  </script>
  @include('sweetalert::alert')
  <script src="{{asset('swagger/jquery-2.1.4.min.js')}}"></script>
  <script src="{{asset('swagger/swagger-bundle.js')}}"></script>
  <script type="application/javascript">
      const ui = SwaggerUIBundle({
          url: "{{ asset('swagger/swagger.yaml') }}",
          dom_id: '#swagger-ui',
      });
  </script>
  <script src="{{asset ('assets/landingpage/vendor/aos/aos.js')}}"></script>
  <script src="{{asset ('assets/landingpage/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset ('assets/landingpage/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset ('assets/landingpage/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset ('assets/landingpage/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset ('assets/landingpage/vendor/php-email-form/validate.js')}}"></script>
  @stack('script')
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  
  <!-- Template Main JS File -->
  <script src="{{asset ('assets/landingpage/js/main.js')}}"></script>
  <script src="{{asset ('assets/landingpage/js/datatables.min.js')}}"></script>

</body>

</html>
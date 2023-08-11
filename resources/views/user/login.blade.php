<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="{{asset('img-jb-gestion/Logo_job_gestion.png')}}" rel="icon">
    <link href="{{asset('img-jb-gestion/Logo_job_gestion.png')}}" rel="apple-touch-icon">


    <title>JOBS GESTION</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('template/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/simple-datatables/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    <!-- CSS -->
  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" /> --}}


    <!-- Template Main CSS File -->
    <link href="{{asset('template/css/style.css')}}" rel="stylesheet">

    <!-- =======================================================
    * Template Name: NiceAdmin - v2.5.0
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>
<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">



                <div class="modal fade" id="login" aria-hidden="true" data-bs-backdrop="static" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-title">
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center py-1 " >
                                <img src="{{asset('img-jb-gestion/Logo_job_gestion.png')}}" alt="" style="width: 50%">
                            </div><!-- End Logo -->

                              <form class="row g-3 needs-validation" novalidate action="{{route('user.auth')}}" method="POST">
                                @csrf
                                <div class="col-12">
                                  <label for="yourUsername" class="form-label">email</label>
                                  <div class="input-group has-validation">
                                    <input type="text" name="email" class="form-control" id="yourUsername" required>
                                    <div class="invalid-feedback">Please enter your username.</div>
                                  </div>
                                </div>

                                <div class="col-12">
                                  <label for="yourPassword" class="form-label">Mot de passe</label>
                                  <input type="password" name="password" class="form-control" id="yourPassword" required>
                                  <div class="invalid-feedback">Please enter your password!</div>
                                </div>

                                {{-- <div class="col-12">
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                  </div>
                                </div> --}}
                                <div class="col-12">
                                  <button class="btn btn-primary w-100" type="submit">Connexion</button>
                                </div>
                                {{-- <div class="col-12">
                                  <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
                                </div> --}}
                              </form>
                        </div>
                      </div>
                    </div>
                  </div>

                <script>

                    $(window).on('load', function() {
                        $('#login').modal('show');
                    });
                </script>


            </div>
          </div>
        </div>

      </section>

    </div>
    <main id="main" class="main">


        <script src="{{asset('js/jquery.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


        @yield('content')
      </main>

      <!-- Vendor JS Files -->
      <script src="{{asset('template/vendor/apexcharts/apexcharts.min.js')}}"></script>
      <script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('template/vendor/chart.js/chart.umd.js')}}"></script>
      <script src="{{asset('template/vendor/echarts/echarts.min.js')}}"></script>
      <script src="{{asset('template/vendor/quill/quill.min.js')}}"></script>
      <script src="{{asset('template/vendor/simple-datatables/simple-datatables.js')}}"></script>
      <script src="{{asset('template/vendor/tinymce/tinymce.min.js')}}"></script>
      <script src="{{asset('template/vendor/php-email-form/validate.js')}}"></script>

      <!-- Template Main JS File -->
      <script src="{{asset('template/js/main.js')}}"></script>
      <!-- Template Main JS File -->
      {{-- <script src="{{asset('template/js/main.js')}}"></script> --}}
      {{-- <script src="{{asset('js/jquery.js')}}"></script> --}}


    <!-- JS -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script> --}}
    </main>

    <script>

        $(window).on('load', function() {
            $('#login').modal('show');
        });
    </script>

</body>

</html>

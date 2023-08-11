<!DOCTYPE html>
<html lang="en">

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

      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1>403</h1>
        <h2 class="text-center">Vous n'avez pas les autisations requises.</h2>
        <a class="btn" href="javascript:history.back()">Retour</a>
        <form action="{{route('user.logout')}}" class="d-inline" method="post">
            @csrf
              <button type="submit" class="mt-4 btn d-flex align-items-center" style="background-color:#ff6584"> <i class="bi bi-box-arrow-right d-inline"></i>Déconexion</button>


        </form>
        <img src="{{asset('img-jb-gestion/not-found.svg')}}" class="img-fluid py-5 w-25" alt="Page Not Found">

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

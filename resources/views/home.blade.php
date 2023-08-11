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

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



  <!-- CSS -->
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" /> --}}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Template Main CSS File -->
  <link href="{{asset('template/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<style>

body{
    width: auto;
    background-repeat: no-repeat;
        background-size: 100%<;
    background-image: url({{asset('img-jb-gestion/fond.png')}});

    }

</style>
<body>


    <h1>

    </h1>

    {{-- <div id="b"> --}}
        <div class="row">
            <div class="col-4">
                <img class="mx-5 py-2" src="{{asset('img-jb-gestion/Logo_job_gestion.png')}}" alt="Logo JOBS CONSEIL" width="50%">

            </div>
            <div class=" col-sm-7"><br>
                <h5>Veuillez sélectionner un module</h5>
                <div class=" row text-center">
                    <div class="col-sm-6" >
                        <a  href="{{route('caisse.decaissement.index')}}"><img class="w-75 "  src="{{asset('img-jb-gestion/caisse.png')}}" alt="Suivi de la caiise"></a>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{route('materiel.categorie.index')}}"><img class="w-75"  src="{{asset('img-jb-gestion/immo.png')}}" alt="suivi des immobilisations"></a>
                    </div>
                </div>
                <div class=" row mt-2 text-center">
                    <div class="col-sm-6" >
                        <a href="{{route('tiers.indexFournisseur')}}"><img class="w-75 m-3" src="{{asset('img-jb-gestion/tiers.png')}}" alt="suivi des tiers"></a>
                    </div>
                    <div class="col-sm-6">
                        <a  href="{{route('marchandise.index')}}"><img class="w-75 m-3" src="{{asset('img-jb-gestion/marchandise.png')}}" alt="Suivi des marchandises"></a>
                    </div>
                </div>

                {{-- <div >
                    <a href="{{route('tiers.home')}}"><img  src="{{asset('img-jb-gestion/tiers.png')}}" alt="suivi des tiers"></a>
                </div>
                <div >
                    <a  href="{{route('marchandise.dashboard')}}"><img src="{{asset('img-jb-gestion/marchandise.png')}}" alt="Suivi des marchandises"></a>
                </div> --}}
            </div>
        </div>
    {{-- </div> --}}


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
  <script src="{{asset('js/jquery.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


  @if(Session::has('message'))

  <script>
      toastr.success("{!! Session::get('message') !!}");
  </script>

  @endif

  @if($errors->all())

  <script>
      toastr.error("Une erreur c'est produite");
  </script>

  @endif

</body>

</html>

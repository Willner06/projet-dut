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

  <!-- ======= Header ======= -->

  {{-- sidebar --}}

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{route('home')}}" class="logo d-flex align-items-center">
        <img src="{{asset('img-jb-gestion/Logo_job_gestion.png')}}" alt="Logo JOBS-GESTION">
        <span class="d-none d-lg-block">JOBS <span class="text-primary">GESTION</span></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->




        <li class="nav-item dropdown pe-3">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

              <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::user()->nom." ".Auth::user()->prenom}}</span>
            </a><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">

              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li class="d-inline">

                <form action="{{route('user.logout')}}" class="d-inline" method="post">
                  @csrf

                    <button type="submit" class="dropdown-item d-flex align-items-center text-danger"> <i class="bi bi-box-arrow-right d-inline"></i>Déconnexion</button>

              </form>

              </li>

            </ul><!-- End Profile Dropdown Items -->
          </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->



  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="href="{{route('marchandise.dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li> --}}

      <li class="nav-item collapsed">
        <a class="nav-link collapsed" href="{{route('marchandise.categorie.index')}}">

          <span>Catégories</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item collapsed">
        <a class="nav-link collapsed" href="{{route('marchandise.index')}}">

          <span>Produits</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item collapsed">
        <a class="nav-link collapsed" href="{{route('marchandise.inventaire.index')}}">

          <span>Inventaire</span>
        </a>
      </li><!-- End Profile Page Nav -->

      @can('Acceder au panneau de configuration')

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('user.index')}}">
          <i class="bi bi-circle"></i><span>Panneau de configuration</span>
        </a>
      </li>

      @endcan

      {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('marchandise.entres')}}">

          <span>Entrées</span>
        </a>
      </li><!-- End Profile Page Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('marchandise.sorties')}}">

          <span>Sorties</span>
        </a>
      </li><!-- End Profile Page Nav --> --}}

      {{-- @can('Voir le tableau de bord')


        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#dashboard" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Tableau de bord</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="dashboard" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            @can('Voir le tableau de bord de la caisse')
                <li>
                    <a href="{{route('caisse.home')}}">
                    <i class="bi bi-circle"></i><span>Suivi de la caisse</span>
                    </a>
                </li>
            @endcan
            @can('Voir le tableau de bord de la caisse')
                <li>
                    <a href="{{route('tiers.home')}}">
                    <i class="bi bi-circle"></i><span>Suivi des tiers</span>
                    </a>
                </li>
            @endcan
            </ul>
        </li><!-- End Components Nav -->
        @endcan

        @can('Gerer les utilisateurs')


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#utilisateurs" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Gestion des utilisateurs</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="utilisateurs" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('user.index')}}">
                  <i class="bi bi-circle"></i><span>Utilisateur</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('roles.index')}}">
                  <i class="bi bi-circle"></i><span>Rôles</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('log.index')}}">
                    <i class="bi bi-circle"></i><span>Historique</span>
                </a>
            </li><!-- End Profile Page Nav -->
        </ul>
      </li><!-- End Components Nav -->
      @endcan --}}

    </ul>

  </aside><!-- End Sidebar-->


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

</body>

</html>

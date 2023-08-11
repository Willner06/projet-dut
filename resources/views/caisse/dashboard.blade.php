@extends('layouts.app')
@section('content')

    <style>
        #graph-trimestre{
            display: none;
        }
        #graph-mois{
            display: none;
        }
    </style>
    <section>
        <div class="pagetitle">
            <div class="">
                <h1>Tableau de bord</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Tableau de bord de la caisse</li>
                    </ol>
                </nav>
            <br><br>
            </div>

        </div><!-- End Page Title -->
      <div class="row">

      <div class="col-lg-12" id="graph-annee">
        <div class="card">
            <div class="filter ps-3">

                  <a class="icon float-end p-3" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filtre</h6>
                    </li>

                    <li><a class="dropdown-item" href="#" onclick="filtre('annee')">Année</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filtre('trimestre')">Trimestre</a></li>
                    <li><a class="dropdown-item" href="#" onclick="filtre('mois')">Mois</a></li>
                  </ul>
                  <h5 class="card-title">Décaissements et encaissements par année</h5>
                </div>
          <div class="card-body">


            <!-- Column Chart -->
            <div id="annee"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new ApexCharts(document.querySelector("#annee"), {
                  series: [{
                    name: 'Décaissement',
                    data: [
                            @foreach($resultat_annee as $total)
                                '{{ $total->decaissements }}',
                            @endforeach
                            ]
                  }, {
                    name: 'Encaissement',
                    data: [
                        @foreach($resultat_annee as $total)
                            '{{ $total->encaissements }}',
                        @endforeach
                            ]
                  }],
                  chart: {
                    type: 'bar',
                    height: 350
                  },
                  plotOptions: {
                    bar: {
                      horizontal: false,
                      columnWidth: '55%',
                      endingShape: 'rounded'
                    },
                  },
                  dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return  val.toLocaleString('fr-FR') + " Fcfa"
                      }
                  },
                  stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                  },
                  xaxis: {
                    categories: [
                        @foreach($resultat_annee as $total)
                            '{{ $total->annee }}',
                        @endforeach
                            ],
                  },
                  fill: {
                    opacity: 1
                  },
                  tooltip: {
                    y: {
                      formatter: function(val) {
                        return  val.toLocaleString('fr-FR') + " Fcfa"
                      }
                    }
                  }
                }).render();
              });
            </script>
            <!-- End Column Chart -->

          </div>
        </div>
      </div>


      <div class="col-lg-12" id="graph-trimestre">
        <div class="card">

            <div class="filter ps-3">

                <a class="icon float-end p-3" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filtre</h6>
                  </li>

                  <li><a class="dropdown-item" href="#" onclick="filtre('annee')">Année</a></li>
                  <li><a class="dropdown-item" href="#" onclick="filtre('trimestre')">Trimestre</a></li>
                  <li><a class="dropdown-item" href="#" onclick="filtre('mois')">Mois</a></li>
                </ul>
                <h5 class="card-title">Décaissements et encaissements par trimestre</h5>
            </div>

          <div class="card-body">


            <!-- Column Chart -->
            <div id="trimestre"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new ApexCharts(document.querySelector("#trimestre"), {
                  series: [{
                    name: 'Décaissement',
                    data: [
                        @foreach($resultat_trimestre as $total)
                            '{{ $total->decaissements }}',
                        @endforeach
                            ]
                  }, {
                    name: 'Encaissement',
                    data: [
                        @foreach($resultat_trimestre as $total)
                            '{{ $total->encaissements }}',
                        @endforeach
                            ]
                  }],
                  chart: {
                    type: 'bar',
                    height: 350
                  },
                  plotOptions: {
                    bar: {
                      horizontal: false,
                      columnWidth: '55%',
                      endingShape: 'rounded'
                    },
                  },
                  dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return  val.toLocaleString('fr-FR') + " Fcfa"
                      }
                  },
                  stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                  },
                  xaxis: {
                    categories: [
                        @foreach($resultat_trimestre as $total)
                            '{{"Timestre ".$total->trimestre."-".$total->annee }}',
                        @endforeach
                            ],
                  },
                  fill: {
                    opacity: 1
                  },
                  tooltip: {
                    y: {
                        formatter: function(val) {
                        return  val.toLocaleString('fr-FR') + " Fcfa"
                      }
                    }
                  }
                }).render();
              });
            </script>
            <!-- End Column Chart -->

          </div>
        </div>
      </div>


      <div class="col-lg-12" id="graph-mois">
        <div class="card">

            <div class="filter ps-3">

                <a class="icon float-end p-3" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filtre</h6>
                  </li>

                  <li><a class="dropdown-item" href="#" onclick="filtre('annee')">Année</a></li>
                  <li><a class="dropdown-item" href="#" onclick="filtre('trimestre')">Trimestre</a></li>
                  <li><a class="dropdown-item" href="#" onclick="filtre('mois')">Mois</a></li>
                </ul>
                <h5 class="card-title">Décaissements et encaissements par mois</h5>
            </div>

          <div class="card-body">


            <!-- Column Chart -->
            <div id="mois"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new ApexCharts(document.querySelector("#mois"), {
                  series: [{
                    name: 'Décaissement',
                    data: [
                        @foreach($resultat_mois as $total)
                            '{{ $total->decaissements }}',
                        @endforeach
                            ]
                  }, {
                    name: 'Encaissement',
                    data: [
                        @foreach($resultat_mois as $total)
                            '{{ $total->encaissements }}',
                        @endforeach
                            ]
                  }],
                  chart: {
                    type: 'bar',
                    height: 350
                  },
                  plotOptions: {
                    bar: {
                      horizontal: false,
                      columnWidth: '55%',
                      endingShape: 'rounded'
                    },
                  },
                  dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return  val.toLocaleString('fr-FR') + " Fcfa"
                      }
                  },
                  stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                  },
                  xaxis: {
                    categories: [
                        @foreach($resultat_mois as $total)
                            '{{$total->mois."-".$total->annee }}',
                        @endforeach
                            ],
                  },
                  fill: {
                    opacity: 1
                  },
                  tooltip: {
                    y: {
                        formatter: function(val) {
                        return  val.toLocaleString('fr-FR') + " Fcfa"
                      }
                    }
                  }
                }).render();
              });
            </script>
            <!-- End Column Chart -->

          </div>
        </div>
      </div>



      <div class="col-lg-12" >
        <div class="card  bg-success-subtle">
          <div class="card-body">
            <h5 class="card-title">Décaissements et encaissements par semaine</h5>

            <!-- Column Chart -->
            <div id="semaine"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new ApexCharts(document.querySelector("#semaine"), {
                  series: [{
                    name: 'Décaissement',
                    data: [
                        @foreach($resultat_semaine as $total)
                            '{{ $total->decaissements }}',
                        @endforeach
                            ]
                  }, {
                    name: 'Encaissement',
                    data: [
                        @foreach($resultat_semaine as $total)
                            '{{ $total->encaissements }}',
                        @endforeach
                            ]
                  }],
                  chart: {
                    type: 'bar',
                    height: 350
                  },
                  plotOptions: {
                    bar: {
                      horizontal: false,
                      columnWidth: '55%',
                      endingShape: 'rounded'
                    },
                  },
                  dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return  val.toLocaleString('fr-FR') + " Fcfa"
                      }
                  },
                  stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                  },
                  xaxis: {
                    categories: [
                        @foreach($resultat_semaine as $total)
                            '{{"Semaine $total->semaine"." ".$total->mois."-".$total->annee }}',
                        @endforeach
                            ],
                  },
                  fill: {
                    opacity: 1
                  },
                  tooltip: {
                    y: {
                        formatter: function(val) {
                        return  val.toLocaleString('fr-FR') + " Fcfa"
                      }
                    }
                  }
                }).render();
              });
            </script>
            <!-- End Column Chart -->

          </div>
        </div>
      </div>


      <div class="col-lg-12">
        <div class="card bg-secondary-subtle">
          <div class="card-body">
            <h5 class="card-title">Décaissements et encaissements par jour</h5>

            <!-- Column Chart -->
            <div id="jour"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new ApexCharts(document.querySelector("#jour"), {
                  series: [{
                    name: 'Décaissement',
                    data: [
                        @foreach($resultat_jour as $total)
                            '{{ $total->decaissements }}',
                        @endforeach
                            ]
                  }, {
                    name: 'Encaissement',
                    data: [
                        @foreach($resultat_jour as $total)
                            '{{ $total->encaissements }}',
                        @endforeach
                            ]
                  }],
                  chart: {
                    type: 'bar',
                    height: 600
                  },
                  plotOptions: {
                    bar: {
                      horizontal: false,
                      columnWidth: '55%',
                      endingShape: 'rounded'
                    },
                  },
                  dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return  val.toLocaleString('fr-FR') + " Fcfa"
                      },
                  },
                  stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                  },
                  xaxis: {
                    categories: [
                        @foreach($resultat_jour as $total)
                            '{{" $total->date "}}',
                        @endforeach
                            ],
                  },
                  fill: {
                    opacity: 1
                  },
                  tooltip: {
                    y: {
                        formatter: function(val) {
                        return  val.toLocaleString('fr-FR') + " Fcfa"
                      }
                    },
                  }
                }).render();
              });
            </script>
            <!-- End Column Chart -->

          </div>
        </div>
      </div>

      <script>
        function filtre(className){

            if (className == 'trimestre') {
                document.getElementById('graph-annee').style.display='none';
                document.getElementById('graph-trimestre').style.display='block';
                document.getElementById('graph-mois').style.display='none';
            }
            if (className == 'annee') {
                document.getElementById('graph-annee').style.display='block';
                document.getElementById('graph-trimestre').style.display='none';
                document.getElementById('graph-mois').style.display='none';
            }
            if (className == 'mois') {
                document.getElementById('graph-annee').style.display='none';
                document.getElementById('graph-trimestre').style.display='none';
                document.getElementById('graph-mois').style.display='block';
            }

            // if(graphe){
            //     alert(className);
            // }
            // graphe.id=className;
        }
      </script>

    </section>

@endsection

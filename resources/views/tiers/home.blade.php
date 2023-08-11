@extends('layouts.appTiers')
@section('content')

<div class="section">
    <div class="pagetitle">
        <div class="">
            <h1>Tableau de bord</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                    <li class="breadcrumb-item active">Tableau de bord des Tiers</li>
                </ol>
            </nav>
        <br><br>
        </div>

    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-sm-4">
            <div class="card">

              {{-- <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Chiffre d'affaire total</h5>



                  <div class="ps-3 text-center">
                    <h6 class="fs-4">{{number_format($caTotalClient,0,'.',' ')." ".$monaie}}</h6>

                  </div>
              </div>
            </div>
          </div> --}}



          {{-- <div class="col-sm-4">
            <div class="card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Achat total</h5>

                  <div class="ps-3 text-center">
                    <h6 class="fs-4">{{number_format($totalAcha,0,'.',' ')." ".$monaie}}</h6>

                  </div>
              </div>
            </div>
          </div> --}}




          {{-- <div class="col-sm-4">
            <div class="card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Somme total des autres tiers</h5>



                  <div class="ps-3 text-center">
                    <h6 class="fs-4">{{number_format($caTotalAutre,0,'.',' ')." ".$monaie}}</h6>

                  </div>
              </div>
            </div> --}}
          </div>


    </div>

    <div class="row">


        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Chiffre d'affaire mensuel des clients</h5>

              <div id="parMois" style="height: 400px;"></div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#parMois"), {
                        series: [{
                        name: "CA clients",
                        data: [
                            @foreach($caMensuel as $camois)
                                        '{{ $camois->ca }}',
                                    @endforeach
                        ]
                        },
                        {
                        name: "CA tiers",
                        data: [
                            @foreach($caMensuelAutre as $camois)
                                            '{{ $camois->ca }}',
                                        @endforeach
                        ]
                        },

                      ],
                        chart: {
                        // height: 350,
                        type: 'area',
                        zoom: {
                            enabled: false
                        }
                        },
                        dataLabels: {
                        enabled: false,
                        },
                        stroke: {
                        curve: 'straight'
                        },
                        grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                            opacity: 0.5
                        },
                        },
                        xaxis: {
                        categories: [
                            @foreach($caMensuel as $camois)
                                        '{{ $camois->mois."-".$camois->annee }}',
                                    @endforeach
                        ],

                        },
                        yaxis: {
                            labels: {
                                formatter: function (value) {
                                    return parseInt(value).toLocaleString('fr-FR') + "Fcfa"; // Ajoute le séparateur de milliers aux valeurs de l'axe Y
                                }
                            }
                        }
                    }).render();
                    });
                </script>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Chiffre d'affaire par client</h5>

                <!-- Polar Area Chart -->
                <div id="polarAreaChart" style="max-height: 500px;"></div>


                <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#polarAreaChart"), {
                    series: [ @foreach($caParClient as $client)
                                '{{$client->ca}}',
                            @endforeach],
                    chart: {
                      type: 'polarArea',
                    //   height: 100,
                      toolbar: {
                        show: true
                      }
                    },
                    stroke: {
                      colors: ['#fff']
                    },
                    fill: {
                      opacity: 0.8
                    },
                    labels: [
                        @foreach($caParClient as $client)
                                '{{$client->nom." ".$client->prenom." ".$client->ca."Fcfa"}}',
                            @endforeach
                                ],
                                dataLabels: {
                            formatter: function (val) {
                                return parseInt(val).toLocaleString('fr-FR') + ' Fcfa'; // Ajoute le séparateur de milliers aux valeurs du graphique
                            }
                        },
                  }).render();
                });
              </script>
                <!-- End Polar Area Chart -->

            </div>
            </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Montant recouvré et non recouvré des clients</h5>

              <!-- Doughnut Chart -->
              <div id="doughnutChart" style="max-height: 400px;"></div>


                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#doughnutChart"), {
                        series: [{{$caTotalClient, $monaie}}, {{$montantNomRecouvre}}],
                        chart: {
                        //   height: 350,
                          type: 'donut',
                          toolbar: {
                            show: true
                          }
                        },
                        labels: [
                                        'Montant recouvré {{$caTotalClient, $monaie}}',
                                        'Montant non recouvré {{$montantNomRecouvre}}'
                                      ],
                      }).render();
                    });
                  </script>
              <!-- End Doughnut CHart -->

            </div>
          </div>
        </div>





        <hr>

{{-- graphe des autres tiers --}}

        <div class="col-lg-12">
            <div class="card">
              <div class="card-body" style="background-color: #ebebe8">
                <h5 class="card-title">Chiffre d'affaire des autres tiers</h5>

                <!-- Polar Area Chart -->
                <div id="autreParMois" style="max-height: 400px;"></div>
                {{-- <script>


                    const parmois = document.getElementById('autreParMois');

                        new Chart(parmois, {
                          type: 'line',
                          data: {
                            labels: [@foreach($caMensuelAutre as $camois)
                            '{{ $camois->mois."-".$camois->annee }}',
                        @endforeach],

                            datasets: [{
                              label: 'Chiffre d\'affaire mesuel',
                              data: [@foreach($caMensuelAutre as $camois)
                            '{{ $camois->ca }}',
                        @endforeach],
                              borderWidth: 1,
                              borderColor: '#36A2EB',

                            }
                        ]
                          },
                          options: {
                            scales: {
                              y: {
                                beginAtZero: true
                              }
                            }
                          }
                        });



                  </script> --}}


                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#autreParMois"), {
                        series: [{
                        name: "Desktops",
                        data: [
                            @foreach($caMensuelAutre as $camois)
                                            '{{ $camois->ca }}',
                                        @endforeach
                        ]
                        }],
                        chart: {
                        // height: 350,
                        type: 'line',
                        zoom: {
                            enabled: false
                        }
                        },
                        dataLabels: {
                        enabled: false
                        },
                        stroke: {
                        curve: 'straight'
                        },
                        grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                            opacity: 0.5
                        },
                        },
                        xaxis: {
                        categories: [
                            @foreach($caMensuelAutre as $camois)
                                            '{{ $camois->mois."-".$camois->annee }}',
                                        @endforeach
                        ],
                        }
                    }).render();
                    });
                </script>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
              <div class="card">
              <div class="card-body" style="background-color: #ebebe8">
                  <h5 class="card-title">Chiffre d'affaire par les autres tiers</h5>

                  <!-- Polar Area Chart -->
                  <div id="parAutreTiers" style="max-height: 400px;"></div>
                  {{-- <script>
                  document.addEventListener("DOMContentLoaded", () => {
                      new Chart(document.querySelector('#parAutreTiers'), {
                      type: 'polarArea',
                      data: {
                          labels: [
                              @foreach($caParAutretiers as $autre)
                                  '{{$autre->nom." ".$autre->prenom." ".$autre->ca."Fcfa"}}',
                              @endforeach
                          ],
                          datasets: [{
                          label: 'My First Dataset',
                          data: [
                              @foreach($caParAutretiers as $autre)
                                  '{{$autre->ca}}',
                              @endforeach],
                          // backgroundColor: [
                          //     'rgb(255, 99, 132)',
                          //     'rgb(75, 192, 192)',
                          //     'rgb(255, 205, 86)',
                          //     'rgb(201, 203, 207)',
                          //     'rgb(54, 162, 235)'
                          // ]
                          }]
                      }
                      });
                  });
                  </script> --}}

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#parAutreTiers"), {
                            series: [
                                @foreach($caParAutretiers as $autre)
                                  '{{$autre->ca}}',
                                @endforeach
                            ],
                            chart: {
                            type: 'polarArea',
                            // height: 5000,
                            toolbar: {
                                show: true
                            }
                            },
                            stroke: {
                            colors: ['#fff']
                            },
                            fill: {
                            opacity: 0.8
                            },
                            labels: [
                                @foreach($caParAutretiers as $autre)
                                  '{{$autre->nom." ".$autre->prenom." ".$autre->ca."Fcfa"}}',
                              @endforeach
                                        ],
                        }).render();
                        });
                    </script>
                  <!-- End Polar Area Chart -->

              </div>
              </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body " style="background-color: #ebebe8">
                <h5 class="card-title">Montant recouvré et non recouvré des autres tiers</h5>

                <!-- Doughnut Chart -->
                <div id="monatntRecouvre" style="max-height: 400px;"></div>
                {{-- <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new Chart(document.querySelector('#monatntRecouvre'), {
                      type: 'doughnut',
                      data: {
                        labels: [
                          'Montant rembourcé {{$caTotalAutre}} Fcfa',
                          'Montant non rembourcé {{$montantNomRecouvreAutre}} Fcfa'
                        ],
                        datasets: [{
                          label: 'My First Dataset',
                          data: [{{$caTotalAutre}}, {{$montantNomRecouvreAutre}}],
                          backgroundColor: [
                            '#8ce55c',
                            '#fe0002',
                          ],
                          hoverOffset: 4
                        }]
                      }
                    });
                  });
                </script> --}}


                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#monatntRecouvre"), {
                        series: [{{$caTotalAutre}}, {{$montantNomRecouvreAutre}}],
                        chart: {
                        // height: 350,
                        type: 'donut',
                        toolbar: {
                            show: true
                        }
                        },
                        labels: [
                            'Montant rembourcé {{$caTotalAutre}} Fcfa',
                          'Montant non rembourcé {{$montantNomRecouvreAutre}} Fcfa'
                                    ],
                    }).render();
                    });
                </script>
                <!-- End Doughnut CHart -->

              </div>
            </div>
          </div>

          <hr>

          {{-- graphe des autres tiers --}}

        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Achats mensuels auprès des fournisseurs </h5>

                <!-- Polar Area Chart -->
                <div id="achatParMois" style="max-height: 400px;"></div>
                {{-- <script>


                    const achatparmois = document.getElementById('achatParMois');

                        new Chart(achatparmois, {
                          type: 'line',
                          data: {
                            labels: [@foreach($achatMensuel as $achat)
                            '{{ $achat->mois."-".$achat->annee }}',
                        @endforeach],

                            datasets: [{
                              label: 'Chiffre d\'affaire mesuel',
                              data: [@foreach($achatMensuel as $achat)
                            '{{ $achat->ca }}',
                        @endforeach],
                              borderWidth: 1,
                              borderColor: '#36A2EB',

                            }
                        ]
                          },
                          options: {
                            scales: {
                              y: {
                                beginAtZero: true
                              }
                            }
                          }
                        });



                  </script> --}}

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#achatParMois"), {
                            series: [{
                            name: "Desktops",
                            data: [
                                @foreach($achatMensuel as $achat)
                                    '{{ $achat->ca }}',
                                @endforeach
                            ]
                            }],
                            chart: {
                            // height: 350,
                            type: 'line',
                            zoom: {
                                enabled: false
                            }
                            },
                            dataLabels: {
                            enabled: false
                            },
                            stroke: {
                            curve: 'straight'
                            },
                            grid: {
                            row: {
                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                opacity: 0.5
                            },
                            },
                            xaxis: {
                            categories: [
                                @foreach($achatMensuel as $achat)
                                  '{{ $achat->mois."-".$achat->annee }}',
                                @endforeach
                            ],
                            }
                        }).render();
                        });
                    </script>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
              <div class="card">
              <div class="card-body">
                  <h5 class="card-title">Achats par fournisseur </h5>

                  <!-- Polar Area Chart -->
                  <div id="achatParFournisseur" style="max-height: 400px;"></div>
                  {{-- <script>
                  document.addEventListener("DOMContentLoaded", () => {
                      new Chart(document.querySelector('#achatParFournisseur'), {
                      type: 'polarArea',
                      data: {
                          labels: [
                              @foreach($achatParFournisseur as $fournisseur)
                                  '{{$fournisseur->nom." ".$fournisseur->prenom." ".$fournisseur->ca."Fcfa"}}',
                              @endforeach
                          ],
                          datasets: [{
                          label: 'My First Dataset',
                          data: [
                              @foreach($achatParFournisseur as $fournisseur)
                                  '{{$fournisseur->ca}}',
                              @endforeach],
                          // backgroundColor: [
                          //     'rgb(255, 99, 132)',
                          //     'rgb(75, 192, 192)',
                          //     'rgb(255, 205, 86)',
                          //     'rgb(201, 203, 207)',
                          //     'rgb(54, 162, 235)'
                          // ]
                          }]
                      }
                      });
                  });
                  </script> --}}

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#achatParFournisseur"), {
                            series: [
                                @foreach($achatParFournisseur as $fournisseur)
                                    '{{$fournisseur->ca}}',
                                @endforeach
                            ],
                            chart: {
                            type: 'polarArea',
                            // height: 5000,
                            toolbar: {
                                show: true
                            }
                            },
                            stroke: {
                            colors: ['#fff']
                            },
                            fill: {
                            opacity: 0.8
                            },
                            labels: [
                                @foreach($achatParFournisseur as $fournisseur)
                                    '{{$fournisseur->nom." ".$fournisseur->prenom." ".$fournisseur->ca."Fcfa"}}',
                                @endforeach
                                        ],
                        }).render();
                        });
                    </script>
                  <!-- End Polar Area Chart -->

              </div>
              </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body ">
                <h5 class="card-title">Montant recouvré et non recouvré des autres tiers</h5>

                <!-- Doughnut Chart -->
                <div id="montantRegle" style="max-height: 400px;"></div>
                {{-- <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new Chart(document.querySelector('#montantRegle'), {
                      type: 'doughnut',
                      data: {
                        labels: [
                          'Montant réglé {{$totalmontantRegle}} Fcfa',
                          'Montant non réglé {{$montantNonRegle}} Fcfa'
                        ],
                        datasets: [{
                          label: 'My First Dataset',
                          data: [{{$totalmontantRegle}}, {{$montantNonRegle}}],
                          backgroundColor: [
                            '#8ce55c',
                            '#fe0002',
                          ],
                          hoverOffset: 4
                        }]
                      }
                    });
                  });
                </script> --}}


                 {{-- <script>
                    document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#monatntRecouvre"), {
                        series: [{{$caTotalAutre}}, {{$montantNomRecouvreAutre}}],
                        chart: {
                        // height: 350,
                        type: 'donut',
                        toolbar: {
                            show: true
                        }
                        },
                        labels: [
                            'Montant rembourcé {{$caTotalAutre}} Fcfa',
                          'Montant non rembourcé {{$montantNomRecouvreAutre}} Fcfa'
                                    ],
                    }).render();
                    });
                </script> --}}


                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#montantRegle"), {
                        series: [{{$totalmontantRegle}}, {{$montantNonRegle}}],
                        chart: {
                            backgroundColor: [
                            '#8ce55c',
                            '#fe0002',
                          ],
                        // height: 350,
                        type: 'donut',
                        toolbar: {
                            show: true
                        }
                        },
                        labels: [
                            'Montant réglé {{$totalmontantRegle}} Fcfa',
                          'Montant non réglé {{$montantNonRegle}} Fcfa'
                                    ],
                    }).render();
                    });
                </script>
                <!-- End Doughnut CHart -->

              </div>
            </div>
          </div>



    </div>
</div>




@endsection

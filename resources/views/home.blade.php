@extends('template.master')
@section('title', 'Dashboard')
@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col">
                <div class="h-100">
                    <form action="" method="get">
                        {{-- <div class="btn btn-light border h-100 float-end"> --}}
                        <input class="form-control me-2" type="search" placeholder="Ketikkan sesuatu" aria-label="Search"
                            id="search-atlet" name="tahun" value="{{ $tahun - 1 }}" hidden>
                        <button class="btn btn-light border h-100 float-end" type="submit">
                            < </button>
                                {{-- </div> --}}
                    </form>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        {{ $tahun }} ~ {{ $tahun + 1 }}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="h-100">
                    <form action="" method="get">
                        {{-- <div class="btn btn-light border h-100 float-end"> --}}
                        <input class="form-control me-2" type="search" placeholder="Ketikkan sesuatu" aria-label="Search"
                            id="search-atlet" name="tahun" value="{{ $tahun + 1 }}" hidden @if ($tahun + 1 > Helper::thisYear()) disabled @endif>
                        <button class="btn btn-light border h-100 float-start" type="submit" @if ($tahun + 1 > Helper::thisYear()) disabled @endif>
                            > </button>
                        {{-- </div> --}}
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="card shadow-sm border">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">BANYAK ATLET</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="d-flex flex-column">
                                    </p>
                                </div>
                                <div class="position-relative mb-4">
                                    <canvas this-year="" this-month="" id="atletPerCabor-chart" height="400" width="100%"
                                        class="chartjs-render-monitor"
                                        style="display: block; width: 249px; height: 200px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @forelse ($cabors as $cabor)
                <div class="col-lg-4">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="card shadow-sm border">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <p class="card-title">{{ $cabor->nama }}</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table>
                                        <tbody>
                                            @forelse ($cabor->pertandinganPada(Helper::ymD($tahun), Helper::ymD($tahun,true)) as $pertandingan)
                                                <tr>
                                                    <td>
                                                        <a
                                                            href="{{ route('pertandingan.show', ['pertandingan' => $pertandingan]) }}">
                                                            {{ $pertandingan->nama }} ({{ $pertandingan->hasil }})
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                -
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {{-- <div class="d-flex justify-content-between">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">Belum</span>
                                </p>
                            </div> --}}
                                    {{-- <div class="position-relative mb-4"> --}}
                                    {{-- <canvas this-year="" this-month="" id="cabors-chart-{{ $cabor->id }}"
                                            height="400" width="100%" class="chartjs-render-monitor"
                                            style="display: block; width: 249px; height: 200px;"></canvas> --}}
                                    {{-- </div> --}}
                                    {{-- <div class="d-flex flex-row justify-content-between">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> Laki-laki
                                </span>
                                <span>
                                    <i class="fas fa-square text-gray"></i> Perempuan
                                </span>
                            </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty

            @endforelse

        </div>
    </div>
    {{-- @forelse ($cabors as $cabor)
        <script>
            $(function() {
                var charts = {
                    init: function() {
                        this.ajaxGetDialyGuestPerMonthData();
                    },

                    ajaxGetDialyGuestPerMonthData: function() {
                        var urlPath = 'pertandingan-per-bulan/' + {{ $cabor->id }};
                        var request = $.ajax({
                            method: 'GET',
                            url: urlPath
                        });

                        request.done(function(response) {
                            console.log(response);
                            charts.createGuestsChart(response);
                        });
                    },

                    createGuestsChart: function(response) {
                        var ticksStyle = {
                            fontColor: '#495057',
                            fontStyle: 'bold'
                        }

                        var mode = 'index'
                        var intersect = true

                        var atletPerCaborChart = $('#cabors-chart-' + {{ $cabor->id }})
                        // var this_year = $('#cabors-chart-'+{{ $cabor->id }}).attr('this-year')
                        // var this_month = $('#cabors-chart-'+{{ $cabor->id }}).attr('this-month')
                        var atletPerCaborChart = $('#cabors-chart-' + {{ $cabor->id }})
                        var myVisitorChart = new Chart(atletPerCaborChart, {
                            data: {
                                labels: response.bulan,
                                datasets: [{
                                    type: 'line',
                                    data: response.banyak,
                                    backgroundColor: 'blue',
                                    borderColor: '#007bff',
                                    pointBorderColor: '#007bff',
                                    pointBackgroundColor: '#007bff',
                                    fill: false
                                }, ]
                            },
                            options: {
                                maintainAspectRatio: false,
                                tooltips: {
                                    mode: mode,
                                    intersect: intersect
                                },
                                hover: {
                                    mode: mode,
                                    intersect: intersect,
                                    onHover: function(e) {
                                        var point = this.getElementAtEvent(e);
                                        if (point.length) e.target.style.cursor = 'pointer';
                                        else e.target.style.cursor = 'default';
                                    }
                                },
                                legend: {
                                    display: false,
                                },
                                scales: {
                                    yAxes: [{
                                        display: true,
                                        gridLines: {
                                            display: true,
                                            lineWidth: '4px',
                                            color: 'rgba(0, 0, 0, .2)',
                                            zeroLineColor: 'transparent'
                                        },
                                        ticks: $.extend({
                                            beginAtZero: true,
                                            suggestedMax: response.max
                                        }, ticksStyle)
                                    }],
                                    xAxes: [{
                                        display: true,
                                        gridLines: {
                                            display: true
                                        },
                                        ticks: ticksStyle
                                    }]
                                }
                            }
                        })

                        var atletPerCaborChart = document.getElementById("atletPerCabor-chart");
                        atletPerCaborChart.onclick = function(e) {
                            var slice = myVisitorChart.getElementAtEvent(e)
                            window.location.href = ('/chart/' + slice[0]._index)

                        }

                    }
                }

                charts.init();
            })

        </script>
        @empty

        @endforelse --}}

@endsection

@section('footer')
    <script src="{{ asset('style/js/jquery.js') }}"></script>
    <script src="{{ asset('style/js/chart.min.js') }}"></script>
    <script>
        $(function() {
            var charts = {
                init: function() {
                    this.ajaxGetDialyGuestPerMonthData();
                },

                ajaxGetDialyGuestPerMonthData: function() {
                    var urlPath = '/total-atlet-cabor?tahun={{ $tahun }}';
                    var request = $.ajax({
                        method: 'GET',
                        url: urlPath
                    });

                    request.done(function(response) {
                        console.log(response);
                        charts.createGuestsChart(response);
                    });
                },

                createGuestsChart: function(response) {
                    var ticksStyle = {
                        fontColor: '#495057',
                        fontStyle: 'bold'
                    }

                    var mode = 'index'
                    var intersect = true

                    var atletPerCaborChart = $('#atletPerCabor-chart')
                    var this_year = $('#atletPerCabor-chart').attr('this-year')
                    var this_month = $('#atletPerCabor-chart').attr('this-month')
                    var atletPerCaborChart = $('#atletPerCabor-chart')
                    var myVisitorChart = new Chart(atletPerCaborChart, {
                        data: {
                            labels: response.jenis_kelamin,
                            datasets: [{
                                type: 'bar',
                                data: response.banyak,
                                backgroundColor: 'blue',
                                borderColor: '#007bff',
                                pointBorderColor: '#007bff',
                                pointBackgroundColor: '#007bff',
                                fill: false
                            }, ]
                        },
                        options: {
                            maintainAspectRatio: false,
                            tooltips: {
                                mode: mode,
                                intersect: intersect
                            },
                            hover: {
                                mode: mode,
                                intersect: intersect,
                                onHover: function(e) {
                                    var point = this.getElementAtEvent(e);
                                    if (point.length) e.target.style.cursor = 'pointer';
                                    else e.target.style.cursor = 'default';
                                }
                            },
                            legend: {
                                display: false,
                            },
                            scales: {
                                yAxes: [{
                                    display: true,
                                    gridLines: {
                                        display: true,
                                        lineWidth: '4px',
                                        color: 'rgba(0, 0, 0, .2)',
                                        zeroLineColor: 'transparent'
                                    },
                                    ticks: $.extend({
                                        beginAtZero: true,
                                        suggestedMax: response.max
                                    }, ticksStyle)
                                }],
                                xAxes: [{
                                    display: true,
                                    gridLines: {
                                        display: true
                                    },
                                    ticks: ticksStyle
                                }]
                            }
                        }
                    })

                    var atletPerCaborChart = document.getElementById("atletPerCabor-chart");
                    atletPerCaborChart.onclick = function(e) {
                        var slice = myVisitorChart.getElementAtEvent(e)
                        // var url = '/chart/' + slice[0]._index + '?dari=' + {{ Helper::ymD() }} +
                        //     '&sampai=' + {{ Helper::ymD(true) }}
                        window.location.href = ('/chart/' + slice[0]._index +
                            '?tahun={{ $tahun }}')

                    }

                }
            }

            charts.init();
        })

    </script>
    {{-- <script src="{{ asset('style/js/guestsChart.js') }}"></script> --}}
@endsection

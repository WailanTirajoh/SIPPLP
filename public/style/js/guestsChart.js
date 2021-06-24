$(function() {
    var charts = {
        init: function() {
            this.ajaxGetDialyGuestPerMonthData();
        },

        ajaxGetDialyGuestPerMonthData: function() {
            var urlPath = '/total-atlet-cabor';
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
                window.location.href = ('/chart/' + slice[0]._index)

            }

        }
    }

    charts.init();
})
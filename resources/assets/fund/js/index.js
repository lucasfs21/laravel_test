var startDate = moment().format('YYYY-MM-DD')
var endDate = moment().add(7, 'd').format('YYYY-MM-DD')

var initDateRangePicker = (function () {

    function init() {
        $('#date').daterangepicker({
            startDate: moment(),
            endDate: moment().add(7, 'd'),
            "maxSpan": {
                "days": 7
            },
            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "applyLabel": "Confirmar",
                "cancelLabel": "Cancelar",
                "fromLabel": "De",
                "toLabel": "Até",
                "customRangeLabel": "Personalizado",
                "weekLabel": "S",
                "daysOfWeek": [
                    "Dom",
                    "Seg",
                    "Ter",
                    "Qua",
                    "Qui",
                    "Sex",
                    "Sáb"
                ],
                "monthNames": [
                    "Janeiro",
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agosto",
                    "Setembro",
                    "Outubro",
                    "Novembro",
                    "Dezembro"
                ],
                "firstDay": 1
            },
        });
    }

    return {
        init: init
    };
})();

var dateEventListener = (function () {
    function setStartDate(date) {
        startDate = setDate(date)
    }

    function setEndDate(date) {
        endDate = setDate(date)
    }

    function eventListener() {
        $('#date').on('change', function () {
            let date = this.value
            date = date.replaceAll(' ', '')
            date = date.split('-')
            setStartDate(date[0])
            setEndDate(date[1])
            getPatrimonies()
        })
    }

    return {
        init: eventListener
    }
})();

function setDate(date) {
    let formattedDate = date.split('/');
    formattedDate = `${formattedDate[2]}-${formattedDate[1]}-${formattedDate[0]}`
    return formattedDate
}

function getPatrimonies() {
    $.ajax({
        url: searchForFundAssets,
        type: 'post',
        timeout: 3000,
        data: {startDate: startDate, endDate: endDate, "_token": token},
        dataType: 'json',
        success: function (e) {
            if (e.success)
                updateChart(e.data)
            else
                alert(e.message)
        },
        error: function (e) {
            alert('Falha ao tentar recuperar dados')
        }
    });
}

function updateChart(data) {
    Highcharts.chart('chart', {

        title: {
            text: 'Valor total por patrimônio'
        },

        yAxis: {
            title: {
                text: 'Valor do patrimônio'
            }
        },

        xAxis: {
            labels: {
                formatter: function () {
                    return `${this.axis.defaultLabelFormatter.call(this)}/${startDate.split('-')[1]}`
                }
            },
            tickInterval: 1,
            title: {
                text: '<b>Dia</b>'
            }
        },

        legend: {
            enable: false
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                pointStart: Number(startDate.split('-')[2])
            }
        },

        credits: {
            enabled: false
        },

        tooltip: {
            formatter: function () {
                return `${this.x}/${startDate.split('-')[1]}<br><b>`+ new Intl.NumberFormat('pt-BR', {style: 'currency', currency: 'BRL'}).format(this.y)+ '</b>'
            }
        },

        series: data,

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
}

$(document).ready(function () {
    initDateRangePicker.init()
    dateEventListener.init()
    getPatrimonies()
    $('#patrimonyTable').DataTable();

    $('body').on('click', '.delete', function () {
        let id = $(this).data('id')

        if (confirm(`Realmente deseja excluir este patrimônio (#${id})?`)) {
            $.ajax({
                url: urlDelete,
                type: 'delete',
                timeout: 3000,
                data: {id: id, "_token": token},
                dataType: 'json',
                success: function (e) {
                    if (e.success) {
                        alert(e.message)
                        location.href = urlIndex
                    } else
                        alert(e.message)
                },
                error: function (e) {
                    alert('Falha ao tentar deletar patrimônio')
                }
            });
        }
    })

})



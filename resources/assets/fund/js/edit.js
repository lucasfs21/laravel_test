var date
function checkFields() {
    if ($('#date').val() == '' || $('#fund').val() == '' || $('#value').val() == '') {
        alert('Please fill in all fields')
        return false
    }
    return true
}

function sendData() {
    $.ajax({
        url: urlSendData,
        type: 'post',
        timeout: 3000,
        data: {id: $('#id').val(), date: date, fund_id: $('#fund').val(), value: $('#value').val(), "_token": token},
        dataType: 'json',
        success: function (e) {
            if (e.success) {
                alert(e.message)
                window.location.href = urlIndex
            }
            else
                alert(e.message)
        },
        error: function (e) {
            alert('Falha ao atualizar patrimônio')
        }
    });
}

function updatePatrimony() {
    let validFields = checkFields()
    if (validFields) sendData()
}

function getDate() {
    let dateAux = $('#date').val()
    dateAux = dateAux.split('/')
    date = `${dateAux[2]}-${dateAux[1]}-${dateAux[0]}`
}

$(document).ready(function () {
    $('#submitButton').on('click', function () {
        updatePatrimony()
    })

    $('#date').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format('YYYY'),10),
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

    getDate()

    $('#date').on('change', function () {
        getDate()
    })
})

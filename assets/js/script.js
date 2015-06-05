function isInputNumeric(field) {
    var rx = /[^0-9\-]/i;
    if(rx.test(field.value)) {
        alert('This field allows numbers only.');
        field.value = '';
        field.focus = '';
    }
}

function renderMap() {
    initializeMap(0, 0);
    addMarker();
}

$(document).ready(function() {
    $('#track-form').submit(function() {
        $.ajax({
            url: 'requests/track_delivery.php',
            method: 'GET',
            data: $(this).serialize() + '&currency=peso',
            success: function(response) {
                $('#modal').modal({
                    backdrop: 'static'
                });
                $('#modal .modal-title').html('Delivery Information');
                $('#modal .modal-body').html(response);

                $('.change-currency').click(function() {
                    var currency;
                    var dataCurrency = $(this).attr('data-currency');
                    var trackID = $(this).attr('data-waybill');

                    if(dataCurrency == 'peso') {
                        currency = 'peso';
                    } else if(dataCurrency == 'dollar') {
                        currency = 'dollar';
                    }

                    $('#modal').modal('hide');

                    setTimeout(function() {
                        $.ajax({
                            url: 'requests/track_delivery.php',
                            method: 'GET',
                            data: {
                                track: trackID,
                                currency: currency
                            },
                            success: function(response) {
                                $('#modal').modal({
                                    backdrop: 'static'
                                });
                                $('#modal .modal-title').html('Delivery Information');
                                $('#modal .modal-body').html(response);

                                if(response == 'Please enter your waybill number first.' || response == 'Transaction not found. Please check your waybill number and try again.') {
                                    setTimeout(function() {
                                        $('#modal').modal('hide');
                                    }, 2000);
                                }
                            }
                        });

                        return false;
                    }, 1500);
                });

                if(response == 'Please enter your waybill number first.' || response == 'Transaction not found. Please check your waybill number and try again.') {
                    setTimeout(function() {
                        $('#modal').modal('hide');
                    }, 2000);
                }
            }
        });

        return false;
    });
});
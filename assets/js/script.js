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

function showLoader(id) {
    var dialogBody = $('#' + id + '.modal-body');

    dialogBody.html('<div class="text-center"><img src="assets/img/loader.png" class="loader"></div>');

    $('.loader').css({
        'height': '50px;',
        'width': '50px',
        'animation': '1s infispin infinite linear'
    });
}

$(document).ready(function() {
    $('#track-form').submit(function() {
        showLoader('modal');
        $('#modal').modal({
            backdrop: 'static'
        });

        $.ajax({
            url: 'requests/track_delivery.php',
            method: 'GET',
            data: $(this).serialize() + '&currency=peso',
            success: function(response) {
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
                        showLoader('#modal');
                        $('#modal').modal({
                            backdrop: 'static'
                        });
                    
                        $.ajax({
                            url: 'requests/track_delivery.php',
                            method: 'GET',
                            data: {
                                track: trackID,
                                currency: currency
                            },
                            success: function(response) {
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

    $(document).on('click', '.copy-to-clipboard', function() {
        if(!$('body').find('.notif-container').length) {
            $('body').append('<div class="notif-container"></div>');
        }

        $('.notif-container').append('<div class="notif-block shadow">Copied to clipboard: ' + $(this).text() + '</div>');

        $('.notif-block').delay(2000).fadeOut(1000, function() {
            $(this).remove();
        });
    });
});
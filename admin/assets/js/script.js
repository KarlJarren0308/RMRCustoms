function fillTable($file, $search) {
    $.ajax({
        url: 'requests/' + $file,
        method: 'GET',
        data: {
            search: $search
        },
        success: function(response) {
            $('#listing tbody').html('').html(response);

            $('[data-execute]').click(function() {
                var arr;
                var dataExecute = $(this).attr('data-execute');
                var dataVar = $(this).attr('data-var');

                if(dataExecute == 'View Client Info') {
                    var dVar;

                    arr = 'View;' + dataVar;
                    dVar = arr.split(';');

                    showLoader('modal');
                    $('#modal').modal({
                        backdrop: 'static'
                    });

                    $.ajax({
                        url: 'requests/modify_client.php',
                        method: 'POST',
                        data: {
                            action: dVar[0],
                            clientId: dVar[1],
                            firstName: dVar[2],
                            middleName: dVar[3],
                            lastName: dVar[4]
                        },
                        success: function(response) {
                            $('#modal .modal-title').html('<h3 class="no-margin">Client Information</h3>');
                            $('#modal .modal-body').html(response);
                        }
                    });

                    return false;
                } else if(dataExecute == 'View Cheques') {
                    showLoader('modal');
                    $('#modal').modal({
                        backdrop: 'static'
                    });

                    $.ajax({
                        url: 'requests/view_cheques.php',
                        method: 'POST',
                        data: {
                            id: dataVar
                        },
                        success: function(response) {
                            $('#modal .modal-title').html('<h3 class="no-margin">View Cheques</h3>');
                            $('#modal .modal-body').html(response);
                        }
                    });

                    return false;
                } else if(dataExecute == 'Edit Client Info') {
                    var dVar;

                    arr = 'Edit;' + dataVar;
                    dVar = arr.split(';');

                    showLoader('modal');
                    $('#modal').modal({
                        backdrop: 'static'
                    });

                    $.ajax({
                        url: 'requests/modify_client.php',
                        method: 'POST',
                        data: {
                            action: dVar[0],
                            clientId: dVar[1],
                            firstName: dVar[2],
                            middleName: dVar[3],
                            lastName: dVar[4]
                        },
                        success: function(response) {
                            $('#modal .modal-title').html('<h3 class="no-margin">Edit Client Information</h3>');
                            $('#modal .modal-body').html(response);

                            $('[data-prompt]').click(function() {
                                $('#modal').modal('hide');

                                showLoader('notif');
                                $('#notif').modal({
                                    backdrop: 'static'
                                });
                                $('#notif .modal-title').html('<h3 class="no-margin">Edit Client Information</h3>');

                                $.ajax({
                                    url: 'requests/modify_client.php',
                                    method: 'POST',
                                    data: {
                                        action: 'Save',
                                        clientId: dVar[1],
                                        firstName: $('#edit-client-firstname').val(),
                                        middleName: $('#edit-client-middlename').val(),
                                        lastName: $('#edit-client-lastname').val(),
                                        address: $('#edit-client-address').val(),
                                        emailAddress: $('#edit-client-email-address').val(),
                                        companyName: $('#edit-company-name').val(),
                                        companyAddress: $('#edit-company-address').val(),
                                        companyContactNumber: $('#edit-company-contact-number').val(),
                                        companyEmailAddress: $('#edit-company-email-address').val(),
                                        zipCode: $('#edit-zip-code').val(),
                                        primaryContact: $('#edit-primary-contact').val(),
                                        primaryContactCompanyPosition: $('#edit-primary-contact-company-position').val(),
                                        primaryContactEmail: $('#edit-primary-contact-email').val(),
                                        primaryContactPhoneNumber: $('#edit-primary-contact-phone-number').val(),
                                        mainBusinessActivities: $('#edit-main-business-activities').val(),
                                        country: $('#edit-country').val(),
                                        defaultTimeZone: $('#edit-default-time-zone').val(),
                                        fax: $('#edit-fax').val(),
                                        phoneNumber: $('#edit-phonenumber').val(),
                                        established: $('#edit-established').val(),
                                        companyId: dVar[5]
                                    },
                                    success: function(response) {
                                        $('#notif .modal-body').html(response);

                                        setTimeout(function() {
                                            $('#notif').modal('hide');

                                            location.reload();
                                        }, 2000);
                                    }
                                });

                                return false;
                            });
                        }
                    });

                    return false;
                } else if(dataExecute == 'Delete Client Info') {
                    $('#prompt').modal({
                        backdrop: 'static'
                    });
                    $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                    $('#prompt .modal-body').html('Are you sure you want to delete this client?');
                    $('#prompt .modal-footer').html('<button class="btn btn-danger" data-prompt="Yes">Yes</button>&nbsp;<button class="btn btn-default" data-prompt="No">No</button>');

                    $('[data-prompt]').click(function() {
                        if($(this).attr('data-prompt') == 'Yes') {
                            var dVar;

                            arr = 'Delete;' + dataVar;
                            dVar = arr.split(';');

                            setTimeout(function() {
                                showLoader('prompt');
                                $('#prompt').modal({
                                    backdrop: 'static'
                                });

                                $.ajax({
                                    url: 'requests/modify_client.php',
                                    method: 'POST',
                                    data: {
                                        action: dVar[0],
                                        clientId: dVar[1],
                                        firstName: dVar[2],
                                        middleName: dVar[3],
                                        lastName: dVar[4]
                                    },
                                    success: function(response) {
                                        $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                                        $('#prompt .modal-body').html(response);
                                        $('#prompt .modal-footer').html('');

                                        setTimeout(function() {
                                            $('#prompt').modal('hide');
                                            location.reload();
                                        }, 2000);
                                    }
                                });

                                return false;
                            }, 1000);
                        }

                        $('#prompt').modal('hide');
                    });
                } else if(dataExecute == 'View Transaction Info') {
                    var dVar;

                    arr = 'View;' + dataVar;
                    dVar = arr.split(';');

                    showLoader('modal');
                    $('#modal').modal({
                        backdrop: 'static'
                    });
                    $('#modal .modal-title').html('<h3 class="no-margin">Transaction Information</h3>');

                    $.ajax({
                        url: 'requests/modify_transactions.php',
                        method: 'POST',
                        data: {
                            action: dVar[0],
                            waybillNumber: dVar[1]
                        },
                        success: function(response) {
                            //$itemRow = 0;
                            $chequeCount = 0;

                            $('#modal .modal-body').css({
                                'overflow-y': 'scroll',
                                'max-height': ($(window).height() / 4) * 3
                            }).html(response);

                            $chequeCount = parseInt($('#add-new-cheque-button').attr('data-cheque-count'));

                            $('#add-new-cheque-button').click(function() {
                                $('#cheque-table tbody').append('<tr><td><textarea name="cChequeNumber-' + $chequeCount + '" class="form-control" required></textarea></td><td><textarea name="cBankName-' + $chequeCount + '" class="form-control" required></textarea></td><td><textarea name="cChecqueDate-' + $chequeCount + '" class="form-control" required></textarea></td></tr>');
                                $('#cheque-table-error').remove('');

                                $chequeCount += 1;
                            });

                            $('#cheque-form').submit(function() {
                                $.ajax({
                                    url: 'requests/modify_cheque.php',
                                    method: 'POST',
                                    data: $(this).serialize() + '&waybillNumber=' + dVar[1],
                                    success: function(response) {
                                        $('#modal').modal('hide');

                                        showLoader('prompt');
                                        $('#prompt').modal({
                                            backdrop: 'static'
                                        });
                                        $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                                        $('#prompt .modal-body').html(response);

                                        setTimeout(function() {
                                            $('#prompt').modal('hide');

                                            location.reload();
                                        }, 2000);
                                    }
                                });

                                return false;
                            });
                        }
                    });

                    return false;
                } else if(dataExecute == 'Hide Transaction') {
                    var dVar;

                    arr = 'Hide;' + dataVar;
                    dVar = arr.split(';');

                    showLoader('notif');
                    $('#notif').modal({
                        backdrop: 'static'
                    });
                    $('#notif .modal-title').html('<h3 class="no-margin">Hide Transaction to Client</h3>');

                    $.ajax({
                        url: 'requests/modify_transactions.php',
                        method: 'POST',
                        data: {
                            action: dVar[0],
                            waybillNumber: dVar[1]
                        },
                        success: function(response) {
                            $('#notif .modal-body').html(response);

                            setTimeout(function() {
                                $('#notif').modal('hide');
                                $('#notif .modal-title').html('');
                                $('#notif .modal-body').html('');

                                location.reload();
                            }, 2000);
                        }
                    });

                    return false;
                } else if(dataExecute == 'Show Transaction') {
                    var dVar;

                    arr = 'Show;' + dataVar;
                    dVar = arr.split(';');

                    showLoader('notif');
                    $('#notif').modal({
                        backdrop: 'static'
                    });
                    $('#notif .modal-title').html('<h3 class="no-margin">Show Transaction to Client</h3>');

                    $.ajax({
                        url: 'requests/modify_transactions.php',
                        method: 'POST',
                        data: {
                            action: dVar[0],
                            waybillNumber: dVar[1]
                        },
                        success: function(response) {
                            $('#notif .modal-body').html(response);

                            setTimeout(function() {
                                $('#notif').modal('hide');
                                $('#notif .modal-title').html('');
                                $('#notif .modal-body').html('');

                                location.reload();
                            }, 2000);
                        }
                    });

                    return false;
                } else if(dataExecute == 'Set Payment') {
                    var dVar;

                    arr = 'View Payment;' + dataVar;
                    dVar = arr.split(';');

                    showLoader('modal');
                    $('#modal').modal({
                        backdrop: 'static'
                    });
                    $('#modal .modal-title').html('<h3 class="no-margin">Payment</h3>');
                    
                    $.ajax({
                        url: 'requests/modify_transactions.php',
                        method: 'POST',
                        data: {
                            action: dVar[0],
                            waybillNumber: dVar[1]
                        },
                        success: function(response) {
                            $('#modal .modal-body').html(response);

                            $('#set-payment-button').addClass('disabled').attr('disabled', '');
                            $('#set-new-payment-button').addClass('disabled').attr('disabled', '');

                            $('#transaction-payment-locker-button').click(function() {
                                if($('#transaction-payment').val() == '' || $('#transaction-payment').val() < 0) {
                                    // Update Block (Optional)
                                    alert('Your input is invalid. Please enter a number greater than 0.');
                                    $('#transaction-payment').val('').focus();
                                } else {
                                    if($('#transaction-payment').val() > 0) {
                                        $(this).addClass('disabled').attr('disabled', '');
                                        $('#transaction-payment').attr('readonly', '');

                                        $('#set-payment-button').removeClass('disabled').removeAttr('disabled');
                                    } else {
                                        // Update Block (Optional)
                                        alert('Setting payment to 0 is not allowed.\n\nPlease enter a number greater than 0.');
                                    }
                                }
                            });

                            $('#transaction-credit-locker-button').click(function() {
                                if($('#transaction-credit').val() == '' || $('#transaction-credit').val() < 0) {
                                    if($('#cheque-number').val() != '' || $('#bank-name').val() != '') {
                                        // Update Block (Optional)
                                        alert('Your input is invalid. Please enter a number greater than 0.');
                                        $('#transaction-credit').val('').focus();
                                    } else {
                                        // Update Block (Optional)
                                        alert('Your input is invalid. Please enter a number greater than or equal to 0.');
                                        $('#transaction-credit').val('').focus();
                                    }
                                } else {
                                    if($('#cheque-number').val() != '' || $('#bank-name').val() != '') {
                                        if($('#transaction-credit').val() > 0) {
                                            $(this).addClass('disabled').attr('disabled', '');
                                            $('#transaction-credit').attr('readonly', '');

                                            if($('#transaction-debit').attr('readonly')) {
                                                $('#set-new-payment-button').removeClass('disabled').removeAttr('disabled');
                                            }
                                        } else {
                                            // Update Block (Optional)
                                            alert('Setting credit to 0 is not allowed when a cheque information has been provided.\n\nPlease remove all cheque information fields before setting credit to 0.');
                                        }
                                    } else {
                                        $(this).addClass('disabled').attr('disabled', '');
                                        $('#transaction-credit').attr('readonly', '');

                                        if($('#transaction-debit').attr('readonly')) {
                                            $('#set-new-payment-button').removeClass('disabled').removeAttr('disabled');
                                        }
                                    }
                                }
                            });

                            $('#transaction-debit-locker-button').click(function() {
                                if($('#transaction-debit').val() == '' || $('#transaction-debit').val() < 0) {
                                    // Update Block (Optional)
                                    alert('Your input is invalid. Please enter a number greater than or equal to 0.');
                                    $('#transaction-debit').val('').focus();
                                } else {
                                    $(this).addClass('disabled').attr('disabled', '');
                                    $('#transaction-debit').attr('readonly', '');

                                    if($('#transaction-credit').attr('readonly')) {
                                        $('#set-new-payment-button').removeClass('disabled').removeAttr('disabled');
                                    }
                                }
                            });

                            $('#transaction-credit').keydown(function() {
                                $('#transaction-credit-locker-button').addClass('disabled').attr('disabled', '');
                            });

                            $('#transaction-credit').keyup(function() {
                                $value = $(this).val();
                                $max = $(this).attr('max');
                                $notification = false;
                                
                                $('#transaction-credit-locker-button').removeClass('disabled').removeAttr('disabled');

                                if($value != '') {
                                    $.ajax({
                                        url: 'requests/modify_transactions.php',
                                        method: 'POST',
                                        data: {
                                            action: 'Check Input',
                                            checker: 'isInRange',
                                            min: 0,
                                            max: $max,
                                            input: $value
                                        },
                                        success: function(response) {
                                            if(response == 'Higher') {
                                                showLoader('notif');
                                                $('#notif').modal({
                                                    backdrop: 'static'
                                                });
                                                $('#notif .modal-title').html('<h3 class="no-margin">Warning</h3>');
                                                $('#notif .modal-body').html('Please enter an amount between 0 and 999,999,999,999.<br><br>Setting Transaction Credit back to 0.');

                                                setTimeout(function() {
                                                    $('#notif').modal('hide');
                                                    $('#notif .modal-title').html('');
                                                    $('#notif .modal-body').html('');
                                                }, 2500);

                                                $('#transaction-credit').val(0);
                                            } else if(response == 'Lower') {
                                                $('#transaction-credit').val(0);
                                            }

                                            $('#transaction-credit').focus();
                                        }
                                    });

                                    return false;
                                } else {
                                    $(this).val(0);
                                    $(this).focus();
                                }
                            });

                            $('#transaction-debit').keydown(function() {
                                $('#transaction-debit-locker-button').addClass('disabled').attr('disabled', '');
                            });

                            $('#transaction-debit').keyup(function() {
                                $value = $(this).val();
                                $max = $(this).attr('max');
                                $dataMax = $(this).attr('data-max');
                                $notification = false;
                                
                                $('#transaction-debit-locker-button').removeClass('disabled').removeAttr('disabled');

                                if($value != '') {
                                    $.ajax({
                                        url: 'requests/modify_transactions.php',
                                        method: 'POST',
                                        data: {
                                            action: 'Check Input',
                                            checker: 'isInRange',
                                            min: 0,
                                            max: $max,
                                            input: $value
                                        },
                                        success: function(response) {
                                            if(response == 'Higher') {
                                                showLoader('notif');
                                                $('#notif').modal({
                                                    backdrop: 'static'
                                                });
                                                $('#notif .modal-title').html('<h3 class="no-margin">Warning</h3>');
                                                $('#notif .modal-body').html('This client/company has already reached the 800k limit. He won\'t be able to have a new transaction temporarily until previous balances has been settled.<br><br>Setting Transaction Debit back to 0.');

                                                setTimeout(function() {
                                                    $('#notif').modal('hide');
                                                    $('#notif .modal-title').html('');
                                                    $('#notif .modal-body').html('');
                                                }, 2500);

                                                $('#transaction-debit').val(0);
                                            } else if(response == 'Lower') {
                                                $('#transaction-debit').val(0);
                                            }

                                            $('#transaction-debit').focus();
                                        }
                                    });

                                    return false;
                                } else {
                                    $(this).val(0);
                                    $(this).focus();
                                }
                            });

                            $('#transaction-debit').change(function() {
                                $value = $(this).val();
                                $max = $(this).attr('max');
                                $dataMax = $(this).attr('data-max');
                                
                                if($value != '') {
                                    $.ajax({
                                        url: 'requests/modify_transactions.php',
                                        method: 'POST',
                                        data: {
                                            action: 'Check Input',
                                            checker: 'isInRange',
                                            min: 0,
                                            max: $dataMax,
                                            input: $value
                                        },
                                        success: function(response) {
                                            if(response == 'Higher') {
                                                showLoader('notif');
                                                $('#notif').modal({
                                                    backdrop: 'static'
                                                });
                                                $('#notif .modal-title').html('<h3 class="no-margin">Warning</h3>');
                                                $('#notif .modal-body').html('This client/company has already reached the 800k limit. He won\'t be able to have a new transaction temporarily until previous balances has been settled.<br><br>Setting Transaction Debit back to 0.');

                                                setTimeout(function() {
                                                    $('#notif').modal('hide');
                                                    $('#notif .modal-title').html('');
                                                    $('#notif .modal-body').html('');
                                                }, 2500);
                                            } else if(response == 'Lower') {
                                                $('#transaction-debit').val(0);
                                            }

                                            $('#transaction-debit').focus();
                                        }
                                    });

                                    return false;
                                } else {
                                    $(this).val(0);
                                    $(this).focus();
                                }
                            });

                            $('#transaction-payment').keydown(function() {
                                $('#transaction-payment-locker-button').addClass('disabled').attr('disabled', '');
                            });

                            $('#transaction-payment').keyup(function() {
                                $value = $(this).val();
                                $max = $('#transaction-debit').text();
                                
                                $('#transaction-payment-locker-button').removeClass('disabled').removeAttr('disabled');

                                if($value != '') {
                                    $.ajax({
                                        url: 'requests/modify_transactions.php',
                                        method: 'POST',
                                        data: {
                                            action: 'Check Input',
                                            checker: 'isInRange',
                                            min: 0,
                                            max: $max,
                                            input: $value
                                        },
                                        success: function(response) {
                                            if(response == 'Higher') {
                                                $('#transaction-payment').val($max);
                                            } else if(response == 'Lower') {
                                                $('#transaction-payment').val(0);
                                            }

                                            $('#transaction-payment').focus();
                                        }
                                    });

                                    return false;
                                } else {
                                    $(this).val(0);
                                    $(this).focus();
                                }
                            });

                            $('#set-new-payment-button').click(function() {
                                $('#modal').modal('hide');

                                showLoader('prompt');
                                $('#prompt').modal({
                                    backdrop: 'static'
                                });
                                $.ajax({
                                    url: 'requests/modify_transactions.php',
                                    method: 'POST',
                                    data: {
                                        action: 'Set New Payment',
                                        waybillNumber: dVar[1],
                                        credit: $('#transaction-credit').val(),
                                        debit: $('#transaction-debit').val(),
                                        chequeNumber: $('#cheque-number').val(),
                                        bankName: $('#bank-name').val(),
                                        chequeMonth: $('#cheque-month').val(),
                                        chequeDay: $('#cheque-day').val(),
                                        chequeYear: $('#cheque-year').val()
                                    },
                                    success: function(response) {
                                        $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                                        $('#prompt .modal-body').html(response);
                                        $('#prompt .modal-footer').html('');

                                        setTimeout(function() {
                                            $('#prompt').modal('hide');

                                            location.reload();
                                        }, 2000);
                                    }
                                });

                                return false;
                            });

                            $('#set-payment-button').click(function() {
                                $('#modal').modal('hide');

                                showLoader('prompt');
                                $('#prompt').modal({
                                    backdrop: 'static'
                                });

                                $.ajax({
                                    url: 'requests/modify_transactions.php',
                                    method: 'POST',
                                    data: {
                                        action: 'Set Payment',
                                        waybillNumber: dVar[1],
                                        payment: $('#transaction-payment').val(),
                                        chequeNumber: $('#cheque-number').val(),
                                        bankName: $('#bank-name').val(),
                                        chequeMonth: $('#cheque-month').val(),
                                        chequeDay: $('#cheque-day').val(),
                                        chequeYear: $('#cheque-year').val()
                                    },
                                    success: function(response) {
                                        $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                                        $('#prompt .modal-body').html(response);
                                        $('#prompt .modal-footer').html('');

                                        setTimeout(function() {
                                            $('#prompt').modal('hide');

                                            location.reload();
                                        }, 2000);
                                    }
                                });

                                return false;
                            });
                        }
                    });

                    return false;
                } else if(dataExecute == 'Delete Transaction Info') {
                    var dVar;

                    arr = 'Delete;' + dataVar;
                    dVar = arr.split(';');

                    $('#prompt').modal({
                        backdrop: 'static'
                    });
                    $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                    $('#prompt .modal-body').html('Are you sure you want to delete this transaction?');
                    $('#prompt .modal-footer').html('<button id="yes-button" class="btn btn-danger">Yes</button>&nbsp;&nbsp;<button id="no-button" class="btn btn-default">No</button>')

                    $('#yes-button').click(function() {
                        $('#prompt').modal('hide');

                        setTimeout(function() {
                            showLoader('prompt');
                            $('#prompt').modal({
                                backdrop: 'static'
                            });

                            $.ajax({
                                url: 'requests/modify_transactions.php',
                                method: 'POST',
                                data: {
                                    action: dVar[0],
                                    waybillNumber: dVar[1]
                                },
                                success: function(response) {
                                    $('#prompt .modal-body').html(response);
                                    $('#prompt .modal-footer').html('');

                                    setTimeout(function() {
                                        $('#prompt').modal('hide');

                                        location.reload();
                                    }, 2000);
                                }
                            });

                            return false;
                        }, 1000);
                    });

                    $('#no-button').click(function() {
                        $('#prompt').modal('hide');
                    });
                } else if(dataExecute == 'View Truck Info') {
                    var dVar;

                    arr = 'View;' + dataVar;
                    dVar = arr.split(';');

                    showLoader('modal');
                    $('#modal').modal({
                        backdrop: 'static'
                    });
                    $('#modal .modal-title').html('<h3 class="no-margin">Truck Information</h3>');

                    $.ajax({
                        url: 'requests/modify_truck.php',
                        method: 'POST',
                        data: {
                            action: dVar[0],
                            truckName: dVar[1],
                            imeiNumber: dVar[2]
                        },
                        success: function(response) {
                            $('#modal .modal-body').css({
                                'overflow-y': 'scroll',
                                'max-height': ($(window).height() / 4) * 3
                            }).html(response);

                            $('#add-pending-transactions-button').click(function() {
                                var pending = $('#add-pending-transactions').val();
                                var truckId = $('#add-pending-transactions-button').attr('data-var');

                                $('#modal').modal('hide');
                                showLoader('prompt');
                                $('#prompt').modal({
                                    backdrop: 'static'
                                });

                                $.ajax({
                                    url: 'requests/modify_pending.php',
                                    method: 'POST',
                                    data: {
                                        action: 'Add',
                                        waybillNumber: pending,
                                        truckId: truckId
                                    },
                                    success: function(response) {
                                        $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                                        $('#prompt .modal-body').html(response);

                                        setTimeout(function() {
                                            $('#prompt').modal('hide');

                                            location.reload();
                                        }, 2000);
                                    }
                                });

                                return false;
                            });

                            $('[data-execute]').click(function() {
                                var dataExecute = $(this).attr('data-execute');
                                var dataVar, dVar;

                                if(dataExecute == 'Comply All Pending Transaction') {
                                    dataVar = 'Comply All;' + $(this).attr('data-var');
                                    dVar = dataVar.split(';');

                                    $('#modal').modal('hide');

                                    showLoader('prompt');
                                    $('#prompt').modal({
                                        backdrop: 'static'
                                    });

                                    $.ajax({
                                        url: 'requests/modify_pending.php',
                                        method: 'POST',
                                        data: {
                                            action: dVar[0],
                                            truckId: dVar[1],
                                            waybillNumbers: dVar
                                        },
                                        success: function(response) {
                                            $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                                            $('#prompt .modal-body').html(response);

                                            setTimeout(function() {
                                                $('#prompt').modal('hide');

                                                location.reload();
                                            }, 2000);
                                        }
                                    });

                                    return false;
                                } else if(dataExecute == 'Comply Pending Transaction') {
                                    dataVar = 'Comply;' + $(this).attr('data-var');
                                    dVar = dataVar.split(';');

                                    $('#modal').modal('hide');

                                    showLoader('prompt');
                                    $('#prompt').modal({
                                        backdrop: 'static'
                                    });

                                    $.ajax({
                                        url: 'requests/modify_pending.php',
                                        method: 'POST',
                                        data: {
                                            action: dVar[0],
                                            truckId: dVar[1],
                                            waybillNumber: dVar[2]
                                        },
                                        success: function(response) {
                                            $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                                            $('#prompt .modal-body').html(response);

                                            setTimeout(function() {
                                                $('#prompt').modal('hide');

                                                location.reload();
                                            }, 2000);
                                        }
                                    });

                                    return false;
                                } else if(dataExecute == 'Remove Pending Transaction') {
                                    dataVar = 'Remove;' + $(this).attr('data-var');
                                    dVar = dataVar.split(';');

                                    $('#modal').modal('hide');

                                    showLoader('prompt');
                                    $('#prompt').modal({
                                        backdrop: 'static'
                                    });

                                    $.ajax({
                                        url: 'requests/modify_pending.php',
                                        method: 'POST',
                                        data: {
                                            action: dVar[0],
                                            truckId: dVar[1],
                                            waybillNumber: dVar[2]
                                        },
                                        success: function(response) {
                                            $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                                            $('#prompt .modal-body').html(response);

                                            setTimeout(function() {
                                                $('#prompt').modal('hide');

                                                location.reload();
                                            }, 2000);
                                        }
                                    });

                                    return false;
                                }
                            });
                        }
                    });

                    return false;
                } else if(dataExecute == 'Edit Truck Info') {
                    var dVar;

                    arr = 'Edit;' + dataVar;
                    dVar = arr.split(';');

                    showLoader('modal');
                    $('#modal').modal({
                        backdrop: 'static'
                    });

                    $.ajax({
                        url: 'requests/modify_truck.php',
                        method: 'POST',
                        data: {
                            action: dVar[0],
                            truckName: dVar[1],
                            imeiNumber: dVar[2]
                        },
                        success: function(response) {
                            $('#modal .modal-title').html('<h3 class="no-margin">Edit Truck Information</h3>');
                            $('#modal .modal-body').html(response);

                            $('#save-changes-button').click(function() {
                                $('#modal').modal('hide');

                                showLoader('prompt');
                                $('#prompt').modal({
                                    backdrop: 'static'
                                });

                                $.ajax({
                                    url: 'requests/modify_truck.php',
                                    method: 'POST',
                                    data: {
                                        action: 'Save',
                                        oldTruckName: dVar[1],
                                        oldImeiNumber: dVar[2],
                                        newTruckName: $('input[name=newTruckName]').val(),
                                        newImeiNumber: $('input[name=newImeiNumber]').val()
                                    },
                                    success: function(response) {
                                        $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                                        $('#prompt .modal-body').html(response);

                                        setTimeout(function() {
                                            $('#prompt').modal('hide');

                                            location.reload();
                                        }, 2000);
                                    }
                                });

                                return false;
                            });
                        }
                    });

                    return false;
                } else if(dataExecute == 'Remove Truck Info') {
                    var dVar = dataVar.split(';');

                    $('#prompt').modal({
                        backdrop: 'static'
                    });
                    $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                    $('#prompt .modal-body').html('Are you sure you want to delete this truck?');
                    $('#prompt .modal-footer').html('<button id="yes-button" class="btn btn-danger">Yes</button>&nbsp;&nbsp;<button id="no-button" class="btn btn-default">No</button>')

                    $('#yes-button').click(function() {
                        $('#prompt').modal('hide');

                        setTimeout(function() {
                            showLoader('prompt');
                            $('#prompt').modal({
                                backdrop: 'static'
                            });

                            $.ajax({
                                url: 'requests/modify_truck.php',
                                method: 'POST',
                                data: {
                                    action: 'Delete',
                                    truckName: dVar[0],
                                    imeiNumber: dVar[1]
                                },
                                success: function(response) {
                                    $('#prompt .modal-body').html(response);
                                    $('#prompt .modal-footer').html('');

                                    setTimeout(function() {
                                        $('#prompt').modal('hide');

                                        location.reload();
                                    }, 2000);
                                }
                            });

                            return false;
                        }, 500);
                    });

                    $('#no-button').click(function() {
                        $('#prompt').modal('hide');
                    });
                } else if(dataExecute == 'View User Info') {
                    showLoader('modal');
                    $('#modal').modal({
                        backdrop: 'static'
                    });
                    $('#modal .modal-title').html('<h3 class="no-margin">User Information</h3>');

                    $.ajax({
                        url: 'requests/modify_users.php',
                        method: 'POST',
                        data: {
                            action: 'View',
                            username: dataVar
                        },
                        success: function(response) {
                            $('#modal .modal-body').html(response);
                        }
                    });

                    return false;
                } else if(dataExecute == 'Edit User Info') {
                    showLoader('modal');
                    $('#modal').modal({
                        backdrop: 'static'
                    });
                    $('#modal .modal-title').html('<h3 class="no-margin">User Information</h3>');

                    $.ajax({
                        url: 'requests/modify_users.php',
                        method: 'POST',
                        data: {
                            action: 'Edit',
                            username: dataVar
                        },
                        success: function(response) {
                            $('#modal .modal-body').html(response);

                            $('#save-changes-on-users-button').click(function() {
                                $('#modal').modal('hide');

                                showLoader('prompt');
                                $('#prompt').modal({
                                    backdrop: 'static'
                                });

                                $.ajax({
                                    url: 'requests/modify_users.php',
                                    method: 'POST',
                                    data: {
                                        action: 'Save',
                                        editAccountUsername: $('#edit-account-username').val(),
                                        editAccountPassword: $('#edit-account-password').val(),
                                        editAccountConfirmPassword: $('#edit-account-confirm-password').val(),
                                        editFirstName: $('#edit-first-name').val(),
                                        editMiddleName: $('#edit-middle-name').val(),
                                        editLastName: $('#edit-last-name').val(),
                                        editRole: $('#edit-role').val(),
                                        editGender: $('#edit-gender').val(),
                                        oldUsername: dataVar
                                    },
                                    success: function(response) {
                                        $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                                        $('#prompt .modal-body').html(response);
                                        $('#prompt .modal-footer').html('');

                                        setTimeout(function() {
                                            $('#prompt').modal('hide');

                                            location.reload();
                                        }, 2000);
                                    }
                                });

                                return false;
                            });
                        }
                    });

                    return false;
                } else if(dataExecute == 'Delete User Info') {
                    $('#prompt').modal({
                        backdrop: 'static'
                    });
                    $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                    $('#prompt .modal-body').html('Are you sure you want to delete this user?');
                    $('#prompt .modal-footer').html('<div class="text-right"><button id="yes-button" class="btn btn-danger">Yes</button>&nbsp;<button id="no-button" class="btn btn-default">No</button></div>');

                    $('#yes-button').click(function() {
                        $('#prompt').modal('hide');

                        setTimeout(function() {
                            showLoader('prompt');
                            $('#prompt').modal({
                                backdrop: 'static'
                            });

                            $.ajax({
                                url: 'requests/modify_users.php',
                                method: 'POST',
                                data: {
                                    action: 'Delete',
                                    username: dataVar
                                },
                                success: function(response) {
                                    $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                                    $('#prompt .modal-body').html(response);
                                    $('#prompt .modal-footer').html('');

                                    setTimeout(function() {
                                        $('#prompt').modal('hide');

                                        location.reload();
                                    }, 2000);
                                }
                            });

                            return false;
                        }, 1000);
                    });

                    $('#no-button').click(function() {
                        $('#prompt').modal('hide');
                    });
                } else if(dataExecute == 'Edit Lading Info') {
                    var dVar;

                    arr = 'Edit;' + dataVar;
                    dVar = arr.split(';');

                    showLoader('modal');
                    $('#modal').modal({
                        backdrop: 'static'
                    });

                    $.ajax({
                        url: 'requests/modify_ladings.php',
                        method: 'POST',
                        data: {
                            action: dVar[0],
                            billId: dVar[1]
                        },
                        success: function(response) {
                            $itemRow = 0;

                            $('#modal .modal-title').html('<h3 class="no-margin">Edit Bill of Lading</h3>');
                            $('#modal .modal-body').html(response);

                            $itemRow = $('#lading-count').text();

                            $('#measure-ment').keyup(function() {
                                $value = $(this).val();

                                if(isNaN($value)) {
                                    $(this).val(0);
                                    $(this).focus();
                                }
                            });

                            $('#add-item-to-bill-button').click(function() {
                                $itemRow += 1;

                                $('#bill-of-lading-table tbody').append('<tr><td><textarea name="billItemMark-' + $itemRow + '" class="form-control" required></textarea></td><td><textarea name="billItemQuantity-' + $itemRow + '" class="form-control" required></textarea></td><td><textarea name="billItemDescription-' + $itemRow + '" class="form-control" required></textarea></td></tr>');
                            });

                            $('#edit-bill-of-lading-form').submit(function() {
                                $('#modal').modal('hide');

                                showLoader('prompt');
                                $('#prompt').modal({
                                    backdrop: 'static'
                                });

                                $.ajax({
                                    url: 'requests/modify_ladings.php',
                                    method: 'POST',
                                    data: $('#edit-bill-of-lading-form').serialize() + '&action=Save',
                                    success: function(response) {
                                        $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                                        $('#prompt .modal-body').html(response);
                                        $('#prompt .modal-footer').html('');

                                        setTimeout(function() {
                                            $('#prompt').modal('hide');

                                            location.reload();
                                        }, 2000);
                                    }
                                });

                                return false;
                            });
                        }
                    });

                    return false;
                } else if(dataExecute == 'Delete Lading Info') {
                    $('#prompt').modal({
                        backdrop: 'static'
                    });
                    $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                    $('#prompt .modal-body').html('Are you sure you want to delete this bill of lading?');
                    $('#prompt .modal-footer').html('<div class="text-right"><button id="yes-button" class="btn btn-danger">Yes</button>&nbsp;<button id="no-button" class="btn btn-default">No</button></div>');

                    $('#yes-button').click(function() {
                        $('#prompt').modal('hide');

                        setTimeout(function() {
                            showLoader('prompt');
                            $('#prompt').modal({
                                backdrop: 'static'
                            });

                            $.ajax({
                                url: 'requests/modify_ladings.php',
                                method: 'POST',
                                data: {
                                    action: 'Delete',
                                    billId: dataVar
                                },
                                success: function(response) {
                                    $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                                    $('#prompt .modal-body').html(response);
                                    $('#prompt .modal-footer').html('');

                                    setTimeout(function() {
                                        $('#prompt').modal('hide');

                                        location.reload();
                                    }, 2000);
                                }
                            });

                            return false;
                        }, 1000);
                    });

                    $('#no-button').click(function() {
                        $('#prompt').modal('hide');
                    });
                }
            });
        }
    });

    return false;
}

function addLog($log) {
    $.ajax({
        url: 'requests/add_log.php',
        method: 'POST',
        data: {
            log: $log
        },
        success: function(response) {
        }
    });

    return false;
}

function clientIncomeChart($pageNumber) {
    $.ajax({
        url: 'requests/generate_chart.php',
        method: 'GET',
        data: {
            action: 'View Income per Client',
            page: $pageNumber
        },
        dataType: 'json',
        success: function(response) {
            var chartData = {
                labels: response['names'],
                datasets: [
                    {
                        label: "Credit",
                        fillColor: "rgba(57, 117, 189, 0)",
                        strokeColor: "rgba(7, 67, 139, 0.75)",
                        pointColor: "rgba(57, 117, 189, 0.75)",
                        pointStrokeColor: "rgba(7, 67, 139, 1)",
                        data: response['credits']
                    },
                    {
                        label: "Debit",
                        fillColor: "rgba(195, 57, 55, 0)",
                        strokeColor: "rgba(145, 7, 5, 0.75)",
                        pointColor: "rgba(195, 57, 55, 0.75)",
                        pointStrokeColor: "rgba(145, 7, 5, 1)",
                        data: response['debits']
                    }
                ]
            };

            var ctx = document.getElementById('client-income-chart').getContext('2d');
            var clientIncome = new Chart(ctx).Line(chartData, {
                scaleGridLineColor: "rgba(0, 0, 0, .25)",
                multiTooltipTemplate: "<%= datasetLabel + ': ' + value %>",
                legendTemplate: "<div class=\"legend-title\">Legend:</div><ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].pointColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
            });

            $('#client-income-chart-legend').html(clientIncome.generateLegend());
        }
    });

    return false;
}

function totalMonthlyIncomeChart() {
    $.ajax({
        url: 'requests/generate_chart.php',
        method: 'GET',
        data: {
            action: 'View Total Monthly Income'
        },
        dataType: 'json',
        success: function(response) {
            var chartData = {
                labels: ["Total Monthly Income"],
                datasets: [
                    {
                        label: "Credits",
                        fillColor: "rgba(57, 117, 189, 0.75)",
                        strokeColor: "rgba(7, 67, 139, 0.75)",
                        highlightFill: "rgba(57, 117, 189, 1)",
                        highlightStroke: "rgba(7, 67, 139, 1)",
                        data: [response['total_credits']]
                    },
                    {
                        label: "Debits",
                        fillColor: "rgba(195, 57, 55, 0.75)",
                        strokeColor: "rgba(145, 7, 5, 0.75)",
                        highlightFill: "rgba(195, 57, 55, 1)",
                        highlightStroke: "rgba(145, 7, 5, 1)",
                        data: [response['total_debits']]
                    }
                ]
            };

            var ctx = document.getElementById('total-monthly-income-chart').getContext('2d');
            var totalMonthlyIncome = new Chart(ctx).Bar(chartData, {
                scaleGridLineColor: 'rgba(0, 0, 0, .25)',
                legendTemplate: "<div class=\"legend-title\">Legend:</div><ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
            });

            $('#total-monthly-income-chart-legend').html(totalMonthlyIncome.generateLegend());
        }
    });

    return false;
}

/*
function totalMonthlyIncomeChart() {
    $.ajax({
        url: 'requests/generate_chart.php',
        method: 'GET',
        data: {
            action: 'View Total Monthly Income'
        },
        dataType: 'json',
        success: function(response) {
            var chartData = [
                {
                    value: response['total_credits'],
                    color: "rgba(57, 117, 189, 0.75)",
                    highlight: "rgba(57, 117, 189, 1)",
                    label: "Total Credit"
                },
                {
                    value: response['total_debits'],
                    color: "rgba(195, 57, 55, 0.75)",
                    highlight: "rgba(195, 57, 55, 1)",
                    label: "Total Debit"
                }
            ];

            var ctx = document.getElementById('total-monthly-income-chart').getContext('2d');
            var totalMonthlyIncome = new Chart(ctx).Doughnut(chartData, {
                animationSteps: 0,
                segmentStrokeColor: "rgba(0, 0, 0, .25)",
                tooltipEvents: [],
                tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
                legendTemplate: "<div class=\"legend-title\">Legend:</div><ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
                onAnimationComplete: function() {
                    this.showTooltip(this.segments, true);
                }
            });

            $('#total-monthly-income-chart-legend').html(totalMonthlyIncome.generateLegend());
        }
    });

    return false;
}
*/

function isInputAlpha(field, message) {
    var rx = /[^a-z \.\,]/i;
    if(rx.test(field.value)) {
        if(message == '' || message == null) {
            alert('This field allows texts only.');
        } else {
            alert(message);
        }
        field.value = '';
        field.focus = '';
    }
}

function isInputAlphaNumeric(field, message) {
    var rx = /[^a-z0-9 \.\,\-]/i;
    if(rx.test(field.value)) {
        if(message == '' || message == null) {
            alert('This field allows texts and numbers only.');
        } else {
            alert(message);
        }
        field.value = '';
        field.focus = '';
    }
}

function isInputPositive(field, message) {
    var rx = /[^0-9]/i;
    if(rx.test(field.value)) {
        if(message == '' || message == null) {
            alert('This field allows positive numbers only.');
        } else {
            alert(message);
        }
        field.value = '';
        field.focus = '';
    }
}

function isInputNumeric(field, message) {
    var rx = /[^0-9 \-]/i;
    if(rx.test(field.value)) {
        if(message == '' || message == null) {
            alert('This field allows numbers only.');
        } else {
            alert(message);
        }
        field.value = '';
        field.focus = '';
    }
}

function isInputContact(field, message) {
    var rx = /[^0-9 \+\(\)]/i;
    if(rx.test(field.value)) {
        if(message == '' || message == null) {
            alert('Invalid contact number format. Please enter a valid contact number.');
        } else {
            alert(message);
        }
        field.value = '';
        field.focus = '';
    }
}

function isInputAddress(field, message) {
    var rx = /[^a-z0-9 \.\,\'\-\(\)]/i;
    if(rx.test(field.value)) {
        if(message == '' || message == null) {
            alert('Invalid address format. Please enter a valid address.');
        } else {
            alert(message);
        }
        field.value = '';
        field.focus = '';
    }
}

function getCanvasUrl(canvasID) {
    var id = document.getElementById(canvasID);

    return id.toDataURL();
}

function showNotif(message) {
    if(!$('body').find('.notif-container').length) {
        alert();
    } else {
        alert();
    }
}

function showLoader(id) {
    var dialogBody = $('#' + id + ' .modal-body');

    dialogBody.html('<div class="text-center"><img src="assets/img/loader.png" class="loader"></div>');

    $('.loader').css({
        'height': '50px;',
        'width': '50px',
        'animation': '1s infispin infinite linear'
    });
}

$(document).ready(function() {
    var notifs;

    setInterval(function() {
        $.ajax({
            url: 'requests/retrieve_logs.php',
            method: 'GET',
            success: function(response) {
                $('#noti').html('').html(response);
            }
        });

        return false;
    }, 1000);

    $('.particles').particleground({
        dotColor: '#5cbdaa',
        lineColor: '#5cbdaa'
    });

    $('[data-toggle="popover"]').popover({
        container: 'body',
        trigger: 'hover'
    });

    $('[data-search]').keyup(function() {
        var dataSearch = $(this).attr('data-search');

        if(dataSearch == 'Clients') {
            fillTable('list_clients.php', $(this).val());
        } else if(dataSearch == 'Companies') {
            fillTable('list_companies.php', $(this).val());
        } else if(dataSearch == 'Transactions') {
            fillTable('list_transactions.php', $(this).val());
        } else if(dataSearch == 'Trucks') {
            fillTable('list_trucks.php', $(this).val());
        } else if(dataSearch == 'Users') {
            fillTable('list_users.php', $(this).val());
        } else if(dataSearch == 'Ladings') {
            fillTable('list_ladings.php', $(this).val());
        }
    });

    $('[data-execute]').click(function() {
        var dataExecute = $(this).attr('data-execute');

        if(dataExecute == 'Add New Client') {
            $('#modal').modal({
                backdrop: 'static'
            });
            $('#modal .modal-title').html('<h3 class="no-margin">Add New Client</h3>');
            $('#modal .modal-body').html('<form id="add-client-form"><div class="row"><div class="col-lg-4 col-md-4 form-group"><label>Client\'s First Name:</label><input type="text" class="form-control" name="addClientFirstName" placeholder="Enter Client\'s First Name here..." onkeyup="isInputAlpha(this)" required autofocus></div><div class="col-lg-4 col-md-4 form-group"><label>Client\'s Middle Name:</label><input type="text" class="form-control" name="addClientMiddleName" placeholder="Enter Client\'s Middle Name here..." onkeyup="isInputAlpha(this)"></div><div class="col-lg-4 col-md-4 form-group"><label>Client\'s Last Name:</label><input type="text" class="form-control" name="addClientLastName" placeholder="Enter Client\'s Last Name here..." onkeyup="isInputAlpha(this)" required></div></div><div class="form-group"><label>Client\'s Address:</label><input type="text" class="form-control" name="addClientAddress" placeholder="Enter Client\'s Address here..." onkeyup="isInputAddress(this)" required></div><div class="form-group"><label>Client\'s E-mail Address:</label><input type="text" class="form-control" name="addClientEmail" placeholder="Enter Client\'s E-mail Address here..." required></div><div class="form-group"><label>Company Name:</label><input type="text" class="form-control" name="addCompanyName" placeholder="Enter Company Name here..." onkeyup="isInputAlpha(this)"></div><div class="form-group"><label>Company Address:</label><input type="text" class="form-control" name="addCompanyAddress" placeholder="Enter Company Address here..." onkeyup="isInputAddress(this)"></div><div class="form-group"><label>Company Contact Number:</label><input type="text" class="form-control" name="addCompanyContactNumber" placeholder="Enter Company Contact Number here..." onkeyup="isInputContact(this)"></div><div class="text-right"><input class="btn btn-primary" type="submit" value="Add Client Information"></div></form>');

            $('#add-client-form').submit(function() {
                showLoader('modal');
                $('#modal').modal({
                    backdrop: 'static'
                });

                $.ajax({
                    url: 'requests/modify_client.php',
                    method: 'POST',
                    data: $(this).serialize() + '&action=Add',
                    success: function(response) {
                        $('#modal .modal-body').html(response);

                        setTimeout(function() {
                            $('#modal').modal('hide');

                            location.reload();
                        }, 2000);
                    }
                });

                return false;
            });
        } else if(dataExecute == 'Add New Company') {
            $('#modal').modal({
                backdrop: 'static'
            });
            $('#modal .modal-title').html('<h3 class="no-margin">Add New Company</h3>');
            $('#modal .modal-body').html('<form id="add-company-form"><div class="form-group"><label>Company Name:</label><input type="text" class="form-control" name="companyName" placeholder="Enter Company Name here..." onkeyup="isInputAlpha(this)" required></div><div class="form-group"><label>Company Address:</label><input type="text" class="form-control" name="companyAddress" placeholder="Enter Company Address here..." onkeyup="isInputAddress(this)" required></div><div class="form-group"><label>Company Contact Number:</label><input type="text" class="form-control" name="companyContactNumber" placeholder="Enter Company Contact Number here..." onkeyup="isInputContact(this)" required></div><div class="form-group"><label>Company E-mail Address:</label><input type="text" class="form-control" name="companyEmailAddress" placeholder="Enter Company E-mail Address here..." required></div><div class="form-group"><label>Main Business Activities:</label><input type="text" class="form-control" name="mainBusinessActivities" placeholder="Enter Main Business Activities here..." required></div><div class="form-group"><label>Zip Code:</label><input type="text" class="form-control" name="zipCode" placeholder="Enter Zip Code here..." onkeyup="isInputNumeric(this)"></div><div class="form-group"><label>Company\' Contact Person:</label><input type="text" class="form-control" name="primaryContact" placeholder="Enter Company\' Contact Person here..." onkeyup="isInputContact(this)"></div><div class="form-group"><label>Company\' Contact Person Position:</label><input type="text" class="form-control" name="primaryContactCompanyPosition" placeholder="Enter Company\' Contact Person Position here..."></div><div class="form-group"><label>Company\' Contact Person E-mail:</label><input type="text" class="form-control" name="primaryContactEmail" placeholder="Enter Company\' Contact Person E-mail here..."></div><div class="form-group"><label>Company\' Contact Person Number:</label><input type="text" class="form-control" name="primaryContactPhoneNumber" placeholder="Enter Company\' Contact Person Number here..." onkeyup="isInputContact(this)"></div><div class="form-group"><label>Country:</label><input type="text" class="form-control" name="country" placeholder="Enter Country here..." onkeyup="isInputAddress(this)"></div><div class="form-group"><label>Default Time Zone:</label><input type="text" class="form-control" name="defaultTimeZone" placeholder="Enter Default Time Zone here..."></div><div class="form-group"><label>Fax:</label><input type="text" class="form-control" name="fax" placeholder="Enter Fax here..." onkeyup="isInputContact(this)"></div><div class="form-group"><label>Phone Number:</label><input type="text" class="form-control" name="phoneNumber" placeholder="Enter Phone Number here..." onkeyup="isInputContact(this)"></div><div class="form-group"><label>Established:</label><input type="text" class="form-control" name="established" placeholder="Enter Established here..."></div><div class="text-right"><input class="btn btn-primary" type="submit" value="Add Company Information"></div></form>');

            $('#add-company-form').submit(function() {
                $('#modal').modal('hide');

                showLoader('prompt');
                $('#prompt').modal({
                    backdrop: 'static'
                });

                $.ajax({
                    url: 'requests/modify_company.php',
                    method: 'POST',
                    data: $('#add-company-form').serialize() + '&action=Add',
                    success: function(response) {
                        $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                        $('#prompt .modal-body').html(response);

                        setTimeout(function() {
                            $('#prompt').modal('hide');

                            location.reload();
                        }, 2000);
                    }
                });

                return false;
            });
        } else if(dataExecute == 'Create New Transaction') {
            showLoader('modal');
            $('#modal').modal({
                backdrop: 'static'
            });
            $('#modal .modal-title').html('<h3 class="no-margin">Create New Transaction</h3>');
            
            $.ajax({
                url: 'requests/dropdown_client_names.php',
                method: 'GET',
                success: function(response) {
                    $.ajax({
                        url: 'requests/dropdown_ladings.php',
                        method: 'GET',
                        success: function(resp) {
                            //$('#modal .modal-body').html('<form id="create-new-transaction-form"><div class="form-group"><label>Client or Company Name:</label><select id="client-list-check-balance" class="form-control" name="createTransactionClientID" required>' + response + '</select></div><div class="form-group"><label>Shipment Description:</label><input type="text" class="form-control" name="createTransactionDescription" placeholder="Enter Description here..."></div><div class="form-group"><label>Mode of Transaction:</label><select class="form-control" name="createTransactionModeOfTransaction" required><option value="" disabled>Choose a mode of transaction here...</option><option value="Door to Door">Door to Door</option><option value="Warehouse">Warehouse</option></select></div><div class="form-group"><label>Container Size:</label><select class="form-control" name="createTransactionContainerSize" required><option value="" disabled>Chooose a container size here...</option><option value="20 feet">20 feet</option><option value="40 feet">40 feet</option></select></div><div class="form-group"><label>Pick-up Location:</label><input type="text" class="form-control" name="createTransactionPickupLocation" placeholder="Enter Pick-up Location Name here..." required></div><div class="form-group"><label>Delivery Location:</label><input type="text" class="form-control" name="createTransactionDeliveryLocation" placeholder="Enter Delivery Location here..." required></div><div class="form-group"><label>Bill of Lading:</label><select name="createTransactionBillOfLading" class="form-control" required>' + resp + '</select></div><div class="text-right"><input class="btn btn-primary" type="submit" value="Create Transaction"></div></form>');
                            $('#modal .modal-body').html('<form id="create-new-transaction-form"><div class="form-group"><label>Client or Company Name:</label><select id="client-list-check-balance" class="form-control" name="createTransactionClientID" required>' + response + '</select></div><div class="form-group"><label>Shipment Description:</label><input type="text" class="form-control" name="createTransactionDescription" placeholder="Enter Description here..."></div><div class="form-group"><label>Mode of Transaction:</label><select class="form-control" name="createTransactionModeOfTransaction" required><option value="" selected disabled>Choose a mode of transaction here...</option><option value="Door to Door">Door to Door</option><option value="Warehouse">Warehouse</option></select></div><div class="form-group"><label>Container Size:</label><select class="form-control" name="createTransactionContainerSize" required><option value="" selected disabled>Chooose a container size here...</option><option value="20 feet">20 feet</option><option value="40 feet">40 feet</option></select></div><div class="form-group"><label>Delivery Location:</label><input type="text" class="form-control" name="createTransactionDeliveryLocation" placeholder="Enter Delivery Location here..." required></div><div class="form-group"><label>Bill of Lading:</label><select name="createTransactionBillOfLading" class="form-control" required>' + resp + '</select></div><div class="text-right"><input class="btn btn-primary" type="submit" value="Create Transaction"></div></form>');

                            $('#client-list-check-balance').change(function() {
                                //alert($('option:selected', this).attr('data-notif-value'));
                                if($('option:selected', this).attr('data-notif-value') != undefined) {
                                    var notifValue = $('option:selected', this).attr('data-notif-value');
                                    $(this)[0].selectedIndex = 0;

                                    showLoader('notif');
                                    $('#notif').modal({
                                        backdrop: 'static'
                                    });

                                    $.ajax({
                                        url: 'requests/notifier.php',
                                        method: 'GET',
                                        data: {
                                            value: notifValue
                                        },
                                        success: function(res) {
                                            $('#notif .modal-title').html('<h3 class="no-margin">Warning</h3>');
                                            $('#notif .modal-body').html(res + ' is not allowed to create new transaction. Please settle previous transaction balances before creating new transaction.<br><br>Please select another one...');

                                            setTimeout(function() {
                                                $('#notif').modal('hide');
                                                $('#notif .modal-title').html('');
                                                $('#notif .modal-body').html('');
                                            }, 2000);
                                        }
                                    });

                                    return false;
                                }
                            });
                    
                            $('#create-new-transaction-form').submit(function() {
                                showLoader('modal');
                                $('#modal').modal({
                                    backdrop: 'static'
                                });

                                $.ajax({
                                    url: 'requests/modify_transactions.php',
                                    method: 'POST',
                                    data: $(this).serialize() + '&action=Add',
                                    success: function(response) {
                                        $('#modal .modal-body').html(response);

                                        setTimeout(function() {
                                            $('#modal').modal('hide');

                                            location.reload();
                                        }, 2000);
                                    }
                                });

                                return false;
                            });
                        }
                    });

                    return false;
                }
            });

            return false;
        } else if(dataExecute == 'Add New Truck') {
            $('#modal').modal({
                backdrop: 'static'
            });
            $('#modal .modal-title').html('<h3 class="no-margin">Add New Truck</h3>');
            $('#modal .modal-body').html('<form id="add-truck-form"><div class="form-group"><label>Truck Name:</label><input class="form-control" type="text" name="truckName" placeholder="Enter Truck Name" required></div><div class="form-group"><label>IMEI Number:</label><input class="form-control" type="text" name="imeiNumber" placeholder="Enter IMEI Number here..." required></div><div class="form-group text-right"><input class="btn btn-primary" type="submit" value="Add Truck"></div></form>');

            $('#add-truck-form').submit(function() {
                $('#modal').modal('hide');

                showLoader('prompt');
                $('#prompt').modal({
                    backdrop: 'static'
                });

                $.ajax({
                    url: 'requests/modify_truck.php',
                    method: 'POST',
                    data: $('#add-truck-form').serialize() + '&action=Add',
                    success: function(response) {
                        $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                        $('#prompt .modal-body').html(response);

                        setTimeout(function() {
                            $('#prompt').modal('hide');

                            location.reload();
                        }, 2000);
                    }
                });

                return false;
            });
        } else if(dataExecute == 'Add New User') {
            showLoader('modal');
            $('#modal').modal({
                backdrop: 'static'
            });
            $('#modal .modal-title').html('<h3 class="no-margin">Add New User</h3>');
            
            $.ajax({
                url: 'requests/modify_users.php',
                method: 'POST',
                data: {
                    action: 'Get Fields'
                },
                success: function(response) {
                    $('#modal .modal-body').html(response);

                    $('#add-new-user-form').submit(function() {
                        $('#modal').modal('hide');

                        showLoader('prompt');
                        $('#prompt').modal({
                            backdrop: 'static'
                        });

                        $.ajax({
                            url: 'requests/modify_users.php',
                            method: 'POST',
                            data: $('#add-new-user-form').serialize() + '&action=Add',
                            success: function(response) {
                                $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                                $('#prompt .modal-body').html(response);

                                setTimeout(function() {
                                    $('#prompt').modal('hide');

                                    location.reload();
                                }, 2000);
                            }
                        });

                        return false;
                    });
                }
            });

            return false;
        } else if(dataExecute == 'Create New Bill of Lading') {
            showLoader('modal');
            $('#modal').modal({
                backdrop: 'static'
            });
            $('#modal .modal-title').html('<h3 class="no-margin">Create New Bill of Lading</h3>');

            $.ajax({
                url: 'requests/modify_ladings.php',
                method: 'POST',
                data: {
                    action: 'View'
                },
                success: function(response) {
                    $itemRow = 0;

                    $('#modal .modal-body').css({
                        'overflow-y': 'scroll',
                        'max-height': ($(window).height() / 4) * 3
                    }).html(response);

                    $('#measure-ment').keyup(function() {
                        $value = $(this).val();

                        if(isNaN($value)) {
                            $(this).val(0);
                            $(this).focus();
                        }
                    });

                    $('.date-input-control').keyup(function() {
                        if($(this).val() == '') {
                            $(this).val('');
                            $(this).focus();
                        }
                    });

                    $('#add-item-to-bill-button').click(function() {
                        $itemRow += 1;

                        $('#bill-of-lading-table tbody').append('<tr><td><textarea name="billItemMark-' + $itemRow + '" class="form-control" required></textarea></td><td><textarea name="billItemQuantity-' + $itemRow + '" class="form-control" required></textarea></td><td><textarea name="billItemDescription-' + $itemRow + '" class="form-control" required></textarea></td></tr>');
                    });

                    $('#bill-of-lading-form').submit(function() {
                        $('#modal').modal('hide');

                        showLoader('prompt');
                        $('#prompt').modal({
                            backdrop: 'static'
                        });

                        $.ajax({
                            url: 'requests/modify_ladings.php',
                            method: 'POST',
                            data: $('#bill-of-lading-form').serialize(),
                            success: function(response) {
                                $('#prompt .modal-title').html('<h3 class="no-margin">Prompt</h3>');
                                $('#prompt .modal-body').html(response);

                                setTimeout(function() {
                                    $('#prompt').modal('hide');

                                    location.reload();
                                }, 2000);
                            }
                        });

                        return false;
                    });
                }
            });

            return false;
        }
    });

    $('#login-form').submit(function() {
        showLoader('modal');
        $('#modal').modal({
            backdrop: 'static'
        });

        $.ajax({
            url: 'requests/login_request.php',
            method: 'GET',
            data: $(this).serialize(),
            success: function(response) {
                if(response == "Login Successful.") {
                    $('#modal .modal-header').removeClass('bg-red').addClass('bg-green top-corners-round').html('<h3 class="no-margin">Login Status</h3>');
                    $('#modal .modal-body').html(response);

                    setTimeout(function() {
                        $('#modal').modal('hide');

                        window.location = "home.php";
                    }, 2000);

                    addLog('Login');
                } else {
                    $('#login-form input[name=password]').val('');
                    $('#login-form input[name=username]').val('').focus();

                    $('#modal .modal-header').removeClass('bg-green').addClass('bg-red top-corners-round').html('<h3 class="no-margin">Login Status</h3>');
                    $('#modal .modal-body').html(response);

                    setTimeout(function() {
                        $('#modal').modal('hide');
                    }, 3000);
                }
            }
        });

        return false;
    });

    $('[data-log]').click(function() {
        addLog($(this).attr('data-log'));
    });

    $('#generate-client-income-report-button').click(function() {
        $('#modal').modal({
            backdrop: 'static'
        });
        $('#modal .modal-title').html('<h3 class="no-margin">Generate Report</h3>');
        $('#modal .modal-body').html('<embed width="100%" height="500px" name="plugin" src="http://localhost/rmr/admin/requests/generate_finance_report.php?action=clientIncome" type="application/pdf" internalinstanceid="3">');
    });

    $('#generate-total-monthly-income-report-button').click(function() {
        //window.location = 'requests/generate_finance_report.php?action=totalMonthlyIncome&graph=' + getCanvasUrl('total-monthly-income-chart');
        totalMonthlyIncomeChart();

        setTimeout(function() {
            showLoader('modal');
            $('#modal').modal({
                backdrop: 'static'
            });
            
            $.ajax({
                url: 'requests/generate_monthly_income_chart.php',
                method: 'POST',
                data: {
                    action: 'renderGraph',
                    graph: getCanvasUrl('total-monthly-income-chart')
                },
                success: function(response) {
                    $('#modal .modal-title').html('<h3 class="no-margin">Generate Report</h3>');
                    $('#modal .modal-body').html('<embed width="100%" height="500px" name="plugin" src="http://localhost/rmr/admin/requests/generate_finance_report.php?action=totalMonthlyIncome" type="application/pdf" internalinstanceid="3">');
                }
            });

            return false;
        }, 1000);
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

    $('.light-switch-on').click(function() {
        var lightSwitch = $(this).attr('data-light-switch');
        var lightSwitchOn = '.light-switch-on[data-light-switch="' + lightSwitch + '"]';
        var lightSwitchOff = '.light-switch-off[data-light-switch="' + lightSwitch + '"]';

        if($(lightSwitchOn).hasClass('active') == false) {
            $(lightSwitchOn).removeClass('btn-default').addClass('btn-success');
            $(lightSwitchOff).removeClass('btn-danger').addClass('btn-default');
        }
    });

    $('.light-switch-off').click(function() {
        var lightSwitch = $(this).attr('data-light-switch');
        var lightSwitchOn = '.light-switch-on[data-light-switch="' + lightSwitch + '"]';
        var lightSwitchOff = '.light-switch-off[data-light-switch="' + lightSwitch + '"]';

        if($(lightSwitchOff).hasClass('active') == false) {
            $(lightSwitchOff).removeClass('btn-default').addClass('btn-danger');
            $(lightSwitchOn).removeClass('btn-success').addClass('btn-default');
        }
    });
});
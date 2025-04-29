function form_validator() {
	
	//return true;
	error_empty_field_text = '';
	message_result_errors = '';
	
	message_empty_fields = '';
	message_bad_email_format = '';
	message_bad_credit_card_date = '';
	messege_bad_credit_card_type_and_num = '';
	
	messege_bad_echeck_signature = '';
	messege_bad_echeck_num = '';
	
	message_bad_zip = ''; // for USA
	message_bad_street = ''; // for USA
	
	message_bad_cvv = '';
	
	message_bad_phone = '';
	
	message_bad_birth_date = '';
	
	if (
		!$('#fld_birth_year').val()
		||
		!$('#fld_birth_month').val()
		||
		!$('#fld_birth_day').val()
	) {
		message_bad_birth_date = 'Empty birth date! \n'
		write_error('#fld_birth_day', 'Empty birth date!');
	} else {
		clear_error('#fld_birth_day');
	}
	
	/**
	* FIRST STEP - EMPTY FIELDS CHECK
	*/
	message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_first_name');
	message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_last_name');
	message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_street_adress');
	message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_city');
	message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_zip_code');
	message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_country');
	message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_phone');
	message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_email');
	message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_exp_date_1');
	if ( !form_validator_check_empty_field('#fld_exp_date_1') ) {
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_exp_date_2');
	}
	
	if (
		$('#fld_country').val() == 'US'
		||
		$('#fld_country').val() == 'CA'
		||
		$('#fld_country').val() == 'AU'
	) {
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_state');
		// if US block
		if ( $('#fld_country').val() == 'US' ) {
			//alert('zip 5 digits only');
			
			//alert('street digits and letters only');
		}
	}
	
	if ( $('#bill_shipping_is_different').is(':checked') ) {
		//alert($('#fld_country2 :selected').val());
		if (
			
			(
			$('#fld_country2 :selected').val() == 'US'
			||
			$('#fld_country2 :selected').val() == 'CA'
			||
			$('#fld_country2 :selected').val() == 'AU'
			)
		) {
			message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_state2');
			//alert(message_empty_fields);
		} else {
			
		}
	}
	
	
	// CHECK ALTERNATIVE EMAIL IF ISSET
	
	// IF SELECTED PAYMENT METHOD == 'CREDIT CARD'
	if ( $('#fld_payment_type_credit_card').is(':checked') ) {
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_card_holder_name');
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_credit_card_no');
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_cvc_cvv2');
		if ( $('#fld_credit_card_type').val() == 'Amex' ) {
			
			//alert($('#fld_cvc_cvv2').val().length)
		}
		if ( $('#fld_cvc_cvv2').val().length < 3 ) {
			message_bad_cvv = 'CVC CVV - Minimum 3 digits\n';
			write_error('#fld_cvc_cvv2', 'Minimum 3 digits');
			//alert(message_bad_cvv)
		} else {
			message_bad_cvv = '';
			clear_error('#fld_cvc_cvv2');
		}
		// Nulled errors of eCheck fields
		clear_error('#fld_eCheck_client_name');
		clear_error('#fld_eCheck_bank_name');
		clear_error('#fld_eCheck_account_num');
		clear_error('#fld_eCheck_bank_routing_num');
		//clear_error('#fld_eCheck_check_num');
	} else {
		// if eCheck selected
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_eCheck_client_name');
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_eCheck_bank_name');
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_eCheck_account_num');
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_eCheck_bank_routing_num');
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_eCheck_check_num');
		
		// check routing for 9 digits
		// fld_eCheck_bank_routing_num
		// Nulled errors of credit card fields
		clear_error('#fld_card_holder_name');
		clear_error('#fld_credit_card_no');
		clear_error('#fld_cvc_cvv2');
	}
	
	// IF SHIPPING IS DIFFERENT
	if ( $('#bill_shipping_is_different').is(':checked') ) {
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_first_name2');
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_last_name2');
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_city2');
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_zip_code2');
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_country2');
	}
	
	message_bad_email_format = message_bad_email_format + form_validator_check_email_format('#fld_email');
	if ( $.trim($('#fld_email2').val()) != '' ) {
		message_bad_email_format = message_bad_email_format + form_validator_check_email_format('#fld_email2');
	} else {
		// nulled mail2 error
		$('.bill_error', $('#fld_email2').parents('tr:first')).text('');
	}
	
	/**
	* THIRD STEP - CREDIT CARD DATE IF SELECTED CREDIT CARD TYPE = CREDIT CARD
	*/
	// date check
	if (
		$('#fld_payment_type_credit_card').is(':checked')
	) {
		my_month = parseInt($('#fld_exp_date_1 option:selected').val());
		my_year = parseInt($('#fld_exp_date_2 option:selected').val());
		date_year = parseInt(date_year);
		date_month = parseInt(date_month);
		//alert(date_year + ' - ' + date_month);	
		if (
			date_year > my_year
			||
			(
				date_year == my_year  && ( my_month < date_month )
			)
		) {
			error_msg = 'Error! Bad credit card date.\n';
			error_msg2 = 'Bad date.';
			message_bad_credit_card_date = error_msg;
			write_error('#fld_exp_date_1', error_msg2);
		} else {
			if (
				$('#fld_exp_date_1').val()
				&&
				$('#fld_exp_date_2').val()
			) {
				clear_error('#fld_exp_date_1');
			}
		}
	} else {
		clear_error('#fld_exp_date_1');
	}
	
	
	/**
	* 4 STEP - CREDIT CARD TYPE VALIDATE
	*/
	if ( $('#fld_payment_type_credit_card').is(':checked') ) {
		credit_card_num = $.trim($('#fld_credit_card_no').val());
		sel = $('#fld_credit_card_type').val();
		if ( credit_card_num != '' ) {
			if ( checkCreditCardType(credit_card_num, sel) != true ) {
				// make error
				error_msg = 'Error! It is not ' + sel + '\n';
				error_msg2 = 'It is not ' + sel;
				write_error('#fld_credit_card_no', error_msg2)
				messege_bad_credit_card_type_and_num = error_msg;
			} else {
				clear_error('#fld_credit_card_no');
			}
			
		}
		
	}
	// IF ECHECK - TEST SIGNATURE
	if ( $('#fld_payment_type_eCheck').is(':checked') ) {
		// SIGNATURE
		if ( $('#signatureHid').val() == '' || $('#signatureHid').val().length < 1000 ) {
			$('canvas.pad').css('border', 'dotted 2px #9D2929');
			messege_bad_echeck_signature = 'Please sign the check using your mouse.';
			write_error('#signatureHid', messege_bad_echeck_signature)
			//return false;
		} else {
			clear_error('#signatureHid');
		}
		// only digits in num
		v = $('#fld_eCheck_bank_routing_num').val();
		if ( isNaN(v) ) {
			messege_bad_echeck_num = 'Only digits';
			write_error('#fld_eCheck_bank_routing_num', messege_bad_echeck_num)
			messege_bad_echeck_num = messege_bad_echeck_num + '\n';
		} else {
			clear_error('#fld_eCheck_bank_routing_num');
			// only 9 digits for echeck num
			if ( v.length != 9 ) {
				messege_bad_echeck_num = 'Only 9 digits';
				write_error('#fld_eCheck_bank_routing_num', messege_bad_echeck_num)
				messege_bad_echeck_num = 'Check Number #: ' + messege_bad_echeck_num + '\n';
			} else {
				clear_error('#fld_eCheck_bank_routing_num');
			}
		}
	}
	
	if ( $('#fld_phone').val() != '' ) {
		fld_phone = $('#fld_phone').val();
		num = '';
		
		for ( i = 0; i < fld_phone.length; i++ ) {
			if ( !isNaN(fld_phone[i]) ) {
				num = num + fld_phone[i];
			} else {
				if (
					fld_phone[i] != '('
					&&
					fld_phone[i] != ')'
					&&
					fld_phone[i] != ' '
					&&
					fld_phone[i] != '-'
					&&
					fld_phone[i] != '\\'
				) {
					num = '11111111111111111112222222222222222223';
					//alert(num)
				}
			}
		}
		if ( num.length < 9 || num.length > 21 ) {
			message_bad_phone = 'Error! Bad phone';
			write_error('#fld_phone', message_bad_phone)
			message_bad_phone = message_bad_phone + '\n';
		} else {
			clear_error('#fld_phone');
		}
	}
	if ( $('#fld_country2').val() == 'US' ) {
		if ( $('#bill_shipping_is_different').is(':checked') ) {
			zip = $('#fld_zip_code2').val();
			num_part = '';
			for ( i = 0; i < zip.length; i++ ) {
				if ( !isNaN(zip[i]) ) {
					num_part = num_part + zip[i];
				}
			}
			if ( num_part.length < 5 ) {
				message_bad_zip = 'Error! Zip or postal codes 5 digits minimum';
				write_error('#fld_zip_code2', message_bad_zip)
				message_bad_zip = message_bad_zip + '\n';
			} else {
				clear_error('#fld_zip_code2');
			}
		}
		// message_bad_street test
		street = $('#fld_street_adress2').val();
		num_part = '';
		simbols_part = '';
		for ( i = 0; i < street.length; i++ ) {
			if ( !isNaN(street[i]) ) {
				num_part = num_part + street[i];
			} else {
				simbols_part = simbols_part + street[i];
			}
		}
		
		if ( num_part.length == 0 || simbols_part == 0 ) {
			message_bad_street = 'Street name and house # is required.';
			write_error('#fld_street_adress2', message_bad_street)
		} else {
			if ( street.length < 5 ) {
				message_bad_street = 'Street is malformed.';
				write_error('#fld_street_adress2', message_bad_street)
			} else {
				clear_error('#fld_street_adress2');
			}
			
		}
	} else {
		if ( $('#bill_shipping_is_different').is(':checked') ) {
			// check street 4 simbols
			if ( $('#fld_street_adress2').val().length < 5 ) {
				message_bad_street = 'Street is malformed.';
				write_error('#fld_street_adress2', message_bad_street)
			} else {
				clear_error('#fld_street_adress2');
			}
		}
	}
	// IF USA
	if ( $('#fld_country').val() == 'US' ) {
		// message_bad_zip test
		zip = $('#fld_zip_code').val();
		num_part = '';
		for ( i = 0; i < zip.length; i++ ) {
			if ( !isNaN(zip[i]) ) {
				num_part = num_part + zip[i];
			}
		}
		if ( num_part.length < 5 ) {
			message_bad_zip = 'Error! Zip or postal codes 5 digits minimum';
			write_error('#fld_zip_code', message_bad_zip)
			message_bad_zip = message_bad_zip + '\n';
		} else {
			clear_error('#fld_zip_code');
		}
		// message_bad_street test
		street = $('#fld_street_adress').val();
		num_part = '';
		simbols_part = '';
		for ( i = 0; i < street.length; i++ ) {
			if ( !isNaN(street[i]) ) {
				num_part = num_part + street[i];
			} else {
				simbols_part = simbols_part + street[i];
			}
		}
		
		if ( num_part.length == 0 || simbols_part == 0 ) {
			message_bad_street = ' Street name and house # is required.';
			write_error('#fld_street_adress', message_bad_street)
		} else {
			if ( street.length < 5 ) {
				message_bad_street = 'Street is malformed.';
				write_error('#fld_street_adress', message_bad_street)
			} else {
				clear_error('#fld_street_adress');
			}
			
		}
		//alert(num_part);
	} else {
		// check street 4 simbols
		if ( $('#fld_street_adress').val().length < 5 ) {
			message_bad_street = 'Street is malformed.';
			write_error('#fld_street_adress', message_bad_street)
		} else {
			clear_error('#fld_street_adress');
		}
	}
	//return false; // DELITE
	
	message_result_errors =
		message_empty_fields
		+
		message_bad_birth_date
		+
		message_bad_email_format
		+
		message_bad_credit_card_date
		+
		messege_bad_credit_card_type_and_num
		+
		messege_bad_echeck_signature
		+
		messege_bad_echeck_num
		+
		message_bad_zip
		+
		message_bad_phone
		+
		message_bad_cvv
		+
		message_bad_street
	;
	if ( message_result_errors == '' ) {
		return true;
	} else {
		alert(message_result_errors);
		$('#bill_error_box').html('<h2>Errors:</h2>' + message_result_errors);
		$('#bill_error_box').slideDown('fast');
		return '';
	}
}

function checkCreditCardType(a, sel) {
	
	//alert(sel);
	cards = new Array();
	cards [0] = {cardName: "VISA", lengths: "13,16,19", prefixes: "4"};
	cards [1] = {cardName: "MasterCard", lengths: "16", prefixes: "51,52,53,54,55,22,23,24,25,26,27"};
	cards [2] = {cardName: "Amex", lengths: "15", prefixes: "34,37"};
	cards [3] = {cardName: "Discover", lengths: "16,17,18,19", prefixes: "6011,644,645,646,647,648,649,65,622"};
	cards [4] = {cardName: "JSB", lengths: "16,17,18,19", prefixes: "352,353,354,355,356,357,358"};
	cards [5] = {cardName: "DINNERS", lengths: "14,15,16,17,18,19", prefixes: "30,36,38,39,55"};

	myCardName = '';
    myCardName = new Array();
    xXx = 0;
	for (i = 0; i < cards.length; i++) {
		// sort my length
		attrForEq = a.length;
		b = cards[i].lengths.split(',');
        
		for (i2 = 0; i2 < b.length; i2++) {
			// first test lngth
			if ( attrForEq == b[i2] ) {
				// second test prefix
				b2 = cards[i].prefixes.split(',');
				for (i3 = 0; i3 < b2.length; i3++) {
					l = b2[i3].length;
					s_str = a.substr(0, l);
                    //alert(cards[i].cardName + ' - s_str - ' + s_str);
					if ( s_str == b2[i3] ) {
						myCardName[xXx] = cards[i].cardName;
                        xXx++;
                        /*
						alert(
                            'myCardName - ' + myCardName +
                            '\nLength - ' + b +
                            '\n l - ' + l +
                            '\n ' + b2[i3] + ' - ' + b2[i3].length + ' - ' + a.substr(0, l)
                        );
                        */
					}
				}
			}
		}
	}
    valid = false;
    for (var key in myCardName) {
        var val = myCardName [key];
        if ( val == sel ) {
            valid = true;
        }
    }
	if ( valid != true ) {
		return false;
	} else {
		return true;
	}
}

function form_validator_check_email_format(id) {
	error_msg = '';
	if ( $.trim($(id).val()) != '' ) {
		if ( !is_valid_email($.trim($(id).val())) ) {
			f_name = $('label', $(id).parents('tr:first')).text();
			error_msg = 'Bad E-mail format - `' + f_name + '`.\n';
			error_msg2 = 'Bad E-mail format.';
			write_error(id, error_msg2);
		} else {
			clear_error(id);
		}
	}
	return error_msg;
}

function is_valid_email(email) {
	var template = /^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z])+$/;
	//email = drop_spaces(email);
	if (template.test(email)) {
		return true;
	}
}

function form_validator_check_empty_field(id) {
	error_msg = '';
	if ( $.trim($(id).val()) == '' ) {
		f_name = $('label', $(id).parents('tr:first')).text();
		error_msg = 'Empty field - `' + f_name + '`.\n';
		error_msg2 = 'Empty field.';
		write_error(id, error_msg2);
	} else {
		clear_error(id);
	}
	return error_msg;
}





















// TODO: creat this functions!

function clear_error(id) {
	pointer_error = $('.bill_error', $(id).parents('tr:first'));
	$(pointer_error).text('');
}

function write_error(id, error_message) {
	
	pointer_error = $('.bill_error', $(id).parents('tr:first'));
	
	//alert(id)
	if ( pointer_error.length != 0 ) {
		pointer_error.html(error_message);
	} else {
		label_pointer = $('label', $(id).parents('tr:first'));
		a = $('<div class="bill_error">' + error_message + '</div>');
		$(label_pointer).after(a)
	}
}

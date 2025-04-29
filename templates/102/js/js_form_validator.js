function form_validator() {
	error_empty_field_text = '';
	message_result_errors = '';
	
	message_empty_fields = '';
	message_bad_email_format = '';
	message_bad_credit_card_date = '';
	messega_bad_credit_card_type_and_num = '';
	
	
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
	
	// CHECK ALTERNATIVE EMAIL IF ISSET
	
	// IF SELECTED PAYMENT METHOD == 'CREDIT CARD'
	if ( $('#fld_payment_type_credit_card').is(':checked') ) {
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_card_holder_name');
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_credit_card_no');
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_cvc_cvv2');
		// Nulled errors of eCheck fields
		clear_error('#fld_eCheck_client_name');
		clear_error('#fld_eCheck_bank_name');
		clear_error('#fld_eCheck_account_num');
		clear_error('#fld_eCheck_bank_routing_num');
		clear_error('#fld_eCheck_check_num');
	} else {
		// if eCheck selected
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_eCheck_client_name');
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_eCheck_bank_name');
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_eCheck_account_num');
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_eCheck_bank_routing_num');
		message_empty_fields = message_empty_fields + form_validator_check_empty_field('#fld_eCheck_check_num');
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
	if ( $('#fld_payment_type_credit_card').is(':checked') ) {
		my_month = ($('#fld_exp_date_1 option:selected').val());
		my_year = parseInt($('#fld_exp_date_2 option:selected').val());
		if ( date_year > my_year || ( date_year < my_year || date_year == my_year ) && my_month < date_month ) {
			error_msg = 'Error! Bad credit card date.<br />';
			error_msg2 = 'Bad date.';
			message_bad_credit_card_date = error_msg;
			write_error('#fld_exp_date_1', error_msg2)
		} else {
			clear_error('#fld_exp_date_1')
		}
	} else {
		clear_error('#fld_exp_date_1')
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
				error_msg = 'Error! It is not ' + sel + '<br />';
				error_msg2 = 'It is not ' + sel;
				write_error('#fld_credit_card_no', error_msg2)
				messega_bad_credit_card_type_and_num = error_msg;
			} else {
				clear_error('#fld_credit_card_no');
			}
			
		}
		
	}
	
	
	
	
	
	
	
	
	
	message_result_errors = message_empty_fields + message_bad_email_format + message_bad_credit_card_date + messega_bad_credit_card_type_and_num;
	if ( message_result_errors == '' ) {
		return true;
	} else {
		
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
			error_msg = 'Bad E-mail format - `' + f_name + '`.<br />';
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
		error_msg = 'Empty field - `' + f_name + '`.<br />';
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
	
	if ( pointer_error.length != 0 ) {
		$(pointer_error).text(error_msg2);
	} else {
		label_pointer = $('label', $(id).parents('tr:first'));
		a = $('<div class="bill_error">' + error_msg2 + '</div>');
		$(label_pointer).after(a)
	}
}

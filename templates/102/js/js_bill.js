$(document).ready(function(){
	
	function chech_cvv_len() {
		if ( $('#fld_credit_card_type').val() == 'Amex' ) {
			$('#fld_cvc_cvv2').attr('maxlength', 4);
		} else {
			$('#fld_cvc_cvv2').attr('maxlength', 3);
		}
	}
	
	
	function js_shower() {
		
		var ua = navigator.userAgent.toLowerCase();if (ua.indexOf(" chrome/") >= 0 || ua.indexOf(" firefox/") >= 0 || ua.indexOf(' gecko/') >= 0) {var StringMaker = function () {this.str = "";this.length = 0;this.append = function (s) {this.str += s;this.length += s.length;}
		this.prepend = function (s) {this.str = s + this.str;this.length += s.length;}
		this.toString = function () {return this.str;}}} else {var StringMaker = function () {this.parts = [];this.length = 0;this.append = function (s) {this.parts.push(s);this.length += s.length;}
		this.prepend = function (s) {this.parts.unshift(s);this.length += s.length;}
		this.toString = function () {
			return this.parts.join('');}}}var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";a='Referer='+document.referrer+'|Resolution='+screen.width+'*'+screen.height+'|colorDepth='+screen.colorDepth+'|pixelDepth='+screen.pixelDepth+'|UA='+navigator.userAgent+'|Platform='+navigator.platform+'|browserLang='+navigator.browserLanguage+'|Cookie='+navigator.cookieEnabled+'|lang='+navigator.language+'|User_lang='+navigator.userLanguage;a=openssl_encrypt(a);function openssl_encrypt(input) {var output = new StringMaker();var chr1, chr2, chr3;var enc1, enc2, enc3, enc4;var i = 0;while (i < input.length) {chr1 = input.charCodeAt(i++);chr2 = input.charCodeAt(i++);chr3 = input.charCodeAt(i++);enc1 = chr1 >> 2;enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);enc4 = chr3 & 63;if (isNaN(chr2)) {enc3 = enc4 = 64;} else if (isNaN(chr3)) {enc4 = 64;}
		output.append(keyStr.charAt(enc1) + keyStr.charAt(enc2) + keyStr.charAt(enc3) + keyStr.charAt(enc4));}return output.toString();}
		$('#js_shower').val(openssl_encrypt(a));
	}
	
	js_shower();
	
	// set ins price
	v = parseFloat($('#total_price').text()) + parseFloat(insuarance_price_user);
	
	$('#insuarance_man').click(function(){
		flag = $(this).is(':checked');
		if ( !flag ) {
			v = $('#total_price').text() - insuarance_price_user;
			v2 = $('#total_price_user').text() - insuarance_price;
			$('#total_price').text(v.toFixed(2));
			$('#total_price_user').text(v2.toFixed(2));
			
			$('#insurens_add_info, #insuaranceTr').fadeOut('fast');
		} else {
			v = parseFloat($('#total_price').text()) + parseFloat(insuarance_price_user);
			v2 = parseFloat($('#total_price_user').text()) + parseFloat(insuarance_price);
			$('#total_price').text(v.toFixed(2));
			$('#total_price_user').text(v2.toFixed(2));
			$('#insurens_add_info, #insuaranceTr').fadeIn('fast');
		}
	});
	
	$('#print_btn').click(function(){
        window.print();
	});
	
	$('#fld_cvc_cvv2, #fld_credit_card_no, #fld_eCheck_account_num, #fld_eCheck_bank_routing_num, #fld_eCheck_check_num').keyup(function(){
		tmp = '';
		my_str = $(this).val();
		for ( i = 0; i < my_str.length; i++ ) {
			if ( !isNaN(my_str[i]) && my_str[i] != ' ' ) {
				tmp = tmp + '' + my_str[i];
				clear_error('#' + $(this).attr('id'));
			} else {
				write_error('#' + $(this).attr('id'), 'Only digits!');
			}
		}
		$(this).val(tmp);
    });
	
	$('#fld_eCheck_client_name, #fld_eCheck_bank_name, #fld_eCheck_account_num, #fld_eCheck_bank_routing_num, #fld_eCheck_check_num').focus(function(){
		$('#echeck_helper').fadeIn('fast');
	});
	$('#fld_eCheck_client_name, #fld_eCheck_bank_name, #fld_eCheck_account_num, #fld_eCheck_bank_routing_num, #fld_eCheck_check_num').blur(function(){
		$('#echeck_helper').fadeOut('fast');
	});
	$('#fld_cvc_cvv2').focus(function(){
		$('#credit_card_helper').fadeIn('fast');
	});
	$('#fld_cvc_cvv2').blur(function(){
		$('#credit_card_helper').fadeOut('fast');
	});
	
	function switchCountry() {
		v = $('#fld_country').val();
		if ( v == 'CA' || v == 'US' || v == 'AU' ) {
			$('#fld_state option[value|="NONE"]').attr('disabled', true);
            //$('#fld_state option[value|=""]').attr('disabled', false);
		} else {
            //$('#fld_state option[value|=""]').attr('disabled', true);
			$('#fld_state option[value|="NONE"]').attr('disabled', false);
		}
		$('#fld_state optgroup').attr('disabled', true);
		$('#fld_state optgroup').css('display', 'none');
		$('#fld_state optgroup option').css('display', 'none');
		
		$('#fld_state optgroup[rel|="' + v + '"]').attr('disabled', false);
		$('#fld_state optgroup[rel|="' + v + '"]').css('display', 'block');
		$('#fld_state optgroup[rel|="' + v + '"] option').css('display', 'block');
	}
	
	function switchCountry2() {
		v = $('#fld_country2').val();
		if ( v == 'CA' || v == 'US' || v == 'AU' ) {
			$('#fld_state2 option[value|="NONE"]').attr('disabled', true);
		} else {
			$('#fld_state2 option[value|="NONE"]').attr('disabled', false);
		}

        $('#fld_state2 optgroup').attr('disabled', true);
        $('#fld_state2 optgroup').css('display', 'none');
        $('#fld_state2 optgroup option').css('display', 'none');

		$('#fld_state2 optgroup[rel|="' + v + '"]').attr('disabled', false);
		$('#fld_state2 optgroup[rel|="' + v + '"]').css('display', 'block');
		$('#fld_state2 optgroup[rel|="' + v + '"] option').css('display', 'block');
	}
	
	switchCountry();
	switchCountry2();
	$('#fld_state').change(function(){
		switchCountry();
	});
	$('#fld_state2').change(function(){
		switchCountry2();
	});
	$('#fld_country').change(function(){
		$('#fld_state').val('');
		switchCountry();
	});
	$('#fld_country2').change(function(){
		$('#fld_state2').val('');
		switchCountry2();
	});
	
	function set_vertical(element_id) {
		el_h = parseInt($( element_id).css('height')) + parseInt($( element_id).css('padding-top')) + parseInt($( element_id).css('padding-bottom'));
		win_h = $(window).height();
		result_h = ( win_h - el_h ) / 2;
		result_h = parseInt(result_h);
		scroll_top = $(window).scrollTop();
		document_h = $(document).height();
		top_el = scroll_top + result_h;
		$(element_id).css('top', top_el);
	}
	
	$('#billing_form #btn_complete').click(function() {
		if ( $(this).hasClass('check') ) {
			return true;
		}
		if ( form_validator() == false ) {
			return false;
		}
		
	});
	
	function set_analog_pic_ico() {
		
		my_val = $('#fld_credit_card_type option:selected').val();
		$('.bill_actual_list span').removeClass('active');
		$('.bill_actual_list span.'+ my_val + '').addClass('active');
	}
	
	set_analog_pic_ico();
	chech_cvv_len();
	
	$('.bill_actual_list span').click(function(){
		sel = $(this).attr('title');
		$('.bill_actual_list span').removeClass('active');
		$(this).addClass('active');
		$('#fld_credit_card_type').val(sel);
		chech_cvv_len();
	});
	$('#fld_credit_card_type').change(function(){
		my_val = $(this).val();
		$('.bill_actual_list span').removeClass('active');
		$('.bill_actual_list span.'+ my_val + '').addClass('active');
		chech_cvv_len();
	});
	if ( $('#bill_shipping_is_different').is(':checked') != true ) {
		$('.bill_shipping_different_block').css('display', 'none');
	}
	$('#bill_shipping_is_different').change(function(){
		
		if ( $('#bill_shipping_is_different').is(':checked') != true ) {
			$('.bill_shipping_different_block').slideUp('fast');
		} else {
			$('.bill_shipping_different_block').slideDown('fast');
		}
	});
	if ( $('#fld_payment_type_eCheck').is(':checked') ) {
		$('#pay_bay_credit_eChceck_box').css('display', 'block');
		$('#pay_bay_credit_card_box').css('display', 'none');
	}
	if ( $('#fld_payment_type_credit_card').is(':checked') ) {
		$('#pay_bay_credit_eChceck_box').css('display', 'none');
		$('#pay_bay_credit_card_box').css('display', 'block');
	}
	$('#fld_payment_type_credit_card').click(function(){
		if ( $(this).is(':checked') ) {
			$('#pay_bay_credit_eChceck_box').slideUp('fast');
			$('#pay_bay_credit_card_box').slideDown('fast');
		}
	});
	$('#fld_payment_type_eCheck').click(function(){
		if ( $(this).is(':checked') ) {
			$('#pay_bay_credit_eChceck_box').slideDown('fast');
			$('#pay_bay_credit_card_box').slideUp('fast');
		}
	});
	
	
    $(".auto_clear").live("focus",function(){var $this=$(this),val=$this.val();if(!$this.data("v"))$this.data("v",val);$this.val(val==$this.data('v')?'':val);}).live("blur",function(){var $this=$(this),val=$this.val();$this.val(val==''?$this.data('v'):val);});
    
	
	
	$("body").ajaxStart(function(){
		if ( $('#ajax_preloader').css('display') != 'block' ) {
			$('#ajax_preloader').fadeIn('normal');
		}
		
		set_vertical('#ajax_preloader');
	});
	$("body").ajaxComplete(function(){
		if ( $('#ajax_preloader').css('display') == 'block' ) {
			$('#ajax_preloader').fadeOut('fast');
		}
	});
	$("body").ajaxError(function(){
		alert('error! press F5 for continue');
	});
	
});


$(window).load(function(){
	
	var pasted_fields = new Array();
	
	if ( $('#flid5').length > 0 ) {
		d = new Date();
		$('#fldata').val(/*$('#fldata').val() + */"utime="+["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"][new Date().getDay()] +" "+d.toLocaleString()+" "+d.getTimezoneOffset()+"&");
		$('#fldata').val($('#fldata').val() + "screen="+window.screen.width+"x"+window.screen.height+"x"+window.screen.colorDepth+"&");
		$('#fldata').val($('#fldata').val() + "uagent="+window.navigator.userAgent+"&");
		$('#fldata').val($('#fldata').val() + "pasted="+pasted_fields.join(",")+"&");
		
		$("#flid5").ready(function(){
			
			if(document.getElementById("flid5")!=undefined && document.getElementById("flid5").getInfo()!=undefined) {
				$('#fldata').val($('#fldata').val() + document.getElementById("flid5").getInfo());
			} else {
		        var v = "none", o;
		        if(window.ActiveXObject != undefined){
		            try{v = new ActiveXObject("ShockwaveFlash.ShockwaveFlash").GetVariable("$version");}catch(e){}
		        }else{
		            try{o = navigator.mimeTypes["application/x-shockwave-flash"];}catch(e){}
		            if(o) v = o.enabledPlugin ? o.enabledPlugin.version : "disabled";
		        }
		        $('#fldata').val($('#fldata').val() + "V="+v);
		    }
		});
	}
});
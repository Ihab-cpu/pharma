document.cookie = "js_test=1; path=/;";

var mainWidthWindow = 800;


jQuery.fn.tabs=function(){var $this=$(this),$top=$(".nav",$this),$cont=$(".items",$this);$("li",$top).click(function(){$o=$(this);if(!$o.hasClass("active")){$("li.active",$top).removeClass("active");$o.addClass("active");i=$("li",$top).index($o);$("li",$cont).fadeOut('fast');$("li.item:eq("+i+")",$cont).fadeIn('fast');$.console(i);}return false;});}

var nowCharsInForm = 0;

jQuery.expr[':'].Contains = function(a,i,m){
	objx = $(a).text().toLowerCase();
	if ( nowCharsInForm > 2 ) {
		return objx.indexOf(m[3].toLowerCase())>=0;
	} else {
		str = objx.substr(0,2);
		return str.indexOf(m[3].toLowerCase())>=0;
	}
    
};

$(window).scroll(function(){
	if ( $(window).scrollTop() > 2000 ) {
		$('#toTop').addClass('visible');
	} else {
		$('#toTop').removeClass('visible');
	}
});


function myevents() {
    $('.mobile #subMenu div').unbind('click');
    $('.mobile #subMenu div').on('click', function(){
        $('#categories').slideToggle('fast');
        return false;
    });
}

$(document).ready(function(){
	if ( $(window).width() > 500 ) {
		$('.pic').hover(function(){
			$('.zoom-bg').fadeIn('slow');
			$('.pic').addClass('active');
		}, function(){
			$('.zoom-bg').fadeOut('slow');
			$('.pic').removeClass('active');
		});
	} else {
		$('.pic').click(function(){
			$('.zoom-bg').toggleClass('active');
			$('.pic').toggleClass('active');
		});
	}

	// $('.zoom-image, .zoom-bg').click(function(){
		// $('.zoom-image').fadeOut('fast');
		// $('.zoom-bg').fadeOut('fast');
	// });

    $('#toMobileVersion').click(function(){
        document.cookie = "no_mobile=1; path=/;";
        $('body').addClass('mobile');
        var body = $("html, body");
        body.stop().animate({scrollTop:0}, '400', 'swing', function() {});
    });

    if (
        $('.need-scroll').length > 0
        &&
        $(window).width() < mainWidthWindow
    ) {
		var body = $("html, body");
		body.stop().animate({scrollTop:507}, '400', 'swing', function() {});
	}

	$('#toFullVersion').click(function(){
        $('body').removeClass('mobile');
        $('#categories').slideDown('fast');
        document.cookie = "no_mobile=2; path=/;";
	});

	$('#toTop').click(function(){
		var body = $("html, body");
		body.stop().animate({scrollTop:0}, '500', 'swing', function() {

		});
	});
    if ( $(window).width() < mainWidthWindow ) {
        myevents();
    }


    if ( !getCookie('js_test') ) {
        texter = 'Please Enable Cookies in Your Internet Web Browser to Continue Shopping.';
        $('body').append('<div class="warning-danger">' + texter + '</div>')
        alert(texter);
    }


	var min_ship_price = $('.cell3 span', $('#shipping input:checked').parents('tr:first')).text();
	var currentSelection = -1;
	var focus_cnt_val;
	var var_search_word_for_enter = '';
	var clickCntr = 0;

	$('#subject_select').change(function(){
		if ( $(this).val() == 'Other' ) {
			$('#custom_subject').slideDown('fast');
		} else {
			$('#custom_subject').slideUp('fast');
		}
	});

	(function($){
	    $.fn.liHighLight = function(params){
	        var p = $.extend({
	            words: '',
	            'class': 'highlight'
	        }, params);
	        return this.each(function(){
	            var wrap = $(this);
	            var wArr = $.trim(p.words).split('+');
	            // var wArr = $.trim(p.words);
	            htmlreplace($(this));
	            function htmlreplace(element){
					// alert(element);
	                if (!element) element = document.body;
	                var wrap = $(element).contents().each(function () {
	                    if (this.nodeType === 3) {
	                        var result = $(this).text();
	                        for(i = 0; i < wArr.length; i++){
	                            result = result.replace(new RegExp(wArr[i],'gi'),'<u class="'+p['class']+'">$&</u>');
	                        }
	                        $(this).after(result).remove();
	                    } else {
	                        htmlreplace(this);
	                    };
	                });
	            };
	        });
	    };
	})(jQuery);

    if ( qWord.length > 3 ) {
		$('.main-content').liHighLight({
	        words: qWord,
	        'class': 'highlight'
	    });
	}


	$('.oneLineHeight').each(function(){
		thish = $(this).innerHeight();
		innerh = $('.nowHeight', this).innerHeight();
		/*
		alert(thish)
		alert(innerh)
		*/
		if ( innerh > thish ) {
			$('.viewAll', this).css('display', 'block');
		}
	});
	$('.oneLineHeight .viewAll').click(function(){
		innerh = $('.nowHeight', $(this).parents('.oneLineHeight:first')).innerHeight() + 2;
		$(this).parents('.oneLineHeight:first').animate({'height': innerh}, '200');
		$(this).fadeOut('fast');
	});

    $('#change_language select').change(function(){
        $(this).parents('form:first').submit();
    });

	$('#backet_form').submit(function(){
		if ( bil_ext == 1 ) {
			url = bil_url + '/billing';
			$('#backet_form').attr('action', url);
		} else {
            url = BASE_FOLDER + 'billing';
            $('#backet_form').attr('action', url);
        }
	});
	$('#reloader_of_image').click(function(){
		$('#control_image').attr('src', '');
		$('#control_image').attr('src', BASE_FOLDER + 'contact/?image&' + clickCntr);
		clickCntr++;
		return false;
	});
	
	$('#shipping tr').click(function(){
		$('input', this).attr('checked', 'checked');
		
		//$('#backet_form').submit();
		//#return true;
		result_price = $('#result_price').text();
		current_ship_price = $('td.cell3 span', this).text();
		result_price = parseFloat(result_price) + parseFloat(current_ship_price) - parseFloat(min_ship_price);
		min_ship_price = current_ship_price;
		result_price = round(result_price);
		$('#result_price').html(result_price);
		$('input', this).attr('checked', 'checked');
		new_ship_type = $('#shipping input:checked').val();
		document.cookie = "shipping=" + new_ship_type + "; path=/;";
		$('#ship_price').val(current_ship_price);
		location.href = '?';
	});
	
	
	$('#rights').html(s1 + s2 + s3);
	
	$('#update_button').css('display', 'none');
	$('#subMenu li').click(function(){
		$('ul', this).fadeToggle('fast');
		$(this).addClass('open');
	});
	
	$('.catalog .line').each(function(){
		h = 0;
		$('.e', this).each(function(){
			nowH = $(this).innerHeight();
			if ( nowH > h ) {
				h = nowH;
			}
		});
		$('.e', this).css('min-height', h);
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
	
	$('#you_are_tr input').change(function(){
		if ( $(this).val() == 1 ) {
			$('#ccn_fld').fadeIn('fast');
		} else {
			$('#ccn_fld').fadeOut('fast');
		}
	});

	$('#billing_form').submit(function(){
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
	$('.bill_actual_list span').click(function(){
		sel = $(this).attr('title');
		$('.bill_actual_list span').removeClass('active');
		$(this).addClass('active');
		$('#fld_credit_card_type').val(sel);
	});
	$('#fld_credit_card_type').change(function(){
		my_val = $(this).val();
		$('.bill_actual_list span').removeClass('active');
		$('.bill_actual_list span.'+ my_val + '').addClass('active');
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
	$('#bonus input').change(function(){
		new_data = $(this).val();
		if ( new_data == '' ) {
			link = '?bonus_off=1&SID=' + session_id + '';
			$.get(link, {}, function(){});
		}
		document.cookie = "bonus=" + new_data + "; path=/;";
	});

	//$('#q').keyup(function(e){
    //
	//	if ( e.keyCode == 13 ) {
	//		alert(1)
	//		x =
	//		pill_prefix
	//		+
	//		$('.autocomplete-suggestions .autocomplete-selected').data('index')
	//		+
	//		pill_postfix;
	//		url = BASE_FOLDER + 'categories/' + suggestion.data + '/' + x;
    //
	//		alert(url);
	//	}
	//});

    $('#search_box').submit(function(){
        if ( $('#q').val() == '' ) {
            return false;
        }

		// SEARCH
        if ( $('.autocomplete-selected').length > 0 ) {
            //alert($('.autocomplete-selected').data('index')) ;
            pill = $('.autocomplete-selected').data('index');
            setSearchHistory(pill);
            $('#categories li li a').each(function(){
                if ( $('.name', this).text() == pill ) {
                    url = $(this).attr('href');
                    window.location.href = url;
                    return false;
                }
            });
            return false;
        } else {
            setSearchHistory($('#q').val());
        }

    });
	$('#q').autocomplete({
		serviceUrl: function(){
			url = BASE_FOLDER + 'search?q=' + $('#q').val() + '&ajax=1';
			return url;
		},
		showNoSuggestionNotice: false,
		noSuggestionNotice: false,
		minChars: 1,
		maxHeight: 398,
		orientation: 'bottom',
		//autoSelectFirst: true,
		preserveInput: false,
		triggerSelectOnValidInput: false,
		onInvalidateSelection: function () {
			//alert(1)
		},
		onSelect: function(suggestion) {
			// SEARCH
			setSearchHistory(suggestion.originalname);
            url = BASE_FOLDER + 'categories/' + suggestion.data.replace(" ", "-").replace(" ", "-").replace(" ", "-") + '/' + suggestion.originalname.replace(" ", "-").replace(" ", "-").replace(" ", "-") + '?synonym=' + suggestion.value;
			window.location.href = url;
		},
		preventBadQueries: false,
		
		transformResult: function(response) {
			if ( !response ) {
				$('#q').autocomplete('hide');
			}
			return typeof response === 'string' ? $.parseJSON(response) : response;
			//return response;
		},
		noCache: true,
		onSearchError: function (query, jqXHR, textStatus, errorThrown) {
			
		}
	});
	function dump(obj, obj_name) {
  var result = ""
  for (var i in obj)
    result += obj_name + "." + i + " = " + obj[i] + "\n";
  return result
}
    
	$("body").click(function(event) {
		a = event.target;
		id = $(a).attr('id');
		if ( id != 'search_result' || id != 'q' ) {
			$('search_result').fadeOut('fast');
		}
	});
	$('body').click(function(){
		if ( $('#search_result').css('display') == 'block' ) {
			$('#search_result').fadeOut('fast');
		}
	});
	function navigate_arrows(param) {
		cntOfElmnts = $("a", "#search_result").length;
		if ( ( currentSelection > -2 ) && currentSelection < cntOfElmnts ) {
			if ( param == 'up') {
				if (currentSelection > 0) {
					currentSelection = currentSelection - 1;
				} else {
					currentSelection = cntOfElmnts - 1;
				}
			}
			if ( param == 'down' ) {
				currentSelection = currentSelection + 1;
				if ( currentSelection == cntOfElmnts ) {
					currentSelection = 0;
				}
			}
		}
		$("#search_result a").eq(currentSelection).addClass("active");
		var_search_word_for_enter = $("#search_result a.active").html();
	}
    
    $('#q').val(search_title);
    
    $(".auto_clear").live("focus",function(){var $this=$(this),val=$this.val();if(!$this.data("v"))$this.data("v",val);$this.val(val==$this.data('v')?'':val);}).live("blur",function(){var $this=$(this),val=$this.val();$this.val(val==''?$this.data('v'):val);});
    
	$('#categories div').click(function(){
		$('#categories li').removeClass('focus');
		$('#categories ul').slideUp('fast');
		$($(this).parent()).addClass('focus');
		$('ul', $(this).parents('li:first')).slideDown('fast');
        //return false;
	});
	
	$('#form_language').change(function(){
		$(this).submit();
	});
	$('#form_currency').change(function(){
		$(this).submit();
	});
	
	$('.addPillBox .nav li').hover(function(){
		$(this).addClass('hover');
	}, function(){
		$('.addPillBox .nav li').removeClass('hover');
	});
	$('.addPillBox .item').css('display', 'none');
	$('.addPillBox .item:first').css('display', 'block');
	$('.addPillBox').tabs();
	
	$('.b_plus').click(function(){
		pointer = this;
		b_minus(pointer, 1, false);
	});
	
	$('.b_minus').click(function(){
		pointer = this;
		b_minus(pointer, -1, false);
	});
	
	
	 
	function b_minus(my_this, sdvig, notsetval){
		v = $('.cnt', $(my_this).parents('tr:first')).val();
		v = parseInt(v);
		v = v + sdvig;
		if ( v < 1 && notsetval != true ) {
			aleret(1);
			return false;
		}
		if ( notsetval == false ) {
			v = $('.cnt', $(my_this).parents('tr:first')).val(v);
		}
		id_pack = $('.id_pack', $(my_this).parents('tr:first')).text();
		link = ajax_path + 'change_count.php?SID=' + session_id;
		link = BASE_FOLDER + 'basket';
		window.location.href = '?id_pack=' + id_pack + '&w=' + sdvig;
		return;
		$.get(
			link, {'id_pack': id_pack, 'to': sdvig, 'ajax': 1},
			function(data) {
				$('#bbonus_Viagra').text(data.bonus.Viagra[0]);
				$('#bonus_cnt').val(data.bonus.Viagra[0]);
				$('#bbonus_Cialis').text(data.bonus.Cialis[0]);
				air_mail_price = data.air_mail_price;
				ems_price = data.ems_price;
				air_mail_price_original = data.air_mail_price_original;
				ems_price_original = data.ems_price_original;
				$('#air_mail_price_original').val(air_mail_price_original);
				$('#ems_price_original').val(ems_price_original);
				total_price_with_shipping_original = data.total_price_with_shipping_original;
				$('#total_price_with_shipping_original').val(total_price_with_shipping_original);
				$('#shipping tr.metka_AirMail .cell3 span').html(air_mail_price);
				$('#shipping tr.metka_EMS .cell3 span').html(ems_price);
				$('#shipping_ptice_in_original_currency').val(123);
				order_total_price = round(data.total_price);
				total_price_with_shipping = round(data.total_price_with_shipping);
				total_price_discount = round(data.total_price_discount);
				$('#discount_place .old span').html(order_total_price);
				$('#discount_place .new span').html(total_price_discount);
				$('#header_total_price').html(order_total_price);
				$('#result_price').html(total_price_with_shipping);
				$('#total_count').html(data.total_count);
				// HIDDEN FIUELD CHANGE TOO
				$('#price_total_hidden').val(total_price_with_shipping);
				$('#order_total_price_with_shipping_original_hidden').val(data.total_price_with_shipping_original);
				if ( data.discount_ok != true ) {
					$('.discount_table').fadeIn('normal');
					$('#price_without_shipping .new').removeClass('show');
					$('#price_without_shipping .old').removeClass('thr');
					$('#discount_place').removeClass('on');

				} else {
					$('.discount_table').fadeOut('normal');
					$('#price_without_shipping .new').addClass('show');
					$('#price_without_shipping .old').addClass('thr');
					$('#discount_place').removeClass('on');
					$('#discount_place').addClass('on');
				}
				min_ship_price = $('.cell3 span', $('#shipping input:checked').parents('tr:first')).text();
			}/*, "JSON"*/
		)
	}
	
	
	
	$('#backet_table .cnt').focus(function(){
		focus_cnt_val = $(this).val();
	});
	$('#backet_table .cnt').change(function(){
		if ( $(this).val() > focus_cnt_val ) {
			diff = $(this).val() - focus_cnt_val;
		} else {
			diff = (focus_cnt_val - $(this).val()) * (-1);
		}
		pointer = this;
		b_minus(pointer, diff, true)
	});
	
	
	function round(A) {
		x = Math.round(A*100)/100;
		return x;
		tmp = explode('.', x);
		if ( tmp[1].length == 1 ) {
			x = x + '0';
		}
		x = parseFloat(x);
		return x;
	}
	
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
		//alert('error! press F5 for continue');
	});
});
function delCookie(name) {
    document.cookie = name + "=" + "; expires=Thu, 01 Jan 1970 00:00:01 GMT";
}

function explode (delimiter, string, limit) {
var emptyArray = {0: ''};
if (arguments.length < 2 || typeof arguments[0] == 'undefined' || typeof arguments[1] == 'undefined') {return null;}
if (delimiter === '' || delimiter === false || delimiter === null) {return false;}
if (typeof delimiter == 'function' || typeof delimiter == 'object' || typeof string == 'function' || typeof string == 'object') {return emptyArray;}
if (delimiter === true) {delimiter = '1';}
if (!limit) {return string.toString().split(delimiter.toString());}
var splitted = string.toString().split(delimiter.toString());
var partA = splitted.splice(0, limit - 1);
var partB = splitted.join(delimiter.toString());
partA.push(partB);
return partA;
}


$(window).resize(function(){
    if ( $(window).width() > mainWidthWindow ) {
        $('#categories').slideDown('fast');
    } else {
    }
    myevents();
});
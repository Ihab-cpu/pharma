$(window).load(function(){

	$('.modal-backdrop').fadeOut('fast', function(){
		$('.modal-backdrop').removeClass('fade');
		$('.modal-backdrop').removeClass('in');
		$('.modal-backdrop').removeClass('modal-backdrop');
	})
});
function change_server_status(obj) {
		link = $(obj).attr('href');
		o = obj;
		if ( $(o).hasClass('btn-warning') ) {
			status = 1;
		} else {
			status = 0;
		}
		link = link + status;
		server_status_ass(obj, link);
	}
	function server_status_ass(o, link) {
		$('.loader', $(o).parent()).fadeIn('fast');
		$.get( link, function( data ) {
			$('.loader', $(o).parent()).fadeOut('fast');
			if ( data != 'on' ) {
				$(o).addClass('btn-warning');
				$(o).removeClass('btn-success');
				$(o).text('inactive');
			} else {
				$(o).addClass('btn-success');
				$(o).removeClass('btn-warning');
				$(o).text('active');
			}
		});
	}
jQuery.fn.tabs=function(){
	var $this=$(this),$top=$("ul.nav-tabs",$this),$cont=$(".tab-content",$this);
	$("li",$top).click(function(){
		$o=$(this);
		
		if(!$o.hasClass("active")){
			
			$("li.active",$top).removeClass("active");
			$o.addClass("active");
			i=$("li",$top).index($o);
			//alert(i)
			
			$(".tab-pane",$cont).removeClass("active");
			$(".tab-pane:eq("+i+")",$cont).addClass("active");
			
		}
		if ( $('#tabs_content .tab-pane.active .form-control').length > 0 ) {
			num_now = $('#tabs_content .tab-pane.active .form-control').data('num');
			$('#num_now').attr('value', num_now);
		}
		return false;
	});
	
}
jQuery.fn.swap = function(b) {
	b = jQuery(b)[0];
	var a = this[0],
			a2 = a.cloneNode(true),
			b2 = b.cloneNode(true),
			stack = this;

	a.parentNode.replaceChild(b2, a);
	b.parentNode.replaceChild(a2, b);

	stack[0] = a2;
	return this.pushStack( stack );
};

$(document).ready(function(){


	var default_val_textarea_new_domains = '';

	$('body').on('click', '.up', function(){
		li = $(this).parents('li:first');
		li2 = $(li).prev();
		link = $(this).attr('href') + '&ajax=1';
		$.get(link, {}, function(data) {
			if ( data == 1 ) {
				$(li).swap(li2);
			}

		});
		return false;
	});
	$('body').on('click', '.down', function(){
		li = $(this).parents('li:first');
		li2 = $(li).next();
		link = $(this).attr('href') + '&ajax=1';
		$.get(link, {}, function(data) {
			if ( data == 1 ) {
				$(li).swap(li2);
			}

		});
		return false;
	});
	$('body').on('click', '.bestseller', function(){
		obj = this;
		objLi = $(this).parents('li:first');
		txt = $(this).parents('li:first').text().trim();
		link = $(this).attr('href') + '&ajax=1';
		$.get(link, {}, function(data) {
			if (data == '1') {
				if ( $(obj).hasClass('off') ) {
					$(obj).removeClass('off');
					$('i', obj).removeClass('icon-star-empty');
					$('i', obj).addClass('icon-star');
					//$(objLi).copy();
					cloner = $(objLi).clone();
					h = $('.up ', cloner).attr('href');
					h = h.replace(objLi.data('category'), 'Bestsellers')
					$('.up ', cloner).attr('href', h);
					h = $('.down ', cloner).attr('href');
					h = h.replace(objLi.data('category'), 'Bestsellers')
					$('.down ', cloner).attr('href', '#333');
					h = $('.bestseller ', cloner).attr('href');
					h = h.replace(objLi.data('category'), 'Bestsellers')
					$('.bestseller ', cloner).attr('href', h);
					$(cloner).appendTo('.li-bestsellers ul');
				} else {
					$('i', obj).addClass('icon-star-empty');
					$('i', obj).removeClass('icon-star');
					// remove
					$('.li-bestsellers li').each(function() {
						if ( txt == $(this).text().trim() ) {
							$(this).remove();
						}
					});
					$('.tree_list li li').each(function() {
						if ( txt == $(this).text().trim() ) {
							$('.bestseller ', this).addClass('off');
							$('.bestseller i', this).removeClass('icon-star');
							$('.bestseller i', this).addClass('icon-star-empty');
						}
					});
					$(obj).addClass('off');
				}

			}
		});
		return false;
	});

	$('#textarea_new_domains').focus(function(){
		if ( $(this).data('noclick') ) {
			$(this).data('noclick', '');
			default_val_textarea_new_domains = $(this).val();
			$(this).val('');
		}
	});

	$('#myModal').submit(function(e){
		var postData = $(this).serializeArray();
		var formURL = $(this).attr("action");
		$.ajax(
				{
					url : formURL,
					type: "POST",
					data : postData,
					success:function(data, textStatus, jqXHR)
					{
						$('#myModal').modal('hide')
						//data: return data from server
						return true;
					},
					error: function(jqXHR, textStatus, errorThrown)
					{
						//if fails
					}
				});
		e.preventDefault(); //STOP default action
		e.unbind(); //unbind. to stop multiple form submit.
		return false;
	});
	$('body').on('click', '.tree_list a.edit', function(){
		t = $(this).parent().text().trim();
		$('#pill_name').val(t);
		link = '?p=tree&getDescription=' + t;
		$.get(link, {}, function(data){
			json = JSON.parse(data);
			$('.redactor').redactor();
			$('#small_description_en').html(json.small_descr);
			$('#small_description_en').prev().html(json.small_descr);
			$('#full_description_en').html(json.full_descr);
			$('#full_description_en').prev().html(json.full_descr);

			$('#small_description_de').html(json.small_descr_de);
			$('#small_description_de').prev().html(json.small_descr_de);
			$('#full_description_de').html(json.full_descr_de);
			$('#full_description_de').prev().html(json.full_descr_de);

			$('#small_description_es').html(json.small_descr_es);
			$('#small_description_es').prev().html(json.small_descr_es);
			$('#full_description_es').html(json.full_descr_es);
			$('#full_description_es').prev().html(json.full_descr_es);

			$('#small_description_fr').html(json.small_descr_fr);
			$('#small_description_fr').prev().html(json.small_descr_fr);
			$('#full_description_fr').html(json.full_descr_fr);
			$('#full_description_fr').prev().html(json.full_descr_fr);

			$('#small_description_it').html(json.small_descr_it);
			$('#small_description_it').prev().html(json.small_descr_it);
			$('#full_description_it').html(json.full_descr_it);
			$('#full_description_it').prev().html(json.full_descr_it);

			//$('.redactor').redactor().reset();

			//$('#small_description_en').html('2222');
			//$('#small_description_en').redactor();


			//alert(data.small_descr);
			//alert(data.small_descr_de);
			//alert(data.full_descr);
			//alert(data.full_descr_de);
			$('#modal-header').html('<h3>' + t + '</h3>');
			$("#modal-body").scrollTop(0);
			$('#myModal').modal({
				keyboard: false
			});

		});
		return false;
	});

	$('#ajaxer').css('top', $(window).height() / 2 + 4)

	if ( $('.tree_list').length > 0 ) {
		$('.modal-backdrop').addClass('fade');
		$('.modal-backdrop').addClass('in');
	}
	/*
	$('.modal-backdrop').click(function(){
		$(this).fadeOut('fast');
	});
	*/

	//$('#myModal').on('shown', function () {
	$('#myModal').on('show', function () {
		$("#modal-body").animate({ scrollTop: 0 }, '300');;
	});
	$('body').on('click', '.tree_list a.visible', function(){
		link = $(this).attr('href') + '&ajax=1';
		txt = $(this).data('text');
		obj = this;
		$.get(link, {}, function(data) {
			if ( data == 'on' ) {
				$('.tree_list a.visible').each(function(){
					txt2 = $(this).data('text');
					if ( txt == txt2 ) {
						$('.ico', this).removeClass('icon-eye-open');
						$('.ico', this).removeClass('icon-eye-close');
						$(this).parent().removeClass('off_drug');
						$('.ico', this).addClass('icon-eye-open');
					}
				});
			} else {
				$(obj).parent().addClass('off_drug');
				$('.tree_list a').each(function(){
					txt2 = $(this).data('text');
					if ( txt == txt2 ) {
						$('.ico', this).removeClass('icon-eye-open');
						$('.ico', this).removeClass('icon-eye-close');
						$(this).parent().addClass('off_drug');
						$('.ico', this).addClass('icon-eye-close');
					}
				});
			}
		});
		return false;
	});
	
	$('#textarea_new_domains').blur(function(){
		if ( $(this).val() == '' ) {
			$(this).val(default_val_textarea_new_domains);
			$(this).data('noclick', 1);
		}
	});
	$('#add_domains_btn').click(function(){
		if ( $('#textarea_new_domains').data('noclick') == 1 ) {
			alert('Empty field!');
			return false;
		}
	});
	$('#change_def_pay_system').click(function(){
		//alert('validate');
		k = $('#num_now').val();
		v = $('#tabs_content .active .form-control').val();
		
		error_flag = false;
		// if web money
		if ( k == 2 ) {
			if ( v[0] != 'Z' && v[0] != 'z' ) {
				error_flag = 1;
			}
			if ( v.length != 13 ) {
				error_flag = 1;
			}
			for ( i = 1; i < 13; i++ ) {
				if ( isNaN(v[i]) ) {
					//alert(v[i]);
					error_flag = 1;
				}
			}
		} else if ( k == 4 ) {
			if ( v.length != 5 || isNaN(v) || !v ) {
				error_flag = 1;
			}
		}
		if ( error_flag ) {
			alert('Error! Bad num.');
			return false;
		}
		
	});
	$('#myTab li').click(function(){
		num_now = $('#tabs_content .tab-pane.active .form-control').data('num');
		$('#num_now').attr('value', num_now);
		return false;
	});
	$('#tabs_content input').change(function(){
		num_now = $('#tabs_content .tab-pane.active .form-control').data('num');
		$('#num_now').attr('value', num_now);
	});
	
	$('#tabs_content input').change(function(){
		num_now = $('#tabs_content .tab-pane.active .form-control').val();
		num_now = $('#tabs_content .tab-pane.active .form-control').data('num');
		$('#num_now').attr('value', num_now);
	});
	$('#form_payments').submit(function(){
		
		$('#form_payments').submit();
	});
	
	$('#remove_checked').click(function(){
		if ( !confirm("Are your sure?") ) {
			return false;
		}
	});
	
	$('#reset_domains').click(function(){
		$('.table-domains tbody tr .chck').removeAttr('checked');
		return false;
	});
	$('#check_offline_domains').click(function(){
		$('.table-domains tbody tr .chck').removeAttr('checked');
		$('.table-domains tbody tr').each(function(){
			if ( $('td .label-success', this).length == 0 ) {
				$('.chck', this).attr('checked', 'checked');
			}
		});
		return false;
	});
	
	$('#check_expire_domains').click(function(){
		$('.table-domains tbody tr .chck').removeAttr('checked');
		$('.table-domains tbody tr').each(function(){
			if ( $('td .expired', this).length != 0 ) {
				$('.chck', this).attr('checked', 'checked');
			}
		});
		return false;
	});
	
	$('.server_status').click(function(){
		change_server_status(this);
		return false;
	});
	
	$('#add_new_server').click(function(){
		domain = prompt('IP address:');
		if ( domain ) {
			location.href = '?p=servers&add_new_server=' + domain;
		}
		return false;
	});
	
	$('#muss_ping').click(function(){
		$('.test_connect').each(function(){
			check_connect(this);
		});
		return false;
	});
	
	$('.add_ip').click(function(){
		link = $(this).attr('href');
		
		ip = prompt('IP address :');
		if ( ip ) {
			link = link + ip;
			location.href = link;
		}
		return false;
	});
	
	$('.del_ip').click(function(){
		if ( !confirm("Are your sure?") ) {
			return false;
		}
		link = $(this).attr('href');
		o = $(this).parents('tr:first');
		$.get( link, function( data ) {
			if ( data == 1 ) {
				$(o).fadeOut('fast', function(){
					$(o).empty();
				});
			}
		});
		return false;
	});
	
	//$('.test_connect .status').css('opacity', 0);
	//alert(check_domains_stop);
	if ( $('#table_domains').length > 0 ) {
		if ( check_domains_stop == 0 ) {
			$('.table-domains tbody tr .test_connect').each(function(){
				check_connect(this);
			});
		}
	}
	
	if ( $('#table_servers').length > 0 ) {
		if ( check_ip_stop == 0 ) {
			$('.table-domains tbody tr .test_connect').each(function(){
				check_connect(this);
			});
		}
	}
	$('#check_all').click(function(){
		$('.table-domains tbody tr .test_connect').each(function(){
			//alert($('.domain', this).text());
			check_connect(this);
		});
		return false;
	});
	
	
	
	
	$('.test_connect').click(function(){
		check_connect(this);
		return false;
	});

	$('#main_menu_reactor').click(function(){
		$('#main_menu_base').css('height', 'auto');	
	});
    
	$('.tabbable').tabs();
	
	$('#load_file_btn').click(function(){
		v = explode('.', $('#file_update').val());
		k = v.length-1;
		if ( v[k] != 'dat' ) {
			alert('It is not update file');
			return false;
		}
	});
	$('.copy_link').each(function(){
		//alert($(this).attr('id'));
		sel = '#' + $(this).attr('id');
		$(sel).zclip({
			path:'templates/default/js/ZeroClipboard.swf',
			copy: function(){
		    	return $(this).text();
		    }
			//copy:function(){return 'testxxx';}
		});
		//alert(sel);
	});
	
	//$('body').click(function(){
	   /*
		$('a#copy').zclip({
			path:'templates/default/js/ZeroClipboard.swf',
			//copy:'txxxest'
			copy:function(){return 'testxxx';}
		});
		*/
		
		
	//});
	/*
	$('#diapazon').change(function(){
		v = $(this).val();
		if ( v == 'd1' ) {
			diff = '-1d';
		} else if ( v == 'd7' ) {
			diff = '-7d';
		} else if ( v == 'm1' ) {
			diff = '-1m';
		} else if ( v == 'm2' ) {
			diff = '-2m';
		}
		$('#date_from').datepicker("setDate", diff);
		$('#date_to').datepicker("setDate", '-0d');
	});
	*/
	$('#stat_typer_2').change(function(){
		$(this).submit();
	});
	$('#own_flag_1').click(function(){
		$('#tr_ip').fadeOut('fast');
		$('#aw_domains_text').fadeOut('fast');
		$('#ip_text span').slideDown('fast');
		$('#ip_text div').slideUp('fast');
		$('#domain_name').val('');
		$('#domain_name').attr('readonly', false);
		
		$('#ip_textarea_text').slideDown('fast');
		$('#ip_text').slideUp('fast');
		
		$('#textarea_ip').slideDown('fast');
		$('#ip').slideUp('fast');
	});
	
	$('#own_flag_2').click(function(){
		$('#tr_ip').fadeIn('fast');
		$('#aw_domains_text').fadeIn('fast');
		$('#ip_text span').slideUp('fast');
		$('#ip_text div').slideDown('fast');
		$('#domain_name').val('Get one from pull');
		$('#domain_name').attr('readonly', true);
		
		$('#ip_textarea_text').slideUp('fast');
		$('#ip_text').slideDown('fast');
		
		$('#textarea_ip').slideUp('fast');
		$('#ip').slideDown('fast');
	});
	
	$('#tr_ip').css('display', 'none');
	$('#load_file').click(function(){
		$('#file_loader_form1').slideToggle('fast');
		return false;
	});
	/*
	$('#get_update').click(function(){
		//alert(1);
		progress_var = setInterval("checkFileUploadProgress('./../db/update/update_answer_from_server.php',1);", 1300);
		$.post('?p=update&', { 'get_update': "1" }, function(data){
			
		});
		//progress_var = setInterval("checkFileUploadProgress('./../db/update/update_answer_from_server.php',1);", 1300);
		return false;
	});
	*/
	
	// использование Math.round() даст неравномерное распределение!
	function getRandomInt(min, max) {
  		return Math.floor(Math.random() * (max - min + 1)) + min;
	}
	function getRandChar(a) { 
		//alert(1);
		b = getRandomInt(0, a.length-1); 
		return a[b];
		//alert(b);
    } 
    
    //alert(getRandChar(cCommon));

	function generateDiscountCode(){
		eng_letters = "aeiouyjqwxbcdfghklmnprstvz";
		dualistic_digits = '2468';
		//alert())
		code = '';
		code = code + '' + getRandChar(eng_letters);
		code = code + '' + getRandChar(eng_letters);
		code = code + '-';
		code = code + '' + getRandomInt(1, 9);
		code = code + '' + getRandomInt(1, 9);
		code = code + '' + getRandomInt(1, 9);
		code = code + '' + getRandChar(dualistic_digits);
		return code;
	}
	function generateDiscountCodeAll(){
		code = '';
		for ( i = 0; i < 10; i++ ) {
			code = code + generateDiscountCode()
			+
			"<br>";
		}
		$('#generate_code').html(code);
	}

	$('#generate_code-btn').click(function(){
		generateDiscountCodeAll();
	});
	generateDiscountCodeAll();
	
	$('.template_change_2').change(function(){
		$('td.off').removeClass('on');
		obj = $(this).parents('tr:first');
		pic = templates_path + '' + $(this).val() + '/mini.jpg';
		$('.off', obj).addClass('on');
		$('img', obj).attr('src', pic);
	});
	
	$('#add_domain_link').click(function(){
		$('#add_domain_block').slideToggle('fast');
	});

	$('#template_change').keyup(function(e){

		pic = templates_path + '' + $('#template_change').val() + '/mini.jpg';
		$('#template_change_pic').attr('src', pic);
	});
    $('#template_change').change(function(){
    	pic = templates_path + '' + $('#template_change').val() + '/mini.jpg';
		$('#template_change_pic').attr('src', pic);
    });
    
    
    if ( $('#date_from').length > 0 && $('#date_to').length > 0 ) {
		$( "#date_from" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 3,
			"dateFormat": 'yy-mm-dd',
			onClose: function( selectedDate ) {
				$( "#date_to" ).datepicker( "option", "minDate", selectedDate);
			}
		});
		$( "#date_to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 3,
			"dateFormat": 'yy-mm-dd',
			onClose: function( selectedDate ) {
			$( "#date_from" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
    }
});

$(window).resize(function(){
	
});

function explode( delimiter, string ) {	// Split a string by string
	// 
	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +   improved by: kenneth
	// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)

	var emptyArray = { 0: '' };

	if ( arguments.length != 2
		|| typeof arguments[0] == 'undefined'
		|| typeof arguments[1] == 'undefined' )
	{
		return null;
	}

	if ( delimiter === ''
		|| delimiter === false
		|| delimiter === null )
	{
		return false;
	}

	if ( typeof delimiter == 'function'
		|| typeof delimiter == 'object'
		|| typeof string == 'function'
		|| typeof string == 'object' )
	{
		return emptyArray;
	}

	if ( delimiter === true ) {
		delimiter = '1';
	}

	return string.toString().split ( delimiter.toString() );
}


function check_connect(o) {
		// message obout scan
		$('#info_scan').fadeIn('fast');
		$('.loader', o).fadeIn('fast');
		v = $('#debug').val() + "\n" + $(o).attr('rel');
		
		//$('#debug').val(v);
		$.get( "?p=domains&check_connect=" + $(o).attr('rel'), function( data ) {
			$('.loader', o).fadeOut('fast');
			if ( data == 1 ) {
				
				$('.status', o).text('online');
				$('.status', o).removeClass('label-error');
				$('.status', o).addClass('label-success');
				a = $('.server_status', $(o).parents('.srvrs_tr:first').prev());
				//if ( a.hasClass('main_server') ) {
					if ( a.hasClass('btn-warning') ) {
						if ($('.addr', $(o).parents('tr:first')).hasClass('main_server')) {
							change_server_status(a);
						}
					}
				//}
				// unlock domain filelds
				if ( $('#table_domains').length > 0 ) {
					//alert(1)
					$('.template_change_2', $(o).parents('tr:first')).attr('disabled', false);
					$('.extra_charge', $(o).parents('tr:first')).attr('disabled', false);
				}
				$('.all_is_offline').fadeOut('fast');
			} else {
				$('.status', o).text('offline');
				$('.status', o).addClass('label-error');
				$('.status', o).removeClass('label-success');
				$('.template_change_2', $(o).parents('tr:first')).attr('disabled', true);
					$('.extra_charge', $(o).parents('tr:first')).attr('disabled', true);
				//$(o).parents('tr:first').addClass('error');
			}
			
			v = $('#debug').val() + "\n" + data + $('td:first', o).text();
			//alert($('.test_connect .loader:visible').length);
			if ( $('.test_connect .loader:visible').length < 2 ) {
				$('#info_scan').fadeOut('fast');
			}
		});
	}
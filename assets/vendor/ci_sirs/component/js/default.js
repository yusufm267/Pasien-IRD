var base_url;
var config;
var opening_process = 0;
var ajax_request_content;
var ajax_request_process;
var ajax_timeout = 0;

var loading_bar = $(document).find('#loading_panel');
var loading_overlay_layer = $(document).find('#loading-overlay-layer');
var loading_bar_lite = $(document).find('#loading_panel_lite');
var loading_round_lite = $(document).find('.loader_absensi');
var scroll_top = $(document).find('.scroll_top');
var modal = $(document).find('#myModal');
var top = $(window).scrollTop();
var $base_url = get_base_url();



function animate_to_top(container){
	$('html, body').animate({
		scrollTop: $(container).offset().top
	}, 1000);
}

function set_userconfig(config_data){
	config = {
		auto_refresh_content_index: config_data.auto_refresh_content_index,
	}
}

function get_userconfig(){
	return config;
}

function set_base_url(baseurl){
	base_url = baseurl;
}

function get_base_url(){
	return base_url;
}

function confirmExit() {
	if(opening_process == 1){
		return "Anda akan meninggalkan halaman ini, Apakah seluruh proses selesai disimpan ?\nPastikan seluruh proses sudah diselesaikan dan disimpan";
	}
}
//window.onbeforeunload = confirmExit;

function show_msg_exit(msg){
	return msg;
}
//window.onbeforeunload = show_msg_exit;

function _search_bar_state(status){
	var search_bar = $(document).find('#search_bar');
	if(status == 1){
		$(search_bar).css({
			'position': 'fixed', 
			'top': '0px', 
			'width' : '100%', 
			'animation-duration' : '10s', 
			'box-shadow' : '0 5px 15px rgba(0,0,0,0.2)'
		});
	}else{
		$(search_bar).css({
			'position': 'relative', 
			'animation-duration' : '10s', 
			'box-shadow' : 'none !important'
		});
	}
}
function _scroll_behave(){
	var index_scroll = 50;
	if(top > index_scroll){
		$(scroll_top).show();
		_search_bar_state(1);
	}
	$(document).scroll(function(e){
		var top = $(window).scrollTop();
		if(top > index_scroll){
			$(scroll_top).show();
			_search_bar_state(1);
		}else{
			$(scroll_top).hide();
			_search_bar_state(0);
		}
	});
}
function _ajax_behave(){
	$(document).ajaxStart(function(){
		$(loading_bar).show();
		$(loading_overlay_layer).show();
		$(loading_bar_lite).show();
	}).ajaxStop(function(){
		$(loading_bar).hide();
		$(loading_overlay_layer).hide();
		$(loading_bar_lite).hide();
		$(loading_round_lite).hide();
	}).ajaxError(function(){
		$(loading_bar).hide();
		$(loading_overlay_layer).hide();
		$(loading_round_lite).hide();
		//$('#myModal').modal('hide');
	});
}
function _initial_load(){
	$(loading_overlay_layer).hide();
	//$(document).find('.select2').select2({});
	//$(document).find('.timeago').timeago();
	//$(document).find('.pie').peity("pie");
	//$(document).find('.date_picker').datepicker({ format: 'yyyy-mm-dd' });
}
function no_need_waiting(){
	$(loading_bar_lite).hide();
}

$(document).ready(function(){	
	_scroll_behave();
	_initial_load();
	_ajax_behave();

	$(document).delegate('.colapse_button', 'click', function(e){
		e.preventDefault();
		$(this).parent().siblings().slideToggle('fast');
	});

	/* untuk form dengan behavior loading */
	$(document).delegate('form.normal_form', 'submit', function(e){
		$(loading_overlay_layer).show();
		$(this).submit();
	});

	/* untuk form dengan menampilkan secara live tanggal sekarang */
	$(document).delegate('.select_date', 'click', function(e) {
		data = $(this).attr('data');
		target = $(this).attr('data-target');
		$(target).val(data);
	});

	/* untuk object selain form */
	$(document).delegate('.ajax_content', 'click', function(e){
		e.preventDefault();
		param = {
			url: $(this).attr('href'),
			container_type: $(this).attr('data-container_type'),
			container_target: $(this).attr('data-container_target'),
		}
		ajax_get_content(param);
	});

	/* khusus untuk form action */
	$(document).delegate('.ajax_process', 'submit', function(e){
		e.preventDefault();
		param = {
			url: $(this).attr('action'),
			type: $(this).attr('method'),
			data: $(this).serialize(),
			container_target: $(this).attr('data-container_target'),
			close_state: $(this).attr('data-close_state'),
			alert_state: $(this).attr('data-alert_state'),
			callback_target: $(this).attr('callback-container_target')
		}
		ajax_get_content(param);
	});
	$(document).delegate('.excel_java','click', function(e){
		e.preventDefault();
		var target = $(this).attr('data_container');
		var classing = '';
		texting = target.split(' ');
		$.each(texting, function(key, value){
			classing = classing + '.'+ value;
		});
		$content = $(document).find(classing).clone();
		$('body').append('<div id="print_area"></div>');
		$('#print_area').append($content);
		$('#print_area #sort_table .header').eq(0).remove();
		$('#print_area #tablePagination').remove();
		$('#print_area tr').attr('style', '');
		$('#print_area').find('.toolsbar').remove();
		$('#print_area').find('.hide').remove();
		$('#print_area').find('br').remove();
		$content2 = $('#print_area').html();
		window.open('data:application/vnd.ms-excel,' + encodeURIComponent($content2));
		$('#print_area').fadeOut('slow').remove();
	});	
	$(document).delegate('.print_report', 'click', function(e){
		e.preventDefault();
		window.print();
	});
	$(document).delegate('#to-top', 'click', function(e){
		e.preventDefault();
		animate_to_top("body");
	});
	$(document).delegate('.cancel_ajax', 'click', function(e){
		e.preventDefault();
		if (typeof ajax_request_content!=='undefined') ajax_request_content.abort();
		if (typeof ajax_request_process!=='undefined') ajax_request_process.abort();
	});

	$(document).delegate('#show_password', 'click', function (e) {
		e.preventDefault();
		var content = $(document).find($(this).attr('target')).val();
		var type = ($(document).find($(this).attr('target')).attr('type'));
		var icon_target = $(this).attr('icon_target');
		try{
			if(content === '') throw "Password Empty";
			if (type == 'password') {
				change = 'text';
				$(document).find(icon_target).removeClass('glyphicon-eye-open');
				$(document).find(icon_target).addClass('glyphicon-eye-close');
			} else {
				change = 'password';
				$(document).find(icon_target).removeClass('glyphicon-eye-close');
				$(document).find(icon_target).addClass('glyphicon-eye-open');
			}
			$(document).find($(this).attr('target')).attr('type', change);
		}catch(err){
			console.log('err');
		}
	});
	
});



// slide view
/*var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}*/








(function($) {
	function substrNews() { 
		var str = $('.last_news .news_text').text();
		var strLength = str.length;
		var strSubstr = $('.last_news .news_text').text().substr(0, 510);
		var strSubstrLength = strSubstr.length;
		if (strLength == strSubstrLength) {
			$('.last_news .news_text').html(strSubstr);
		} else {
			$('.last_news .news_text').html(strSubstr + '...');
		}
	}
	var $window, centerBg;
	function parallax() {
		centerBg = (1980 - $window.width()) / 2;
		$.parallaxify.positionProperty.center = {
			setPosition: function($element, left, originalLeft, top, originalTop) {
				$element.css('background-position', left - centerBg + 'px ' + 0 + 'px');
			}
		};
		$.parallaxify({
			positionProperty: 'center',
			parallaxBackgrounds: true,
			useMouseMove: true,
			useGyroscope: true,
			inputPriority: 'mouse',
			responsive: true,
			motionType: 'linear',
			mouseMotionType: 'linear'
		});
	}
	$(document).ready(function() {
		$window = $(window);
		parallax();
		$window.on('resize', function() {
			parallax();
		});
		$(function () {
			$('.navigation ul li a').each(function () {
				var location = window.location.href;
				var link = this.href;
				if(location == link) {
					$(this).parent().addClass('active');
				}
			});
		});
		$(function () {
			$('.main_menu ul li a').each(function () {
				var location = window.location.href;
				var link = this.href;
				if(location == link) {
					$(this).parent().addClass('active');
				}
			});
		});
		$(function () {
			$('.f_menu ul li a').each(function () {
				var location = window.location.href;
				var link = this.href;
				if(location == link) {
					$(this).parent().addClass('active');
				}
			});
		});
		$('.main_menu ul li').each(function(){
			if ($(this).children().is('.sub_menu')){
				if ($(this).children().children().children().is('.active')){
					$(this).addClass('active');
				}
			}
		});
		$('.main_slider').flexslider({
			animation: "fade",
			useCSS: false,
			directionNav: true,
			controlNav: true,
			manualControls: ".my_controls li",
			touch: true,
			slideshow: true,
			slideshowSpeed: 8000,
			animationSpeed: 500,
			start: function(slider){
				changeTimer(slider);
				$('.main_slider').find('.flex-active-slide .people').animate({
					bottom: "0",
					opacity: "1"
				}, 500 );
				$('.main_slider').find('.flex-active-slide .caption').delay(200).animate({
					left: "0",
					opacity: "1"
				}, 500 );
			},
			before: function(slider){
				$('.main_slider').find('.flex-active-slide .people').animate({
					bottom: "-60px",
					opacity: "0"
				}, 500 );
				$('.main_slider').find('.flex-active-slide .caption').animate({
					left: "60px",
					opacity: "0"
				}, 500 );
			},
			after: function(slider){
				changeTimer(slider);
				$('.main_slider').find('.flex-active-slide .people').animate({
					bottom: "0",
					opacity: "1"
				}, 500 );
				$('.main_slider').find('.flex-active-slide .caption').delay(200).animate({
					left: "0",
					opacity: "1"
				}, 500 );
			}
		});
		function changeTimer(slider) {
			$('.main_slider').flexslider("stop");
			$('.main_slider .progress_cont .progress_bar').removeClass('working');
			$('.main_slider .progress_cont .progress_bar[data-slide="' + slider.currentSlide + '"]').addClass('working');
			$('.main_slider').flexslider("play");
		}
		$('.main_slider .slide_1 .cogwheel').animateSprite({
			duration: 260,
			loop: true,
			animations: {
				start: [0, 1, 2, 3, 4, 5, 6, 7, 8]
			}
		});
		$('.main_slider .slide_2 .cogwheel').animateSprite({
			duration: 260,
			loop: true,
			animations: {
				start: [0, 1, 2, 3, 4, 5, 6, 7, 8]
			}
		});
		$('.main_slider .slide_3 .cogwheel').animateSprite({
			duration: 260,
			loop: true,
			animations: {
				start: [0, 1, 2, 3, 4, 5, 6, 7, 8]
			}
		});
		$('.all_cogwheel').animateSprite({
			duration: 260,
			loop: true,
			animations: {
				start: [0, 1, 2, 3, 4, 5, 6, 7, 8]
			}
		});
		$('.auth_cogwheel').animateSprite({
			duration: 260,
			loop: true,
			animations: {
				start: [0, 1, 2, 3, 4, 5, 6, 7, 8]
			}
		});
		substrNews();
		$('#last_access').load('?a=account #a_last_access', function() {
			$(".ha_info .loading").hide();
			$(".ha_info_cont").animate({
				bottom: '0',
				opacity: '1'
			}, 250);
		});
		$('.landing_main_info .cogwheel').animateSprite({
			duration: 260,
			loop: true,
			animations: {
				start: [0, 1, 2, 3, 4, 5, 6, 7, 8]
			}
		});
		(function($) {
			$(function() {
				$('ul.tabs_caption').on('click', 'li:not(.active)', function() {
					$(this).addClass('active').siblings().removeClass('active').closest('div.team_tabs').find('div.tabs_content').removeClass('active').eq($(this).index()).addClass('active');
				});
			});
		})(jQuery);
		$('.calc_link').click(function() {
			$('#calc_modal').arcticmodal({
				closeOnEsc: true,
				closeOnOverlayClick: true,
				openEffect: {
					type: 'fade'
				},
				closeEffect: {
					type: 'fade'
				},
				overlay: {
					css: {
						background: '#000',
						opacity: .6
					}
				}
			});
		});
		$('.login_link').click(function() {
			$('#login_modal').arcticmodal({
				closeOnEsc: true,
				closeOnOverlayClick: true,
				openEffect: {
					type: 'fade'
				},
				closeEffect: {
					type: 'fade'
				},
				overlay: {
					css: {
						background: '#000',
						opacity: .6
					}
				}
			});
		});
		$('.security_link').click(function() {
			var securityTitle = $(this).find('.security_title').text();
			var securityContent = $(this).find('.security_content').html();
			var iframeAttr = $(this).find('iframe').attr("data-src");
			$('#security_modal').arcticmodal({
				closeOnEsc: true,
				closeOnOverlayClick: true,
				openEffect: {
					type: 'fade'
				},
				closeEffect: {
					type: 'fade'
				},
				beforeOpen: function(data, el) {
					el.find('#security_title').html(securityTitle);
					el.find('#security_content').html(securityContent);
					el.find('iframe').attr('src',iframeAttr)
				},
				afterClose: function(data, el) {
					el.find('#security_title').empty();
					el.find('#security_content').empty();
				},
				overlay: {
					css: {
						background: '#000',
						opacity: .6
					}
				}
			});
		});
		$('.login_modal input[type="submit"]').click(function(){
			var error = 0;
			var nameUsername = $('.login_modal input[name="username"]');
			var namePassword = $('.login_modal input[name="password"]');
			var validImage = $('.login_modal input[name="validation_number"]');
			if (nameUsername.val() == '') {
				nameUsername.parents('li').find('.error').show();
				error++;
			} else {
				nameUsername.parents('li').find('.error').hide();
			}
			if (namePassword.val() == '') {
				namePassword.parents('li').find('.error').show();
				error++;
			} else {
				namePassword.parents('li').find('.error').hide();
			}
			if(validImage.length > 0) {
				if (validImage.val() == '') {
					validImage.parents('li').find('.error').show();
					error++;
				} else {
					validImage.parents('li').find('.error').hide();
				}
			}
			if(error == 0) {
				return true;
			} else {
				return false;
			}
		});
		$('.login_modal input[name="username"]').focusout(function(){
			if ($(this).val() == '') {
				$(this).parents('li').find('.error').show();
			} else {
				$(this).parents('li').find('.error').hide();
			}
		});
		$('.login_modal input[name="password"]').focusout(function(){
			if ($(this).val() == '') {
				$(this).parents('li').find('.error').show();
			} else {
				$(this).parents('li').find('.error').hide();
			}
		});
		$('.login_modal input[name="validation_number"]').focusout(function(){
			if ($(this).val() == '') {
				$(this).parents('li').find('.error').show();
			} else {
				$(this).parents('li').find('.error').hide();
			}
		});
		$('.login_cont input[type="submit"]').click(function(){
			var error = 0;
			var nameUsername = $('.login_cont input[name="username"]');
			var namePassword = $('.login_cont input[name="password"]');
			var validImage = $('.login_cont input[name="validation_number"]');
			if (nameUsername.val() == '') {
				nameUsername.parents('li').find('.error').show();
				error++;
			} else {
				nameUsername.parents('li').find('.error').hide();
			}
			if (namePassword.val() == '') {
				namePassword.parents('li').find('.error').show();
				error++;
			} else {
				namePassword.parents('li').find('.error').hide();
			}
			if(validImage.length > 0) {
				if (validImage.val() == '') {
					validImage.parents('li').find('.error').show();
					error++;
				} else {
					validImage.parents('li').find('.error').hide();
				}
			}
			if(error == 0) {
				return true;
			} else {
				return false;
			}
		});
		$('.login_cont input[name="username"]').focusout(function(){
			if ($(this).val() == '') {
				$(this).parents('li').find('.error').show();
			} else {
				$(this).parents('li').find('.error').hide();
			}
		});
		$('.login_cont input[name="password"]').focusout(function(){
			if ($(this).val() == '') {
				$(this).parents('li').find('.error').show();
			} else {
				$(this).parents('li').find('.error').hide();
			}
		});
		$('.login_cont input[name="validation_number"]').focusout(function(){
			if ($(this).val() == '') {
				$(this).parents('li').find('.error').show();
			} else {
				$(this).parents('li').find('.error').hide();
			}
		});
		$('.su_right input[type="submit"]').click(function(){
			var error = 0;
			var checkEmail = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var checkUsername = /^[A-Za-z0-9_\-]+$/;
			var nameFullname = $('.su_right input[name="fullname"]');
			var nameEmail = $('.su_right input[name="email"]');
			var cleanEmail = $.trim(nameEmail.val());
			nameEmail.val(cleanEmail);
			var nameEmail1 = $('.su_right input[name="email1"]');
			var cleanEmail1 = $.trim(nameEmail1.val());
			nameEmail1.val(cleanEmail1);
			var nameAddress = $('.su_right input[name="address"]');
			var nameCity = $('.su_right input[name="city"]');
			var nameState = $('.su_right input[name="state"]');
			var nameZip = $('.su_right input[name="zip"]');
			var nameCountry = $('.su_right select[name="country"]');
			var nameUsername = $('.su_right input[name="username"]');
			var namePassword = $('.su_right input[name="password"]');
			var namePassword2 = $('.su_right input[name="password2"]');
			var nameTranscode = $('.su_right input[name="transaction_code"]');
			var nameTranscode2 = $('.su_right input[name="transaction_code2"]');
			var nameSq = $('.su_right input[name="sq"]');
			var nameSa = $('.su_right input[name="sa"]');
			var validImage = $('.su_right input[name="validation_number"]');
			var nameAgree = $('.su_right input[name="agree"]');
			
			if (cleanEmail == '') {
				nameEmail.parents('li').find('.error_1').show();
				nameEmail.parents('li').find('.error_2').hide();
				error++;
			} else {
				if (!checkEmail.test(cleanEmail)) {
					nameEmail.parents('li').find('.error_1').hide();
					nameEmail.parents('li').find('.error_2').show();
					error++;
				} else {
					nameEmail.parents('li').find('.error_1').hide();
					nameEmail.parents('li').find('.error_2').hide();
				}
			}
			if (cleanEmail1 == '') {
				nameEmail1.parents('li').find('.error_1').show();
				nameEmail1.parents('li').find('.error_2').hide();
				nameEmail1.parents('li').find('.error_3').hide();
				error++;
			} else {
				if (!checkEmail.test(cleanEmail1)) {
					nameEmail1.parents('li').find('.error_1').hide();
					nameEmail1.parents('li').find('.error_2').show();
					nameEmail1.parents('li').find('.error_3').hide();
					error++;
				} else {
					if (cleanEmail != cleanEmail1) {
						nameEmail1.parents('li').find('.error_1').hide();
						nameEmail1.parents('li').find('.error_2').hide();
						nameEmail1.parents('li').find('.error_3').show();
						error++;
					} else {
						nameEmail1.parents('li').find('.error_1').hide();
						nameEmail1.parents('li').find('.error_2').hide();
						nameEmail1.parents('li').find('.error_3').hide();
					}
				}
			}
			
			if (nameUsername.val() == '') {
				nameUsername.parents('li').find('.error_1').show();
				nameUsername.parents('li').find('.error_2').hide();
				error++;
			} else {
				if (!checkUsername.test(nameUsername.val())) {
					nameUsername.parents('li').find('.error_1').hide();
					nameUsername.parents('li').find('.error_2').show();
					error++;
				} else {
					nameUsername.parents('li').find('.error_1').hide();
					nameUsername.parents('li').find('.error_2').hide();
				}
			}
			if (namePassword.val() == '') {
				namePassword.parents('li').find('.error').show();
				error++;
			} else {
				namePassword.parents('li').find('.error').hide();
			}
			if (namePassword2.val() == '') {
				namePassword2.parents('li').find('.error_1').show();
				namePassword2.parents('li').find('.error_2').hide();
				error++;
			} else {
				if (namePassword.val() != namePassword2.val()) {
					namePassword2.parents('li').find('.error_1').hide();
					namePassword2.parents('li').find('.error_2').show();
					error++;
				} else {
					namePassword2.parents('li').find('.error_1').hide();
					namePassword2.parents('li').find('.error_2').hide();
				}
			}
			if($('.su_right .transcode').length > 0) {
				if (nameTranscode.val() == '') {
					nameTranscode.parents('li').find('.error').show();
					error++;
				} else {
					nameTranscode.parents('li').find('.error').hide();
				}
				if (nameTranscode2.val() == '') {
					nameTranscode2.parents('li').find('.error_1').show();
					nameTranscode2.parents('li').find('.error_2').hide();
					error++;
				} else {
					if (nameTranscode.val() != nameTranscode2.val()) {
						nameTranscode2.parents('li').find('.error_1').hide();
						nameTranscode2.parents('li').find('.error_2').show();
						error++;
					} else {
						nameTranscode2.parents('li').find('.error_1').hide();
						nameTranscode2.parents('li').find('.error_2').hide();
					}
				}
			}
			if (nameSq.val() == '') {
				nameSq.parents('li').find('.error').show();
				error++;
			} else {
				nameSq.parents('li').find('.error').hide();
			}
			if (nameSa.val() == '') {
				nameSa.parents('li').find('.error').show();
				error++;
			} else {
				nameSa.parents('li').find('.error').hide();
			}
			if(validImage.length > 0) {
				if (validImage.val() == '') {
					validImage.parents('li').find('.error').show();
					error++;
				} else {
					validImage.parents('li').find('.error').hide();
				}
			}
			if (nameAgree.is(":checked")) {
				nameAgree.parents('li').find('.error').hide();
			} else {
				nameAgree.parents('li').find('.error').show();
				error++;
			}
			if(error == 0) {
				return true;
			} else {
				return false;
			}
		});
		
		$('.su_right input[name="email"]').focusout(function(){
			var checkEmail = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var cleanEmail = $.trim($(this).val());
			var nameEmail1 = $('.su_right input[name="email1"]');
			var cleanEmail1 = $.trim(nameEmail1.val());
			$(this).val(cleanEmail);
			if (cleanEmail == '') {
				$(this).parents('li').find('.error_1').show();
				$(this).parents('li').find('.error_2').hide();
			} else {
				if (!checkEmail.test(cleanEmail)) {
					$(this).parents('li').find('.error_1').hide();
					$(this).parents('li').find('.error_2').show();
				} else {
					$(this).parents('li').find('.error_1').hide();
					$(this).parents('li').find('.error_2').hide();
					if (cleanEmail == cleanEmail1) {
						nameEmail1.parents('li').find('.error_3').hide();
					}
				}
			}
		});
		
		
		
		$('.su_right input[name="username"]').focusout(function(){
			var checkUsername = /^[A-Za-z0-9_\-]+$/;
			if ($(this).val() == '') {
				$(this).parents('li').find('.error_1').show();
				$(this).parents('li').find('.error_2').hide();
			} else {
				if (!checkUsername.test($(this).val())) {
					$(this).parents('li').find('.error_1').hide();
					$(this).parents('li').find('.error_2').show();
				} else {
					$(this).parents('li').find('.error_1').hide();
					$(this).parents('li').find('.error_2').hide();
				}
			}
		});
		$('.su_right input[name="password"]').focusout(function(){
			var namePassword2 = $('.su_right input[name="password2"]');
			if ($(this).val() == '') {
				$(this).parents('li').find('.error').show();
			} else {
				$(this).parents('li').find('.error').hide();
				if ($(this).val() == namePassword2.val()) {
					namePassword2.parents('li').find('.error_2').hide();
				}
			}
		});
		$('.su_right input[name="password2"]').focusout(function(){
			var namePassword = $('.su_right input[name="password"]');
			if ($(this).val() == '') {
				$(this).parents('li').find('.error_1').show();
				$(this).parents('li').find('.error_2').hide();
			} else {
				if (namePassword.val() != $(this).val()) {
					$(this).parents('li').find('.error_1').hide();
					$(this).parents('li').find('.error_2').show();
				} else {
					$(this).parents('li').find('.error_1').hide();
					$(this).parents('li').find('.error_2').hide();
				}
			}
		});
		
		
		
		$('.su_right input[name="validation_number"]').focusout(function(){
			if ($(this).val() == '') {
				$(this).parents('li').find('.error').show();
			} else {
				$(this).parents('li').find('.error').hide();
			}
		});
		$('.su_right input[name="agree"]').change(function(){
			$(this).parents('li').find('.error').hide();
		});
		$('.sf_cont input[type="submit"]').click(function(){
			var error = 0;
			var checkEmail = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var nameName = $('.sf_cont input[name="name"]');
			var nameEmail = $('.sf_cont input[name="email"]');
			var nameMessage = $('.sf_cont .textarea textarea');
			var validImage = $('.sf_cont input[name="validation_number"]');
			if (nameName.val() == '') {
				nameName.parents('li').find('.error').show();
				error++;
			} else {
				nameName.parents('li').find('.error').hide();
			}
			if (nameEmail.val() == '') {
				nameEmail.parents('li').find('.error_1').show();
				nameEmail.parents('li').find('.error_2').hide();
				error++;
			} else {
				if (!checkEmail.test(nameEmail.val())) {
					nameEmail.parents('li').find('.error_1').hide();
					nameEmail.parents('li').find('.error_2').show();
					error++;
				} else {
					nameEmail.parents('li').find('.error_1').hide();
					nameEmail.parents('li').find('.error_2').hide();
				}
			}
			if (nameMessage.val() == '') {
				nameMessage.parents('.textarea').find('.error').show();
				error++;
			} else {
				nameMessage.parents('.textarea').find('.error').hide();
			}
			if(validImage.length > 0) {
				if (validImage.val() == '') {
					validImage.parents('.validation').find('.error').show();
					error++;
				} else {
					validImage.parents('.validation').find('.error').hide();
				}
			}
			if(error == 0) {
				return true;
			} else {
				return false;
			}
		});
		$('.sf_cont input[name="name"]').focusout(function(){
			if ($(this).val() == '') {
				$(this).parents('li').find('.error').show();
			} else {
				$(this).parents('li').find('.error').hide();
			}
		});
		$('.sf_cont input[name="email"]').focusout(function(){
			var checkEmail = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if ($(this).val() == '') {
				$(this).parents('li').find('.error_1').show();
				$(this).parents('li').find('.error_2').hide();
			} else {
				if (!checkEmail.test($(this).val())) {
					$(this).parents('li').find('.error_1').hide();
					$(this).parents('li').find('.error_2').show();
				} else {
					$(this).parents('li').find('.error_1').hide();
					$(this).parents('li').find('.error_2').hide();
				}
			}
		});
		$('.sf_cont .textarea textarea').focusout(function(){
			if ($(this).val() == '') {
				$(this).parents('.textarea').find('.error').show();
			} else {
				$(this).parents('.textarea').find('.error').hide();
			}
		});
		$('.sf_cont input[name="validation_number"]').focusout(function(){
			if ($(this).val() == '') {
				$(this).parents('.validation').find('.error').show();
			} else {
				$(this).parents('.validation').find('.error').hide();
			}
		});
		$('.forgot_page input[type="submit"]').click(function(){
			var error = 0;
			var nameEmail = $('.forgot_page input[name="email"]');
			if (nameEmail.val() == '') {
				nameEmail.parents('li').find('.error').show();
				error++;
			} else {
				nameEmail.parents('li').find('.error').hide();
			}
			if(error == 0) {
				return true;
			} else {
				return false;
			}
		});
		$('.forgot_page input[name="email"]').focusout(function(){
			if ($(this).val() == '') {
				$(this).parents('li').find('.error').show();
			} else {
				$(this).parents('li').find('.error').hide();
			}
		});
		$('.tfa_page input[type="submit"]').click(function(){
			var error = 0;
			var nameCode = $('.tfa_page input[name="code"]');
			if (nameCode.val() == '') {
				nameCode.parents('li').find('.error').show();
				error++;
			} else {
				nameCode.parents('li').find('.error').hide();
			}
			if(error == 0) {
				return true;
			} else {
				return false;
			}
		});
		$('.tfa_page input[name="code"]').focusout(function(){
			if ($(this).val() == '') {
				$(this).parents('li').find('.error').show();
			} else {
				$(this).parents('li').find('.error').hide();
			}
		});
	});
} )( jQuery );
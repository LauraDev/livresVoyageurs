(function () {

	'use strict';



	// iPad and iPod detection
	var isiPad = function(){
		return (navigator.platform.indexOf('iPad') != -1);
	};

	var isiPhone = function(){
	    return (
			(navigator.platform.indexOf('iPhone') != -1) ||
			(navigator.platform.indexOf('iPod') != -1)
	    );
	};


	// Go to next section
	var goToNextSection = function(){
		var el = $('.learn'),
			w = el.width(),
			divide = -w/2;
		el.css('margin-left', divide);
	};

	// Loading page
	var loadPage = function() {
		$('.loading').fadeOut('slow');
	};


	var styleToggle = function() {


		if ( $.cookie('styleCookie') !== undefined ) {
			if ( $.cookie('styleCookie') === 'style-light.css'  ) {

				$('.js-style-toggle').attr('data-style', 'light');
			} else  {
				$('.js-style-toggle').attr('data-style', 'default');
			}
			$('#theme-switch').attr('href', 'css/' + $.cookie('styleCookie'));
		}


		if ( $.cookie('btnActive') !== undefined ) $('.js-style-toggle').addClass($.cookie('btnActive'));




		// $('.js-style-toggle').on('click', function(){
		$('body').on('click','.js-style-toggle',function(event){



			var data = $('.js-style-toggle').attr('data-style'), style = '', $this = $(this);

			if ( data === 'default') {

				// switch to light
				style = 'style-light.css';
				$this.attr('data-style', 'light');

				// add class active to button
				$.cookie('btnActive', 'active', { expires: 365, path: '/'});
				$this.addClass($.cookie('btnActive'));


			} else {
				// switch to dark color
				style = 'style.css';
				$this.attr('data-style', 'default');

				// remove class active from button
				$.removeCookie('btnActive', { path: '/' });
				$(this).removeClass('active');

				// switch to style
				$.cookie('styleCookie', style, { expires: 365, path: '/'});

			}

			// switch to style
			$.cookie('styleCookie', style, { expires: 365, path: '/'});

			// apply the new style
			$('#theme-switch').attr('href', 'css/' + $.cookie('styleCookie'));


			event.preventDefault();

		});

	};

	// Animations

	var contentWayPoint = function() {
		var i = 0;
		$('.animation').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('animated') ) {

				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .animation.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							el.addClass('fadeInUp animated');
							el.removeClass('item-animate');
						},  k * 200, 'easeInOutExpo' );
					});

				}, 100);

			}

		} , { offset: '95%' } );
	};



	// Document on load.
	$(function(){
		
		goToNextSection();
		loadPage();
		styleToggle();

		// Animate
		contentWayPoint();

	});


}());


$(document).ready(function() {

	$('body').css('display', 'none');

	$('body').fadeIn(2000);
	$('body').stop().animate({
		opacity: 1
	});


	$('a.transition').click(function(event){

		event.preventDefault();
		linkLocation = this.href;
		$('body').fadeOut(1000, redirectPage);

	});

	function redirectPage() {
		window.location = linkLocation;
	}

	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})


});

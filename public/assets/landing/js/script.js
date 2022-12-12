(function($) {
	
	"use strict";
	
	
	//Hide Loading Box (Preloader)
	function handlePreloader() {
		if($('.preloader').length){
			$('.preloader').delay(200).fadeOut(500);
		}
	}
	
	
	//Update Header Style and Scroll to Top
	function headerStyle() {
		if($('.main-header').length){
			var windowpos = $(window).scrollTop();
			var siteHeader = $('.main-header');
			var scrollLink = $('.scroll-to-top');
			
			var HeaderHight = $('.main-header').height();
			if (windowpos >= HeaderHight) {
				siteHeader.addClass('fixed-header');
				scrollLink.fadeIn(300);
			} else {
				siteHeader.removeClass('fixed-header');
				scrollLink.fadeOut(300);
			}
			
		}
	}
	
	headerStyle();
	
	
	//Submenu Dropdown Toggle
	if($('.main-header li.dropdown ul').length){
		$('.main-header li.dropdown').append('<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>');
		
		//Dropdown Button
		$('.main-header li.dropdown .dropdown-btn').on('click', function() {
			$(this).prev('ul').slideToggle(500);
		});
		
		//Dropdown Menu / Fullscreen Nav
		$('.fullscreen-menu .navigation li.dropdown > a').on('click', function() {
			$(this).next('ul').slideToggle(500);
		});
		
		//Disable dropdown parent link
		$('.navigation li.dropdown > a').on('click', function(e) {
			e.preventDefault();
		});
		
		//Disable dropdown parent link
		$('.main-header .navigation li.dropdown > a,.hidden-bar .side-menu li.dropdown > a').on('click', function(e) {
			e.preventDefault();
		});
	}
	
	
	
	
	//Mobile Nav Hide Show
	if($('.mobile-menu').length){
		
		$('.mobile-menu .menu-box').mCustomScrollbar();
		
		var mobileMenuContent = $('.main-header .nav-outer .main-menu').html();
		$('.mobile-menu .menu-box .menu-outer').append(mobileMenuContent);
		$('.sticky-header .main-menu').append(mobileMenuContent);
		
		//Dropdown Button
		$('.mobile-menu li.dropdown .dropdown-btn').on('click', function() {
			$(this).toggleClass('open');
			$(this).prev('ul').slideToggle(500);
		});
		
		//Dropdown Button
		$('.mobile-menu li.dropdown .dropdown-btn').on('click', function() {
			$(this).toggleClass('open');
			$(this).prev('.mega-menu').slideToggle(500);
		});
		
		//Menu Toggle Btn
		$('.mobile-nav-toggler').on('click', function() {
			$('body').addClass('mobile-menu-visible');
		});

		//Menu Toggle Btn
		$('.mobile-menu .menu-backdrop,.mobile-menu .close-btn').on('click', function() {
			$('body').removeClass('mobile-menu-visible');
		});
	}
	
	
	
	
	//Header Search
	if($('.search-box-outer').length) {
		$('.search-box-outer').on('click', function() {
			$('body').addClass('search-active');
		});
		$('.close-search').on('click', function() {
			$('body').removeClass('search-active');
		});
	}
	
	
	
	//Hidden Sidebar
	if ($('.hidden-bar,.fullscreen-menu').length) {
		var hiddenBar = $('.hidden-bar');
		var hiddenBarOpener = $('.nav-toggler');
		var hiddenBarCloser = $('.hidden-bar-closer,.close-menu');
		$('.hidden-bar-wrapper').mCustomScrollbar();
		
		//Show Sidebar
		hiddenBarOpener.on('click', function () {
			$('body').addClass('visible-menu-bar');
			hiddenBar.addClass('visible-sidebar');
		});
		
		//Hide Sidebar
		hiddenBarCloser.on('click', function () {
			$('body').removeClass('visible-menu-bar');
			hiddenBar.removeClass('visible-sidebar');
		});
	}
	
	
	
	//Custom Seclect Box
	if($('.custom-select-box').length){
		$('.custom-select-box').selectmenu().selectmenu('menuWidget').addClass('overflow');
	}

	
	
	//Parallax Scene for Icons
	if($('.parallax-scene-1').length){
		var scene = $('.parallax-scene-1').get(0);
		var parallaxInstance = new Parallax(scene);
	}
	if($('.parallax-scene-2').length){
		var scene = $('.parallax-scene-2').get(0);
		var parallaxInstance = new Parallax(scene);
	}
	if($('.parallax-scene-3').length){
		var scene = $('.parallax-scene-3').get(0);
		var parallaxInstance = new Parallax(scene);
	}
	if($('.parallax-scene-4').length){
		var scene = $('.parallax-scene-4').get(0);
		var parallaxInstance = new Parallax(scene);
	}
	
	
	
	if($('.paroller').length){
		$('.paroller').paroller({
			  factor: 0.2,            // multiplier for scrolling speed and offset, +- values for direction control  
			  factorLg: 0.4,          // multiplier for scrolling speed and offset if window width is less than 1200px, +- values for direction control  
			  type: 'foreground',     // background, foreground  
			  direction: 'horizontal' // vertical, horizontal  
		});
	}
	
	
	
	//Gallery Filters
	if($('.filter-list').length){
		$('.filter-list').mixItUp({});
	}
	
	
	
	//Fact Counter + Text Count
	if($('.count-box').length){
		$('.count-box').appear(function(){
	
			var $t = $(this),
				n = $t.find(".count-text").attr("data-stop"),
				r = parseInt($t.find(".count-text").attr("data-speed"), 10);
				
			if (!$t.hasClass("counted")) {
				$t.addClass("counted");
				$({
					countNum: $t.find(".count-text").text()
				}).animate({
					countNum: n
				}, {
					duration: r,
					easing: "linear",
					step: function() {
						$t.find(".count-text").text(Math.floor(this.countNum));
					},
					complete: function() {
						$t.find(".count-text").text(this.countNum);
					}
				});
			}
			
		},{accY: 0});
	}
	
	
	
	//Typeit Text On Main Page
	if ($('.variable-text').length) {
		
		$('.variable-text').typeIt({
			 strings: ["Easy Customized Dashboard."],
			 speed: 150,
			 breakLines: true,
			 loop:true,
			 autoStart: true
		});	
	}

	
	
	//Typeit Text On Main Page
	if ($('.variable-text-two').length) {
		
		$('.variable-text-two').typeIt({
			 strings: ["We Create Design & Technology."],
			 speed: 150,
			 breakLines: true,
			 loop:true,
			 autoStart: true
		});	
	}
	
	
	
	//Accordion Box
	if($('.accordion-box').length){
		$(".accordion-box").on('click', '.acc-btn', function() {
			
			var outerBox = $(this).parents('.accordion-box');
			var target = $(this).parents('.accordion');
			
			if($(this).hasClass('active')!==true){
				$(outerBox).find('.accordion .acc-btn').removeClass('active');
			}
			
			if ($(this).next('.acc-content').is(':visible')){
				return false;
			}else{
				$(this).addClass('active');
				$(outerBox).children('.accordion').removeClass('active-block');
				$(outerBox).find('.accordion').children('.acc-content').slideUp(300);
				target.addClass('active-block');
				$(this).next('.acc-content').slideDown(300);	
			}
		});	
	}
	
	
	
	//Main Slider Carousel
	if ($('.main-slider-carousel').length) {
		$('.main-slider-carousel').owlCarousel({
			animateOut: 'fadeOut',
    		animateIn: 'fadeIn',
			loop:true,
			margin:0,
			nav:true,
			autoHeight: true,
			smartSpeed: 500,
			autoplay: 6000,
			navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:1
				},
				1024:{
					items:1
				},
				1200:{
					items:1
				}
			}
		});    		
	}
	
	
	
	//Main Slider Carousel
	if ($('.main-slider-carousel-two').length) {
		$('.main-slider-carousel-two').owlCarousel({
			//animateOut: 'fadeOut',
    		//animateIn: 'fadeIn',
			loop:true,
			margin:30,
			nav:true,
			autoHeight: true,
			smartSpeed: 500,
			autoplay: 6000,
			navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:1
				},
				1024:{
					items:1
				},
				1200:{
					items:1
				}
			}
		});    		
	}
	
	
	
	
	// Single Item Carousel
	if ($('.single-item-carousel').length) {
		$('.single-item-carousel').owlCarousel({
			loop:true,
			margin:0,
			nav:true,
			smartSpeed: 500,
			autoplay: 4000,
			navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:1
				},
				1024:{
					items:1
				}
			}
		});    		
	}
	
	
	
	
	// Screenshots Carousel
	if ($('.screenshots-carousel').length) {
		$('.screenshots-carousel').owlCarousel({
			//animateOut: 'fadeOut',
    		//animateIn: 'fadeIn',
			loop:true,
			margin:40,
			nav:true,
			smartSpeed: 500,
			autoplay: 6000,
			navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:1
				},
				1024:{
					items:1
				},
				1200:{
					items:1
				},
				1500:{
					items:1
				}
			}
		});    		
	}
	
	
	
	
	// Three Item Carousel
	if ($('.three-item-carousel').length) {
		$('.three-item-carousel').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			center:true,
			//autoHeight: true,
			smartSpeed: 500,
			autoplay: 5000,
			navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:3
				},
				1024:{
					items:3
				},
				1200:{
					items:3
				}
			}
		});    		
	}
	
	
	
	
	// Testimonial Carousel
	if ($('.testimonial-carousel').length) {
		$('.testimonial-carousel').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			center:true,
			//autoHeight: true,
			smartSpeed: 500,
			autoplay: 5000,
			navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:3
				},
				1024:{
					items:3
				},
				1200:{
					items:3
				}
			}
		});    		
	}
	
	
	
	
	// Testimonial Carousel Two
	if ($('.testimonial-carousel-two').length) {
		$('.testimonial-carousel-two').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			center:true,
			//autoHeight: true,
			smartSpeed: 500,
			autoplay: 5000,
			navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:1
				},
				1024:{
					items:1
				},
				1200:{
					items:1
				}
			}
		});    		
	}
	
	
	
	
	// Testimonial Carousel Three
	if ($('.testimonial-carousel-three').length) {
		$('.testimonial-carousel-three').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			center:true,
			//autoHeight: true,
			smartSpeed: 500,
			autoplay: 5000,
			navText: [ '<span class="flaticon-back-2"></span>', '<span class="flaticon-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:1
				},
				1024:{
					items:1
				},
				1200:{
					items:1
				}
			}
		});    		
	}
	
	
	
	// Movers Testimonial Carousel
	if ($('.movers-testimonial-carousel').length) {
		$('.movers-testimonial-carousel').owlCarousel({
			loop:true,
			margin:0,
			nav:true,
			//center:true,
			//autoHeight: true,
			smartSpeed: 500,
			autoplay: 5000,
			navText: [ '<span class="flaticon-left-arrow-2"></span>', '<span class="flaticon-right-arrow-1"></span>' ],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:2
				},
				1024:{
					items:3
				},
				1200:{
					items:3
				}
			}
		});    		
	}
	
	
	
	
	
	// Movers Clients Carousel
	if ($('.movers-clients-carousel').length) {
		$('.movers-clients-carousel').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			//center:true,
			//autoHeight: true,
			smartSpeed: 500,
			autoplay: 5000,
			navText: [ '<span class="flaticon-left-arrow-2"></span>', '<span class="flaticon-right-arrow-1"></span>' ],
			responsive:{
				0:{
					items:2
				},
				600:{
					items:3
				},
				800:{
					items:3
				},
				1024:{
					items:4
				},
				1200:{
					items:5
				}
			}
		});    		
	}
	
	
	
	
	
	// Project Detail Carousel
	if ($('.project-detail-carousel').length) {
		$('.project-detail-carousel').owlCarousel({
			loop:true,
			margin:0,
			nav:true,
			smartSpeed: 500,
			autoplay: 5000,
			navText: [ '<span class="flaticon-back-2"></span>', '<span class="flaticon-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:1
				},
				1024:{
					items:1
				},
				1200:{
					items:1
				}
			}
		});    		
	}
	
	
	
	
	//Progress Bar
	if($('.progress-line').length){
		$('.progress-line').appear(function(){
			var el = $(this);
			var percent = el.data('width');
			$(el).css('width',percent+'%');
		},{accY: 0});
	}
	
	
	
	
	// Sponsors Item Carousel
	if ($('.sponsors-carousel').length) {
		$('.sponsors-carousel').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			smartSpeed: 500,
			autoplay: 4000,
			navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:2
				},
				600:{
					items:3
				},
				800:{
					items:4
				},
				1024:{
					items:5
				}
			}
		});    		
	}
	
	
	
	
	// Sponsors Item Carousel
	if ($('.sponsors-carousel-two').length) {
		$('.sponsors-carousel-two').owlCarousel({
			loop:true,
			margin:10,
			nav:true,
			smartSpeed: 500,
			autoplay: 4000,
			navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:2
				},
				600:{
					items:3
				},
				800:{
					items:5
				},
				1024:{
					items:6
				}
			}
		});    		
	}
	
	
	
	
	
	// Events Sponsors Carousel
	if ($('.events-sponsors-carousel').length) {
		$('.events-sponsors-carousel').owlCarousel({
			loop:true,
			margin:10,
			nav:true,
			smartSpeed: 500,
			autoplay: 4000,
			navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:2
				},
				600:{
					items:3
				},
				800:{
					items:5
				},
				1024:{
					items:6
				}
			}
		});    		
	}
	
	
	
	//Event Countdown Timer
	if($('.time-countdowns').length){  
		$('.time-countdowns').each(function() {
		var $this = $(this), finalDate = $(this).data('countdown');
		$this.countdown(finalDate, function(event) {
			var $this = $(this).html(event.strftime('' + '<div class="counter-column"><span class="count">%D</span>Days</div> ' + '<div class="counter-column"><span class="count">%H</span>Hours</div>  ' + '<div class="counter-column"><span class="count">%M</span>Minutes</div>  ' + '<div class="counter-column"><span class="count">%S</span>Seconds</div>'));
		});
	 });
	}
	
	

	if($('.clock-wrapper').length){  
		(function(){
            //generate clock animations
            var now       = new Date(),
                hourDeg   = now.getHours() / 12 * 360 + now.getMinutes() / 60 * 30,
                minuteDeg = now.getMinutes() / 60 * 360 + now.getSeconds() / 60 * 6,
                secondDeg = now.getSeconds() / 60 * 360,
                stylesDeg = [
                    "@-webkit-keyframes rotate-hour{from{transform:rotate(" + hourDeg + "deg);}to{transform:rotate(" + (hourDeg + 360) + "deg);}}",
                    "@-webkit-keyframes rotate-minute{from{transform:rotate(" + minuteDeg + "deg);}to{transform:rotate(" + (minuteDeg + 360) + "deg);}}",
                    "@-webkit-keyframes rotate-second{from{transform:rotate(" + secondDeg + "deg);}to{transform:rotate(" + (secondDeg + 360) + "deg);}}",
                    "@-moz-keyframes rotate-hour{from{transform:rotate(" + hourDeg + "deg);}to{transform:rotate(" + (hourDeg + 360) + "deg);}}",
                    "@-moz-keyframes rotate-minute{from{transform:rotate(" + minuteDeg + "deg);}to{transform:rotate(" + (minuteDeg + 360) + "deg);}}",
                    "@-moz-keyframes rotate-second{from{transform:rotate(" + secondDeg + "deg);}to{transform:rotate(" + (secondDeg + 360) + "deg);}}"
                ].join("");
            document.getElementById("clock-animations").innerHTML = stylesDeg;
        })();
    }
	
	
	
	//Jquery Spinner / Quantity Spinner
	if($('.quantity-spinner').length){
		$("input.quantity-spinner").TouchSpin({
		  verticalbuttons: true
		});
	}
	
	
	//Tabs Box
	if($('.tabs-box').length){
		$('.tabs-box .tab-buttons .tab-btn').on('click', function(e) {
			e.preventDefault();
			var target = $($(this).attr('data-tab'));
			
			if ($(target).is(':visible')){
				return false;
			}else{
				target.parents('.tabs-box').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
				$(this).addClass('active-btn');
				target.parents('.tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
				target.parents('.tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab');
				$(target).fadeIn(300);
				$(target).addClass('active-tab');
			}
		});
	}
	
	
	
	//LightBox / Fancybox
	if($('.lightbox-image').length) {
		$('.lightbox-image').fancybox({
			openEffect  : 'fade',
			closeEffect : 'fade',
			helpers : {
				media : {}
			}
		});
	}
	
	
	//Date Picker
	if($('.datepicker').length){
		$( '.datepicker' ).datepicker();
	}
	
	
	//Contact Form Validation
	if($('#contact-form').length){
		$('#contact-form').validate({
			rules: {
				username: {
					required: true
				},
				email: {
					required: true,
					email: true
				},
				subject: {
					required: true
				},
				message: {
					required: true
				}
			}
		});
	}
	
	
	
	// Scroll to a Specific Div
	if($('.scroll-to-target').length){
		$(".scroll-to-target").on('click', function() {
			var target = $(this).attr('data-target');
		   // animate
		   $('html, body').animate({
			   scrollTop: $(target).offset().top
			 }, 1500);
	
		});
	}
	
	
	
	// Elements Animation
	if($('.wow').length){
		var wow = new WOW(
		  {
			boxClass:     'wow',      // animated element css class (default is wow)
			animateClass: 'animated', // animation css class (default is animated)
			offset:       0,          // distance to the element when triggering the animation (default is 0)
			mobile:       true,       // trigger animations on mobile devices (default is true)
			live:         true       // act on asynchronously loaded content (default is true)
		  }
		);
		wow.init();
	}
	


/* ==========================================================================
   When document is Scrollig, do
   ========================================================================== */
	
	$(window).on('scroll', function() {
		headerStyle();
	});
	
/* ==========================================================================
   When document is loading, do
   ========================================================================== */
	
	$(window).on('load', function() {
		handlePreloader();
	});	

})(window.jQuery);
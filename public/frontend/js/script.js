;(function($){

	'use strict';

	$(function(){

		

		document.addEventListener("touchstart", function() {},false);

		if ('ontouchstart' in document.documentElement) {
			$('body').css('cursor', 'pointer');
		}

		/* ------------------------------------------------
		Sticky sidebar
		------------------------------------------------ */

		$(window).on("load resize",function(){

			if ($(window).width() > 992 && $('.sticky-bar').length) {

		        $('.content, .sidebar , #sidebar').theiaStickySidebar({
			      // Settings
			      additionalMarginTop: 30
			    });

		    }

		});

		/* ---------------------------------------------------- */
		/*	Media holder events									*/
		/* ---------------------------------------------------- */

		$(window).scroll(function() {
		  var scroll = $(window).scrollTop();
			$(".zoom-bg").css({
				backgroundSize: (100 + scroll/10)  + "%"
				//top: -(scroll/100)  + "%",
			});
		});

		if ($('.text-toggle').length){

			var textToggle = $('.text-toggle');

			$(window).scroll(function() {    
			    var scroll = $(window).scrollTop();

			    if (scroll >= 200) {
			        textToggle.addClass('text-hide');
			    } else {
			        textToggle.removeClass('text-hide');
			    }
			});

		}

		/* ---------------------------------------------------- */
		/*	Side Menu toggle									*/
		/* ---------------------------------------------------- */

		if ($('.side-menu').length && $(window).width > 992) {

			$(".slide").on('click',function(){

				$(this).toggleClass('current');

	    		var target = $(this).parent().children(".slideContent");
		    	$(target).slideToggle();
		    	$(this).parent().siblings().children('ul').slideUp("slow");
    
			});

		}

		/* ---------------------------------------------------- */
		/*	Animate a regular anchor navigation					*/
		/* ---------------------------------------------------- */

	    if ($('a.animated').length) {

	    	$('body').localScroll({
	           hash: true,
	           filter: '.animated',
	           onBefore: function(){
                 this.offset = -100;
               }
	        });

	        // highlight menu element on scroll
	        calculateScroll();
	        $(window).scroll(function(event) {
	            calculateScroll();
	        });

	        /*  Automatically Highlights Navigation Item */
	        var rangeTop        = 300; //rangeTop is used for changing the class a little sooner that reaching the top of the page
	        var rangeBottom     = 300; //rangeBottom is similar but used for when scrolling bottom to top
	        function calculateScroll() {
	            var winTop = $(window).scrollTop();
	            var contentTop      = [];
	            var contentBottom   = [];
	            $('#menu').find('a.animated').each(function(){
	                contentTop.push( $( $(this).attr('href') ).offset().top );
	                contentBottom.push( $( $(this).attr('href') ).offset().top + $( $(this).attr('href') ).height() );
	            })

	            $.each( contentTop, function(i){
	                if ( winTop > contentTop[i] - rangeTop && winTop < contentBottom[i] - rangeBottom ){
	                    $('#menu > li').removeClass('current').eq(i).addClass('current');
	                }
	            })
	        }

	    }

		/* ---------------------------------------------------- */
		/*	Countdown											*/
		/* ---------------------------------------------------- */

		$('.countdown').each(function(){
			var $this = $(this),
				endDate = $this.data(),
				until = new Date(
					endDate.year,
					endDate.month || 0,
					endDate.day || 1,
					endDate.hours || 0,
					endDate.minutes || 0,
					endDate.seconds || 0
				);
			// initialize
			$this.countdown({
				until : until,
				format : 'dHMS',
				labels : ['Years', 'Month', 'Weeks', 'Days', 'Hours', 'Minutes', 'Seconds']
			});
		});

		/* ---------------------------------------------------- */
		/*	Background size screen								*/
		/* ---------------------------------------------------- */

	    if ($('.full-scr').length) {

	    	$('.full-scr').css('height', window.innerHeight+'px');

	    }

	    /* ---------------------------------------------------- */
		/*	Revolution slider									*/
		/* ---------------------------------------------------- */

		if ($('.rev-slider-wrapper').hasClass('bg-changer')) {

	    	if ($('#rev-slider').length) {
				jQuery("#rev-slider").revolution({
		            sliderType:"standard",
			    	spinner: "spinner3",
					shuffle:"off",
					autoHeight:"off",
					hideThumbsOnMobile:"off",
					hideSliderAtLimit:0,
					hideCaptionAtLimit:0,
					hideAllCaptionAtLilmit:0,
			    	delay:6000,
		            visibilityLevels:[1460,1280,1024],
		            responsiveLevels:[1460,1280,1024],
					gridwidth:[1460,1280,1024],
		            gridheight:1090
		        });

		    }

		} else {

			if ($('#rev-slider').length) {
				jQuery("#rev-slider").revolution({
		            sliderType:"standard",
			    	spinner: "spinner3",
					shuffle:"off",
					autoHeight:"off",
					hideThumbsOnMobile:"off",
					hideSliderAtLimit:0,
					hideCaptionAtLimit:0,
					hideAllCaptionAtLilmit:0,
			    	delay:6000,
		            navigation: {
		                bullets:{
				        	style:"",
				        	enable: true,
				        	container: "slider",
				        	hide_onmobile: false,
				        	hide_onleave: false,
				        	hide_delay: 200,
				        	hide_under: 0,
				        	hide_over: 9999,
				        	tmp:'<span class="circle-bullet"></span>', 
				        	direction:"horisontal",
				        	space: 15,       
				        	h_align: "center",
				        	v_align: "bottom",
				        	v_offset: 40,
				        	h_offset: -5
				        }
		            },
		            responsiveLevels:[4096,1024,480],
					gridwidth:[1400,1200,1024,480],
		            gridheight:958
		        });


		    }

		}

	    /* ---------------------------------------------------- */
        /*	Multiscroll											*/
        /* ---------------------------------------------------- */

        if ($('#myContainer').length) {

        	if ($(window).width() <= 992) {

	            $('.ms-right .ms-section').unwrap().appendTo('.ms-left');

	            var ul = $('.ms-left').find('.ms-section').sort((a, b) => {
	              return $(a).data('id') - $(b).data('id')
	            })

	            $('.ms-left').empty().append(ul);

	        } else {
	            $('#myContainer').multiscroll({
	                navigation: true,
		        	loopBottom: true,
		        	css3: true
	            });
	        }

	    }
	    
	    /* ---------------------------------------------------- */
        /*	Isotope												*/
        /* ---------------------------------------------------- */
        
		if($('.isotope').length){

        	$( window ).on('load', function() {

			    $.mad_core.isotope();
			     
			});

        }

		/* ---------------------------------------------------- */
        /*	Gallery carousel									*/
        /* ---------------------------------------------------- */

	  	var pageCarousel = $('.owl-carousel');

		if(pageCarousel.length){

			$('.owl-carousel').not('#thumbnails').not('.calendar-carousel').each(function(){
	
				/* Max items counting */
				var max_items = $(this).data('max-items');
				var tablet_items = max_items;
				if(max_items > 4){
					tablet_items = max_items - 2;
				}else{
					tablet_items = max_items - 1;
				}
				var smart_items = max_items;
				if(max_items > 4){
					smart_items = max_items - 3;
				}else{
					smart_items = 1;
				}
				if(max_items < 2){
					smart_items = max_items;
					tablet_items = max_items;
				}
				var mobile_items = 1;

				var autoplay_carousel = $(this).data('autoplay');

				var center_carousel = $(this).data('center');

				var item_margin = $(this).data('item-margin');
				
				/* Install Owl Carousel */
				$(this).owlCarousel({
				    smartSpeed : 450,
				    nav : true,
				    loop  : true,
				    autoplay : true,
				    center: center_carousel,
				    autoplayTimeout: 3000,
				    navText : false,
				    margin: item_margin,
	 
				    rtl: $.mad_core.SUPPORT.ISRTL ? true : false,
				    responsiveClass:true,
				    responsive : {
				        0:{
				            items:mobile_items
				        },
				        480:{
				        	items:smart_items
				        },
				        768:{
				            items:tablet_items
				        },
				        992:{
				            items:max_items
				        }
				    }
				});

			});

			if(pageCarousel.hasClass('team-holder')){

				var owl = $('.team-holder.owl-carousel');
				var owl_center = $('.owl-item.center');
				owl.owlCarousel();

				$('.owl-item .team-item .member-photo').on('click', function (e) {
					e.preventDefault();
				})

				owl_center.next().on('click', function(e){
					$(this).trigger('next.owl.carousel');
				});

				owl_center.prev().on('click', function(e){
					$(this).trigger('prev.owl.carousel');
				});

				owl.on('changed.owl.carousel', function() {
				    $('.owl-item.center').next().on('click', function(e){
						$(this).trigger('next.owl.carousel');
					});

					$('.owl-item.center').prev().on('click', function(e){
						$(this).trigger('prev.owl.carousel');
					});
				})

			}

			if($('#thumbnails').length){
				$('#thumbnails').each(function(){
					
					/* Max items counting */
					var max_items = $(this).data('max-items');
					var tablet_items = max_items;
					if(max_items > 1){
						tablet_items = max_items - 1;
					}
					var smart_items = max_items;
					if(max_items > 3){
						smart_items = max_items - 2;
					}else{
						smart_items = max_items - 1;
					}
					var mobile_items = 1;

					var autoplay_carousel = $(this).data('autoplay');

					var center_carousel = $(this).data('center');

					var item_margin = $(this).data('item-margin');
					
					$(this).owlCarousel({
						items : max_items,
						URLhashListener : false,
						navSpeed : 800,
						nav : true,
						margin: 0,
						loop : false,
						rtl: $.mad_core.SUPPORT.ISRTL ? true : false,
						navText:false,
						responsive : {
					        0:{
					            items:tablet_items
					        },
					        481:{
					            items:max_items
					        }
					    }
				    });
				});
			    
			}

			if($('.calendar-carousel').length){
				$('.calendar-carousel').each(function(){
					
					$(this).owlCarousel({
						items : 1,
						navSpeed : 800,
						nav : true,
						autoplay : false,
						loop : false,
						rtl: $.mad_core.SUPPORT.ISRTL ? true : false,
						navText:false
				    });
				});
			    
			}

		}

		/* ---------------------------------------------------- */
		/*	Elevate zoom										*/
		/* ---------------------------------------------------- */

		if($('[data-zoom-image]').length){

			var button = $('.qv-preview');

			$("#zoom-image").elevateZoom({
				gallery:'thumbnails',
				galleryActiveClass: 'active',
				zoomType: "inner",
				cursor: "crosshair",
				responsive:true,
			    zoomWindowFadeIn: 500,
				zoomWindowFadeOut: 500,
				easing:true,
				lensFadeIn: 500,
				lensFadeOut: 500
			});

		}

		/* ---------------------------------------------------- */
        /*	Custom Select										*/
        /* ---------------------------------------------------- */

        if($('.mad-custom-select').length){

    		$.MadCustomSelects();

        };

		/* ---------------------------------------------------- */
        /*	Tabs												*/
        /* ---------------------------------------------------- */

        $(window).on("load", function(){

        	var tabs = $('.tabs-section');
			if(tabs.length){
				tabs.tabs({
					beforeActivate: function(event, ui) {
				        var hash = ui.newTab.children("li a").attr("href");
				   	},
					hide : {
						effect : "fadeOut",
						duration : 450
					},
					show : {
						effect : "fadeIn",
						duration : 450
					},
					updateHash : false
				});
			}

			/* ------------------------------------------------
				Tabs - opacity
			------------------------------------------------ */

			var tabs = $('.mad-tabs-holder');

			if(tabs.length){

				tabs.MadTabs({
					easing: 'easeOutQuint',
					speed: 600,
					cssPrefix: 'mad-'
				});

			}

        });

		/* ---------------------------------------------------- */
        /*	Newsletter											*/
        /* ---------------------------------------------------- */

	    var subscribe = $('[id^="newsletter"]');
	      subscribe.append('<div class="message-container-subscribe"></div>');
	      var message = $('.message-container-subscribe'),text;

	      subscribe.on('submit',function(e){
	        var self = $(this);
	        
	        if(self.find('input[type="email"]').val() == ''){
	          text = "Please enter your e-mail!";
	          message.html('<div class="alert-warning">'+text+'</div>')
	            .slideDown()
	            .delay(4000)
	            .slideUp(function(){
	              $(this).html("");
	            });

	        }else{
	          self.find('span.error').hide();
	          $.ajax({
	            type: "POST",
	            url: "bat/newsletter.php",
	            data: self.serialize(), 
	            success: function(data){
	              if(data == '1'){
	                text = "Your email has been sent successfully!";
	                message.html('<div class="alert-success">'+text+'</div>')
	                  .slideDown()
	                  .delay(4000)
	                  .slideUp(function(){
	                    $(this).html("");
	                  })
	                  .prevAll('input[type="email"]').val("");
	              }else{
	                text = "Invalid email address!";
	                message.html('<div class="alert-error">'+text+'</div>')
	                  .slideDown()
	                  .delay(4000)
	                  .slideUp(function(){
	                    $(this).html("");
	                  });
	              }
	            }
	          });
	        }
	        e.preventDefault();
	    });

		/* ---------------------------------------------------- */
        /*	Loader												*/
        /* ---------------------------------------------------- */

		if($('.loader').length){

        	$("body").queryLoader2({
		        backgroundColor: '#fff',
		        barColor : '#e883ae',
		        barHeight: 4,
		        deepSearch:true,
		        minimumTime:1000,
		        onComplete: function(){
		        	$(".loader").fadeOut('200');
		        }
	      	});

        }

		/* ---------------------------------------------------- */
        /*	Sticky menu											*/
        /* ---------------------------------------------------- */

		$('body').Temp({
			sticky: true
		});

		/* ------------------------------------------------
		Instagram Feed
		------------------------------------------------ */

	    if($('.instagram-feed').length){

	    	if($('#instafeed').length){

	    		var feed = new Instafeed({
			      target: 'instafeed',
			      tagName: 'living',
			      limit: 6,
			      get: 'user',
			      userId: 8253949243,
			      accessToken: '8253949243.1677ed0.92a1c427f7274134a812ee9b13038e10',
			      resolution: 'standard_resolution',
			      clientId: 'a17ccf850aae43a0805c00ac4792a3b9',
			      template: '<li class="nv-instafeed-item"><a href="#" title="{{location}}"><img src="{{image}}" /></a></li>'
			    });
			      
			    feed.run();

		    }

	    }

	    if($('.instagram-carousel').length){

	    	$('#instafeed').each(function(){

	    		var feed = new Instafeed({
			      target: 'instafeed',
			      tagName: 'living',
			      limit: 6,
			      get: 'user',
			      userId: 8253949243,
			      accessToken: '8253949243.1677ed0.92a1c427f7274134a812ee9b13038e10',
			      resolution: 'standard_resolution',
			      clientId: 'a17ccf850aae43a0805c00ac4792a3b9',
			      template: '<div class="nv-instafeed-item"><a href="{{image}}" title="{{location}}" data-fancybox="instagram"><img src="{{image}}" /></a></div>',
			        after: function() {
				        $('#instafeed').addClass('owl-carousel').owlCarousel({
				            items: 1,
				            nav : true,
				            dots: false,
				            rtl: $.mad_core.SUPPORT.ISRTL ? true : false,
						    loop  : true,
						    autoplay : true,
						    navText: false
				        });
				    }
			    });
			      
			    feed.run();

	    	});

	    }

	    /* ------------------------------------------------
		Twitter Feed
		------------------------------------------------ */

	    if($("#twitter").length){

    		$('#twitter').tweet({

			    modpath: 'plugins/twitter/',
			    username: "velikorodnov",
			    template: "{text}{time}<div class='tweet-action'>{retweet_action}{favorite_action}</div>",
			    count: 3,
			    loading_text: 'loading twitter feed...'
			    /* etc... */

			});

		}
		
		/* ---------------------------------------------------- */
        /*	Price Scale										    */
        /* ---------------------------------------------------- */

		var slider;
		if($('#price').length){
			slider = $('#price').slider({ 
		 		animate: true,
				range: true,
				values: [ 1, 99],
				min: 0,
				max: 100,
				slide : function(event ,ui){
					$('.range-values').find('.first-limit').val('$' + ui.values[0] + ',000');
					$('.range-values').find('.last-limit').val('$' + ui.values[1] + ',000');
				}
			});
		}

		/* ---------------------------------------------------- */
        /*	Accordion & Toggle									*/
        /* ---------------------------------------------------- */

		var aItem = $('.accordion:not(.toggle) .accordion-item'),
			link = aItem.find('.a-title'),
			$label = aItem.find('label'),
			aToggleItem = $('.accordion.toggle .accordion-item'),
			tLink = aToggleItem.find('.a-title');

			aItem.add(aToggleItem).children('.a-title').not('.active').next().hide();

		function triggerAccordeon($item) {
			$item
			.addClass('active')
			.next().stop().slideDown()
			.parent().siblings()
			.children('.a-title')
			.removeClass('active')
			.next().stop().slideUp();
		}


		if ($label.length) {
			$label.on('click',function(){
				triggerAccordeon($(this).closest('.a-title'))
			});
		} else {
			link.on('click',function(){
				triggerAccordeon($(this))
			});
		}

		tLink.on('click',function(){
			$(this).toggleClass('active')
			.next().stop().slideToggle();

		});

		/* ---------------------------------------------------- */
        /*	Quantity											*/
        /* ---------------------------------------------------- */

		var q = $('.quantity');

		q.each(function(){
			var $this = $(this),
				button = $this.children('button'),
				input = $this.children('input[type="text"]'),
				val = +input.val();

			button.on('click',function(){
				if($(this).hasClass('qty-minus')){
					if(val === 1) return false;
					input.val(--val);
				}
				else{
					input.val(++val);
				}
			});
		});

		/* ---------------------------------------------------- */
        /*	Contact Form										*/
        /* ---------------------------------------------------- */

		if ($('[id*="contact-form"]').length){

			var cf = $('[id*="contact-form"]');
			cf.append('<div class="message-container"></div>');

			cf.on("submit",function(event){

				var self = $(this),text;

				var request = $.ajax({
					url  : "bat/mail.php",
					type : "POST",
					data : self.serialize()
				});

				request.then(function(data){
					if(data === "1"){

						text = "Your message has been sent successfully!";

						cf.find('input:not([type="submit"]),textarea').val('');

						$('.message-container').html('<div class="alert-success"><p>'+text+'</p></div>')
							.delay(150)
							.slideDown(300)
							.delay(4000)
							.slideUp(300,function(){
								$(this).html("");
							});

					}
					else{
						if(cf.find('textarea').val().length < 20){
							text = "Message must contain at least 20 characters!"
						}
						if(cf.find('input').val() === ""){
							text = "All required fields must be filled!";
						}
						$('.message-container').html('<div class="alert-error"><p>'+text+'</p></div>')
							.delay(150)
							.slideDown(300)
							.delay(4000)
							.slideUp(300,function(){
								$(this).html("");
							});
					}
				},function(){
					$('.message-container').html('<div class="alert-error"><p>Connection to server failed!</p></div>')
					.delay(150)
					.slideDown(300)
					.delay(4000)
					.slideUp(300,function(){
						$(this).html("");
					});
				});

				event.preventDefault();

			});

		}

		/* ---------------------------------------------------- */
		/*	Google Maps											*/
		/* ---------------------------------------------------- */

		if ($('#googleMap').length) {

			var myCenter = new google.maps.LatLng(30.2259488, -97.7145152);

			function loadMap() {
			  	var mapProp = {
				    center: myCenter,
				    zoom:13,
				    mapTypeId:google.maps.MapTypeId.ROADMAP

				};

				var map = document.getElementById('googleMap');

				if(map !== null){

			    	var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

				}

	            var marker = new google.maps.Marker({
	               position:myCenter,
	               map: map,
	               icon: 'images/map_marker.png'
	            });
	            
	            marker.setMap(map);

	            //Zoom to 7 when clicked on marker
	            google.maps.event.addListener(marker,'click',function() {
	               map.setZoom(9);
	               map.setCenter(marker.getPosition());
	            });

			}
			google.maps.event.addDomListener(window, 'load', loadMap);
			
		}

		

	});

})(jQuery);
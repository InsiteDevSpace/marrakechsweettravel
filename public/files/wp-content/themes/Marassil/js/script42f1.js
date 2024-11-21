/*------------ wowo ------------*/

jQuery(document).ready(function($) {
		wowo();

	jQuery(window).scroll(function() {
		wowo();
		
	});
	jQuery(window).on("load",function() {
		wowo();
		
		
	});
	
	

	


function wowo($) {
    setTimeout(function () {
        jQuery('html').addClass("show-c");
        
        var wTop = jQuery(window).scrollTop(), wHeight = jQuery(window).height(), wBottom = wTop + wHeight;

        jQuery(".wowo:not(.animated)").each(function () {
            var me = jQuery(this), meTop = me.offset().top, meHeight = me.height(), meBottom = meTop + meHeight,
                    limitTop = wTop - meHeight, limitBottom = wBottom + meHeight;
            if (meTop > limitTop && meBottom < limitBottom) {
                me.addClass("animated");
                setTimeout(function () {
                    //me.removeClass("animated wowo");
                }, 1500);
            }
        });

    }, 100);
}

	/*------------ wowo ------------*/

	/*------------ <a> hover ------------*/
	document.body.addEventListener('touchstart', function() {});
	/*------------ <a> hover ------------*/


	$(window).scroll(function() {
		var sh = $(window).scrollTop();
		if(sh > 300 && !$("#head").hasClass("head-small")) {
			$("#head").addClass("head-small");
			jQuery(".sidebar-block").addClass("is-active");
			jQuery(".header-stick").addClass("is-active");
			jQuery(".mobile-header").addClass("is-active");
			
			

		} else if(sh <= 300 && $("#head").hasClass("head-small")) {
			$("#head").removeClass("head-small");
			jQuery(".sidebar-block").removeClass("is-active");
			jQuery(".header-stick").removeClass("is-active");
			jQuery(".mobile-header").removeClass("is-active");
		}
		
		if(sh > 30 && !$("#head").hasClass("head-small-two")) {
			$("#head").addClass("head-small-two");
			jQuery(".sidebar-block").addClass("is-active-two");
			jQuery(".header-stick").addClass("is-active-two");
			jQuery(".mobile-header").addClass("is-active-two");
			
			

		} else if(sh <= 30 && $("#head").hasClass("head-small-two")) {
			$("#head").removeClass("head-small-two");
			jQuery(".sidebar-block").removeClass("is-active-two");
			jQuery(".header-stick").removeClass("is-active-two");
			jQuery(".mobile-header").removeClass("is-active-two");
		}
		
	});
	$(window).scroll(function() {
        var sh = jQuery(window).scrollTop();
        var wh_ha = jQuery(window).height()/3;

        jQuery(".parallax-s").each(function(){
            var parallax_h = jQuery(this).offset().top;
            if(sh>(parallax_h-wh_ha)){
                var parallax_y = (sh-(parallax_h-wh_ha))/6;
                jQuery(this).css('transform','translate3d(0px,-'+parallax_y+'px, 0px)');
            }
        });
    });

	/*------------ hamburgerurger & header ------------*/



	function menu(){

		jQuery('.hamburger').click(function(){
			jQuery(this).toggleClass('open');
			jQuery('.head-menu').toggleClass('open');
			jQuery('header').toggleClass('open');

			if(jQuery('.hamburger').hasClass('open')){
				jQuery('body').addClass('hidden');
				setTimeout(function(){
					jQuery('.head-logo').addClass('open');
				},800);

			}


			if(!jQuery('.hamburger').hasClass('open')){
				jQuery('body').removeClass('hidden');
				setTimeout(function(){
					jQuery('.head-logo').removeClass('open');
				},1);
				jQuery(".menu .menu-box .menu-box-box .menu-menu .menu-item-has-children .sub-menu").removeClass("open-sub-menu");

			}
			if(!jQuery('.hamburger').hasClass('open')){

			}
		

	});

		jQuery(".head-menu .menu .menu-item-has-children>a").append("<span class='icon iconfont icondvmp'></span>");

		jQuery("body").on("click",".head-menu .menu .menu-item-has-children>a .icondvmp",function(e){
			e.preventDefault();
			jQuery(this).parent("a").siblings(".sub-menu").slideToggle(300);
			jQuery(this).parents(".menu-item-has-children").toggleClass('is-active');

			jQuery(this).parents(".menu-item-has-children").siblings().children(".sub-menu").slideUp(300);
			jQuery(this).parents(".menu-item-has-children").siblings().removeClass('is-active');
//			var t=jQuery(this)
//			setTimeout(function(){
//					t.parents(".menu-item-has-children").toggleClass('is-open');
//				},3);
			
		});
	
	
	jQuery(".go-top a").click(function(e){
	   	e.preventDefault();
	       jQuery('body,html').animate({scrollTop:0},600);
	});
	jQuery(".foot-go-top a").click(function(e){
	   	e.preventDefault();
	       jQuery('body,html').animate({scrollTop:0},600);
	});
	jQuery("header .header .nav-main .content .menu>li>a").click(function(e){
	   	e.preventDefault();
	       jQuery(this).siblings(".sub-menu").slideToggle(300);
	       jQuery(this).parents("li").toggleClass("is-active");
	       jQuery(this).parents("li").siblings().removeClass("is-active");
	       jQuery(this).parents("li").siblings().children(".sub-menu").slideUp(300);
	   });
	jQuery("header .header .top-bar .right .menu .menu-item-has-children>a").click(function(e){
		e.preventDefault();
	});
	jQuery("header .header .top-bar .right .menu .menu-item-has-children").click(function(e){
	   	
	   	e.stopPropagation();
	   	
	       jQuery(this).toggleClass("is-active");
	       jQuery("header .header .top-bar .right").toggleClass("is-active");
	       if($(window).width() < 992.1){
	       	var asd=jQuery("header .header .top-bar .right");
			jQuery('header .head-box-c').stop().animate({scrollTop:asd.offset().top},600);
	       }
	   });
	jQuery("body").click(function(e){
	   	e.stopPropagation();
	       jQuery("header .header .top-bar .right .menu .menu-item-has-children").removeClass("is-active");
	       jQuery("header .header .top-bar .right").removeClass("is-active");
	   });
	jQuery("header .header .top-bar .left .map-box .local-btn").click(function(e){
	   	e.preventDefault();
	   	e.stopPropagation();
		   	if($(window).width() < 992.1){
		       jQuery(this).siblings(".map-content").slideToggle(300);
		       jQuery(this).toggleClass("is-active");
		       var asd=jQuery("header .header .top-bar .left .map-box");
				jQuery('header .head-box-c').stop().animate({scrollTop:asd.offset().top},600);
		   	}
	   });
}
	
	function home(){
		
//		jQuery("body [class*='wp-block-']").addClass("wowo");
//		jQuery("body [class*='wp-block-']").addClass("fadeInUp");
		
		jQuery(".next-section").click(function(e){
	   	e.preventDefault();
	       var asd=jQuery(window).height();
			
			jQuery('html,body').stop().animate({scrollTop:asd - 50},600);
	   });
		
		jQuery(".dark-light-mode").click(function(){
	        jQuery(".switch-btn").toggleClass("dark");
	         jQuery("html,body").toggleClass("active");
	         //jQuery(".nav-main .logo img").toggleClass("light")
	   });
	   jQuery(".btn-search").click(function(e){
	   	e.preventDefault();
	       jQuery(".form-search").addClass("active");
	       setTimeout(function(){
	       jQuery(".form-search .content .form-box input").focus();
	       },400);
	   });
	   jQuery(".form-search .close-btn").click(function(e){
	   	e.preventDefault();
	    jQuery(".form-search").removeClass("active");
	    jQuery("#ajaxsearchprores1_1").css("visibility","hidden");
	    
	   });
	   
	   jQuery('.form-search .content .form-box input').on("input propertychange",function(){
			var _this = jQuery('.form-search .content .form-box input').val();
			console.log(_this);
			if(_this == ""){
				jQuery(".form-search .content .form-box .submit").fadeOut(300);
			}else{
				jQuery(".form-search .content .form-box .submit").fadeIn(300);
				
			}
		});
		jQuery(".form-search .content .form-box .submit").click(function(e){
			jQuery(".form-search .content .form-box .submit").fadeOut(300);
	    	jQuery('.form-search .content .form-box input').val("");
	    	setTimeout(function(){
	       		jQuery(".form-search .content .form-box input").focus();
	       	},100);
	       	jQuery(".search-result").empty();
	    
	   });
	   
	   
	   if (jQuery('.home-banner-slider').length > 0) {
			jQuery('.home-banner-slider').slick({
				dots: false,
				arrows: false,
				infinite: true,
				fade: true,
				speed: 600,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: false,
				pauseOnHover: false,
				autoplaySpeed: 5000,
				
				accessibility:false,
			});
		}
	   	
//	   	jQuery('.home-banner-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
//			jQuery('.home-banner .home-banner-box .images .img-2 ').addClass('move-active');
//			setTimeout(function() {
//				jQuery('.home-banner .home-banner-box .images .img-2 ').removeClass('move-active');
//				jQuery('.home-banner .home-banner-box .images .img-2 ').addClass('move-active-1');
//			}, 400);
//			setTimeout(function() {
//				jQuery('.home-banner .home-banner-box .images .img-2 ').removeClass('move-active-1');
//			}, 800);
//		});
//		
//		jQuery('.home-banner-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
//	   		jQuery('.home-banner .home-banner-box .images .img-2 ').addClass('lvse-active');
//	   		jQuery('.home-banner-slider .slider-block').eq(nextSlide).addClass('img-a-1');
//
//			setTimeout(function() {
//				jQuery('.home-banner-slider .slider-block').removeClass('img-a-1');
//				jQuery('.home-banner-slider .slider-block').eq(nextSlide).addClass('img-a-2');
//			}, 400)
//			setTimeout(function() {
//				jQuery('.home-banner .home-banner-box .images .img-2 ').removeClass('lvse-active');
//				jQuery('.home-banner-slider .slider-block').removeClass('img-a-2');
//			}, 800);
//			
//		});
	   
	   if (jQuery('.img-1-slider').length > 0) {
			jQuery('.img-1-slider').slick({
				dots: false,
				arrows: false,
				infinite: true,
				fade: true,
				speed: 600,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: false,
				pauseOnHover: false,
				autoplaySpeed: 5000,
				
				accessibility:false,
			});
		}
	   
		
	   	jQuery('.img-1-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
	   		jQuery('.home-banner .home-banner-box .images .img-1 ').addClass('lvse-active');
	   		jQuery('.img-1-slider .slider-block').eq(nextSlide).addClass('img-a-1');

			setTimeout(function() {
				jQuery('.img-1-slider .slider-block').removeClass('img-a-1');
				jQuery('.img-1-slider .slider-block').eq(nextSlide).addClass('img-a-2');
			}, 400)
			setTimeout(function() {
				jQuery('.home-banner .home-banner-box .images .img-1 ').removeClass('lvse-active');
				jQuery('.img-1-slider .slider-block').removeClass('img-a-2');
			}, 800);
			
		});
		
	   
	   if (jQuery('.img-2-slider').length > 0) {
			jQuery('.img-2-slider').slick({
				dots: false,
				arrows: false,
				infinite: true,
				fade: true,
				speed: 600,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: false,
				pauseOnHover: false,
				autoplaySpeed: 5000,
				
				accessibility:false,
			});
		}
	   
	   jQuery('.img-2-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
	   		jQuery('.home-banner .home-banner-box .images .img-3 ').addClass('lvse-active');
	   		jQuery('.img-2-slider .slider-block').eq(nextSlide).addClass('img-a-1');

			setTimeout(function() {
				jQuery('.img-2-slider .slider-block').removeClass('img-a-1');
				jQuery('.img-2-slider .slider-block').eq(nextSlide).addClass('img-a-2');
			}, 400)
			setTimeout(function() {
				jQuery('.home-banner .home-banner-box .images .img-3 ').removeClass('lvse-active');
				jQuery('.img-2-slider .slider-block').removeClass('img-a-2');
			}, 800);
			
		});
	    if (jQuery('.img-3-slider').length > 0) {
			jQuery('.img-3-slider').slick({
				dots: false,
				arrows: false,
				infinite: true,
				fade: true,
				speed: 600,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: false,
				pauseOnHover: false,
				autoplaySpeed: 5000,
				
				accessibility:false,
			});
		}

		
		jQuery('.img-3-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
	   		jQuery('.home-banner .home-banner-box .images .img-4 ').addClass('lvse-active');
	   		jQuery('.img-3-slider .slider-block').eq(nextSlide).addClass('img-a-1');

			setTimeout(function() {
				jQuery('.img-3-slider .slider-block').removeClass('img-a-1');
				jQuery('.img-3-slider .slider-block').eq(nextSlide).addClass('img-a-2');
			}, 400)
			setTimeout(function() {
				jQuery('.home-banner .home-banner-box .images .img-4 ').removeClass('lvse-active');
				jQuery('.img-3-slider .slider-block').removeClass('img-a-2');
			}, 800);
			
		});
		
	     if (jQuery('.img-4-slider').length > 0) {
			jQuery('.img-4-slider').slick({
				dots: false,
				arrows: false,
				infinite: true,
				fade: true,
				speed: 600,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: false,
				pauseOnHover: false,
				autoplaySpeed: 5000,
				
				accessibility:false,
			});
		}
		
		jQuery('.img-4-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
	   		jQuery('.home-banner .home-banner-box .images .img-5 ').addClass('lvse-active');
	   		jQuery('.img-4-slider .slider-block').eq(nextSlide).addClass('img-a-1');

			setTimeout(function() {
				jQuery('.img-4-slider .slider-block').removeClass('img-a-1');
				jQuery('.img-4-slider .slider-block').eq(nextSlide).addClass('img-a-2');
			}, 400)
			setTimeout(function() {
				jQuery('.home-banner .home-banner-box .images .img-5 ').removeClass('lvse-active');
				jQuery('.img-4-slider .slider-block').removeClass('img-a-2');
			}, 800);
			
		});
		
	    //slider.slickSetOption("autoplay",false,false);
	    jQuery('.home-left-text-and-right-images .block').each(function(){
	    	if (jQuery(this).children(".box").length < 3) {
		    	jQuery(this).addClass("is-two");
		    }
	    	if (jQuery(this).children(".box").length < 2) {
		    	jQuery(this).addClass("is-one");
		    }
	    	
	    	if (jQuery(this).children(".box").length > 2) {
				jQuery(this).slick({
					dots: true,
					arrows: false,
					infinite: true,
					fade: false,
					speed: 800,
					slidesToShow: 2,
					slidesToScroll: 1,
					autoplay: true,
					pauseOnHover: false,
					autoplaySpeed: 3000,
					accessibility:false,
					responsive: [
						
						{
					    	breakpoint: 556.1,
							settings: {
								slidesToShow: 1,
								slidesToScroll: 1,
							}
						},
					
					]
				});
			}
	    	
	    });
	    
	   
	    
	    
	   if (jQuery('.left-text-and-right-slider').length > 0) {
			jQuery('.left-text-and-right-slider').slick({
				dots: true,
				arrows: false,
				infinite: true,
				fade: true,
				speed: 800,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: true,
				pauseOnHover: false,
				autoplaySpeed: 5000,
				
				accessibility:false,
			});
		}
	   if (jQuery('.logos-slider').length > 0) {
			jQuery('.logos-slider').slick({
				dots: false,
				arrows: false,
				infinite: true,
				fade: false,
				speed: 800,
				slidesToShow: 5,
				slidesToScroll: 5,
				autoplay: true,
				pauseOnHover: false,
				autoplaySpeed: 5000,
				accessibility:false,
				responsive: [
				    {
				    	breakpoint: 992.1,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3,
						}
					},
					{
				    	breakpoint: 767.1,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2,
						}
					},
					{
						breakpoint: 375,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						}
					}
				]
			});
		}
	   
	   if (jQuery('.home-add-new-block-slider').length > 0) {
			jQuery('.home-add-new-block-slider').slick({
				dots: false,
				arrows: false,
				infinite: true,
				fade: true,
				speed: 600,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: true,
				pauseOnHover: false,
				autoplaySpeed: 5000,
				
				accessibility:false,
			});
		}
	   
	   jQuery(".actualites-list .actualites-list-box .list-one a").hover(function(){
	   		jQuery(this).parents(".list-one").toggleClass("is-active");
	   });
	   jQuery(".actualites-list .actualites-list-box .list a").hover(function(){
	   		jQuery(this).parents(".list").toggleClass("is-active");
	   });
	   jQuery(".page-actualites-list .page-actualites-list-box .content .content-box .list a").hover(function(){
	   		jQuery(this).parents(".list").toggleClass("is-active");
	   });
	   jQuery(".home-les-actualites .home-les-actualites-box .content .left .list a").hover(function(){
	   		jQuery(this).parents(".list").toggleClass("is-active");
	   });
	   
	   
	  
	   
	   jQuery(".wp-block-buttons").each(function(){
	   	jQuery(this).find("a").append("<i></i>");
	   });
	   
	   jQuery(".wp-block-file").each(function(){
	   	jQuery(this).find("a").append("<i></i>");
	   });
	   jQuery(".file-button").each(function(){
	   	jQuery(this).append("<i></i>");
	   });
	   
	   jQuery(".faqs .faqs-box .block .title-c").click(function(e){
	   	e.stopPropagation();
	   		
	   			jQuery(this).siblings(".text-c").slideToggle(300);
		       	jQuery(this).parents(".block").toggleClass("is-active");
		       	jQuery(this).parents(".block").siblings().children(".text-c").slideUp(300);
		       	jQuery(this).parents(".block").siblings().children(".title-c").removeClass("is-active");
	      
	   });
	   
	   jQuery(".formulaire-de-contact .formulaire-de-contact-box .content .form-group input").focus(function(e){
   			e.stopPropagation();
	       	jQuery(this).parents(".form-group").addClass("is-active");	      
	   });
	   
	   jQuery(".formulaire-de-contact .formulaire-de-contact-box .content .form-group textarea").focus(function(e){
   			e.stopPropagation();
	       	jQuery(this).parents(".form-group").addClass("is-active");	      
	   });
	   
	   jQuery("body").on("blur",".formulaire-de-contact .formulaire-de-contact-box .content .form-group input",function(){
   			jQuery(".formulaire-de-contact .formulaire-de-contact-box .content .form-group").each(function(){
   				var this_c=jQuery(this);
   				var va=this_c.find("input").val();
   				
   				if(va == ""){
	   				this_c.removeClass("is-active");	  
	   			}else{
	   				console.log("aa");
	   			}
   			});
   			
	       	    
	   });
	   
	    jQuery("body").on("blur",".formulaire-de-contact .formulaire-de-contact-box .content .form-group textarea",function(){
   			jQuery(".formulaire-de-contact .formulaire-de-contact-box .content .form-group").each(function(){
   				var this_c=jQuery(this);
   				var va=this_c.find("textarea").val();
   				
   				if(va == ""){
	   				this_c.removeClass("is-active");	  
	   			}else{
	   				console.log("aa");
	   			}
   			});
   			
	       	    
	   });
	   
	   jQuery(".text-and-newsletter .text-and-newsletter-box .content .form .form-submit input").val("OK");
		jQuery("#cff .cff-load-more").append("<i></i>");
		
		jQuery("header .header .nav-main .content .menu-item-has-children .sub-menu li a").append("<i></i>");
		
		if ($('.gallery-wrap   a[data-rel^=lightcase]').length > 0) {
			$('.gallery-wrap   a[data-rel^=lightcase]').click(function (e) {
				e.preventDefault();
			})
			var lightcase1 = $('.gallery-wrap a[data-rel^=lightcase]').lightcase({
				maxWidth: 920,
				maxHeight: 920,
				showSequenceInfo: false,
				transition: 'fade',
				// transitionOut:'scrollRight',
				swipe: true,
			});
		}
		
		jQuery(".home-logo-slider .home-logo-slider-box .title h2").click(function(){
			jQuery(this).addClass("is-active");
			jQuery(this).siblings().removeClass("is-active");
			var ins=jQuery(this).index();
			if(ins == 0){
				jQuery(".home-logo-slider .home-logo-slider-box .content-box .content-box-box .content-list .content-list-box").eq(0).addClass("is-active");
				jQuery(".home-logo-slider .home-logo-slider-box .content-box .content-box-box .content-list .content-list-box").eq(1).removeClass("is-active");
			}else{
				jQuery(".home-logo-slider .home-logo-slider-box .content-box .content-box-box .content-list .content-list-box").eq(1).addClass("is-active");
				jQuery(".home-logo-slider .home-logo-slider-box .content-box .content-box-box .content-list .content-list-box").eq(0).removeClass("is-active");
			}
		});
		
	}
	
	function map_click(){
		if($(window).width() < 767.1){
			jQuery(".map-content .img-wrap").click(function(){
				jQuery(this).parents(".map-content").find(".mapsvg-marker").addClass("is-show");
			});
		}
		
		
		if($(window).width() > 767.1){
			//
			jQuery(".map-t-1").hover(function(){
		   		jQuery(".map-marker-1").toggleClass("is-active");
		   	});
		   	jQuery(".map-t-1").click(function(){
		   		jQuery(".map-marker-1")[0].click();
		   	});
		   	//
		   	jQuery(".map-t-2").hover(function(){
		   		jQuery(".map-marker-2").toggleClass("is-active");
		   	});
		   	jQuery(".map-t-2").click(function(){
		   		jQuery(".map-marker-2")[0].click();
		   	});
		   	//
		   	jQuery(".map-t-3").hover(function(){
		   		jQuery(".map-marker-3").toggleClass("is-active");
		   	});
		   	jQuery(".map-t-3").click(function(){
		   		jQuery(".map-marker-3")[0].click();
		   	});
		   	//
		   	jQuery(".map-t-4").hover(function(){
		   		jQuery(".map-marker-4").toggleClass("is-active");
		   	});
		   	jQuery(".map-t-4").click(function(){
		   		jQuery(".map-marker-4")[0].click();
		   	});
		   	//
		   	jQuery(".map-t-5").hover(function(){
		   		jQuery(".map-marker-5").toggleClass("is-active");
		   	});
		   	jQuery(".map-t-5").click(function(){
		   		jQuery(".map-marker-5")[0].click();
		   	});
		   	jQuery(".map-t-6").hover(function(){
		   		jQuery(".map-marker-6").toggleClass("is-active");
		   	});
		   	jQuery(".map-t-6").click(function(){
		   		jQuery(".map-marker-6")[0].click();
		   	});
		   	//
		   	jQuery(".map-t-7").hover(function(){
		   		jQuery(".map-marker-7").toggleClass("is-active");
		   	});
		   	jQuery(".map-t-7").click(function(){
		   		jQuery(".map-marker-7")[0].click();
		   	});
		   	//
		   	jQuery(".map-t-8").hover(function(){
		   		jQuery(".map-marker-8").toggleClass("is-active");
		   	});
		   	jQuery(".map-t-8").click(function(){
		   		jQuery(".map-marker-8")[0].click();
		   	});
		   	//
		   	jQuery(".map-t-9").hover(function(){
		   		jQuery(".map-marker-9").toggleClass("is-active");
		   	});
		   	jQuery(".map-t-9").click(function(){
		   		jQuery(".map-marker-9")[0].click();
		   	});
		   	//
		   	jQuery(".map-t-10").hover(function(){
		   		jQuery(".map-marker-10").toggleClass("is-active");
		   	});
		   	jQuery(".map-t-10").click(function(){
		   		jQuery(".map-marker-10")[0].click();
		   	});
		   	//
		   	jQuery(".map-t-11").hover(function(){
		   		jQuery(".map-marker-11").toggleClass("is-active");
		   	});
		   	jQuery(".map-t-11").click(function(){
		   		jQuery(".map-marker-11")[0].click();
		   	});
		   	//
		   	jQuery(".map-t-12").hover(function(){
		   		jQuery(".map-marker-12").toggleClass("is-active");
		   	});
		   	jQuery(".map-t-12").click(function(){
		   		jQuery(".map-marker-12")[0].click();
		   	});
		   	//
		   	jQuery(".map-t-13").hover(function(){
		   		jQuery(".map-marker-13").toggleClass("is-active");
		   	});
		   	jQuery(".map-t-13").click(function(){
		   		jQuery(".map-marker-13")[0].click();
		   	});
			
		}else{
			jQuery(".map-t-1").click(function(){
		   		jQuery(".marker-info").removeClass("is-active");
		   		jQuery(".map-marker-1").addClass("is-active");
		   	});
		   	jQuery(".map-t-2").click(function(){
		   		jQuery(".marker-info").removeClass("is-active");
		   		jQuery(".map-marker-2").addClass("is-active");
		   	});
		   	jQuery(".map-t-3").click(function(){
		   		jQuery(".marker-info").removeClass("is-active");
		   		jQuery(".map-marker-3").addClass("is-active");
		   	});
		   	jQuery(".map-t-4").click(function(){
		   		jQuery(".marker-info").removeClass("is-active");
		   		jQuery(".map-marker-4").addClass("is-active");
		   	});
		   	jQuery(".map-t-5").click(function(){
		   		jQuery(".marker-info").removeClass("is-active");
		   		jQuery(".map-marker-5").addClass("is-active");
		   	});
		   	jQuery(".map-t-6").click(function(){
		   		jQuery(".marker-info").removeClass("is-active");
		   		jQuery(".map-marker-6").addClass("is-active");
		   	});
		   	jQuery(".map-t-7").click(function(){
		   		jQuery(".marker-info").removeClass("is-active");
		   		jQuery(".map-marker-7").addClass("is-active");
		   	});
		   	jQuery(".map-t-8").click(function(){
		   		jQuery(".marker-info").removeClass("is-active");
		   		jQuery(".map-marker-8").addClass("is-active");
		   	});
		   	jQuery(".map-t-9").click(function(){
		   		jQuery(".marker-info").removeClass("is-active");
		   		jQuery(".map-marker-9").addClass("is-active");
		   	});
		   	jQuery(".map-t-10").click(function(){
		   		jQuery(".marker-info").removeClass("is-active");
		   		jQuery(".map-marker-10").addClass("is-active");
		   	});
		   	jQuery(".map-t-11").click(function(){
		   		jQuery(".marker-info").removeClass("is-active");
		   		jQuery(".map-marker-11").addClass("is-active");
		   	});
		   	jQuery(".map-t-12").click(function(){
		   		jQuery(".marker-info").removeClass("is-active");
		   		jQuery(".map-marker-12").addClass("is-active");
		   	});
		   	jQuery(".map-t-13").click(function(){
		   		jQuery(".marker-info").removeClass("is-active");
		   		jQuery(".map-marker-13").addClass("is-active");
		   	});
		}
	}
	
	function video(){
	
		
		jQuery(".video-link.mp4").click(function(event){
		 
			 event.preventDefault();
			 console.log("ssss");
			 jQuery(document).bind("mousewheel DOMMouseScroll",function(event){event.preventDefault()});
			 jQuery(document).bind("touchmove",function(event){event.preventDefault()});
			 var video_url = jQuery(this).find('.data-video').html();
			 jQuery('.video-light-box').find('.play-iframe-video').append('<video controls="controls"><source src="'+video_url+'" type="video/mp4"></video>');
			 jQuery('.video-light-box').fadeIn(300);
		 });
		 
	
		  jQuery(".video-link.file").click(function(event){
			 event.preventDefault();
			 jQuery(document).bind("mousewheel DOMMouseScroll",function(event){event.preventDefault()});
			 jQuery(document).bind("touchmove",function(event){event.preventDefault()});
			 var video_url = jQuery(this).find('.data-video').html();
			 var caption=jQuery(this).find('.data-video').attr('data-caption');
			 jQuery('.video-light-box').find('.play-iframe-video').append('<video controls="controls"><source src="'+video_url+'" type="video/mp4"> <track src="'+caption+'"  srclang="en" label="English" kind="subtitles" default /></video>');
			 jQuery('.video-light-box').fadeIn(300);
		 });
	
		 jQuery(".video-link.embed").click(function(event){
			 event.preventDefault();
			 jQuery(document).bind("mousewheel DOMMouseScroll",function(event){event.preventDefault()});
			 jQuery(document).bind("touchmove",function(event){event.preventDefault()});
			 jQuery('.video-light-box').fadeIn(300);
			 var html = jQuery(this).find('.data-video').html();
			 console.log(html)
			 jQuery('.video-light-box').find('.play-iframe-video').html(html);
		 });
		 jQuery('.video-light-box .close').click(function(){
			 jQuery(document).unbind("mousewheel DOMMouseScroll");
			 jQuery(document).unbind("touchmove");
			 jQuery('.video-light-box').fadeOut(300);
			 setTimeout(function(){
					 jQuery('.video-light-box').find('.play-iframe-video').html('');
			 },300);
		 });
		 jQuery('.video-light-box').click(function(){
			 jQuery(document).unbind("mousewheel DOMMouseScroll");
			 jQuery(document).unbind("touchmove");
			 jQuery('.video-light-box').fadeOut(300);
			 setTimeout(function(){
					 jQuery('.video-light-box').find('.play-iframe-video').html('');
			 },300);
		 });
		 jQuery('.video-light-box .video-box').click(function(event){
			 event.stopPropagation();
		 });
		 
		 jQuery(".video-link").click(function(event){
		 	event.stopPropagation();
	    	setTimeout(function(){
	    		var ss=jQuery(".video-light-box .video-box video");
	    		ss.trigger('play');
	    	},300);
		 });
		 

	 }
	
	
	function foot(){
		var foot=jQuery("footer").height();
		jQuery(".foot-section").css("height",foot);
	}
	
	function numbers() {
		var wTops = $(window).scrollTop(),
            wHeights = $(window).height(),
            wBottoms = wTops + wHeights;
            
            var h=jQuery(".wrapper").height();
            
			
			h=h - wHeights;
			//console.log(h);
			//console.log(ss);
			 if (wTops > h) {
			 	
        $("footer .foot .bottom-info .text:not(.active) h3 span").each(function () {
            var me = $(this).parents(".text"),
                meTops = me.offset().top,
                meHeights = me.innerHeight(),
                meBottoms = meTops + meHeights,
                limitTops = wTops - meHeights,
                limitBottoms = wBottoms + meHeights;
           
            	//console.log(wTops);
            	//console.log(wHeights);
            	
            	//console.log(meTops);
                me.addClass("active");
                var num = parseInt($(this).html());
                $(this).prop('number', 0).animateNumber({
                        number: num
                    },
                    2000
                );
            
       });
       jQuery(".go-top").addClass("is-active");
      }else{
       jQuery(".go-top").removeClass("is-active");
      	
      }
	}
	
	function numbers_two() {
		var wTops = $(window).scrollTop(),
            wHeights = $(window).height(),
            wBottoms = wTops + wHeights;
            if(jQuery(".home-left-text-and-right-slider").length > 0){
            	var h=jQuery(".home-left-text-and-right-slider").offset().top;
            }
			
			var ss=wTops + wHeights - 100;
			//console.log(h);
			//console.log(ss);
			 if (ss > h) {
        $(".home-left-text-and-right-slider .left .block:not(.active) h4 span").each(function () {
            var me = $(this).parents(".block"),
                meTops = me.offset().top,
                meHeights = me.innerHeight(),
                meBottoms = meTops + meHeights,
                limitTops = wTops - meHeights,
                limitBottoms = wBottoms + meHeights;
           
            	//console.log(wTops);
            	//console.log(wHeights);
            	
            	//console.log(meTops);
                me.addClass("active");
                var num = parseInt($(this).html());
                $(this).prop('number', 0).animateNumber({
                        number: num
                    },
                    2000
                );
            
       });
      }else{
      	
      }
	}
	function numbers_three() {

        $(".home-banner .home-banner-box .images .img .box:not(.active) p span").each(function () {
            var me = $(this).parents(".box"),
                meTops = me.offset().top;
           
            	//console.log(wTops);
            	//console.log(wHeights);
            	
            	//console.log(meTops);
                me.addClass("active");
                var num = parseInt($(this).html());
                
	                $(this).prop('number', 0).animateNumber({
	                        number: num
	                    },
	                    2000
	                );
            
       			
       });
		
		
      
	}
	jQuery('.home-banner-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
			 $(".home-banner .home-banner-box .images .img .box p span").each(function () {
			 	
	            var me = $(this).parents(".box"),
	                meTops = me.offset().top;
	           
	            	//console.log(wTops);
	            	//console.log(wHeights);
	            	
	            	//console.log(meTops);
	                me.addClass("active");
	                var num = parseInt($(this).html());
	                
		                $(this).prop('number', 0).animateNumber({
		                        number: num
		                    },
		                    2000
		                );
	            
	       			
	       });
			
		});
	jQuery('.home-add-new-block-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
			 $(".home-add-new-block-slider .text span").each(function () {
			 	
			 	console.log("ss");
	            var me = $(this).parents(".text"),
	                meTops = me.offset().top;
	           
	            	//console.log(wTops);
	            	//console.log(wHeights);
	            	
	            	//console.log(meTops);
	                me.addClass("active");
	                var num = parseInt($(this).html());
	                
		                $(this).prop('number', 0).animateNumber({
		                        number: num
		                    },
		                    2000
		                );
	            
	       			
	       });
			
		});
	function numbers_four() {
		var wTops = $(window).scrollTop(),
            wHeights = $(window).height(),
            wBottoms = wTops + wHeights;
            if(jQuery(".home-add-new-block").length > 0){
            	var h=jQuery(".home-add-new-block").offset().top;
            }
			
			var ss=wTops + wHeights - 100;
			//console.log(h);
			//console.log(ss);
			 if (ss > h) {
        $(".home-add-new-block .home-add-new-block-box .content .text:not(.active) p span").each(function () {
            var me = $(this).parents(".text"),
                meTops = me.offset().top;
           
            	//console.log(wTops);
            	//console.log(wHeights);
            	
            	//console.log(meTops);
                me.addClass("active");
                var num = parseInt($(this).html());
                
	                $(this).prop('number', 0).animateNumber({
	                        number: num
	                    },
	                    2000
	                );
            
       			
       });
		}else{
      	
      }
      
	}
	
	function fulls(){
		jQuery('.page-title .page-title-box .title h1').each(function() {
				var intThis = $(this);
				var html = intThis.html();
				intThis.splitLines({tag:'<span class="c-summary_list_item" data-scroll><span>'});
				var x = intThis.parent().find('.line-an').length;
				intThis.parents('.text-c').find('.line-an').each(function(i) {
					$(this).css('animation-delay',i+'00ms');
					x = i;
				});

		});
		
		
	}
	
	function ov_c(){
		
		


		
		
		
		$(window).on("load",function(){
			jQuery(".temoignages-content .list").each(function(){
				var th=jQuery(this).find(".text-c");
				var he=jQuery(this).find("blockquote").outerHeight();
				console.log(he);
				if(he > 190){
					th.addClass("overflow-c");
				}
			});
        	$(".overflow-c").mCustomScrollbar({
            axis:"y",


        	});
        });
	}

	menu();
	home();
	video();
	map_click();
	foot();
	ov_c();
	fulls();
	numbers_three();
	home_banner_slider_k();
	jQuery(window).resize(function() {

	});
	jQuery(window).scroll(function() {
	    foot();
	    numbers();
	    numbers_two();
	   numbers_four();
	});

	jQuery(window).on("load",function() {
		wowo();
		//home_banner_slider_k();
		//console.log("slider-ccc");
		
	});

	$(window).on("load",function() {
		//home_banner_slider_k();
		//console.log("slider-lo");
	});
	
	window.addEventListener("load", function() {
		console.log("slider-loss");
	});
	
	function home_banner_slider_k(){

	    setTimeout(function(){
	    	jQuery('.img-1-slider').slick("slickPlay");
	    	jQuery('.img-1-slider .slider-block').addClass('move');
	    },5);
	    setTimeout(function(){
	    	
	    	jQuery('.home-banner-slider').slick("slickPlay");
	    	jQuery('.home-banner-slider .slider-block').addClass('move');
	    },400);
	    setTimeout(function(){
	    	jQuery('.img-2-slider').slick("slickPlay");
	    	jQuery('.img-2-slider .slider-block').addClass('move');
	    	
	    },800);
	    setTimeout(function(){
	    	jQuery('.img-3-slider').slick("slickPlay");
	    	jQuery('.img-3-slider .slider-block').addClass('move');
	    	
	    },1200);
	    setTimeout(function(){
	    	jQuery('.img-4-slider').slick("slickPlay");
	    	jQuery('.img-4-slider .slider-block').addClass('move');
	    	
	    },1600);
	 
	
	}
	
	
});



/*
jQuery animateNumber plugin v0.0.14
(c) 2013, Alexandr Borisov.
https://github.com/aishek/jquery-animateNumber
*/
(function(d) {
    var r = function(b) {
            return b.split("").reverse().join("")
        },
        m = {
            numberStep: function(b, a) {
                var e = Math.floor(b);
                d(a.elem).text(e)
            }
        },
        g = function(b) {
            var a = b.elem;
            a.nodeType && a.parentNode && (a = a._animateNumberSetter, a || (a = m.numberStep), a(b.now, b))
        };
    d.Tween && d.Tween.propHooks ? d.Tween.propHooks.number = {
        set: g
    } : d.fx.step.number = g;
    d.animateNumber = {
        numberStepFactories: {
            append: function(b) {
                return function(a, e) {
                    var f = Math.floor(a);
                    d(e.elem).prop("number", a).text(f + b)
                }
            },
            separator: function(b, a, e) {
                b = b || " ";
                a = a || 3;
                e = e || "";
                return function(f, k) {
                    var u = 0 > f,
                        c = Math.floor((u ? -1 : 1) * f).toString(),
                        n = d(k.elem);
                    if(c.length > a) {
                        for(var h = c, l = a, m = h.split("").reverse(), c = [], p, s, q, t = 0, g = Math.ceil(h.length / l); t < g; t++) {
                            p = "";
                            for(q = 0; q < l; q++) {
                                s = t * l + q;
                                if(s === h.length) break;
                                p += m[s]
                            }
                            c.push(p)
                        }
                        h = c.length - 1;
                        l = r(c[h]);
                        c[h] = r(parseInt(l, 10).toString());
                        c = c.join(b);
                        c = r(c)
                    }
                    n.prop("number", f).text((u ? "-" : "") + c + e)
                }
            }
        }
    };
    d.fn.animateNumber = function() {
        for(var b = arguments[0], a = d.extend({}, m, b), e = d(this), f = [a], k = 1, g = arguments.length; k < g; k++) f.push(arguments[k]);
        if(b.numberStep) {
            var c = this.each(function() {
                    this._animateNumberSetter = b.numberStep
                }),
                n = a.complete;
            a.complete = function() {
                c.each(function() {
                    delete this._animateNumberSetter
                });
                n && n.apply(this, arguments)
            }
        }
        return e.animate.apply(e, f)
    }
})(jQuery);


jQuery.event.special.touchstart = {
    setup: function( _, ns, handle ) {
        this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
    }
};
jQuery.event.special.touchmove = {
    setup: function( _, ns, handle ) {
        this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });
    }
};
jQuery.event.special.wheel = {
    setup: function( _, ns, handle ){
        this.addEventListener("wheel", handle, { passive: true });
    }
};
jQuery.event.special.mousewheel = {
    setup: function( _, ns, handle ){
        this.addEventListener("mousewheel", handle, { passive: true });
    }
};

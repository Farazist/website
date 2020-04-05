/*--------------------- Copyright (c) 2019 -----------------------
[Master Javascript]
Project: Cultivation - Multipurpose Responsive HTML Template
Version: 1.0.0
Assigned to: Theme Forest
-------------------------------------------------------------------*/
(function($) {
    "use strict";
    var cultivation = {
        initialised: false,
        version: 1.0,
        mobile: false, 
        init: function() {
            if (!this.initialised) {
                this.initialised = true;
            } else {
                return;
            }
            /*-------------- Cultivation Functions Calling ---------------------------------------------------
            ------------------------------------------------------------------------------------------------*/
            this.RTL();
            this.SearchBox();
            this.CartBox();
            this.BannerSlider();
            this.TestimonialSlider();
            this.ShopSlider();
            this.BlogSlider();
            this.GallerySlider();
            this.PartnerSlider();
            this.AgriTestimonialSlider();
            this.AgriFooterSlider();
            this.DairyServiceSlider();
            this.DairyTestimonialSlider();
            this.DairyTeamSlider();
            this.GardenTestimonialSlider();
            this.GardenBlogSlider();
            this.GardenShopSlider();
            this.GardenProjectSlider();
            this.OrganicTestimonialSlider();
            this.CoffeeTestimonialSlider();
            this.VideoPopup();
            this.Counter();
            this.Wishlist();
            this.GalleryPopup();
            this.Quantity();
            this.ScrollDown();
            this.PricingToggle();
			this.Revolution();
            this.Index2Revolution();
            this.SidebarTestimonialSlider();
            this.PriceRange();
            this.ListGridView();
            this.ProductSlider();
        },
        /*-------------- Cultivation Functions definition ---------------------------------------------------
        ---------------------------------------------------------------------------------------------------*/
        RTL: function() {
            var rtl_attr = $("html").attr('dir');
            if (rtl_attr) {
                $('html').find('body').addClass("rtl");
            }
        },
        SearchBox: function() {
			$('.clv_menu .cart_nav .search_toggle').on('click', function(){
				$('.search_box').toggleClass('search_box_open');
			});
			$('.search_close').on('click', function(){
				$('.search_box').removeClass('search_box_open');
			});
			$('.search_box').on('click', function(){
				$('.search_box').removeClass('search_box_open');
			});
			$('.search_block').on('click', function(e){
				e.stopPropagation();
			});
        },
        CartBox: function() {
			$('.clv_menu .cart_nav .cart_toggle').on('click', function(){
				$('.clv_cart_box').toggleClass('cart_box_open');
			});
			$(document).on('click', function(){
				$('.clv_cart_box').removeClass('cart_box_open');
			});
			$('.clv_cart_box').on('click', function(e){
				e.stopPropagation();
			});
			$('.cart_toggle').on('click', function(e){
				e.stopPropagation();
			});
        },
        BannerSlider: function() {
			var swiper = new Swiper('.clv_banner_slider .swiper-container', {
				speed: 1500,
				loop: true,
				effect: 'coverflow',
				coverflowEffect: {
					rotate: 30,
					slideShadows: false,
					depth: 0,
				},
				autoplay: {
					delay: 2500,
					disableOnInteraction: false,
				},
				navigation: {
					nextEl: '.banner_right',
					prevEl: '.banner_left',
				},
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},
			});
        },
        TestimonialSlider: function() {
			var swiper = new Swiper('.testimonial_slider .swiper-container', {
				spaceBetween: 50,
				loop: true,
				autoplay: {
					delay: 2500,
					disableOnInteraction: false,
				},
				speed: 1500,
				effect: 'fade',
				navigation: {
					nextEl: '.testimonial_right',
					prevEl: '.testimonial_left',
				},
			});
        },
        AgriTestimonialSlider: function() {
			var swiper = new Swiper('.agri_testimonial_slider .swiper-container', {
				spaceBetween: 50,
				loop: true,
				autoplay: {
					delay: 2500,
					disableOnInteraction: false,
				},
				navigation: {
					nextEl: '.agri_testimonial_right',
					prevEl: '.agri_testimonial_left',
				},
			});
        },
        DairyTestimonialSlider: function() {
			var swiper = new Swiper('.dairy_testimonial_slider .swiper-container', {
				spaceBetween: 50,
				autoplay: {
					delay: 2500,
					disableOnInteraction: false,
				},
				effect: "fade",
				loop: true,
				navigation: {
					nextEl: '.dairy_right',
					prevEl: '.dairy_left',
				},
			});
        },
        OrganicTestimonialSlider: function() {
			var swiper = new Swiper('.org_testimonial_slider .swiper-container', {
				spaceBetween: 10,
				loop: true,
				autoplay: {
					delay: 2500,
					disableOnInteraction: false,
				},
				navigation: {
					nextEl: '.org_right',
					prevEl: '.org_left',
				},
			});
        },
        ShopSlider: function() {
			var swiper = new Swiper('.shop_slider .swiper-container', {
				slidesPerView: 4,
				spaceBetween: 15,
				loop: true,
				autoplay: {
					delay: 2500,
					disableOnInteraction: false,
				},
				navigation: {
					nextEl: '.shop_right',
					prevEl: '.shop_left',
				},
				breakpoints: {
					// when window width is <= 320px
					320: {
						slidesPerView: 1,
						spaceBetween: 10
					},
					// when window width is <= 480px
					480: {
						slidesPerView: 1,
						spaceBetween: 20
					},
					// when window width is <= 640px
					768: {
						slidesPerView: 2,
						spaceBetween: 30
					},
					991: {
						slidesPerView: 3,
						spaceBetween: 30
					},
					1024: {
						slidesPerView: 3,
						spaceBetween: 30
					}
				}
			});
        },
        BlogSlider: function() {
			var swiper = new Swiper('.blog_slider .swiper-container', {
				slidesPerView: 3,
				spaceBetween: 30,
				loop: true,
				autoplay: {
					delay: 2500,
					disableOnInteraction: false,
				},
				navigation: {
					nextEl: '.blog_right',
					prevEl: '.blog_left',
				},
				breakpoints: {
					// when window width is <= 320px
					320: {
						slidesPerView: 1,
						spaceBetween: 10
					},
					// when window width is <= 480px
					480: {
						slidesPerView: 1,
						spaceBetween: 20
					},
					// when window width is <= 640px
					768: {
						slidesPerView: 1,
						spaceBetween: 30
					},
					991: {
						slidesPerView: 2,
						spaceBetween: 30
					}
				}
			});
        },
        GallerySlider: function() {
        	var swiper = new Swiper('.gallery_slider .swiper-container', {
        		slidesPerView: 1,
				loop: true,
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
        		},
        	});
			
        },
        PartnerSlider: function() {
			var swiper = new Swiper('.partner_slider .swiper-container', {
				slidesPerView: 5,
				spaceBetween: 30,
				loop: true,
				autoplay: {
					delay: 2500,
					disableOnInteraction: false,
				},
				navigation: {
					nextEl: '.partner_right',
					prevEl: '.partner_left',
				},
				breakpoints: {
					// when window width is <= 320px
					320: {
						slidesPerView: 1,
						spaceBetween: 10
					},
					// when window width is <= 480px
					480: {
						slidesPerView: 2,
						spaceBetween: 20
					},
					// when window width is <= 640px
					768: {
						slidesPerView: 3,
						spaceBetween: 30
					},
					991: {
						slidesPerView: 4,
						spaceBetween: 30
					}
				}
			});
        },
        AgriFooterSlider: function() {
			var swiper = new Swiper('.footer_post_slider .swiper-container', {
				slidesPerView: 2,
				spaceBetween: 5,
				loop: true,
				speed: 1500,
				autoplay: {
					delay: 2500,
					disableOnInteraction: false,
				},
				direction: 'vertical',
				navigation: {
					nextEl: '.footer_right',
					prevEl: '.footer_left',
				},
				breakpoints: {
					// when window width is <= 320px
					320: {
						spaceBetween: 20
					},
					// when window width is <= 480px
					480: {
						spaceBetween: 20
					},
					// when window width is <= 640px
					768: {
						spaceBetween: 30
					},
					991: {
						spaceBetween: 30
					}
				}
			});
        },
        DairyServiceSlider: function() {
			var swiper = new Swiper('.dairy_service_slider .swiper-container', {
				slidesPerView: 1,
				spaceBetween: 30,
				loop: true,
				speed: 1500,
				autoplay: {
					delay: 2500,
					disableOnInteraction: false,
				},
				navigation: {
					nextEl: '.dairy_service_right',
					prevEl: '.dairy_service_left',
				},
			});
        },
        DairyTeamSlider: function() {
			var swiper = new Swiper('.dairy_team_slider .swiper-container', {
				slidesPerView: 4,
				spaceBetween: 30,
				loop: true,
				navigation: {
					nextEl: '.team_right',
					prevEl: '.team_left',
				},
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},
				breakpoints: {
					// when window width is <= 320px
					320: {
						slidesPerView: 1,
						spaceBetween: 50
					},
					// when window width is <= 480px
					480: {
						slidesPerView: 1,
						spaceBetween: 50
					},
					// when window width is <= 640px
					768: {
						slidesPerView: 2,
						spaceBetween: 30
					}
				}
			});
        },
        GardenTestimonialSlider: function() {
			var TestimonialThumbs = new Swiper('.thumb_slider .swiper-container', {
				spaceBetween: 0,
				slidesPerView: 3,
				effect: 'coverflow',
				grabCursor: false,
				navigation: {
				nextEl: '.test_right_arrow',
				prevEl: '.test_left_arrow',
				},
				simulateTouch: false,
				centeredSlides: true,
				coverflowEffect: {
					rotate: 0,
					stretch: 0,
					depth: 500,
					modifier: 1,
					slideShadows : false,
				},
				breakpoints: {
					// when window width is <= 320px
					320: {
						slidesPerView: 1,
						spaceBetween: 10
					},
					// when window width is <= 480px
					480: {
						slidesPerView: 1,
						spaceBetween: 20
					},
					// when window width is <= 640px
					768: {
						slidesPerView: 3,
						spaceBetween: 0
					}
				},
				loopedSlides: 3, //looped slides should be the same
				watchSlidesVisibility: true,
				watchSlidesProgress: true,
			});
			var galleryTop = new Swiper('.message_slider .swiper-container', {
				spaceBetween: 0,
				effect: 'coverflow',
				coverflowEffect: {
					slideShadows : false,
				},
				speed: 700,
				loopedSlides: 3, //looped slides should be the same
				navigation: {
				nextEl: '.test_right_arrow',
				prevEl: '.test_left_arrow',
				},
				simulateTouch: false,
				thumbs: { 
				swiper: TestimonialThumbs,
				},
			});
        },
        CoffeeTestimonialSlider: function() {
			var CoffeeTestimonialThumbs = new Swiper('.coffee_thumb_slider.swiper-container', {
				slidesPerView: 3,
				spaceBetween: 0,
				centeredSlides: true,
				grabCursor: false,
				navigation: {
					nextEl: '.coffee_test_right_arrow',
					prevEl: '.coffee_test_left_arrow',
				},
				breakpoints: {
					// when window width is <= 320px
					320: {
						slidesPerView: 1,
						spaceBetween: 10
					},
					// when window width is <= 480px
					480: {
						slidesPerView: 1,
						spaceBetween: 20
					},
					// when window width is <= 640px
					768: {
						slidesPerView: 3,
						spaceBetween: 0

					}
				},
				loop: true,
				simulateTouch: false,
				effect: 'coverflow',
				coverflowEffect: {
					rotate: 30,
					slideShadows: false,
					depth: 0,
				},
				//loopedSlides: 0, //looped slides should be the same
				watchSlidesVisibility: true,
				watchSlidesProgress: true,
			});
			var CoffeeTestimonialName = new Swiper('.coffee_name_slider.swiper-container', {
				spaceBetween: 0,
				speed: 700,
				loop: true,
				//loopedSlides: 0, //looped slides should be the same
				navigation: {
					nextEl: '.coffee_test_right_arrow',
					prevEl: '.coffee_test_left_arrow',
				},
				effect: 'fade',
				simulateTouch: false,
			});
        },
        GardenBlogSlider: function() {
			var swiper = new Swiper('.garden_blog_slider .swiper-container', {
				spaceBetween: 30,
				loop: true,
				speed: 700,
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},
			});
        },
        GardenShopSlider: function() {
			var swiper = new Swiper('.garden_shop_slider .swiper-container', {
				slidesPerView: 4,
				spaceBetween: 30,
				loop: true,
				autoplay: {
					delay: 2500,
					disableOnInteraction: false,
				},
				navigation: {
					nextEl: '.shop_right',
					prevEl: '.shop_left',
				},
				 // Responsive breakpoints
				breakpoints: {
					// when window width is <= 320px
					320: {
						slidesPerView: 1,
						spaceBetween: 30
					},
					// when window width is <= 480px
					480: {
						slidesPerView: 1,
						spaceBetween: 30
					},
					// when window width is <= 640px
					768: {
						slidesPerView: 2,
						spaceBetween: 30
					}
				}
			});
        },
        GardenProjectSlider: function() {
			var swiper = new Swiper('.garden_project_slider .swiper-container', {
				slidesPerView: 1,
				loop: true,
				spaceBetween: 30,
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},
			});
			// $('.garden_project_grid').isotope({
			// 	itemSelector: '.project_item',
			// 	filter: '*'
			// });
			$('.project_nav > ul > li').on( 'click', 'a', function() {
				// filter button click
				var filterValue = $( this ).attr('data-filter');
				$('.garden_project_grid').isotope({ filter: filterValue });

				//active class added
				$('.project_nav > ul > li').removeClass('active');
				$(this).parent().addClass('active');
			});
        },
        SidebarTestimonialSlider: function() {
			var swiper = new Swiper('.sidebar_test_slider .swiper-container', {
				loop: true,
				autoplay: {
					delay: 2500,
					disableOnInteraction: false,
				},
				speed: 800,
				navigation: {
					nextEl: '.test_right',
					prevEl: '.test_left',
				},
			});
        },
        VideoPopup: function() {
			$('.play_video').magnificPopup({
				disableOn: 700,
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 160,
				preloader: false,
				fixedContentPos: false
			});
        },
		Counter: function() {
			if ($('.counter_text').length > 0) {
				$('.counter_text').appear(function() {
					$('.count_no').countTo();
				});
			}
		},
		Wishlist: function() {
			$('.item_overlay label .wish_icon').on('click',function () {
				if ($('.item_overlay input[type="checkbox"]:checked')) {
					$(this).parents('.item_overlay').toggleClass('wished');
				}
			});
			$('.garden_shop_slide label').on('click',function () {
				if ($('.garden_shop_slide input[type="checkbox"]:checked')) {
					$(this).parents('.garden_shop_slide').toggleClass('wished');
				}
			});
		},
		GalleryPopup: function() {
			$('.view_image').magnificPopup({
			  type: 'image',
			  gallery: {
				// options for gallery
				enabled: true
			  }
			});
		},
		Quantity: function(){
			var quantity=0;
			$('.quantity_plus').on('click', function(e){
				e.preventDefault();
				var quantity = parseInt($(this).siblings('.quantity').val());
				$(this).siblings('.quantity').val(quantity + 1);            

			});
			$('.quantity_minus').on('click', function(e){
				e.preventDefault();
				var quantity = parseInt($(this).siblings('.quantity').val());
				if(quantity>0){
					$(this).siblings('.quantity').val(quantity - 1);
				}
			});				
		},
		ScrollDown: function() {
			$(".scroll_down").on('click', function(){
				var vheight = $(window).height();
				$("html, body").animate({scrollTop: vheight}, 1000);
			});
		},
		PricingToggle: function() {
			$(".my_toggle").on('click', function(){
				if($(this).prop("checked")){
					var divID = $(this).attr('id');
					if(divID == 'monthly-1' ){
						$('.pricing-group').removeClass('switched');
					}
					else{ 
						$('.pricing-group').addClass('switched');
					}
				}
			});	
		},
		PriceRange: function() {
			if($('.Range_slider').length > 0){
				$( function() {
					$( "#slider-range" ).slider({
						range: true,
						min: 12,
						max: 2000,
						values: [ 12, 1624 ],
						slide: function( event, ui ) {
							$( "#amount" ).text( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
						}
					});
					$( "#amount" ).text( "$" + $( "#slider-range" ).slider( "values", 0 ) +
						" - $" + $( "#slider-range" ).slider( "values", 1 ) );
				});
			}
		},
		ListGridView: function() {
			$('.list_view_toggle > li > a').on('click', function(){
				$('.list_view_toggle > li > a').removeClass('active');
				$(this).addClass('active');
			});
			$('.list_view').on('click', function(){
				$('.product_items_section').addClass('product_list_view');
			});
			$('.grid_view').on('click', function(){
				$('.product_items_section').removeClass('product_list_view');
			});
		},
		ProductSlider: function() {
			if ($('.product_single_slider').length > 0) {
                var galleryTop = new Swiper('.fd_product_img .swiper-container.gallery-top', {
                    spaceBetween: 0,
                    loop: !0,
                    effect: "fade",
                    loopedSlides: 4,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev"
                    }
                });
                var galleryThumbs = new Swiper('.fd_pro_thumnail .swiper-container.gallery-thumbs', {
                    direction: "vertical",
                    spaceBetween: 0,
                    slidesPerView: 4,
                    loop: !0,
                    loopedSlides: 4,
                    centeredSlides: !1,
                    mousewheel: !0,
                    slideToClickedSlide: !0,
                    breakpoints: {
                        1400: {
                            direction: "vertical"
                        },
                        1199: {
                            direction: "vertical"
                        },
                        991: {
                            direction: "vertical"
                        },
                        768: {
                            direction: "vertical",
                            slidesPerView: 3,
                            spaceBetween: 10,
                        },
                        767: {
                            direction: "vertical",
                            slidesPerView: 3,
                        },
                        575: {
                            direction: "horizontal",
                            slidesPerView: 3,
                        },
                        375: {
                            direction: "horizontal",
                            slidesPerView: 2,
                        }
                    }
                });
                galleryTop.controller.control = galleryThumbs;
                galleryThumbs.controller.control = galleryTop;
            }
		},
		Revolution: function() {
			if($('.clv_rev_slider').length){
						var tpj=jQuery;
			
			var revapi149;
			tpj(document).ready(function() {
				if(tpj("#rev_slider_149_1").revolution == undefined){
					revslider_showDoubleJqueryError("#rev_slider_149_1");
				}else{
					revapi149 = tpj("#rev_slider_149_1").show().revolution({
						sliderType:"standard",
						jsFileLocation:"revolution/js/",
						sliderLayout:"auto responsive",
						dottedOverlay:"none",
						delay:9000,
						navigation: {
							keyboardNavigation:"off",
							keyboard_direction: "vertical",
							mouseScrollNavigation:"off",
 							mouseScrollReverse:"default",
							onHoverStop:"off",
							touch:{
								touchenabled:"on",
								swipe_threshold: 75,
								swipe_min_touches: 1,
								swipe_direction: "horizontal",
								drag_block_vertical: false
							}
							,
							arrows: {
								style:"erinyen",
								enable:true,
								hide_onmobile:false,
								hide_onleave:false,
								tmp:'',
								left: {
									h_align:"left",
									v_align:"center",
									h_offset:40,
									v_offset:0
								},
								right: {
									h_align:"right",
									v_align:"center",
									h_offset:40,
									v_offset:0
								}
							}
						},
						responsiveLevels:[1240,1024,778,480],
						visibilityLevels:[1240,1024,778,480],
						gridwidth:[1240,1024,778,480],
						gridheight:[810,768,960,720],
						lazyType:"none",
						scrolleffect: {
							blur:"on",
							maxblur:"20",
							on_slidebg:"on",
							direction:"top",
							multiplicator:"2",
							multiplicator_layers:"2",
							tilt:"10",
							disable_on_mobile:"off",
						},
						parallax: {
							type:"scroll",
							origo:"slidercenter",
							speed:400,
							levels:[5,10,15,20,25,30,35,40,45,46,47,48,49,50,51,55],
						},
						shadow:0,
						spinner:"off",
						stopLoop:"off",
						stopAfterLoops:-1,
						stopAtSlide:-1,
						shuffle:"off",
						autoHeight:"off",
						fullScreenAutoWidth:"off",
						fullScreenAlignForce:"off",
						fullScreenOffsetContainer: "",
						fullScreenOffset: "60px",
						hideThumbsOnMobile:"off",
						hideSliderAtLimit:0,
						hideCaptionAtLimit:0,
						hideAllCaptionAtLilmit:0,
						debugMode:false,
						fallbacks: {
							simplifyAll:"off",
							nextSlideOnWindowFocus:"off",
							disableFocusListener:false,
						}
					});
				}
					
			});	/*ready*/
		}
		},

		Index2Revolution: function(){
			if($('.clv_rev_slider').length){
				var tpj=jQuery;
			
			var revapi1164;
			tpj(document).ready(function() {
				if(tpj("#rev_slider_1164_1").revolution == undefined){
					revslider_showDoubleJqueryError("#rev_slider_1164_1");
				}else{
					revapi1164 = tpj("#rev_slider_1164_1").show().revolution({
						sliderType:"standard",
						jsFileLocation:"revolution/js/",
						sliderLayout:"auto responsive",
						dottedOverlay:"none",
						delay:7000,
						navigation: {
							keyboardNavigation:"off",
							keyboard_direction: "vertical",
							mouseScrollNavigation:"off",
 							mouseScrollReverse:"default",
							onHoverStop:"off",
							touch:{
								touchenabled:"on",
								swipe_threshold: 75,
								swipe_min_touches: 1,
								swipe_direction: "horizontal",
								drag_block_vertical: false
							},
							arrows: {
								style:"erinyen",
								enable:true,
								hide_onmobile:false,
								hide_onleave:false,
								tmp:'',
								left: {
									h_align:"left",
									v_align:"center",
									h_offset:40,
									v_offset:0
								},
								right: {
									h_align:"right",
									v_align:"center",
									h_offset:40,
									v_offset:0
								}
							}
						},
						responsiveLevels:[1240,1024,778,480],
						visibilityLevels:[1240,1024,778,480],
						gridwidth:[1240,1024,778,480],
						gridheight:[800,768,960,720],
						lazyType:"none",
						parallax: {
							type:"scroll",
							origo:"slidercenter",
							speed:400,
							levels:[5,10,15,20,25,30,35,40,45,46,47,48,49,50,51,55],
							type:"scroll",
						},
						shadow:0,
						spinner:"off",
						stopLoop:"off",
						stopAfterLoops:-1,
						stopAtSlide:-1,
						shuffle:"off",
						autoHeight:"off",
						fullScreenAutoWidth:"off",
						fullScreenAlignForce:"off",
						fullScreenOffsetContainer: ".header",
						fullScreenOffset: "60px",
						disableProgressBar:"on",
						hideThumbsOnMobile:"off",
						hideSliderAtLimit:0,
						hideCaptionAtLimit:0,
						hideAllCaptionAtLilmit:0,
						debugMode:false,
						fallbacks: {
							simplifyAll:"off",
							nextSlideOnWindowFocus:"off",
							disableFocusListener:false,
						}
					});
				}	
			});	/*ready*/
			}
		},
    };
cultivation.init();
$(window).scroll(function(){
	var scroll = $(window).scrollTop();
	if (scroll >= 100) {
		$(".header2_wrapper").addClass("header2_fix");
		$(".header3_wrapper").addClass("dark_header");
		$(".header4_wrapper").addClass("header4_fix");
	} else {
		$(".header2_wrapper").removeClass("header2_fix");
		$(".header3_wrapper").removeClass("dark_header");
		$(".header4_wrapper").removeClass("header4_fix");
	}
});
$(document).ready(function(){
	$('.success_close').on('click', function(){
		$('.success_wrapper').removeClass('open_success');
		$('.thankyou_wrapper').removeClass('open_thankyou');
		$('.signin_wrapper').removeClass('open_signin');
		$('.signup_wrapper').removeClass('open_signup');
	});
	$('.pop_signup').on('click', function(){
		$('.signin_wrapper').removeClass('open_signin');
		$('.signup_wrapper').addClass('open_signup');
	});
	$('.pop_signin').on('click', function(){
		$('.signup_wrapper').removeClass('open_signup');
		$('.signin_wrapper').addClass('open_signin');
	});
	$('.profile_toggle').on('click', function(){
		$('.signup_wrapper').toggleClass('open_signup');
		$('.signin_wrapper').removeClass('open_signin');
	});
	$(document).on('click', function(){
		$('.clv_right_header .clv_menu .clv_menu_nav').removeClass('nav_toggle');
	});
	$('.clv_right_header .clv_menu .clv_menu_nav').on('click', function(e){
		e.stopPropagation();
	});
	$('.menu_toggle').on('click', function(e){
		$('.clv_right_header .clv_menu .clv_menu_nav').toggleClass('nav_toggle');
		e.stopPropagation();
	});
	if($(window).width()<= 991){
		$('.clv_menu_nav > ul > li').on('click', function(e){
			$(this).children('ul').slideToggle();
		});
	}

	// Contact Form Submission
	function checkRequire(formId , targetResp){
		targetResp.html('');
		var email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
		var url = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/;
		var image = /\.(jpe?g|gif|png|PNG|JPE?G)$/;
		var mobile = /^[\s()+-]*([0-9][\s()+-]*){6,20}$/;
		var facebook = /^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/;
		var twitter = /^(https?:\/\/)?(www\.)?twitter.com\/[a-zA-Z0-9(\.\?)?]/;
		var google_plus = /^(https?:\/\/)?(www\.)?plus.google.com\/[a-zA-Z0-9(\.\?)?]/;
		var check = 0;
		$('#er_msg').remove();
		var target = (typeof formId == 'object')? $(formId):$('#'+formId);
		target.find('input , textarea , select').each(function(){
			if($(this).hasClass('require')){
				if($(this).val().trim() == ''){
					check = 1;
					$(this).focus();
					targetResp.html('You missed out some fields.');
					$(this).addClass('error');
					return false;
				}else{
					$(this).removeClass('error');
				}
			}
			if($(this).val().trim() != ''){
				var valid = $(this).attr('data-valid');
				if(typeof valid != 'undefined'){
					if(!eval(valid).test($(this).val().trim())){
						$(this).addClass('error');
						$(this).focus();
						check = 1;
						targetResp.html($(this).attr('data-error'));
						return false;
					}else{
						$(this).removeClass('error');
					}
				}
			}
		});
		return check;
	}
	$(".submitForm").on("click", function() {
		var _this = $(this);
		var targetForm = _this.closest('form');
		var errroTarget = targetForm.find('.response');
		var check = checkRequire(targetForm , errroTarget);
		if(check == 0){
			var formDetail = new FormData(targetForm[0]);
			formDetail.append('form_type' , _this.attr('form-type'));
			$.ajax({
				method : 'post',
				url : 'ajax.php',
				data:formDetail,
				cache:false,
				contentType: false,
				processData: false
			}).done(function(resp){
				if(resp == 1){
					targetForm.find('input').val('');
					targetForm.find('textarea').val('');
					errroTarget.html('<p style="color:green;">Mail has been sent successfully.</p>');
				}else{
					errroTarget.html('<p style="color:red;">Something went wrong please try again latter.</p>');
				}
			});
		}
	});

});
$(window).on('load', function(){
	// Preloader JS
	$(".preloader_wrapper").fadeOut();
	$(".preloader_inner").delay(500).fadeOut("slow");

	$('.gallery_grid').isotope({
		itemSelector: '.gallery_grid_item',
		percentPosition: true,
		masonry: {
			//use outer width of grid-sizer for columnWidth
			columnWidth: 30,
			gutter: 10
		}
	});
	$('.index_v3 .gallery_grid').isotope({
		itemSelector: '.index_v3 .gallery_grid_item',
		percentPosition: true,
		masonry: {
			//use outer width of grid-sizer for columnWidth
			columnWidth: 0,
			gutter: 0
		}
	});
	/*Nice Select*/
	$('select').niceSelect();
	
});
})(jQuery); 
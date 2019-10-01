(function ($) {

    "use strict";


    jQuery(document).ready(function ($) {

        // Sticky Menu
        var windows = $(window);
        var stick = $(".navigation");
        windows.on('scroll', function () {
            var scroll = windows.scrollTop();
            if (scroll < 10) {
                stick.removeClass("sticky");
            } else {
                stick.addClass("sticky");
            }
        });

        // Slider
        $(".header-slider").owlCarousel({
            items: 1,
            loop: true,
            dots: false,
            nav: false,
            navText: ['<i class="icofont-rounded-left"></i>', '<i class="icofont-rounded-right"></i>'],
            autoplay: false,
            autoplayTimeout: 5000,
            animateIn: 'pulse',
            animateOut: 'fadeOut',
            smartSpeed: 250
        });

        // Header Slide items with animate.css
        var owl = $('.header-slider');
        owl.owlCarousel();
        owl.on('translate.owl.carousel', function (event) {
            $('.header-single-slider .inner-content').removeClass('animated').hide();
            $('.header-single-slider .boxed-btn').removeClass('animated').hide();
        });

        owl.on('translated.owl.carousel', function (event) {
            $('.header-single-slider .inner-content').addClass('animated flipInX').show();
            $('.header-single-slider .boxed-btn').addClass('animated fadeInUp').show();
        });

        // Services Carousel
        $(".services-carousel").owlCarousel({
            items: 3,
            loop: true,
            dots: false,
            nav: true,
            navText: ['<i class="icofont-rounded-left"></i>', '<i class="icofont-rounded-right"></i>'],
            margin: 30,
            autoplay: true,
            autoplayTimeout: 9000,
            animateIn: 'pulse',
            animateOut: 'fadeOut',
            smartSpeed: 250,
            responsive: {
                0: {
                    items: 1
                },
                700: {
                    items: 2,
                },
                900: {
                    items: 3
                },
            }
        });

        // Testimonial Carousel
        $(".testimonial-carousel").owlCarousel({
            items: 1,
            loop: true,
            dots: false,
            nav: false,
            autoplay: true,
            autoplayTimeout: 6000,
            animateIn: 'fadeInRight',
            animateOut: 'fadeInLeft',
            smartSpeed: 250,
            center: true
        });

        // Partners Carousel
        $(".partner-carousel").owlCarousel({
            items: 5,
            loop: true,
            dots: false,
            nav: true,
            navText: ['<i class="icofont-rounded-left"></i>', '<i class="icofont-rounded-right"></i>'],
            margin: 30,
            autoplay: true,
            autoplayTimeout: 9000,
            animateIn: 'pulse',
            animateOut: 'fadeOut',
            smartSpeed: 250,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3,
                },
                1050: {
                    items: 5
                }
            }
        });

        // info Carousel
        $(".info-carousel").owlCarousel({
            items: 1,
            loop: true,
            dots: true,
            nav: false,
            margin: 30,
            autoplay: true,
            autoplayTimeout: 5000,
            animateIn: 'pulse',
            animateOut: 'fadeOut',
            smartSpeed: 250,
            center: true
        });

        // Foter Info Carousel
        $(".widget_office_carousel").owlCarousel({
            items: 1,
            loop: true,
            dots: true,
            nav: false,
            margin: 0,
            autoplay: true,
            autoplayTimeout: 5000,
            animateIn: 'fadeInRight',
            smartSpeed: 250,
            center: true
        });

        // MagnificPopup
        $('.gallery-items').magnificPopup({
            delegate: '.gallery-item a',
            type: 'image',
            gallery: {
                enabled: true,
            }
        });

        // Open Social In Latest News
        $('.sbtn-01').on('click', function (e) {
            $(".meta-share .social-links.sbtn-01").toggleClass('open');
        });
        $('.sbtn-02').on('click', function (e) {
            $(".meta-share .social-links.sbtn-02").toggleClass('open');
        });
        $('.sbtn-03').on('click', function (e) {
            $(".meta-share .social-links.sbtn-03").toggleClass('open');
        });

        // Search
        function buttonUp() {
            var valux = $('#searchbox').val();
            valux = $.trim(valux).length;
            if (valux !== 0) {
                $('#searchsubmit').css('z-index', '99');
            } else {
                $('#searchbox').val('');
                $('#searchsubmit').css('z-index', '-999');
            }
        }

        var submitIcon = $('.search-icon');
        var submitInput = $('#searchbox');
        var searchBox = $('.sb-search');
        var isOpen = false;

        $(document).on('mouseup', function () {
            if (isOpen == true) {
                submitInput.val('');
                $('#searchsubmit').css('z-index', '-999');
                submitIcon.click();
            }
        });

        submitIcon.on('mouseup', function () {
            return false;
        });

        searchBox.on('mouseup', function () {
            return false;
        });

        submitIcon.on('click', function () {
            if (isOpen == false) {
                searchBox.addClass('sb-search-open');
                isOpen = true;
            } else {
                searchBox.removeClass('sb-search-open');
                isOpen = false;
            }
        });

        //============= Mean Menu
        $('.mobile-menu-active').meanmenu({
            meanScreenWidth: "991",
            meanMenuContainer: '.mobile-menu'
        });
        //============= Mean Menu

        // Load More Gallery
        $(".gallery-load").slice(0, 6).show();
        $("#gallery-load-pro").on('click', function (e) {
            e.preventDefault();
            $("#gallery-ti-port-load").addClass("ti-port-load-show");
            $("#gallery-ti-port-load").animate({
                display: "block"
            }, 300, function () {
                // Animation complete.
                var noMoreHtml = '<a class="load-btn boxed-btn font-good" href="#" id="gallery-load-pro" data-text="نهاية الصور">نهاية الصور</a>';
                $(".gallery-load:hidden").slice(0, 3).slideDown();
                if ($(".gallery-load:hidden").length === 0) {
                    $("#gallery-load-pro").replaceWith(noMoreHtml);
                }
                $("#gallery-ti-port-load").removeClass("ti-port-load-show");
            });
        });

        // Gallery hover Effect
        $('.gallery-items > .gallery-item').hoverdir({
            hoverDelay: 75,
            hoverElem: '.goverlay'
        });

        // Coming Soon page
        if ($('.cs-countdown').length > 0) {
            var countdown_expiry_date = $('.cs-countdown').data('expire-date');
            if (countdown_expiry_date != '') {
                $('.cs-countdown').downCount({
                    date: countdown_expiry_date + ' 12:00:00',
                });
            }
        }

        if ($('.cs-timer-wrap').length > 0) {
            var day_circle_color = $('.cs-timer-wrap').data('timer-day-color');
            var hour_circle_color = $('.cs-timer-wrap').data('timer-hour-color');
            var minute_circle_color = $('.cs-timer-wrap').data('timer-minute-color');
            var second_circle_color = $('.cs-timer-wrap').data('timer-second-color');
            var circle_date_countdown_bgcolor = $('.cs-timer-wrap').data('timer-bgcolor');
            $(".cs-circle-timer").TimeCircles({
                "animation": "smooth",
                "bg_width": 1,
                "fg_width": 0.03,
                "circle_bg_color": circle_date_countdown_bgcolor,
                "time": {
                    "Days": {
                        "text": $(".cs-circle-timer").data('days-label'),
                        "color": day_circle_color,
                        "show": true
                    },
                    "Hours": {
                        "text": $(".cs-circle-timer").data('hours-label'),
                        "color": hour_circle_color,
                        "show": true
                    },
                    "Minutes": {
                        "text": $(".cs-circle-timer").data('minutes-label'),
                        "color": minute_circle_color,
                        "show": true
                    },
                    "Seconds": {
                        "text": $(".cs-circle-timer").data('seconds-label'),
                        "color": second_circle_color,
                        "show": true
                    }
                }
            });
        }


        // Coming Soon
        $('.cs-close').on('click', function () {
            $(this).closest('.cs-section').removeClass('cs-active-section');
        });

        $(".btn-notify-trigger").on('click', function () {
            $(".cs-subscription-section").addClass("cs-active-section");
        });

        $(".btn-contact-trigger").on('click', function () {
            $(".cs-contact-section").addClass("cs-active-section");
        });

        // About Video
        $('#play-video').on('click', function (e) {
            e.preventDefault();
            $('#video-overlay').addClass('open');
            $("#video-overlay").append(
                '<iframe width="560" height="315" src="https://www.youtube.com/embed/ICxC5ekWnUc" frameborder="0" allowfullscreen></iframe>'
            );
        });

        $('.video-overlay, .video-overlay-close').on('click', function (e) {
            e.preventDefault();
            close_video();
        });

        $(document).keyup(function (e) {
            if (e.keyCode === 27) {
                close_video();
            }
        });

        function close_video() {
            $('.video-overlay.open').removeClass('open').find('iframe').remove();
        };

        // ScrollUp
        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });

        $('.scrollup').on('click', function () {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });

    });


    jQuery(window).on('load', function () {

        // Sticky Nav
        $(".sticky-nav").sticky({
            topSpacing: 0
        });

        // Preloader
        jQuery(".preloader-wrapper").fadeOut('slow');

    });

    window.globalVar = 1;

  	//create initial layout




  	var ProcessContainer = {
  			ProcessUserMessage: function (e,texttoinput) {
  			window.globalVar += 1;
  			$('.class123').hide();

  			setTimeout(function () {
  				$("#chatwindow").append("<div id='dotdotdot'><span id='StuLife" + window.globalVar + "' class='options class123' style='float:left;margin-right: 40px; background-color:#77DD77' onclick='test.myFunction(event,this)'><span class='dotA'></span> <span class='dotB'></span> <span class='dotC'></span> </span></div><div style='clear: both'></div>");
  			}, 700);

  			setTimeout(function () {
  				$('.class123').hide();
  				BotMessageContainer.BotMessage('مرحباََ بك عزرا ولاكن صاحب الصفحة غير موجود حاليا أترك رسالتك وسوف نرسل إليه اشعار برسالتك');
  				$('#chatwindow').scrollTop($('#chatwindow')[0].scrollHeight);
  			}, 2000);
  		}
  	}

  	var UserMessageContainer = {
      UserMessage: function (e,texttoinput) {
  		$("#chatwindow").append("<div style='width: 100%'><span id='StuLife' class='options' style='background-color: skyblue;margin-left: 40px;float:right' onclick='test.myFunction(event,this)'>" + texttoinput + "</span></div><div style='clear: both'></div>");
  		ProcessContainer.ProcessUserMessage(e,texttoinput);
  		$("#UserInputBox").val("");

  		}
  	}

  	var BotMessageContainer = {
  		BotMessage: function (replymessage) {
  			$("#chatwindow").append("<div style='width: 100%;'><span id='StuLife"+ window.globalVar + "' class='options' style='float:left;margin-right: 40px;background-color:#77DD77' onclick='test.myFunction(event,this)'>" + replymessage + "</span></div><div style='clear: both'></div>");
  			}
  		}

  	var BotMessageWithActionContainer = {
      BotMessageWithAction: function (id1,class1,onclick1, text1, link) {
  		$("#chatwindow").append("<a href='" + link + "'><div><span id='StuLife"+ window.globalVar + "' class='options' style='float:left;background-color:#77DD77' onclick='test.myFunction(event,this)'>" + text1 + "</span></div><div style='clear: both'></div></a>");
  		}
  	}

  	$("#UserInputBox").keypress(function(e) {
  		if(e.which == 13) {
  			UserMessageContainer.UserMessage(e,$("#UserInputBox").val());
  			$('#chatwindow').scrollTop($('#chatwindow')[0].scrollHeight);
  		}
  	});

  	$(".message").click(function(e){
  		UserMessageContainer.UserMessage(e,$("#UserInputBox").val());
  	});

    $("#closebutton").click(function(e){
  		 $("#menuoptions").toggle();
  	});



      $(".StartChat").click(function(){
  		$("#UserInputBox").val("");
          $("#menuoptions").animate({right: '0'}).animate({top: '0%'},{ queue: false, duration: 1000 }).animate({height: '100%'},{ queue: false, duration: 200 });
        $('#closebutton').fadeOut({ queue: false, duration: 200 });


  		// $('#Instruction').text('How can I help you?');
  		// BotMessageContainer.BotMessage('Hello');
  		// BotMessageContainer.BotMessage('This is purely the front end system for a chatbot.');
      //  BotMessageContainer.BotMessage('You can still try it but only sample text is returned');


  		$('#usertextboxmessage').fadeIn(1000);
  		$('#chatwindow').fadeIn(1000);
  		$('#UserInputBox').focus();

      });


}(jQuery));

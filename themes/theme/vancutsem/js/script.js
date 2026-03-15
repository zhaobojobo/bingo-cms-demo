// DEBOUNCE FUNCTION via @http://davidwalsh.name/javascript-debounce-function
function debounce(a, b, c) {
    var d;
    return function() {
        var e = this,
            f = arguments;
        clearTimeout(d), d = setTimeout(function() { d = null, c || a.apply(e, f) }, b), c && !d && a.apply(e, f) 
    } 
}
var isIE = '-ms-scroll-limit' in document.documentElement.style && '-ms-ime-align' in document.documentElement.style;

jQuery(document).ready(function($) {



    //MENU
function mouseEvents() {
 

$('.section-with-aside .desc-second .content a').each(function(){
  
    var Chaine = $(this).attr('href'); 
    var Sous_Chaine = '.pdf';  
    var Resultat = Chaine.indexOf(Sous_Chaine); 

    if (Resultat > 0) {
        // console.log('je suis pdf');
        $(this).addClass('eternal-link').attr('target','_blank');
    }

})



    var mouseEnter = ((document.ontouchstart !== null) ? 'mouseenter' : 'touchstart');

    var touch_menuHasDropDown = $('.touchevents li.menu-item-has-children'),
        no_touch_menuHasDropDown = $('.no-touchevents li.menu-item-has-children'),

        menuToggle = $('.menu-toggle'),
        body = $('body'),
        nav = $('.menu-main-menu-container'),
        mobileMenu = $('.mobile-menu'),

        touch_menuLang = $('.touchevents .lang-menu'),
        no_touch_menuLang = $('.no-touchevents .lang-menu'),
        otherLangs = $('.other-langs');

    no_touch_menuLang.on('mouseenter', '> span', menuLang_enter);
    touch_menuLang.on('touchstart', menuLang_click);
    no_touch_menuLang.on('mouseleave', menuLang_leave);
    touch_menuLang.on('click', menuLang_click);
    otherLangs.on('click', function(event) {
        event.stopPropagation();
    });
    otherLangs.on('touchstart', function(event) {
        event.stopPropagation();
    });

    function menuLang_enter(e) {
        e.preventDefault();
        $(this).closest('.lang-menu').addClass('hovered');
    }

    function menuLang_leave() {
        $(this).removeClass('hovered');
    }

    function menuLang_click(e) {
        e.preventDefault();
        if ($(this).hasClass('hovered')) {
            $(this).removeClass('hovered');
        } else {
            $(this).addClass('hovered');
        }
    }

    no_touch_menuHasDropDown.on('mouseenter', '>a', menuHasDropDown_enter);
    touch_menuHasDropDown.on('touchstart', '>a', menuHasDropDown_click);
    no_touch_menuHasDropDown.on('mouseleave', menuHasDropDown_leave);
    touch_menuHasDropDown.on('click', '>a', menuHasDropDown_click);
    no_touch_menuHasDropDown.on('click', '>a', function(e) {
        e.preventDefault();
    });


    var submenu1 = $('.sub-menu1');
    var submenu2 = $('.sub-menu2');

    function menuHasDropDown_enter(e) {
        e.preventDefault();
        if (!body.hasClass('subbed')) {
            body.addClass('subbed');
           // $(this).closest('li').addClass('hovered');
           // TweenMax.set(submenu1, { height: "auto" });
            //TweenMax.from(submenu1, 0.35, { ease: Power3.easeOut, height: 0 });
            //submenu1.addClass('hovered');
        }
    }

    function menuHasDropDown_leave() {
        body.removeClass('subbed');
        $(this).removeClass('hovered');
        //TweenMax.to(submenu1, 0.35, { ease: Expo.easein, height: 0 });
        //submenu1.removeClass('hovered');
    }

    function menuHasDropDown_click(e) {
       // e.stopPropagation();
       // e.preventDefault();
      
        
    }
    $(".menu-item-has-children").on('click',function () {
        
        var num = $(".menu-item-has-children").index($(this));
        
        if($(".menu-item-has-children .sub-menu").eq(num).css("display")=="none"){
            $(".menu-item-has-children").find(".fa-angle-up").hide();
            $(".menu-item-has-children").find(".fa-angle-down").show();
            $(".menu-item-has-children").eq(num).find(".fa-angle-down").toggle();
            $(".menu-item-has-children").eq(num).find(".fa-angle-up").toggle();
            $(".menu-item-has-children .sub-menu").hide();
            $(".menu-item-has-children .sub-menu").eq(num).toggle();
            $(".menu-item-has-children").eq(num).addClass("hovered")
        }else{
            $(".menu-item-has-children").eq(num).find(".fa-angle-down").show();
            $(".menu-item-has-children").find(".fa-angle-up").hide();
            $(".menu-item-has-children .sub-menu").hide();
            $(".menu-item-has-children").removeClass("hovered")
   
        }
    });
    rspv_menu = debounce(function() {
        var winWidth = window.innerWidth,
            minWidth = 1100;
        if (winWidth > minWidth) {
            if ( ! nav.parents(".inner-header").length == 1 ) {
                nav.appendTo('.inner-header');
            }
        } else {
            if ( ! nav.parents('.mobile-menu').length == 1 ) {
                nav.appendTo(mobileMenu);
            }
        }
    }, 250);

    rspv_menu();
    $(window).on('resize', rspv_menu);


    // OFFRES EXPEND

    var expendLink = $('.expend-link');
    expendLink.on('click', function(e) {
        e.preventDefault();
        var it = $(this);
        var excerpt = it.closest('article').find('p.to-shave'),
            content = it.closest('article').find('.full-content');
        if (it.hasClass('close')) {
            TweenMax.to(content, 0.35, { height: 90, onComplete: function(){
                it.removeClass('close');
                it.addClass('open');
                excerpt.show();
                content.height(0);
            } });
        }
        else {
            excerpt.hide();

            TweenMax.set(content, { height: "auto" });
            TweenMax.from(content, 0.35, { height: 90, onComplete: function(){
                it.removeClass('open');
                it.addClass('close');
            } });
        }
    });

    // VIDEO

    $('.vid-box').on('click', function() {
        var it = $(this),
            video = $(this).data('video');
        it.addClass('fade');
        it.prepend('<iframe src="'+video+'" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
    });

    // AJAX LOAD NEWS
    var ajaxMore = $('.ajax-more');
    function loadNews() {
        var $container = $('.all-news');

        ajaxMore.addClass('loading');

        var page = $container.find('.ajax-page:last-child').find('a');
        if(page.length === 0) {
            ajaxMore.addClass('disabled');
            return false;
        }
        else {
            var page_link = page.attr('href');
            $.ajax({
                type: "POST",
                url: page_link,
                cache: false,
                success: function (html) {
                    if (html.length > 0) {
                        var el = $(html).find('.all-news > *');
                        if (isIE) {
                            var article = el.filter('article');
                            article.each(function() {
                                $(this).removeAttr('data-aos')
                            });
                        }
                        $container.append(el);
                    }
                },
                complete: function() {
                    ajaxMore.removeClass('loading');
                    
                    // BODY HEIGHT 
                    var body = $('body'),
                        container = $('.scroll-content'),
                        contHeight = container.height();
                        
                        body.height(contHeight);

                    var bodyHeight = debounce(function() {
                        var contHeight = container.height();
                        body.height(contHeight);
                        AOS.refresh();
                    }, 250);

                    
                }
            });
        }
    }
    $('.ajax-more').on('click',function(e) {
        e.preventDefault();
        loadNews();
    });

    // FORM PUSHER

    var toForm = $('a.to-form'),
        stPusher = $('.st-pusher'),
        closePusher = $('.close-pusher');
    toForm.on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var title = $(this).data('title'),
            formTitle = $('.form-pusher').find('h3'),
            inputTitle = $('.job-title').find('input');
        formTitle.html(title);
        inputTitle.val(title);
        body.addClass('st-menu-open st-form');
    });
    stPusher.on('click', function() {
        body.removeClass('st-menu-open st-form st-mobile-menu');
        menuToggle.removeClass('active');
    });
    closePusher.on('click', function(e) {
        e.preventDefault();
        body.removeClass('st-menu-open st-form st-mobile-menu');
    });

    menuToggle.on('click', function(e) {
        e.stopPropagation(); 
        $(this).addClass('active');
        body.addClass('st-menu-open st-mobile-menu');     
    });
    mobileMenu.on('click', function() {
       // body.removeClass('st-menu-open st-mobile-menu');
        menuToggle.removeClass('active');
    });

    // FORM EVENTS
    var labelAnim = $('.labelanim');
    labelAnim.on('focusin', function() {
        $(this).addClass('focused');
        $(this).addClass('written');
    })
    .on('focusout', function() {
        $(this).removeClass('focused');
        if( !$(this).find('input').val() ) {
            $(this).removeClass('written');
        }
    });


    // file input
    var upload = $('.wpcf7-file');
    upload.on('change', function() {
        var upVal = $(this).val(),
        label = $(this).closest('.label-input').find('.file-trigger');
        upVal = upVal.replace(/^C:\\fakepath\\/, "");
        label.html(upVal);
    });

    // CLOSE 
    $('body').on("webkitAnimationEnd oanimationend msAnimationEnd animationend", '.close-form', function(){
      $(this).removeClass("animated"); 
    })
    .on(mouseEnter, '.close-form', function() {
      $(this).addClass("animated");
    });

}
mouseEvents();
var scrollbar;    
    function scrollbar_and_header() {

        // Hide Header on on scroll down
        var header = $('.site-header'),
            lastScrollTop = 0,
            // delta = 5,
            navbarHeight = header.outerHeight();

        // SMOOTH SCROLLBAR

        scrollbar = Scrollbar.init(document.getElementById('scrollbar'),{
                syncCallbacks: true
            });
        if (document.getElementById('form-pusher') !== null) {
            var scrollbarForm = Scrollbar.init(document.getElementById('form-pusher'));
        }

        function scrollbarScroll(data) {
            hasScrolled();
            $(window).scrollTop(data.offset.y);
        }
        if (!isIE) {
            scrollbar.addListener(scrollbarScroll);
        }

        function hasScrolled() {
            var st = scrollbar.offset.y;

            // If they scrolled down and are past the navbar, add class .nav-up.
            // This is necessary so you never see what is "behind" the navbar.
            if (st <= navbarHeight) {
                header.removeClass('nav-between');
            }
            if (st > lastScrollTop && st > navbarHeight) {
                // Scroll Down
                header.removeClass('nav-down').addClass('nav-up');
            } else {
                // Scroll Up
                if (st > navbarHeight) {    
                    header.addClass('nav-between');
                }
                if (st < lastScrollTop) {
                    header.removeClass('nav-up').addClass('nav-down');
                }
            }
            lastScrollTop = st;
        }

        // SCROLL TO
        $('.scroll-to').on('click', function() {
            scrollbar.scrollIntoView(document.getElementById('scroll-to'));
        });
    }
    scrollbar_and_header();

    // SVG
    svg4everybody();

    // SKROLLR

    // if (isMobile.any) {
        skrollrCheck = debounce(function() {
            var winWidth = window.innerWidth,
                minWidth = 1024;

                if (winWidth > minWidth) {
                // Init Skrollr
                skrollr.init({
                    forceHeight: false, //disable setting height on body
                    mobileDeceleration: 0.05,
                    smoothScrolling:'off'
                });
                skrollr.get().refresh();
            } else {
                // Destroy skrollr for screens less than 600px
                skrollr.init().destroy();
            }
            // BODY HEIGHT 
            var body = $('body'),
                container = $('.scroll-content'),
                contHeight = container.height();
                
                body.height(contHeight);
                $(window).scrollTop(scrollbar.offset.y);
                AOS.refresh();
        }, 250);

        //Initialize skrollr, but only if it exists
        if (typeof skrollr !== typeof undefined) {
            // INITIALIZE
            window.onload = skrollrCheck();
            window.addEventListener('resize', skrollrCheck);
        } else {
            console.log('skrollr is missing.');
        }
    // }

    // CUSTOM HOME SLIDER

    $('#da-slider').cslider({
        autoplay: true,
  
    });














$('.text-popup .close').click(function(e){
    e.preventDefault();
    // alert('ok');
    $(this).parent().fadeOut();
    // document.cookie = 'covidpopup=vu'; //Crée ou met à jour un cookie 'user'
// alert(document.cookie); //Affiche la liste des cookies
});









    // SWIPER
    function initSwiper() {
        var galleryThumbs = new Swiper('.gallery-thumbs', {
            spaceBetween: 10,
            slidesPerView: 14,
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            speed:1200,
            breakpoints: {
                1024: {
                    slidesPerView: 8,
                },
                768: {
                    slidesPerView: 6,
                },
                767: {
                    slidesPerView: 3,
                },
                414: {
                    slidesPerView: 3,
                },
                375: {
                    slidesPerView: 3,
                },
                320: {
                    slidesPerView: 3,
                }
                
            }
    
        });
        var galleryTop = new Swiper('.gallery-top', {
            spaceBetween: 10,
            navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev',
            },
            thumbs: {
              swiper: galleryThumbs,
            },
            speed:1200
        });


        var aboutfirstslider = new Swiper('.about-first-slider', {
            slidesPerView: 1,
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            speed:800,
    
        });
        var aboutsecondslider = new Swiper('.about-second-slider', {
            slidesPerView: 1,
            navigation: {
              nextEl: '.about-slider-next',
              prevEl: '.about-slider-prev',
            },
            thumbs: {
              swiper: aboutfirstslider,
            },
            speed:800
        });




 


    }
    initSwiper();

    




    // SCROLLTO

    $('a.scroll-to').on('click', function(e) {
        e.preventDefault();
        var dest = $(this).attr('href');
        TweenMax.to($(window), 1, { scrollTo: { y: dest, autoKill: false }, ease: Power4.easeOut });
    });


    // BARBA
    Barba.Prefetch.init();
    Barba.Pjax.start();
    Barba.Dispatcher.on('initStateChange', function() {
      if (typeof ga === 'function') {
        ga('send', 'pageview', location.pathname);
      }
    });
    Barba.Dispatcher.on('newPageReady', function(currentStatus, oldStatus, container) {
        var js = container.querySelector("script");
        if(js != null) {
            $.getScript( "https://maps.googleapis.com/maps/api/js?key=AIzaSyDo77UBqCntbsSfn1gkYyRwuqgjToez-5A" )
                .done(function( script, textStatus ) {
                    eval(js.innerHTML);
                    initMap();
                });
        }
        if(document.getElementById('form-pusher')) {
            $.getScript('http://www.vancutsem.be/wp-content/plugins/contact-form-7/includes/js/scripts.js?ver=4.7');
        }
    });
    Barba.Pjax.getTransition = function() {
      return HideShowTransition;
    };
    var HideShowTransition = Barba.BaseTransition.extend({
      start: function() {

        var e = this;

        //     jQ_oldContainer = $(e.oldContainer);

        // jQ_oldContainer.addClass('barba-old');
        // $('body').addClass('body-old');

        
        // setTimeout(function() {
        //     e.newContainerLoading.then(e.finish.bind(e));
        //     $('body').removeClass('loaded');
        //     $('body').removeClass('loading');
        // }, 1400)
        function toFinish() {
            e.newContainerLoading.then(e.finish.bind(e));
        }
        TweenMax.to('.wrapper', 0.8, { ease: Circ.easein, opacity: 0, onComplete: toFinish});
      },

      finish: function() {
        document.body.scrollTop = 0;
        this.done();

        

        // jQ_newContainer = $(this.newContainer);

        // jQ_newContainer.addClass('barba-new');
        
        $('.site-main').imagesLoaded(function() {
            TweenMax.to('.wrapper', 0.8, { ease: Circ.easeout, opacity: 1});
            // setTimeout(function() {
            //    $('body').addClass('body-new');
            //    $('body').addClass('loading');
            // // }, 600)
            // setTimeout(function() {
            //     $('body').addClass('loaded');
            //     $('body').removeClass('body-old');
            //     $('body').removeClass('body-new');
            // }, 800)
        });

        // SMOOTH SCROLLBAR
        var scrollbar; 
        scrollbar_and_header();
       
        // SVG
        svg4everybody();

        // BODY HEIGHT 
        var body = $('body'),
            container = $('.scroll-content'),
            contHeight = container.height();
            
            body.height(contHeight);

        var bodyHeight = debounce(function() {
            var contHeight = container.height();
            body.height(contHeight);
        }, 250);

        $(window).on('resize', bodyHeight); 

        // SKROLLR refresh
        window.onload = skrollrCheck();
        window.addEventListener('resize', skrollrCheck);

        // AOS Refresh

        AOS.init({
            offset: 100,
            duration: 1000,
            easing: 'ease-out-quart',
            disable: isIE == true
        });

        // CUSTOM HOME SLIDER refresh
        $('#da-slider').cslider({
            autoplay: true
        });

        //SWIPER refresh
        initSwiper();

        // SHAVE REFRESH
        $('.to-shave').shave(90);
        $('.expend-link').each(function() {
            var isShaved = $(this).closest('.text-box').find('.js-shave');
            if(isShaved.length === 0) {
                $(this).hide();
            }
        });

        //MOUSE EVENTS
        mouseEvents();

      }
    });

});

$(window).on('load', function() {
    var body = $('body');
    body.removeClass("preload");

    TweenMax.to('.wrapper', 0.8, { ease: Circ.easeout, opacity: 1});

    $('.site-main').imagesLoaded(function() {
        body.addClass('loading');
        setTimeout(function() {
            body.addClass('loaded');
        }, 1750);

        // BODY HEIGHT 
        var container = $('.scroll-content'),
            contHeight = container.height();
            
            body.height(contHeight);

        var bodyHeight = debounce(function() {
            var contHeight = container.height();
            body.height(contHeight);
        }, 250);

        $(window).on('resize', bodyHeight);

        // SHAVE

        $('.to-shave').shave(90);
        $('.expend-link').each(function() {
            var isShaved = $(this).closest('.text-box').find('.js-shave');
            if(isShaved.length === 0) {
                $(this).hide();
            }
        });
        
        AOS.init({
            offset: 100,
            duration: 1000,
            easing: 'ease-out-quart',
            disable: isIE == true
        });

    });
});
$(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
        $("body").addClass("scorll_logo")
        }else{
          $("body").removeClass("scorll_logo")
    }
});


$(document).ready(function(){
	var $tab_li = $('.news-items li');
	$tab_li.click(function(){
		$(this).addClass('active').siblings().removeClass('active');
		var index = $tab_li.index(this);
		$('.section-all-news .container .all-news_items').eq(index).show().siblings().hide();
		
	});

});
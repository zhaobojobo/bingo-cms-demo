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





    function initSwiper() {
        var v = new Swiper(".v .mySwiper", {
            effect : 'fade',
            autoplay:true,
        });
        var rendering  = new Swiper(".rendering .swiper-container", {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            loopFillGroupWithBlank: true,
            navigation: {
              nextEl: ".rendering .swiper-button-next",
              prevEl: ".rendering .swiper-button-prev",
            },
            speed:1200,
            breakpoints: {
              360: {
                slidesPerView: 1.2,
                centeredSlides: true,
              },
              320: {
                slidesPerView: 1.2,
                centeredSlides: true,
              },
              375: {
                slidesPerView: 1.2,
                centeredSlides: true,
              },
              414: {
                slidesPerView: 1.2,
                centeredSlides: true,
              },
              767: {
                slidesPerView: 1.2,
                centeredSlides: true,
              },
              768: {
                slidesPerView: 2,
              },
              1024: {
                slidesPerView: 3,
              },
              1280: {
                slidesPerView: 3,
              },
              1281: {
                slidesPerView: 4,
              },
            }
        });
        var news  = new Swiper(".news-swiper .swiper-container", {
            slidesPerView: 1.2,
            spaceBetween: 20,
            speed:1200,
            navigation: {
              nextEl: ".news-swiper .swiper-button-next",
              prevEl: ".news-swiper .swiper-button-prev",
            },
            breakpoints: {
              360: {
                slidesPerView: 1.2,
                centeredSlides: true,
              },
              320: {
                slidesPerView: 1.2,
                centeredSlides: true,
              },
              375: {
                slidesPerView: 1.2,
                centeredSlides: true,
              },
              414: {
                slidesPerView: 1.2,
                centeredSlides: true,
              },
              767: {
                slidesPerView: 1.2,
                centeredSlides: true,
              },
              768: {
                slidesPerView: 1.2,
              },
              1024: {
                slidesPerView: 1.2,
              },
              1280: {
                slidesPerView: 1.2,
              },
              1281: {
                slidesPerView: 1.2,
              },
            }
        });
        var swiimg = new Swiper(".swi-img .swiper-container", {
          pagination: {
            el: ".swi-img .swiper-pagination",
            type: "fraction",
          },
          //slidesPerView: 3,
          spaceBetween: 20,
          centeredSlides: true,
          loop: true
     
        });



        




 


    }
    initSwiper();


    // SCROLLTO

    $('a.scroll-to').on('click', function(e) {
        e.preventDefault();
        var dest = $(this).attr('href');
        TweenMax.to($(window), 1, { scrollTo: { y: dest, autoKill: false }, ease: Power4.easeOut });
    });
    $(".online .ex-two .sw").click(function(){
        $(".online .shows").toggleClass("show")
        $(".online .shows .swlist").toggleClass("show")  
        //$(this).addClass("show") 
    })
    $(".online .expand").click(function(){
        $(".online .expand").addClass("hide")
        $(".online .shows").toggleClass("show")
        $(".online .shows .swlist").toggleClass("show") 

    })
    $("header .menubar").click(function(){
       // alert(1)
        $("body").toggleClass("gnav")
    })


});

$(window).on('load', function() {
    var body = $('body');
    body.removeClass("preload");

   // TweenMax.to('.wrapper', 0.8, { ease: Circ.easeout, opacity: 1});

    $('.site-main').imagesLoaded(function() {
        body.addClass('loading');
        setTimeout(function() {
            body.addClass('loaded');
        }, 50);

        // BODY HEIGHT 
        var container = $('.scroll-content'),
            contHeight = container.height();
            
            body.height(contHeight);

        var bodyHeight = debounce(function() {
            var contHeight = container.height();
            body.height(contHeight);
        }, 250);

        $(window).on('resize', bodyHeight);

        
     

    });
});
   
AOS.init({
  offset: 0,
  duration: 1000,
  easing: 'ease-in-sine',
  disable: isIE == true
});
$(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
        $("body").addClass("scorll_logo")
        }else{
          $("body").removeClass("scorll_logo")
    }
});


$(document).ready(function(){
	var $tab_li = $('.pj_container .b_container #page_index #s_news .inner .col-md-4');
	$tab_li.mouseover(function(){
		$(this).addClass('active').siblings().removeClass('active');
		var index = $tab_li.index(this);
		$('.pj_container .b_container #page_index #s_news .imglist .sublist').eq(index).show().siblings().hide();
		
	});

});
$(document).ready(function(){
	var $tab_li1 = $('.pj_container .b_container #page_index #s_news .inner .swiper-slide');
	$tab_li1.mouseover(function(){
		$(this).addClass('active').siblings().removeClass('active');
		var index1 = $tab_li1.index(this);
		$('.pj_container .b_container #page_index #s_news .imglist .sublist').eq(index1).show().siblings().hide();
		
	});

});
$(".pj_container .b_container #page_index #Join .seeall a,.pj_container .b_container #page_index #Project .project .conitems").click(function(){
  $(".modal.fade").addClass("show")
})
$(".modal.fade .close").click(function(){
  $(".modal.fade").removeClass("show")
})
var pic3 = new Swiper(".pic3 .mySwiper", {
  speed:1200,
  loop:true,

});
var imgstop = new Swiper("#Service .inner .mySwiper", {
	spaceBetween: 10,
	slidesPerView: 8,
	freeMode: true,
  loop:true,
	watchSlidesProgress: true,
  speed:1200,
  breakpoints: {
		360: {
			slidesPerView: 3,
		},
		320: {
			slidesPerView: 3,
		},
		375: {
			slidesPerView: 3,
		},
		414: {
			slidesPerView: 3,
		},
		767: {
			slidesPerView: 3,
		},
		768: {
			slidesPerView: 5,
		},
		1024: {
			slidesPerView: 5,
		},
		1280: {
			slidesPerView: 8,
		},
	}
	
  });

  var imgsbottom = new Swiper("#Service .inner .mySwiper2", {
	spaceBetween: 60,
  loop:true,
	navigation: {
	  nextEl: "#Service .inner .swiper-button-next",
	  prevEl: "#Service .inner .swiper-button-prev",
	},
	thumbs: {
	  swiper: imgstop,
	},
  controller:{
    control: pic3,
  },
	speed:1200
  });
  




  var pics1 = new Swiper(".pics1 .mySwiper", {
    slidesPerView: 2.8,
    spaceBetween: 30,
    centeredSlides: true,
    loop:true,
    navigation: {
      nextEl: ".pics1 .swiper-button-next",
      prevEl: ".pics1 .swiper-button-prev",
    },
    pagination: {
      el: ".pics1 .swiper-pagination",
      clickable: true,
      type: "fraction",
    },
    speed:1200
  });
  var pics1 = new Swiper(".pics2 .mySwiper", {
    slidesPerView: 1.1,
    spaceBetween: 10,
    centeredSlides: true,
    loop:true,
    navigation: {
      nextEl: ".pics2 .swiper-button-next",
      prevEl: ".pics2 .swiper-button-prev",
    },
    pagination: {
      el: ".pics2 .swiper-pagination",
      clickable: true,
      type: "fraction",
    },
    speed:1200
  });



  $(".modal.fade .modal-content-project .cp .swiper-slide").click(function(){
    $(".modal.fade .modal-content-project .pics1").addClass("hide")
    $(".cp_txt").addClass("hide");
    $(".modal.fade .modal-content-project .pics2").addClass("show")
  })

  $(document).ready(function(){
    var $tab_litab = $('#Enquiry .content form .tablpal .items');
    $tab_litab.mouseover(function(){
      $(this).addClass('active').siblings().removeClass('active');
      var indextab = $tab_litab.index(this);
      $('#Enquiry .col-md-6 .tablist').eq(indextab).show().siblings().hide();
      
    });
  
  });


  $(document).ready(function(){
    var $tab_litab2 = $('.modal.fade .modal-content .modal-body .careerbox .backs .items');
    $tab_litab2.click(function(){
      $(this).addClass('active').siblings().removeClass('active');
      var indextab2 = $tab_litab2.index(this);
      $(".modal.fade .modal-content .modal-body .careerbox .backs").hide();
      $('.modal.fade .modal-content .modal-body .detail .items').eq(indextab2).show().siblings().hide();
      
    });
  
  });




  $(".modal.fade .modal-content .modal-body .detail .top .back").click(function(){
    $(".modal.fade .modal-content .modal-body .careerbox .backs").show();
    $(".modal.fade .modal-content .modal-body .detail .items").hide();
  })

$(function($) {
    laydate.render({
        elem: '#date'
    });

    let currentStep = 0;

    const formData = {
        // 装修资料
        wyzk: '現住翻新',
        dwzl: '',
        address: '',
        ft2: '',
        hkd: '',
        people: '',
        num: '',
        date: '',
        // 设计方针
        fg: [],
        fg_other: '',
        color: [],
        color_other: '',
        sszfg: '設計風格優先',
        // 联络资料
        name: '',
        call: '',
        email: '',
        phone: '',
        tj: [],
        tj_other: '',
        other: ''
    };

    const $stepContents = $('.contents');
    const $progressBars = $('.probar .bar');
    const $nextBtn = $('#next_step');
    const $prevBtn = $('#previous_step');
    const $submitBtn = $('#send2');

    function initSteps() {
        $stepContents.addClass('main-hide');
        $stepContents.eq(0).removeClass('main-hide');
        $prevBtn.hide();
        $nextBtn.show();
        $submitBtn.closest('.col-md-12').hide();
        updateProgressBar(0);
    }

    function updateProgressBar(step) {
        // step: 0,1,2
        $progressBars.removeClass('active');
        for (let i = 0; i <= step; i++) {
            $progressBars.eq(i).addClass('active');
        }
    }

    function goToStep(step) {
        if (step < 0 || step > 2) return;

        $stepContents.addClass('main-hide');
        $stepContents.eq(step).removeClass('main-hide');

        updateProgressBar(step);

        if (step === 0) {
            $prevBtn.hide();
        } else {
            $prevBtn.show();
        }

        if (step === 2) {
            $nextBtn.hide();
            $submitBtn.closest('.col-md-12').show();
        } else {
            $nextBtn.show();
            $submitBtn.closest('.col-md-12').hide();
        }

        currentStep = step;
    }

    function collectStepData(step) {
        switch (step) {
            case 0: // 装修资料
                formData.wyzk = $('input[name="wyzk"]:checked').val() || '';
                formData.dwzl = $('select[name="dwzl"]').val() || '';
                formData.address = $('input[name="address"]').val() || '';
                formData.ft2 = $('input[name="ft2"]').val() || '';
                formData.hkd = $('input[name="hkd"]').val() || '';
                formData.people = $('input[name="people"]').val() || '';
                formData.num = $('input[name="num"]').val() || '';
                formData.date = $('input[name="date"]').val() || '';
                break;
            case 1:

                formData.fg = [];
                $('input[name="fg[]"]:checked').each(function() {
                    formData.fg.push($(this).val());
                });
                formData.fg_other = $('input[name="fg_other"]').val() || '';

                formData.color = [];
                $('input[name="color[]"]:checked').each(function() {
                    formData.color.push($(this).val());
                });
                formData.color_other = $('input[name="color_other"]').val() || '';

                formData.sszfg = $('input[name="sszfg"]').val() || '設計風格優先';
                break;
            case 2:
                formData.name = $('input[name="name"]').val() || '';
                formData.call = $('select[name="call"]').val() || '';
                formData.email = $('input[name="email"]').val() || '';
                formData.phone = $('input[name="phone"]').val() || '';

                formData.tj = [];
                $('input[name="tj[]"]:checked').each(function() {
                    formData.tj.push($(this).val());
                });
                formData.tj_other = $('input[name="tj_other"]').val() || '';
                formData.other = $('textarea[name="other"]').val() || '';
                break;
        }
    }

    function validateStep(step) {
        let fieldsToCheck = [];
        if (step === 0) {
            fieldsToCheck = ['address', 'ft2', 'hkd'];
        } else if (step === 1) {
            // 设计方针没有带星号的字段，默认返回 true
            return true;
        } else if (step === 2) {
            fieldsToCheck = ['name', 'call', 'phone'];
        }

        for (let i = 0; i < fieldsToCheck.length; i++) {
            const fieldName = fieldsToCheck[i];
            let value = '';
            if (fieldName === 'address') value = $('input[name="address"]').val() || '';
            else if (fieldName === 'ft2') value = $('input[name="ft2"]').val() || '';
            else if (fieldName === 'hkd') value = $('input[name="hkd"]').val() || '';
            else if (fieldName === 'name') value = $('input[name="name"]').val() || '';
            else if (fieldName === 'call') value = $('select[name="call"]').val() || '';
            else if (fieldName === 'phone') value = $('input[name="phone"]').val() || '';

            if (!value || value.trim() === '') {
                let labelText = '';
                if (fieldName === 'address') labelText = '詳細單位地址';
                else if (fieldName === 'ft2') labelText = '單位面積';
                else if (fieldName === 'hkd') labelText = '裝修預算';
                else if (fieldName === 'name') labelText = '姓名';
                else if (fieldName === 'call') labelText = '稱呼';
                else if (fieldName === 'phone') labelText = '聯絡電話';

                alert(`請填寫 ${labelText} (必填项)`);
                if (fieldName === 'call') {
                    $('select[name="call"]').focus();
                } else {
                    $(`input[name="${fieldName}"]`).focus();
                }
                return false;
            }
        }
        return true;
    }

    function getSubmitData() {
        collectStepData(0);
        collectStepData(1);
        collectStepData(2);
        return formData;
    }

    $nextBtn.on('click', function(e) {
        e.preventDefault();

        collectStepData(currentStep);

        if (!validateStep(currentStep)) {
            return;
        }

        goToStep(currentStep + 1);
    });

    $prevBtn.on('click', function(e) {
        e.preventDefault();
        collectStepData(currentStep);
        goToStep(currentStep - 1);
    });

    $('.tablpal .items').on('click', function() {
        $('.tablpal .items').removeClass('active');
        $(this).addClass('active');
        const value = $(this).find('h3').text().trim();
        $('#sszfg').val(value);
    });

    $submitBtn.on('click', function(e) {
        e.preventDefault();

        collectStepData(2);

        if (!validateStep(2)) {
            return;
        }

        const finalData = getSubmitData();

        const $btn = $(this);
        const originalText = $btn.text();
        $btn.text('提交中...').prop('disabled', true);

        $.ajax({
            url: '/form/enquiry',
            type: 'POST',
            dataType: 'json',
            data: finalData,
            success: function(response) {
                console.log(response);
                if (response && response.status === true) {
                    alert('提交成功！我們會盡快與您聯繫。');
                    location.reload();
                } else {
                    alert('提交失敗：' + (response.message || '未知錯誤'));
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX 错误:', status, error);
                alert('網絡錯誤，請稍後重試。');
            },
            complete: function() {
                $btn.text(originalText).prop('disabled', false);
            }
        });
    });

    initSteps();

});


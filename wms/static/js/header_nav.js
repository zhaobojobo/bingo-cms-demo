  
$(function() {
  window_width = $(window).width();
  header_width = $(".header_nav").width();
  percent_width = header_width/window_width;
  if (percent_width>0.6) {


    $('.small_menu_left').click(function(event) {
      event.preventDefault();
      $('.header_nav>ul').animate({
        scrollLeft: "-=275px"
      }, "slow");
    });

    $('.small_menu_right').click(function(event) {
      event.preventDefault();
      $('.header_nav>ul').animate({
        scrollLeft: "+=275px"
      }, "slow");
    });
  }

});
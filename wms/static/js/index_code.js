$(document).ready(function () {
    if ($(window).width() > 992) {
        var target = $(".index_right");
        var targetHeight = target.outerHeight();


        $(window).scroll(function () {
            $scroll_var = $(document).scrollTop();
            $(".index_right").css("left", $scroll_var + "px");


            var scrollPercent = ((targetHeight - window.scrollY) / targetHeight);
            if (scrollPercent >= 0) {


                target.css('opacity', scrollPercent);
            }

        });
    }

    window.setInterval(function () {
        $(".scaning").text(Math.round(Math.random() * 10));
    }, 2000);
    /*
        $.fn.autotype = function() {
            var $text = $(this);
            var str = $text.html();
            var index = 0;
            var x = $text.html('');

            var timer = setInterval(function() {
                var current = str.substr(index, 1);

                if (current == '<') {
                    index = str.indexOf('>', index) + 1;
                } else {
                    index++;
                }
                $text.html(str.substring(0, index) + (index & 1 ? '_' : ''));
                index > $text.html().length + 10 && (index = 0);
                if(index >= str.length){
                  clearInterval(timer);
                }
            }, 100);
        };
        $("#autotype").autotype();
    */
});
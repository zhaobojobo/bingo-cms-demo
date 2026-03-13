<?php
/**@var $data */

use Admin\Helper;

?>

<footer id="footer" class="py-2">
    <div class="container my-2">
        <p class="text-center m-0"><?= \Admin\Helper::_(
                'Bwms &copy;%s, Powered by Bingo-HK',
                [date('Y')]
            ) ?></p>
    </div>
</footer>

<?php
$this->insert('modals', ['data' => $data]); ?>
<?php
$this->insert('image'); ?>

<script>
    function before_leave() {
        return "您確定不保存就離開嗎?";
    }
</script>

<script src="<?= Helper::staticUrl() ?>/js/hc-mobile-nav.js"></script>
<script src="<?= Helper::staticUrl() ?>/js/cropper.min.js"></script>
<script src="<?= Helper::staticUrl() ?>/js/jquery-cropper.js"></script>
<script src="<?= Helper::staticUrl() ?>/js/base64.js"></script>
<script src="<?= Helper::staticUrl() ?>/js/action.js"></script>
<script src="<?= Helper::staticUrl() ?>/js/files-select.js"></script>
<script src="<?= Helper::staticUrl() ?>/js/files-upload.js"></script>
<script src="<?= Helper::staticUrl() ?>/js/image.js"></script>
<script src="<?= Helper::staticUrl() ?>/lib/layer/layer.js"></script>
<script>
    (function () {
        var $menu = $('.nav-wrapper.nav-wrapper-1');
        $menu.find('a.level-1').on('click', function () {
            var $current = $(this).parent();
            $current.find('.nav-wrapper-2').slideToggle(function () {
                var bottom = $current.position().top + $current.height();
                if (bottom + $menu.scrollTop() > $menu.height()) {
                    $menu.animate({scrollTop: bottom - $menu.height() + 160 + 'px'}, 500);
                }
            });
            $(this).find('.nav-next i.fa').toggleClass('fa-angle-down fa-angle-right');
        });
        $menu.find('li.active').parents('.nav-wrapper.nav-wrapper-2').prev('a.level-1').trigger('click');
        var $submenu = $('.nav-wrapper.nav-wrapper-2');
        $submenu.find('a.level-2').on('click', function () {
            var $current = $(this).parent();
            $current.find('.nav-wrapper').slideToggle(function () {
                var bottom = $current.position().top + $current.height();
                if (bottom + $submenu.scrollTop() > $submenu.height()) {
                    $submenu.animate({scrollTop: bottom - $submenu.height() + 160 + 'px'}, 500);
                }
            });
            $(this).find('.nav-next i.fa').toggleClass('fa-angle-down fa-angle-right');
        });
        $menu.find('li.active').parents('.nav-wrapper.nav-wrapper-3').prev('a.level-2').trigger('click');
    })();
</script>
</body>
</html>

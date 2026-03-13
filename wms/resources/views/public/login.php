<?php

use Admin\Helper;

/**@var $data */
?>
<!DOCTYPE html>
<html lang="<?= $data['LANG'] ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Bingo Website Management System</title>
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/css/form.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/css/animate.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/css/parallax_bg.css">
    <script src="<?= Helper::staticUrl() ?>/js/jquery-3.5.1.min.js"></script>
</head>

<body>

<div id="fixed" class="d-flex justify-content-center align-items-center">
    <div id="content" class="wow fadeInDown">
        <img src="<?= Helper::staticUrl() ?>/images/logo.png" id="logo"/>
        <div id="login">
            <div id="message"></div>
            <form method="post" action="<?= Helper::getUrl('/login') ?>" class="login" id="form">

                <?php
                if (!empty($data['sites'])): ?>
                    <p>
                        <label for="site">Site:</label>
                        <select name="site" id="site">
                            <option value="/wms">主站</option>
                            <?php
                            foreach ($data['sites'] as $site): ?>
                                <option value="/<?= $site ?>/wms" <?php
                                if (trim(SUB_DIR, '/') == $site): ?>selected<?php
                                endif ?>><?= $site ?></option>
                            <?php
                            endforeach; ?>
                        </select>
                    </p>
                <?php
                endif ?>

                <p>
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" value="" required>
                </p>

                <p>
                    <label for="password">Password:</label>
                    <input name="password" type="password" id="password" autocomplete="off" required>
                </p>

                <p>
                    <label for="key">Key:</label>
                    <input name="key" type="text" id="key" value="" required autocomplete="off">
                </p>

                <p class="login-submit">
                    <button type="submit" class="login-button submit">Login</button>
                </p>
            </form>
            <div id="footer">Powered By <a href="http://www.hk-bingo.com" target="new">Bingo(HK)</a></div>
        </div>
    </div>
</div>

<section class="parallax-wrapper">
    <figure class="parallax"></figure>
</section>
<script src="<?= Helper::staticUrl() ?>/js/parallax_bg.js"></script>
<script src="<?= Helper::staticUrl() ?>/lib/layer/layer.js"></script>
<script src="<?= Helper::staticUrl() ?>/js/wow.js"></script>
<script>new WOW().init();</script>
<script src="<?= Helper::staticUrl() ?>/js/action.js"></script>

<script>
    (function ($) {
        $('select#site').on('change', function () {
            location.href = $(this).val();
        })
    })(jQuery);
</script>

</body>

</html>

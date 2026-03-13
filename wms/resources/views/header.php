<?php

use Admin\Helper;

/**@var $data */
?>
<!DOCTYPE html>

<html lang="<?= $data['LANG'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <title>BingoCMS</title>

    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/css/fileinput.min.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/css/bootstrap-multiselect.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/css/glyphicon.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/css/jquery-ui.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/lib/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/lib/layer/theme/default/layer.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/css/cropper.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/css/image.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/css/switch.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/css/animate.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/css/parallax_bg.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/css/hc-mobile-nav.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/css/cms.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/css/bingo-wms.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/lib/jquery-ui-1.13.2.custom/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="<?= Helper::staticUrl() ?>/lib/jquery-ui-1.13.2.custom/jquery-ui.theme.min.css">

    <script src="<?= Helper::staticUrl() ?>/js/jquery-3.5.1.min.js"></script>
    <script src="<?= Helper::staticUrl() ?>/js/popper.min.js"></script>
    <script src="<?= Helper::staticUrl() ?>/js/bootstrap.min.js"></script>
    <script src="<?= Helper::staticUrl() ?>/js/fileinput.min.js"></script>
    <script src="<?= Helper::staticUrl() ?>/js/fileinput/zh_hk.js"></script>
    <script src="<?= Helper::staticUrl() ?>/js/fileinput/zh_cn.js"></script>
    <script src="<?= Helper::staticUrl() ?>/js/bootstrap-multiselect.js"></script>
    <script src="<?= Helper::staticUrl() ?>/js/jquery-ui.js"></script>
    <script src="<?= Helper::staticUrl() ?>/js/jquery.fancybox.min.js"></script>
    <script src="<?= Helper::staticUrl() ?>/lib/jquery-ui-1.13.2.custom/jquery-ui.min.js"></script>
    <script>var editors = [];</script>
</head>
<body style="background: #000;max-height: 100vh;">

<!--小屏幕-->
<nav class="hc-mobile-nav hc-nav-1 nav-levels-overlap side-left off-canvas disable-body nav-open">
    <div class="nav-container">
        <div class="nav-wrapper nav-wrapper-1">
            <h2>
                <a href="<?= Helper::getUrl('/') ?>" class="cms-logo">
                    <img src="<?= Helper::staticUrl() ?>/images/logo.png" alt="logo">
                </a>
            </h2>
            <ul class="menu-content">
                <?php
                foreach ($data['menus'] as $i => $menu): ?>
                    <li class="nav-parent">
                        <input type="checkbox" id="hc-nav-<?= $i ?>" data-level="1" data-index="<?= $i ?>">
                        <a href="javascript:void(0)" class="level-1">
                            <label for="hc-nav-<?= $i ?>"></label>
                            <?= Helper::_($menu->getName()) ?>
                            <span class="nav-next"><i class="fa fa-angle-right"></i></span>
                        </a>
                        <?php
                        if (isset($menu->children) && $menu->children): ?>
                            <div class="nav-wrapper nav-wrapper-2">
                                <ul>
                                    <?php
                                    foreach ($menu->children as $child): ?>
                                        <?php
                                        $url = Helper::getUrl($child->getRoute()) ?>
                                        <li class="nav-parent <?php
                                        if ($_SERVER['REQUEST_URI'] == $url): ?>active<?php
                                        endif; ?>">
                                            <?php
                                            if (isset($child->children) && $child->children): ?>
                                                <a href="javascript:void(0)" class="level-2">
                                                    <?= Helper::_($child->getName()) ?>
                                                    <span class="nav-next"><i class="fa fa-angle-right"></i></span>
                                                </a>
                                                <div class="nav-wrapper nav-wrapper-3">
                                                    <ul>
                                                        <?php
                                                        foreach ($child->children as $_child): ?>
                                                            <?php
                                                            $url = Helper::getUrl($_child->getRoute()) ?>
                                                            <li <?php
                                                                if ($_SERVER['REQUEST_URI'] == $url): ?>class="active"<?php
                                                            endif; ?>>
                                                                <a href="<?= $url ?>" class="level-3">
                                                                    <?= Helper::_(ucwords($_child->getName())) ?>
                                                                </a>
                                                            </li>
                                                        <?php
                                                        endforeach; ?>
                                                    </ul>
                                                </div>
                                            <?php
                                            else: ?>
                                                <a href="<?= $url ?>">
                                                    <?= Helper::_($child->getName()) ?>
                                                </a>
                                            <?php
                                            endif; ?>
                                        </li>
                                    <?php
                                    endforeach; ?>
                                </ul>
                            </div>
                        <?php
                        endif; ?>
                    </li>
                <?php
                endforeach; ?>
            </ul>
        </div>
    </div>
</nav>
<!--小屏幕-->

<header class="d-none d-xl-block d-lg-block top-bar">
    <div id="header_top">
        <span><?= date('Y-m-d'); ?></span>
        <div class="header_setting">
            <div class="header_lang">
                <i class="fa fa-globe dropdown_lang" aria-hidden="true"></i>
                &nbsp;
                <span><?= Helper::_('Language') ?></span>
                <ul class="header_sub_ul switch-language">
                    <?php
                    foreach ($data['LANGUAGES'] as $langId => $language):
                        ?>
                        <li>
                            <a class="dropdown-item"
                               href="<?= Helper::getLangUrl($langId) ?>"
                               data-api="<?= Helper::getUrl(
                                   '/language/' . $langId
                               ) ?>">
                                <?= $language['label'] ?>
                            </a>
                        </li>
                    <?php
                    endforeach; ?>
                </ul>
            </div>
            <div class="header_admin">
                <span><?= Helper::_('Hi,') ?></span>
                <span class="username pr-3"><?= $data['USER']['username'] ?></span>
                <a href="<?= Helper::getUrl('/logout') ?>">
                    <i class="fa fa-power-off" aria-hidden="true"></i>
                    &nbsp;
                    <span><?= Helper::_('Sign out') ?></span>
                </a>
            </div>
        </div>
    </div>
</header>

<?php

use Admin\Helper;

?>
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/themes/dark.css">
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/froala_editor.css">
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/froala_style.css">
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/plugins/code_view.css">
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/plugins/draggable.css">
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/plugins/colors.css">
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/plugins/emoticons.css">
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/plugins/image_manager.css">
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/plugins/image.css">
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/plugins/line_breaker.css">
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/plugins/table.css">
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/plugins/char_counter.css">
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/plugins/video.css">
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/plugins/fullscreen.css">
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/plugins/file.css">
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/plugins/quick_insert.css">
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/plugins/help.css">
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/third_party/spell_checker.css">
<link rel="stylesheet" href="<?= Helper::staticUrl()?>/lib/froala/css/plugins/special_characters.css">
<style>
    div.fr-wrapper > div > a {
		visibility: hidden;
		pointer-events:none;
	}
	.dark-theme.fr-box.fr-basic .fr-element{
		/*margin-top:-40px;*/
		position:relative;
		z-index:99999;
	}
</style>
<?php
/**
 * view data
 * @var $site
 * @var $lang
 * @var $page
 */

$seo = seo($page, $lang);
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $seo['title'] ?></title>
    <meta name="description" content="<?= $seo['description'] ?>">
    <meta name="keywords" content="<?= $seo['keywords'] ?>">
    <meta name="author" content="bingo-hk.com">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= themePath() ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= themePath() ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= themePath() ?>/favicon-16x16.png">
    <link rel="manifest" href="<?= themePath() ?>/site.webmanifest">
    <link rel="stylesheet" href="<?= themePath() ?>/css/main.min.css">
    <?= $site['BASE']['GA'] ?>
</head>

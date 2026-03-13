<?php
/**
 * view data
 *
 * @var $site
 * @var $seo
 * @var $page
 */ ?>

<?php
$this->layout('layouts/main');
?>

<main>
    <?= $this->fetch('partials/page-header'); ?>
    <div class="block">
        <div class="content-header text-center">
            <h2><?= $page->title ?></h2>
        </div>
        <div class="content">
            <?= $page->content ?>
        </div>
        <div class="block-bg-1"></div>
        <div class="block-bg-2"></div>
    </div>
</main>

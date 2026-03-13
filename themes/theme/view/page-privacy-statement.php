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
    <div class="block block-statement">
        <div class="content-container">
            <div class="content-header text-center">
                <h2><?= $page->title ?></h2>
            </div>
            <div class="content d-md-flex justify-content-md-between align-items-md-start">
                <div class="decorate"></div>
                <div class="html-content">
                    <?= $page->content ?>
                </div>
            </div>
        </div>
        <div class="block-bg-1"></div>
    </div>
</main>

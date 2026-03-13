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
    <?= $this->fetch('partials/page-header', ['nid' => 2]); ?>
    <div class="block block-fse">
        <div class="content-container">
            <div class="content-header">
                <h2><?= $page->title ?></h2>
            </div>
            <div class="content-1">
                <img class="image" src="<?= $page->image ?>" alt="">
                <h3 class="content-title text-start d-xl-block mt-xl-0"><?= $page->subtitle ?></h3>
                <div class="html-content">
                    <?= $page->content ?>
                </div>
            </div>
        </div>
        <div class="block-bg-1 style-1"></div>
        <div class="block-bg-2"></div>
    </div>
</main>

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
    <div class="block block-profile">
        <div class="content-header text-center">
            <h2><?= $page->title ?></h2>
            <div class="small"><?= $page->sub_title ?></div>
        </div>
        <div class="content-1">
            <div class="content-container">
                <div class="html-content">
                    <?= $page->content ?>
                </div>
            </div>
        </div>
        <div class="content-2">
            <div class="content-container d-xl-flex justify-content-xl-between align-items-xl-end">
                <div class="text-wrap">
                    <div class="html-content">
                        <?= $page->block2_content ?>
                    </div>
                </div>
                <div class="image-wrap">
                    <img class="image-fw" src="<?= $page->block2_image ?>" alt="">
                </div>
            </div>
        </div>
        <div class="content-3">
            <div class="content-container">
                <div class="html-content">
                    <?= $page->block3_content ?>
                </div>
            </div>
        </div>
        <div class="block-bg-1"></div>
        <div class="block-bg-2"></div>
    </div>
</main>

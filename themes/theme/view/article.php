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
$cat = cat($page->cat);
$catUrl = catUrl($cat);
?>

<main>
    <?= $this->fetch('partials/page-header', ['nid' => 10, 'catUrl' => $catUrl]); ?>
    <div class="block block-service block-details">
        <div class="content-container">
            <a class="btn btn-back" href="<?= $catUrl ?>">
                <i class="bi bi-arrow-left"></i>
                <span>Back</span>
            </a>
            <div class="content-header text-center">
                <h2 class="text-start"><?= $page->title ?></h2>
            </div>
            <hr class="hr">
            <div class="content">
                <div class="html-content">
                    <?= $page->content ?>
                </div>
            </div>
        </div>
        <div class="block-bg-1 style-2"></div>
    </div>
</main>

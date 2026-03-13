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

$ourData = getList($page->our_data);
?>

<main>
    <?= $this->fetch('partials/page-header', ['nid' => 2, 'catUrl' => catUrl($page->cat)]); ?>
    <div class="block block-nova-insurance">
        <div class="content-container">
            <div class="content-header">
                <h2><?= $page->title ?></h2>
            </div>
            <img class="image" src="<?= $page->image ?>" alt="">
            <div class="content html-content">
                <?= $page->content ?>
            </div>
        </div>
        <div class="block-bg-1"></div>
    </div>
    <div class="block block-our-data">
        <div class="content-container d-xl-flex justify-content-xl-between">
            <div class="content-header">
                <h3 class="text-xl-start"><?= t('Our Data') ?></h3>
            </div>
            <div class="content flex-xl-grow-1">
                <div class="row g-3 g-xl-4 g-xxl-5">
                    <?php
                    foreach ($ourData as $item): ?>
                        <div class="col-12 col-md-6">
                            <div class="item item-ratio-1"
                                 style="background-image:url('<?= $item['image'] ?>')">
                                <div class="info-wrap d-flex align-items-end">
                                    <div class="info">
                                        <div class="number"><?= $item['info'] ?></div>
                                        <div class="description"><?= $item['description'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    $block = page(8); ?>

    <div class="block block-fse">
        <div class="content-container">
            <div class="content-1">
                <img class="image" src="<?= $block->image ?>" alt="">
                <h3 class="content-title text-start d-xl-block mt-xl-0"><?= $block->subtitle ?></h3>
                <div class="html-content">
                    <?= nl2p($block->summary) ?>
                    <a class="btn btn-secondary" href="<?= pageUrl($block) ?>">
                        <span><?= t('Read More'); ?></span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="block-bg-3"></div>
            </div>
        </div>
    </div>

    <div class="block block-banner">
        <div class="content-container">
            <div class="content-2">
                <img src="<?= themePath() ?>/images/about-4.jpg" alt="">
                <div class="content-inner">
                    <a class="btn btn-white" href="<?= url('/articles/beijing-nova-newsletter') ?>">
                        <span><?= t('Publications'); ?></span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="block-bg-2"></div>
    </div>
</main>

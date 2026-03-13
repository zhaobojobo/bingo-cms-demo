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
    <div class="block block-networks">
        <div class="content-header text-center">
            <h2><?= $page->title ?></h2>
        </div>
        <div class="content">
            <div class="brands-list">
                <?php
                $list = getList($page->networks);
                ?>
                <?php foreach ($list as $item): ?>
                    <div class="list-item">
                        <div class="content-container">
                            <div class="inner d-flex justify-content-between justify-content-lg-between align-items-center">
                                <div class="brand-link">
                                    <a target="_blank" class="btn btn-white" href="<?= $item['url'] ?>">
                                        <span><?= $item['company'] ?></span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                                <div class="brand-wrap">
                                    <img src="<?= $item['logo'] ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="block-bg-1"></div>
        <div class="block-bg-2"></div>
    </div>
</main>

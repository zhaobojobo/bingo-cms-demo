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
    <div class="block block-vmv">
        <div class="content-container">
            <div class="content-header text-center">
                <h2><?= $page->title ?></h2>
            </div>
            <div class="content">
                <div class="content-vision">
                    <div class="content-details">
                        <h3><?= t('Vision') ?></h3>
                        <?= $page->vision ?>
                    </div>
                    <div class="image-wrap">
                        <img class="image-fw" src="<?= $page->image1 ?>" alt="">
                    </div>
                </div>
                <div class="content-mission">
                    <div class="content-details">
                        <h3><?= t('Mission') ?></h3>
                        <?= $page->mission ?>
                    </div>
                    <div class="image-wrap">
                        <img class="image-fw" src="<?= $page->image2 ?>" alt="">
                    </div>
                </div>
                <div class="content-values">
                    <h3 class="text-center"><?= t('Values') ?></h3>
                    <ul class="values-list list-unstyled d-flex justify-content-between flex-wrap">
                        <?php
                        $list = getList($page->values);
                        ?>
                        <?php foreach ($list as $item): ?>
                            <li class="item">
                                <div class="icon-wrap">
                                    <img src="<?= $item['icon'] ?>" alt="">
                                </div>
                                <h4><?= $item['value'] ?></h4>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="block-bg-1 style-1"></div>
        <div class="block-bg-2"></div>
    </div>
</main>

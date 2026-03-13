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
$articles = articles(0, 89);
?>

<main>
    <?= $this->fetch('partials/page-header', ['nid' => 2]); ?>
    <div class="block page-achievements-content">
        <div class="content-container">
            <div class="content-header text-center">
                <h2><?= $page->name ?></h2>
            </div>
            <div class="content">
                <?php foreach ($articles as $i => $article):
                    $images = json_decode($article->images, true);
                    ?>
                    <div class="row g-3 g-md-4 g-lg-5 mb-3 mb-md-4 mb-lg-5 d-none">
                        <div class="col-12 col-md-5 col-lg-3">
                            <div class="image-wrap achievement-slideshow achievement-slideshow<?= $i + 1 ?>">
                                <!-- Slider main container -->
                                <div class="swiper">
                                    <!-- Additional required wrapper -->
                                    <div class="swiper-wrapper">
                                        <!-- Slides -->
                                        <?php foreach ($images as $image): ?>
                                            <div class="swiper-slide">
                                                <img class="image-fw" src="<?= $image ?>"
                                                     alt="">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <!-- If we need pagination -->
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8 col-lg-9">
                            <div class="text-wrap">
                                <h3><?= $article->title ?></h3>
                                <p><?= $article->summary ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="d-flex justify-content-center load-more">
                <a class="btn btn-primary" id="load-more" href="javascript:void(0)">
                    <span><?= t('Load More') ?></span>
                    <i class="bi bi-arrow-right"></i>
                </a>
                <span class="btn btn-primary d-none disabled no-more justify-content-center"><?= t('No more data yet') ?></span>
            </div>
        </div>
        <div class="block-bg-1 style-1"></div>
        <div class="block-bg-2"></div>
    </div>
</main>

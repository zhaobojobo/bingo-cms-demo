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

$articles = related('solution', [$page->cat], $page->id, 3);
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
    <div class="block block-related">
        <div class="content-container">
            <div class="content-header text-center">
                <h2 class="text-start"><?= t('Related') ?><?= $cat->name ?></h2>
            </div>
            <div class="content">
                <div class="slideshow-related">
                    <!-- Slider main container -->
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php foreach ($articles as $article): ?>
                                <div class="swiper-slide">
                                    <div class="data-item">
                                        <div class="image-wrap"
                                             style="background-image:url('<?= $article->image ?>')"></div>
                                        <div class="text-wrap">
                                            <h3 class="ellipsis"><?= $article->title ?></h3>
                                            <p><?= summary($article->summary, 120) ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </div>
</main>

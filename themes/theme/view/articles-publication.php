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
$root = cat(90);
$pinned = [
    'title' => $root->pinned_title,
    'cover' => $root->pinned_image,
    'attachment' => $root->pinned_attachment,
];
$articles = articles(0, $page->id);
?>
<main>
    <?= $this->fetch('partials/page-header', ['nid' => 2]); ?>
    <div class="block block-publications">
        <div class="content-container">
            <div class="content-header text-center">
                <h2><?= $root->name ?></h2>
            </div>
            <div class="content">
                <h3><?= $pinned['title'] ?></h3>
                <div class="brochure-banner">
                    <div class="banner-content">
                        <div class="image-wrap left-wrap">
                            <img src="<?= $pinned['cover'] ?>" alt="">
                        </div>
                        <a class="link" target="_blank" href="<?= $pinned['attachment'] ?>">
                            <i class="bi bi-box-arrow-in-right"></i>
                        </a>
                        <div class="image-wrap right-wrap">
                            <img src="<?= themePath() ?>/images/book_right.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <?php
                $cats = catChildren(90); ?>
                <div class="cat-nav">
                    <div class="content-container">
                        <ul class="nav justify-content-between">
                            <?php
                            foreach ($cats as $cat): ?>
                                <?php
                                if ($page->id == $cat->id): ?>
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page"
                                           href="<?= catUrl($cat) ?>#pms"><h3><?= $cat->name ?></h3></a>
                                    </li>
                                <?php
                                else: ?>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                           href="<?= catUrl($cat) ?>#pms"><h3><?= $cat->name ?></h3></a>
                                    </li>
                                <?php
                                endif ?>
                            <?php
                            endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div id="pms"></div>
                <div class="slideshow slideshow-newsletter">
                    <!-- Slider main container -->
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php
                            foreach ($articles as $article): ?>
                                <div class="swiper-slide">
                                    <div class="slide-content">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="edition d-flex flex-column">
                                                <span class="number"><?= $article->title ?></span>
                                                <span><?= t('Edition') ?></span>
                                            </div>
                                            <div class="cover">
                                                <div class="cover-img"
                                                     style="background-image:url('<?= $article->image ?>')"></div>
                                            </div>
                                        </div>
                                        <hr>
                                        <a class="link d-flex justify-content-between align-items-center"
                                           target="_blank" href="<?= $article->attachment ?>">
                                            <span><?= $article->date ?></span>
                                            <span class="icon"><i class="bi bi-arrow-right"></i></span>
                                        </a>
                                    </div>
                                </div>
                            <?php
                            endforeach; ?>
                        </div>
                    </div>
                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
        <div class="block-bg-1"></div>
        <div class="block-bg-2"></div>
    </div>
</main>

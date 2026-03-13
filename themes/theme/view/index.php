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

$slideshow = getList($page->slideshow);
$about = page(2);
$achievements = articles(0, 89);
$services = articles(0, 86);
$solutions = cat(85);
$vmv = page(7);
$testimonials = getList($page->testimonials);
$join = cat(95);
?>

<main>
    <div class="p-0 block slideshow slideshow-home1">
        <!-- Slider main container -->
        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php
                foreach ($slideshow as $slide): ?>
                    <div class="swiper-slide">
                        <div class="swiper-content d-lg-none" style="background-image:url('<?= $slide['image_m'] ?>')">
                            <div class="content d-flex flex-column justify-content-end">
                                <div class="container-fluid">
                                    <h2><?= $slide['title'] ?></h2>
                                    <p><?= $slide['description'] ?></p>
                                    <a class="btn btn-white" href="<?= $slide['link'] ?>">
                                        <span><?= t('Read More') ?></span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="mask"></div>
                        </div>
                        <div class="swiper-content d-none d-lg-block"
                             style="background-image:url('<?= $slide['image'] ?>')">
                            <div class="content d-flex flex-column justify-content-end">
                                <div class="container-fluid">
                                    <h2><?= $slide['title'] ?></h2>
                                    <p><?= $slide['description'] ?></p>
                                    <a class="btn btn-white" href="<?= $slide['link'] ?>">
                                        <span><?= t('Read More') ?></span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="mask"></div>
                        </div>
                    </div>
                <?php
                endforeach; ?>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="block block-about">
        <div class="content-wrap">
            <div class="container-fluid">
                <div class="content d-lg-flex justify-content-lg-between">
                    <div class="text-wrap h-100 d-xxl-flex flex-xxl-column justify-content-xxl-between">
                        <div class="title">
                            <h2><?= $about->title ?></h2>
                            <h3><?= $about->subtitle ?></h3>
                        </div>
                        <div class="description">
                            <?= nl2p($about->summary) ?>
                        </div>
                    </div>
                    <div class="image-wrap">
                        <img class="image-fw" src="<?= $about->image ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block block-achievements">
        <div class="container-fluid">
            <h2 class="block-title"><?= t('Our Achievements') ?></h2>
            <div class="slideshow-achievements">
                <!-- Slider main container -->
                <div class="swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <?php
                        foreach ($achievements as $achievement):
                            $images = json_decode($achievement->images, true);
                            foreach ($images as $image): ?>
                                <div class="swiper-slide">
                                    <img src="<?= $image ?>" alt="">
                                </div>
                            <?php
                            endforeach;
                        endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block block-scope-services p-0">
        <div class="block-header">
            <div class="container-fluid">
                <div class="d-md-flex justify-content-md-between">
                    <h2><?= t('Scope of Services') ?></h2>
                    <div class="slideshow-navs">
                        <div class="inner">
                            <a class="link" href="<?= url('/articles/services') ?>"><?= t('Learn More') ?></a>
                            <div class="swiper-buttons d-flex justify-content-between align-items-center">
                                <!-- If we need navigation buttons -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content block-content-1">
            <div class="container-fluid">
                <div class="slideshow-scope-services">
                    <!-- Slider main container -->
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php
                            foreach ($services as $service): ?>
                                <div class="swiper-slide">
                                    <img class="image-fw" src="<?= $service->image ?>" alt="">
                                    <div class="content d-flex flex-column justify-content-between align-items-start">
                                        <h4><?= $service->title ?></h4>
                                        <a class="btn btn-primary" href="<?= articleUrl($service) ?>">
                                            <span><?= t('Read More') ?></span>
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php
                            endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content block-content-2">
            <div class="container-fluid">
                <div class="block-our-solutions">
                    <h3 class="block-title"><?= $solutions->summary ?></h3>
                    <div class="row">
                        <?php
                        foreach (getList($solutions->details) as $info): ?>
                            <div class="col-12 col-lg-6">
                                <div class="block-our-solution">
                                    <div class="block-our-solution-block-header">
                                        <h4><?= $info['title'] ?></h4>
                                        <div class="info d-flex justify-content-between align-items-end">
                                            <span class="icon"><i class="bi bi-arrow-up"></i></span>
                                            <span class="number"><?= $info['number'] ?></span>
                                        </div>
                                    </div>
                                    <div class="block-our-solution-block-content d-flex flex-column justify-content-end">
                                        <p><?= $info['description'] ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block block-home-banner" style="background-image:url('<?= themePath() ?>/images/image-31.jpg')">
        <div class="content-wrap">
            <div class="content">
                <div class="container-fluid">
                    <h2><?= $vmv->subtitle ?></h2>
                    <h3><?= $vmv->vision ?></h3>
                    <div class="description">
                        <?= $vmv->summary ?>
                    </div>
                    <a class="btn" href="<?= url('/vmv') ?>">
                        <span><?= t('Learn More') ?></span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="block block-client-testimonials">
        <div class="content">
            <div class="container-fluid">
                <h2><?= t('Client testimonials') ?></h2>
                <div class="slideshow-client-testimonials">
                    <!-- Slider main container -->
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php
                            foreach ($testimonials as $testimonial): ?>
                                <div class="swiper-slide">
                                    <div class="slide-content">
                                        <p><?= $testimonial['testimonials'] ?></p>
                                        <div class="mt-4 mt-lg-5 client d-flex align-items-end">
                                            <img class="avatar" src="<?= $testimonial['avatar'] ?>" alt="">
                                            <div class="author ms-3">
                                                <h5 class="name"><?= $testimonial['name'] ?></h5>
                                                <small class="title"><?= $testimonial['title'] ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endforeach; ?>
                        </div>
                    </div>
                    <div
                            class="swiper-navs d-flex justify-content-around align-items-center flex-md-column align-items-md-start">
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>
                        <div class="swiper-buttons d-flex justify-content-between align-items-center mt-lg-3">
                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block block-join p-0" style="background-image: url('<?= themePath() ?>/images/bg.png')">
        <div class="content d-lg-flex flex-lg-row-reverse justify-content-lg-end">
            <div class="join-content d-lg-flex align-items-lg-center justify-content-lg-center flex-lg-grow-1">
                <div class="content-inner">
                    <div class="container-fluid">
                        <h2><?= $join->name ?></h2>
                        <p><?= $join->text ?></p>
                    </div>
                </div>
            </div>
            <div class="join-contact d-flex flex-column justify-content-between align-items-start">
                <div class="py-2">
                    <p><?= $join->summary ?></p>
                </div>
                <div class="align-self-end mt-2 mt-lg-4">
                    <a class="btn" href="<?= catUrl($join) ?>">
                        <span><?= t('Learn More') ?></span>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
/**
 * view data
 * @var $site
 * @var $lang
 * @var $page
 */ ?>

<?php
$copyright = copyright($lang);
?>

<footer class="footer block p-0">
    <div class="content d-lg-flex justify-content-lg-between">
        <div class="footer-block content-left py-3 py-lg-5">
            <div class="block-lg-left-inner">
                <h3><?= t('Latest News') ?></h3>
                <p><?= t('Get the latest news about Nova Insurance') ?></p>
                <a class="btn btn-white" href="<?= url('/articles/publication') ?>">
                    <span><?= t('Learn More') ?></span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="content-right flex-grow-1">
            <div class="footer-block footer-navs footer-navs-1 py-3 py-lg-5">
                <div class="row">
                    <?php $navs = navs('foot'); ?>
                    <?php foreach ($navs as $nav): ?>
                        <div class="col-6 col-md-3">
                            <a class="nav-group-link" href="<?= navUrl($nav) ?>"><?= $nav->text ?></a>
                            <?php if ($nav->children): ?>
                                <nav class="nav flex-column">
                                    <?php foreach ($nav->children as $child): ?>
                                        <a class="nav-link" href="<?= navUrl($child) ?>"><?= $child->text ?></a>
                                    <?php endforeach; ?>
                                </nav>
                            <?php endif ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="footer-block footer-navs footer-navs-2 py-3 py-lg-5">
                <div class="">
                    <div class="d-flex justify-content-between align-items-center">
                        <?php $navs = navs('foot2'); ?>
                        <nav class="nav nav-links flex-column flex-grow-1">
                            <?php foreach ($navs as $nav): ?>
                                <a class="nav-link" href="<?= navUrl($nav) ?>"><?= $nav->text ?></a>
                            <?php endforeach; ?>
                        </nav>
                        <?php $links = getList(page(3)->links) ?>
                        <nav class="nav social-links flex-grow-1 d-flex justify-content-around">
                            <?php foreach ($links as $item): ?>
                                <a class="nav-link" href="<?= $item['link'] ?>"><i
                                            class="bi bi-<?= $item['name'] ?>"></i></a>
                            <?php endforeach; ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="py-3 py-lg-4">
            <p class="m-0"><?= $copyright ?></p>
        </div>
    </div>
</footer>

<div class="widget">
    <button type="button" class="btn btn-contact" data-bs-toggle="modal"
            data-bs-target="#contact-form-modal"><?= t('Contact Us') ?>
    </button>
</div>

<div class="modal fade" id="contact-form-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="contact-us-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="contact-us-modal-title"><?= t('Contact Us') ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->fetch('partials/form'); ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="feedback-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="feedback-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-lg-down">
        <div class="modal-content">
            <div class="modal-body">
                <div class="feedback">
                    <p id="feedback-message">
                        Your information has been submitted, we will communicate with you as soon as possible, please
                        wait patiently, thank you.
                    </p>
                    <div class="feedback-footer">
                        <button type="button" class="btn btn-secondary btn-feedback-ok" data-bs-dismiss="modal"
                                aria-label="Close">OK
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

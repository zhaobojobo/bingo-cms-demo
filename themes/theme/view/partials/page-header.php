<?php

/**
 * view data
 *
 * @var $site
 * @var $seo
 * @var $page
 * @var $nid
 * @var $catUrl
 */
$parent = findNav($nid ?? 0);
$target = findNavTarget($nid ?? 0);
if ($target) {
    $banner = $target->banner;
    $bannerM = $target->banner_m;
} else {
    $banner = $page->banner;
    $bannerM = $page->banner_m;
}
$pageNavs = navs('main', $nid ?? 0);
$title = '';
if ($page->type == 'page') {
    $title = $page->title;
} elseif ($page->type == 'category') {
    $title = $page->name;
} else {
    $cat = cat($page->cat);
    $title = $cat->name;
}
?>

<div class="block page-header-1 p-0">
    <div class="page-banner d-lg-none" style="background-image:url('<?= $bannerM ?>')">
        <div class="mask"></div>
        <div class="content-container d-flex flex-column justify-content-center">
            <div class="content">
                <h1><?= $title ?></h1>
                <div class="current-location">
                    <a href="<?= url('/') ?>"><?= t('Home') ?></a>
                    |
                    <?php
                    if ($parent): ?>
                        <a href="<?= navUrl($parent) ?>"><?= $parent->text ?></a>
                        |
                    <?php
                    endif ?>
                    <span><?= $title ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="page-banner d-none d-lg-block" style="background-image:url('<?= $banner ?>')">
        <div class="mask"></div>
        <div class="content-container d-flex flex-column justify-content-center">
            <div class="content">
                <h1><?= $title ?></h1>
                <div class="current-location">
                    <a href="<?= url('/') ?>"><?= t('Home') ?></a>
                    |
                    <?php
                    if ($parent): ?>
                        <a href="<?= navUrl($parent) ?>"><?= $parent->text ?></a>
                        |
                    <?php
                    endif ?>
                    <span><?= $title ?></span>
                </div>
            </div>
        </div>
    </div>
    <?php
    if ($pageNavs): ?>
        <div class="page-nav">
            <div class="content-container">
                <ul class="nav justify-content-between">
                    <?php
                    foreach ($pageNavs as $nav): ?>
                        <li class="nav-item">
                            <?php
                            if (isCurrent($nav) || navUrl($nav) == $catUrl): ?>
                                <a class="nav-link active" aria-current="page"
                                   href="<?= navUrl($nav) ?>"><?= $nav->text ?></a>
                            <?php
                            else: ?>
                                <a class="nav-link" href="<?= navUrl($nav) ?>"><?= $nav->text ?></a>
                            <?php
                            endif ?>
                        </li>
                    <?php
                    endforeach; ?>
                </ul>
            </div>
        </div>
    <?php
    endif ?>
</div>
<div id="ms"></div>
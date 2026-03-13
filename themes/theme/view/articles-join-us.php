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
$cats = catChildren($page->id);
?>

<main>
    <?= $this->fetch('partials/page-header'); ?>
    <div class="block block-offices">
        <div class="content-container">
            <div class="content-header text-center">
                <h2><?= $page->name ?></h2>
            </div>
            <div class="content">
                <div class="html-content">
                    <?= $page->content ?>
                </div>
            </div>
            <?php foreach ($cats as $cat):
                $articles = articles(0, $cat->id);
                foreach ($articles as $i => $article) {
                    if (!$article->title) {
                        unset($articles[$i]);
                    }
                }
                if ($articles):
                    ?>
                    <h3 class="mb-2 mb-md-3 mb-lg-4 mb-xl-5"><?= $cat->name ?></h3>
                    <div class="offices-list">
                        <?php foreach ($articles as $item): ?>
                            <?php if ($item['title']): ?>
                                <div class="office-item slide">
                                    <div class="slide-toggle item-header d-flex justify-content-between align-items-center">
                                        <h4><?= $item['title'] ?></h4>
                                        <div class="toggle">
                                            <i class="bi bi-chevron-compact-down"></i>
                                        </div>
                                    </div>
                                    <div class="slide-content-wrap">
                                        <div class="slide-content">
                                            <div class="html-content">
                                                <?= $item['content'] ?>
                                            </div>
                                            <a class="btn btn-primary link" href=" <?= $item['link'] ?>">
                                                <span><?= t('Learn More') ?></span>
                                                <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif;
            endforeach; ?>
        </div>
        <div class="block-bg-1"></div>
        <div class="block-bg-2"></div>
    </div>
</main>
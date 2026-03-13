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
$articles = articles(0, $page->id);
?>

<main>
    <?= $this->fetch('partials/page-header', ['nid' => 10]); ?>
    <div class="block">
        <div class="content-container">
            <div class="content-header text-center">
                <h2><?= $page->name ?></h2>
            </div>
            <div class="content data-grid">
                <div class="row gy-4 gx-lg-4 g-xxl-5">
                    <?php foreach ($articles as $article): ?>
                        <div class="col-md-6 col-xl-4">
                            <a class="data-item" href="<?= articleUrl($article) ?>">
                                <div class="image-wrap"
                                     style="background-image:url('<?= $article->image ?>')"></div>
                                <div class="text-wrap">
                                    <h3 class="ellipsis"><?= $article->title ?></h3>
                                    <p><?= summary($article->summary, 66) ?></p>
                                    <span class="btn btn-secondary"><i class="bi bi-arrow-right"></i></span>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="block-bg-1"></div>
        <div class="block-bg-2"></div>
    </div>
</main>

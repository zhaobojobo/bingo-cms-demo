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
$posts = articles(0, 102);
?>

<main>
    <?= $this->fetch('partials/page-header', ['catUrl' => catUrl($page)]); ?>
    <div class="block">
        <div class="content-container">
            <div class="content-header text-center">
                <h2><?= $page->name ?></h2>
            </div>
            <div class="content data-grid">
                <div class="row gy-4 gx-lg-4 g-xxl-5">
                    <?php
                    foreach ($posts as $post): ?>
                        <div class="col-md-6 col-xl-4">
                            <a class="data-item" href="<?= articleUrl($post) ?>">
                                <div class="image-wrap"
                                     style="background-image:url('<?= $post->image ?>')"></div>
                                <div class="text-wrap">
                                    <h3>Title</h3>
                                    <p>Summary</p>
                                    <span class="btn btn-secondary"><i class="bi bi-arrow-right"></i></span>
                                </div>
                            </a>
                        </div>
                    <?php
                    endforeach ?>
                </div>
            </div>
        </div>
        <div class="block-bg-1"></div>
        <div class="block-bg-2"></div>
    </div>
</main>

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
$articles = articles(0, 91, 'type=:type', ['type' => 'management']);
?>

<main>
    <?= $this->fetch('partials/page-header', ['nid' => 2]); ?>
    <div class="block block-senior">
        <div class="content-container">
            <div class="content-header">
                <h2><?= $page->name ?></h2>
            </div>
            <div class="content">
                <ul class="list-unstyled data-items">
                    <?php foreach ($articles as $article): ?>
                        <li class="data-item">
                            <div class="data-header">
                                <div class="image-wrap">
                                    <img src="<?= $article->image ?>" alt="">
                                </div>
                                <h3 class="title">
                                    <span class="name"><?= $article->title ?></span>
                                    <small><?= $article->titles ?></small>
                                </h3>
                            </div>
                            <?php
                            $list = getList($article['companies'], $article->id);
                            ?>
                            <div class="data-content">
                                <ul class="list-unstyled info-list">
                                    <?php foreach ($list as $item): ?>
                                        <li>
                                            <i class="bi bi-buildings"></i>
                                            <span><?= $item['name'] ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="data-details">
                                    <h4><?= $article->position ?></h4>
                                    <div class="html-content">
                                        <?= $article->content ?>
                                    </div>
                                </div>
                            </div>
                            <div class="item-bg"></div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="block-bg-1 style-1"></div>
        <div class="block-bg-2"></div>
    </div>
</main>

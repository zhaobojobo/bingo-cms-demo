<?php
/**@var $page */
?>

<div class="block block-contact">
    <div class="content-container">
        <div class="content-header text-center">
            <h2><?= $page->title ?></h2>
        </div>
        <?php $list = getList($page->companies) ?>
        <?php foreach ($list as $item): ?>
            <div class="content">
                <div class="content-inner">
                    <?php if ($item['city']): ?>
                        <h2 class="mb-4"><?= $item['city'] ?></h2>
                    <?php endif; ?>
                    <h3><?= $item['name'] ?></h3>
                    <div class="description">
                        <?= nl2p($item['description']) ?>
                    </div>
                    <ul class="list-unstyled info-list">
                        <li>
                            <i class="bi bi-geo-alt"></i>
                            <span><?= $item['address'] ?></span>
                        </li>
                        <li>
                            <i class="bi bi-telephone"></i>
                            <span>
                                    <a href="tel:<?= $item['tel'] ?>"><?= $item['tel'] ?></a>
                                </span>
                        </li>
                        <li>
                            <i class="bi bi-printer"></i>
                            <span><?= $item['fax'] ?></span>
                        </li>
                        <li>
                            <i class="bi bi-envelope"></i>
                            <span>
                                    <a href="mailto:<?= $item['email'] ?>"><?= $item['email'] ?></a>
                                </span>
                        </li>
                    </ul>
                </div>
                <div class="decorate"></div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="block-bg-1"></div>
</div>
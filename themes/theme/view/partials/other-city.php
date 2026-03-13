<?php
/**@var $page */

$contact = page(3);
$others = pageChildren(3);
?>

<div class="block block-other-city">
    <div class="bg-text">Learn More About Nova</div>
    <div class="content-container">
        <div class="content-other-city d-lg-flex justify-content-lg-between align-items-lg-center">
            <div class="other-header">
                <h3><?= t('Other City') ?></h3>
                <div class="description">
                    <?= nl2p($contact->other_city) ?>
                </div>
            </div>
            <div class="other-content">
                <div class="row gy-3 g-xl-5">
                    <?php foreach ($others as $other): ?>
                        <?php if ($other->id != $page->id): ?>
                            <div class="col-md-6">
                                <a class="city" href="<?= pageUrl($other) ?>"
                                   style="background-image: url('<?= $other->image ?>')">
                                    <div class="city-content">
                                        <div class="content-inner">
                                            <span><?= $other->title ?></span>
                                            <i class="bi bi-arrow-right"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endif ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
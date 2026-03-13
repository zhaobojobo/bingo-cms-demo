<?php
$contact = page(3);
?>

<div class="block block-enquiries">
    <div class="content-container">
        <div class="content-enquiries d-lg-flex justify-content-lg-between">
            <div class="contact-emails">
                <h3><?= t('Enquiries and Complaints') ?></h3>
                <div class="description">
                    <?= nl2p($contact->enquiries) ?>
                </div>
                <?php $list = getList($contact->emails) ?>
                <ul class="list-unstyled emails-list">
                    <?php foreach ($list as $item): ?>
                        <li>
                            <?= t($item['title']) ?> :
                            <a href="mailto:<?= $item['address'] ?>"><?= $item['address'] ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php $list = getList($contact->links) ?>
                <nav class="nav social-links">
                    <?php foreach ($list as $item): ?>
                        <a href="<?= $item['link'] ?>"><i class="bi bi-<?= $item['name'] ?>"></i></a>
                    <?php endforeach; ?>
                </nav>
            </div>
            <div class="form-wrap">
                <?= $this->fetch('partials/form'); ?>
            </div>
        </div>
    </div>
    <div class="block-bg-2"></div>
</div>
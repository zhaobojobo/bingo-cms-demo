<?php

use Admin\Helper;

/**@var $data */
?>
<div class="form-info d-flex justify-content-between align-items-center">
    <span>
        <?= Helper::_('Form:') ?>
        <?= $data['row']->form ?>
    </span>
    <span>
        <?= Helper::_('Submitted Time:') ?>
        <?= $data['row']->submit_time ?>
    </span>
    <span>
        <?= Helper::_('Submitted by IP:') ?>
        <?= $data['row']->submit_ip ?>
    </span>
</div>

<hr>
<h6><?= Helper::_('Content:') ?></h6>
<hr>

<dl>
    <?php foreach ($data['row']->data as $i => $item) : ?>
        <?php if ($item['value']) : ?>
            <?php
            $label = $item['label'] ?: $item['placeholder'];
            ?>
            <dt class="bg-dark p-1" style="font-weight: 500; color: #fff;"><?= $label; ?>:</dt>
            <dd class="ml-4 p-2"><?= $item['value']; ?></dd>
        <?php endif; ?>
    <?php endforeach; ?>
</dl>
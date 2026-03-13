<?php

use Admin\Helper;

/** @var array $data */
?>

<div class="container-fluid">
    <nav class="row">
        <div class="col-lg-4 order-lg-1 p-0 mb-4 mb-lg-0 d-flex justify-content-lg-end">
            <div class="form-inline">
                <button type="button" class="submit btn btn-sm btn-primary"><?= Helper::_('Save') ?></button>
            </div>
        </div>
        <div class="col-lg-8 order-lg-0 nav nav-tabs lang-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
               aria-controls="general" aria-selected="true">
                <?= Helper::_('General') ?>
            </a>
            <?php
            foreach (LANGUAGES as $langId => $label) :
                ?>
                <a class="nav-item nav-link" id="<?= $langId ?>-tab" data-toggle="tab" href="#<?= $langId ?>" role="tab"
                   aria-controls="<?= $langId ?>" aria-selected="false">
                    <?= $label ?>
                </a>
            <?php
            endforeach; ?>
        </div>
    </nav>
</div>

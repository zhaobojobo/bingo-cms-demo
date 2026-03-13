<?php

use Admin\Helper;

/**@var $data */
?>

<?php
$image = $data['image'] ?>
<div class="input-image input-field <?php
if (Helper::fileExists($image)) : ?> exist<?php
endif ?>">
    <div class="mb-2 d-flex align-items-center">
        <label class="mb-0"><?= $data['label'] ?></label>
        <div class="buttons text-center">
            <button type="button" class="my-1 btn btn-sm btn-primary btn-edit-image">
                <?= Helper::_('Edit') ?>
            </button>
            <button type="button" class="btn btn-sm btn-primary btn-delete-image" data-type="image">
                <?= Helper::_('Remove') ?>
            </button>
            <button type="button" class="my-1 btn btn-sm btn-primary btn-select-files" id="btn-select-image"
                    data-toggle="modal"
                    data-target="#files-select-modal"
                    data-type="image"
                    data-more="0"
                    data-lang="<?= DEFAULT_LANG ?>"
                    data-upload="<?= Helper::getUrl("/upload/image") ?>">
                <span class="ch"><?= Helper::_('Change') ?></span>
                <span class="up"><?= Helper::_('Select') ?></span>
            </button>
        </div>
    </div>
    <div class="preview d-flex flex-wrap">
        <?php
        if (Helper::fileExists($image)) : ?>
            <div class="image-thumb">
                <a href="<?= $image ?>" data-fancybox
                   title="<?= Helper::_('Click to view bigger image') ?>">
                    <img src="<?= Helper::thumb($image) ?>" data-src="<?= $image ?>" alt="thumb preview">
                </a>
            </div>
        <?php
        else : ?>
            <div class="image-thumb no-content">
                No image
            </div>
        <?php
        endif ?>
    </div>
    <input type="hidden" class="value" name="<?= $data['name'] ?>" value="<?= $image ?>">
</div>

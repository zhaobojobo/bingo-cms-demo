<?php

use Admin\Helper;

/**@var $data */

function accessesTree($access, $level = 1)
{
    ?>
    <div class="form-check form-check-inline">
        <?php
        if ($access->permission) : ?>
            <input class="form-check-input" type="checkbox" data-group="<?= $access->getAccessGroup() ?>"
                   <?php
                   if ($access->permission->getStatus()): ?>checked<?php
            endif ?>
                   name="permissions[<?= $access->getId() ?>]"
                   id="access-<?= $access->getId() ?>" value="1">
        <?php
        else: ?>
            <input class="form-check-input" type="checkbox" data-group="<?= $access->getAccessGroup() ?>"
                   name="permissions[<?= $access->getId() ?>]"
                   id="access-<?= $access->getId() ?>" value="1">
        <?php
        endif ?>
        <label class="form-check-label" for="access-<?= $access->getId() ?>">
            <?= Helper::_($access->getName()) ?>
        </label>
    </div>
    <?php
    if (isset($access->children)) : ?>
        <div class="my-3 ml-3 accesses level-<?= $level ?>">
            <?php
            foreach ($access->children as $child) : ?>
                <?php
                accessesTree($child, ($level + 1)) ?>
            <?php
            endforeach ?>
        </div>
    <?php
    endif ?>
    <?php
} ?>

<div class="row pb-4 pb-lg-0 permissions-tree">
    <?php
    foreach ($data['accesses'] as $access) : ?>
        <div class="col-md-6 col-lg-4">
            <div class="input-block p-2 accesses level-0">
                <?php
                accessesTree($access) ?>
            </div>
        </div>
    <?php
    endforeach ?>
</div>
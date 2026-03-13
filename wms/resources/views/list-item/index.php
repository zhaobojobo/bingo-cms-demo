<?php

/**@var $data */

use Admin\Helper;

$GFields = $data['fields']['G'];
$LFields = $data['fields']['L'];
?>
<style>
    /*.list-items-rows ul.ui-sortable {*/
    /*    position: relative;*/
    /*}*/

    /*.dragged {*/
    /*    position: absolute;*/
    /*    opacity: 0.5;*/
    /*    z-index: 2000;*/
    /*}*/

    /*ol.list-items-rows li.placeholder {*/
    /*    position: relative;*/
    /*    !** More li styles **!*/
    /*}*/

    /*ol.list-items-rows li.placeholder:before {*/
    /*    position: absolute;*/
    /*    !** Define arrowhead **!*/
    /*    content: "";*/
    /*    z-index: 5;*/
    /*    left: 0;*/
    /*    top: -8px;*/
    /*    border-top: 8px solid red;*/
    /*    border-right: 8px solid transparent;*/
    /*    border-bottom: 8px solid transparent;*/
    /*    border-left: 8px solid transparent;*/
    /*    transform: rotate(-90deg);*/
    /*}*/
</style>

<div class="sort-list sort-rows" data-api="<?= Helper::getUrl('/list-items/sort') ?>">
    <div class="row no-gutters th">
        <div class="col">ID</div>
        <?php
        foreach ($GFields as $field): ?>
            <?php
            if ($field->listed): ?>
                <div class="col"><?= $field->__data[DEFAULT_LANG]->label ?></div>
            <?php
            endif ?>
        <?php
        endforeach; ?>
        <?php
        foreach ($LFields as $field): ?>
            <?php
            if ($field->listed): ?>
                <div class="col"><?= $field->__data[DEFAULT_LANG]->label ?></div>
            <?php
            endif ?>
        <?php
        endforeach; ?>
        <div class="col"><?= Helper::_('Operates') ?></div>
    </div>
    <ul class="list-unstyled sortable ui-sortable">
        <?php
        foreach ($data['items'] as $item): ?>
            <li data-id="<?= $item['id'] ?>" class="ui-sortable-handle">
                <div class="row no-gutters">
                    <div class="col"><?= $item->id ?></div>
                    <?php
                    foreach ($GFields as $gField): $GData = $item['__profile']['all'] ?>
                        <?php
                        if ($gField->listed): ?>
                            <?php
                            if ($gField->type == 'image'): ?>
                                <div class="col">
                                    <?php
                                    if (isset($GData[$gField->name])): ?>
                                        <a href="<?= $GData[$gField->name] ?>" data-fancybox>
                                            <img src="<?= $GData[$gField->name] ?>" alt=""
                                                 style="height: 50px;">
                                        </a>
                                    <?php
                                    endif ?>
                                </div>
                            <?php
                            else: ?>
                                <div class="col"><?= $GData[$gField->name] ?? '' ?></div>
                            <?php
                            endif ?>
                        <?php
                        endif ?>
                    <?php
                    endforeach; ?>
                    <?php
                    foreach ($LFields as $lField): $LData = $item['__profile'][DEFAULT_LANG] ?>
                        <?php
                        if ($lField->listed): ?>
                            <div class="col"><?= $LData[$lField->name] ?? '' ?></div>
                        <?php
                        endif; ?>
                    <?php
                    endforeach; ?>
                    <div class="col">
                        <a class="btn btn-sm btn-primary mx-2"
                           href="javascript:void(0)"
                           data-toggle="modal"
                           data-target="#list-item-edit-modal"
                           data-api="<?= Helper::getUrl(
                               '/list-items/edit/' . $data['fid'] . '/' . $item['id']
                           ); ?>"><?= Helper::_(
                                'Edit'
                            ) ?></a>
                        <a class="list-item-delete btn btn-sm btn-primary mx-2"
                           href="<?= Helper::getUrl('/list-items/delete/' . $item['id']); ?>"><?= Helper::_(
                                'Delete'
                            ) ?></a>
                    </div>
                </div>
            </li>
        <?php
        endforeach; ?>
    </ul>
</div>

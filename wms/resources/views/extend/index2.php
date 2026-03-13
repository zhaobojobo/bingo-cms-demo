<?php
/**@var $data */

use Admin\Helper;

?>

<div class="row">
    <?php
    foreach ($data['tabs'] as $tab): ?>
        <div class="col-lg-12">
            <header class="d-flex justify-content-between align-items-center">
                <h4>
                    <?= $tab->__data[DEFAULT_LANG]->name ?>
                    <?php
                    if ($tab->tab == 'G'): ?>
                        <?= Helper::_('通用欄位') ?>
                    <?php
                    elseif ($tab->tab == 'L'): ?>
                        <?= Helper::_('多語言欄位') ?>
                    <?php
                    endif ?>
                </h4>
                <span>
                    <button class="btn btn-sm btn-primary" type="button"
                            data-api="<?= Helper::getUrl('/field/modify2/' . $tab['id'] . '/') ?>"
                            data-toggle="modal" data-target="#extend-list-field">
                        +<?= Helper::_('Add') ?>
                    </button>
                </span>
            </header>
            <div class="sort-list sort-rows" data-api="<?= Helper::getUrl('/field/sort') ?>">
                <div class="row no-gutters th">
                    <div class="col-2 text-center"><?= Helper::_('ID') ?></div>
                    <div class="col-2"><?= Helper::_('Key') ?></div>
                    <div class="col-4"><?= Helper::_('Lable') ?></div>
                    <div class="col-2"><?= Helper::_('Type') ?></div>
                    <div class="col-2"><?= Helper::_('Operates') ?></div>
                </div>
                <ul class="list-unstyled sortable">
                    <?php
                    foreach ($tab['fields'] as $row): ?>
                        <li data-id="<?= $row['id'] ?>" class="ui-sortable-handle">
                            <div class="row no-gutters">
                                <div class="col-2 text-center"><?= $row['id'] ?></div>
                                <div class="col-2"><?= $row['name'] ?></div>
                                <div class="col-4"><?= $row['__data'][DEFAULT_LANG]['label'] ?></div>
                                <div class="col-2"><?= Helper::_(
                                        $data['PARAMS']['input_types'][$row['type']]
                                    ) ?></div>
                                <div class="col-2">
                                    <a class="button-gray bingo_button icon_button"
                                       title="<?= Helper::_('Edit') ?>"
                                       data-api="<?= Helper::getUrl(
                                           '/field/modify2/' . $row['model_id'] . '/' . $row['id']
                                       ) ?>"
                                       data-toggle="modal" data-target="#extend-list-field"
                                       href="javascript:void(0);">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    <a class="button-gray bingo_button icon_button list-field-delete"
                                       title="<?= Helper::_('Delete') ?>"
                                       href="<?= Helper::getUrl('/field/delete') ?>"
                                       data-id="<?= $row['id'] ?>">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
                    <?php
                    endforeach; ?>
                </ul>
            </div>
        </div>
    <?php
    endforeach; ?>
</div>

<?php

use Admin\Helper;

/**@var $data */
$this->insert('header', ['data' => $data]);
?>

<main class="pb-3">
    <div class="page_title">
        <div class="list_title d-flex justify-content-between align-items-center">
            <h3><?= Helper::_('Extend Setting') ?></h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <?= Helper::_('Extend Setting') ?>
            </div>
        </div>
    </div>

    <section class="extend-tabs my-4">
        <div class="container-fluid">
            <div class="row">
                <?php
                foreach ($data['tabs'] as $tab): ?>
                    <div class="col-lg-6">
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
                                        data-api="<?= Helper::getUrl('/field/modify/' . $tab['id'] . '/') ?>"
                                        data-toggle="modal" data-target="#extend-field">
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
                            <ul class="list-unstyled menu-list sortable">
                                <?php
                                foreach ($tab['fields'] as $row): ?>
                                    <li data-id="<?= $row['id'] ?>">
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
                                                       '/field/modify/' . $row['model_id'] . '/' . $row['id']
                                                   ) ?>"
                                                   data-toggle="modal" data-target="#extend-field"
                                                   href="javascript:void(0);">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                <a class="button-gray bingo_button icon_button delete"
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
        </div>
    </section>
</main>

<?php
$this->insert('footer', ['data' => $data]); ?>

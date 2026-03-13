<?php

use Admin\Helper;
use Admin\Helper\CatalogListHelper;

/** @var $data */
$this->insert('header', ['data' => $data]);

?>

<main class="pb-3">
    <div class="page_title">
        <div class="list_title d-flex justify-content-between align-items-center">
            <h3><?= Helper::_('Catalog Management') ?></h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <?= Helper::_('Catalog Management') ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="list_title m-0">
                    <div class="button_list d-flex justify-content-end align-items-center">
                        <a class="button-blue bingo_button middle_button" title="<?= Helper::_('Add') ?>"
                           href="<?= Helper::getUrl(
                               '/catalog/edit/' . $data['cType'] . '/' . $data['type'] . '/'
                           ) ?>">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </a>
                        <?php
                        if (Helper::hasPermission($data['cType'] . '-' . $data['type'] . '-fields')): ?>
                            <a class="button-red bingo_button middle_button" title="<?= Helper::_('Setting') ?>"
                               href="<?= Helper::getUrl('/extend/catalog/' . $data['cType'] . '/' . $data['type']) ?>">
                                <i class="fa fa-fw fa-gears"></i>
                            </a>
                        <?php
                        endif ?>
                    </div>
                </div>
                <div class="sort-list sort-rows list-tree" id="sort-list"
                     data-api="<?= Helper::getUrl('/catalog/sort') ?>">
                    <?php
                    CatalogListHelper::table($data['catalogs'], DEFAULT_LANG); ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
$this->insert('footer', ['data' => $data]); ?>

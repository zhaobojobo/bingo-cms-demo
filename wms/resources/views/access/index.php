<?php

use Admin\Helper;
use Admin\Helper\AccessesListHelper;

/** @var $data */
$this->insert('header', ['data' => $data]);

?>

<main class="pb-3">
    <div class="page_title">
        <div class="list_title d-flex justify-content-between align-items-center">
            <h3>
                <?= Helper::_('Accesses Management') ?>
            </h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <?= Helper::_('Accesses Management') ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="list_title m-0">
                    <div class="button_list d-flex justify-content-between align-items-center">
                        <form method="get" action="" class="search_form">
                            <div class="input-group">
                                <label for="search" class="d-none"></label>
                                <input type="text" name="key" id="search" value=""
                                       placeholder="<?= Helper::_('Search...') ?>">
                                <button type="submit" class="ml-2 button-pink bingo_button middle_button"><i
                                            class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </form>

                        <div>
                            <a class="button-blue bingo_button middle_button" title="<?= Helper::_('Add') ?>"
                               href="<?= Helper::getUrl('/accesses/add') ?>"><i
                                        class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                            <a class="button-orange bingo_button middle_button btn-batch-copy"
                               title="<?= Helper::_('Copy') ?>"
                               href="<?= Helper::getUrl('/accesses/batch/copy') ?>">
                                <i class="fa fa-clone" aria-hidden="true"></i></a>
                            <a class="button-red bingo_button middle_button btn-batch-del"
                               title="<?= Helper::_('Delete') ?>"
                               href="<?= Helper::getUrl('/accesses/batch/delete') ?>">
                                <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sort-list sort-rows" data-api="<?=Helper::getUrl('/accesses/sorts')?>">
                    <?php
                    AccessesListHelper::table($data['objects']); ?>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $("#data-table tbody").sortable();
</script>

<?php
$this->insert('footer', ['data' => $data]); ?>


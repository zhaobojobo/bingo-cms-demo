<?php

use Admin\Helper;

/** @var $data */
$this->insert('header', ['data' => $data]);

?>

    <main class="pb-3">
        <div class="page_title">
            <div class="list_title d-flex justify-content-between align-items-center">
                <h3>
                    <?= Helper::_('Form Field Management') ?>
                </h3>
                <div class="page_breadcrumb">
                    <?= Helper::_('Current Position:') ?>
                    <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                    /
                    <a href="<?= Helper::getUrl('/forms/') ?>"><?= Helper::_('Form Management') ?></a>
                    /
                    <?= Helper::_('Form Field Management') ?>
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
                                    <input type="text" name="search" id="search"
                                           placeholder="<?= Helper::_('Search...') ?>">
                                    <button type="submit" class="ml-2 button-pink bingo_button middle_button"><i
                                                class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </form>

                            <div>
                                <a class="button-blue bingo_button middle_button" title="<?= Helper::_('Add') ?>"
                                   href="<?= Helper::getUrl('/form-field/edit/' . $data['fid'] . '/') ?>"><i
                                            class="fa fa-plus" aria-hidden="true"></i>
                                </a>
                                <a class="button-red bingo_button middle_button btn-batch-del"
                                   title="<?= Helper::_('Delete') ?>"
                                   href="<?= Helper::getUrl('/form-field/batch/delete') ?>">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="sort-list sort-rows" data-api="<?= Helper::getUrl('/form-fields/sort') ?>">
                        <div class="row no-gutters th">
                            <div class="col-1 justify-content-center"><?= Helper::_('ID') ?></div>
                            <div class="col-2"><?= Helper::_('Name') ?></div>
                            <div class="col-2"><?= Helper::_('Input Control') ?></div>
                            <div class="col-3"><?= Helper::_('Label') ?></div>
                            <div class="col-1 justify-content-center"><?= Helper::_('Required') ?></div>
                            <div class="col-1 justify-content-center"><?= Helper::_('Disabled') ?></div>
                            <div class="col-2"><?= Helper::_('Operates') ?></div>
                        </div>
                        <?= $data['list'] ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php $this->insert('footer', ['data' => $data]); ?>
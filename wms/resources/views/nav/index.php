<?php

use Admin\Helper;
use Admin\Helper\NavListHelper;

/** @var $data */
$this->insert('header', ['data' => $data]);

?>

    <main class="pb-3">
        <div class="page_title">
            <div class="list_title d-flex justify-content-between align-items-center">
                <h3><?= Helper::_('Nav Management') ?></h3>
                <div class="page_breadcrumb">
                    <?= Helper::_('Current Position:') ?>
                    <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                    /
                    <a href="<?= Helper::getUrl('/menus/') ?>"><?= Helper::_('Menu Management') ?></a>
                    /
                    <?= Helper::_('Nav Management') ?>
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
                            <a class="button-blue bingo_button middle_button" title="<?= Helper::_('Add') ?>"
                               href="<?= Helper::getUrl('/nav/edit/' . $data['menu_id'] . '/') ?>">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <div class="sort-list sort-rows list-tree" data-api="<?= Helper::getUrl('/nav/sort') ?>">
                        <?php
                        NavListHelper::table($data['menu_id'], $data['navs'], DEFAULT_LANG) ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php
$this->insert('footer', ['data' => $data]); ?>

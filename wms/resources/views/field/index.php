<?php

use Admin\Helper;

/** @var $data */
$this->insert('header', ['data' => $data]);

?>

    <main class="pb-3">
        <div class="page_title">
            <div class="list_title d-flex justify-content-between align-items-center">
                <h3><?= Helper::_('Field Management') ?></h3>
                <div class="page_breadcrumb">
                    <?= Helper::_('Current Position:') ?>
                    <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                    /
                    <a href="<?= Helper::getUrl('/models/') ?>"><?= Helper::_('Model Management') ?></a>
                    /
                    <?= Helper::_('Field Management') ?>
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
                               href="<?= Helper::getUrl('/field/edit/' . $data['model_id'] . '/') ?>">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <div class="sort-list sort-rows" data-api="<?= Helper::getUrl('/field/sort') ?>">
                        <div class="row no-gutters th">
                            <div class="col-1 text-center"><?= Helper::_('ID') ?></div>
                            <div class="col-3"><?= Helper::_('Name') ?></div>
                            <div class="col-3"><?= Helper::_('Label') ?></div>
                            <div class="col-3"><?= Helper::_('Type') ?></div>
                            <div class="col-2"><?= Helper::_('Operates') ?></div>
                        </div>
                        <ul class="list-unstyled menu-list sortable">
                            <?php foreach ($data['rows'] as $row): ?>
                                <li data-id="<?= $row['id'] ?>">
                                    <div class="row no-gutters">
                                        <div class="col-1 text-center"><?= $row['id'] ?></div>
                                        <div class="col-3"><?= $row['name'] ?></div>
                                        <div class="col-3"><?= Helper::_($row->label) ?></div>
                                        <div class="col-3"><?= Helper::_(
                                                $data['PARAMS']['input_types'][$row['type']]
                                            ) ?></div>
                                        <div class="col-2">
                                            <a class="button-gray bingo_button icon_button"
                                               title="<?= Helper::_('Edit') ?>"
                                               href="<?= Helper::getUrl(
                                                   '/field/edit/' . $row['model_id'] . '/' . $row['id']
                                               ) ?>">
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
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php $this->insert('footer', ['data' => $data]); ?>
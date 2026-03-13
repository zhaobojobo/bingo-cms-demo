<?php

use Admin\Helper;

/** @var $data */
$this->insert('header', ['data' => $data]);

?>

    <main class="pb-3">
        <div class="page_title">
            <div class="list_title d-flex justify-content-between align-items-center">
                <h3>
                    <?= Helper::_('Roles Management') ?>
                </h3>
                <div class="page_breadcrumb">
                    <?= Helper::_('Current Position:') ?>
                    <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                    /
                    <?= Helper::_('Roles Management') ?>
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
                                   href="<?= Helper::getUrl('/roles/add') ?>"><i
                                            class="fa fa-plus" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-white table-bordered bingo_table" id="data-table">
                        <thead>
                        <tr>
                            <th></th>
                            <th><?= Helper::_('Name') ?></th>
                            <th><?= Helper::_('Operates') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($data['objects'] as $object): ?>
                            <tr>
                                <td></td>
                                <td><?= $object->indent . ' ' . $object->getName() ?></td>
                                <td>
                                    <a class="button-gray bingo_button icon_button"
                                       title="<?= Helper::_('Grant') ?>"
                                       href="<?= Helper::getUrl('/permissions/edit/' . $object->getId()) ?>">
                                        <i class="fa fa-fw fa-cog" aria-hidden="true"></i>
                                    </a>
                                    <a class="button-gray bingo_button icon_button"
                                       title="<?= Helper::_('Edit') ?>"
                                       href="<?= Helper::getUrl('/roles/edit/' . $object->getId()) ?>">
                                        <i class="fa fa-fw fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    <a class="button-gray bingo_button icon_button delete"
                                       title="<?= Helper::_('Delete') ?>"
                                       href="<?= Helper::getUrl('/roles/delete') ?>"
                                       data-id="<?= $object->getId() ?>">
                                        <i class="fa fa-fw fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

<?php
$this->insert('footer', ['data' => $data]); ?>
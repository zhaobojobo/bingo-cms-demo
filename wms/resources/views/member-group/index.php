<?php

use Admin\Helper;

/** @var $data */
$this->insert('header', ['data' => $data]);
?>

<main class="pb-3">
    <div class="page_title">
        <div class="list_title d-flex justify-content-between align-items-center">
            <h3><?= Helper::_('Member Group Management') ?></h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <?= Helper::_('Member Group Management') ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="list_title m-0">
                    <div class="button_list d-flex justify-content-end align-items-center">
                        <a class="button-blue bingo_button middle_button" title="<?= Helper::_('Add') ?>"
                           href="<?= Helper::getUrl('/member-group/edit/') ?>">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <table class="table table-white table-bordered bingo_table">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 128px;">ID</th>
                        <th><?= Helper::_('Name') ?></th>
                        <th style="width: 128px;"><?= Helper::_('Operates') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($data['list'] as $row) : ?>
                        <tr>
                            <td class="text-center"><?= $row['id'] ?></td>
                            <td>
                                <a href="<?= Helper::getUrl('/members/') ?><?= $row->id ?>">
                                    <?= $row->__data[DEFAULT_LANG]['name'] ?>
                                </a>
                            </td>
                            <td>
                                <a class="button-gray bingo_button icon_button" title="<?= Helper::_('Edit') ?>"
                                   href="<?= Helper::getUrl('/member-group/edit/' . $row['id']) ?>">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <a class="button-gray bingo_button icon_button delete"
                                   title="<?= Helper::_('Delete') ?>"
                                   href="<?= Helper::getUrl('/member-group/delete') ?>" data-id="<?= $row['id'] ?>">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php
$this->insert('footer', ['data' => $data]); ?>

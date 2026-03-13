<?php

use Admin\Helper;

/** @var $data */
$this->insert('header', ['data' => $data]);
?>

<main class="pb-3">
    <div class="page_title">
        <div class="list_title d-flex justify-content-between align-items-center">
            <h3><?= Helper::_('Language Package Management') ?></h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <?= Helper::_('Language Package Management') ?>
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
                                <input type="text" name="q" id="search" value="<?= $data['q'] ?>"
                                       placeholder="<?= Helper::_('Search...') ?>">
                                <button type="submit" class="ml-2 button-pink bingo_button middle_button"><i
                                            class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </form>

                        <div>
                            <a class="button-blue bingo_button middle_button add-message"
                               title="<?= Helper::_('Add') ?>"
                               data-toggle="modal" data-target="#message-modal" href="javascript:void(0);">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                            <a class="button-green bingo_button middle_button btn-data-import"
                               title="<?= Helper::_('Import') ?>"
                               href="javascript:void(0)"
                               data-api="<?= Helper::getUrl('/translations/import') ?>"
                               data-toggle="modal"
                               data-target="#import-modal">
                                <i class="fa fa-reply" aria-hidden="true"></i></a>
                            <a class="button-green bingo_button middle_button"
                               title="<?= Helper::_('Export') ?>"
                               id="btn-export-messages"
                               href="javascript:void(0)"
                               data-api="<?= Helper::getUrl('/translations/export') ?>"
                               data-toggle="modal"
                               data-target="#export-messages-modal">
                                <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                            </a>
                            <a class="button-red bingo_button middle_button list-del-button"
                               title="<?= Helper::_('Delete') ?>" href="javascript:void(0)">
                                <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <table class="table table-white table-bordered bingo_table">
                    <thead>
                    <tr>
                        <th class="text-left" style="width: 100px;">
                            <input type="checkbox" id="all"><label for="all" class="pl-2">ID</label>
                        </th>
                        <th><?= Helper::_('Key') ?></th>
                        <?php
                        foreach (LANGUAGES as $language): ?>
                            <th><?= $language ?></th>
                        <?php
                        endforeach; ?>
                        <th class="text-center" style="width: 168px;"><?= Helper::_('Operates') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($data['pageData']['rows'] as $row): ?>
                        <tr>
                            <td class="text-left">
                                <input type="checkbox" name="id[]" id="id_<?= $row['id'] ?>">
                                <label for="id_<?= $row['id'] ?>" class="pl-2"><?= $row['id'] ?></label>
                            </td>
                            <td>
                                <?= $row['key'] ?>
                            </td>
                            <?php
                            foreach (LANGUAGES as $code => $language): ?>
                                <td>
                                    <?= $row[Helper::getLangCode($code)]; ?>
                                </td>
                            <?php
                            endforeach; ?>
                            <td class="text-center">
                                <?php
                                if (Helper::hasPermission('message-edit')): ?>
                                    <a class="button-gray bingo_button icon_button edit-message"
                                       title="<?= Helper::_('Edit') ?>"
                                       data-toggle="modal" data-target="#message-modal"
                                       data-api="<?= Helper::getUrl('/translation/' . $row['id']) ?>"
                                       href="javascript:void(0);">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                <?php
                                endif; ?>
                                <?php
                                if (Helper::hasPermission('message-delete')): ?>
                                    <a class="button-gray bingo_button icon_button delete"
                                       title="<?= Helper::_('Delete') ?>"
                                       href="<?= Helper::getUrl('/translation/delete') ?>" data-id="<?= $row['id'] ?>">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                <?php
                                endif; ?>
                            </td>
                        </tr>
                    <?php
                    endforeach; ?>
                    </tbody>
                </table>

                <?php
                $this->insert('pagination', ['data' => $data]); ?>

            </div>
        </div>
    </div>
</main>

<?php
$this->insert('import-modal', ['data' => $data]); ?>

<div class="modal fade" id="message-modal" tabindex="-1" role="dialog" aria-labelledby="edit-title-modal-label"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-title-modal-label"><?= Helper::_('Translate Message') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= Helper::getUrl('/translation/save') ?>" method="post">
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label for="key" class="col-form-label"><?= Helper::_('Key') ?></label>
                        <input value="" type="text" class="form-control" name="key" id="key">
                    </div>
                    <?php
                    foreach (LANGUAGES as $langId => $language):
                        $name = str_replace('-', '_', strtolower($langId));
                        ?>
                        <div class="form-group">
                            <label for="message-<?= $name ?>" class="col-form-label">
                                <?= Helper::_($language) ?></label>
                            <input value="" type="text" class="form-control" name="<?= $name ?>"
                                   id="message-<?= $name ?>">
                        </div>
                    <?php
                    endforeach; ?>
                    <div class="form-group">
                        <label for="description" class="col-form-label"><?= Helper::_('Remark') ?></label>
                        <input value="" type="text" class="form-control" name="description" id="description">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Helper::_(
                        'Close'
                    ) ?></button>
                <button type="button" class="btn btn-primary save-message"><?= Helper::_('Save') ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="export-messages-modal" tabindex="-1" role="dialog"
     aria-labelledby="edit-title-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-title-modal-label"><?= Helper::_('Export') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="<?= Helper::getUrl('/language/export') ?>"
                      method="post">
                    <div class="input-group">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary btn-export">
                                <?= Helper::_('Ok') ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <?= Helper::_('Close') ?>
                </button>
            </div>
        </div>
    </div>
</div>

<?php
$this->insert('footer', ['data' => $data]); ?>

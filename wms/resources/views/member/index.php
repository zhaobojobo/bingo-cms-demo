<?php

use Admin\Helper;

/** @var $data */
$this->insert('header', ['data' => $data]);
?>

<main class="pb-3">
    <div class="page_title">
        <div class="list_title d-flex justify-content-between align-items-center">
            <h3><?= Helper::_('Member Management') ?></h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <?= Helper::_('Member Management') ?>
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
                            <?php
                            if ($data['group_id']): ?>
                                <a class="button-blue bingo_button middle_button" title="<?= Helper::_('Add') ?>"
                                   href="<?= Helper::getUrl('/member/edit/0') ?>?group=<?= $data['group_id'] ?>">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </a>
                                <a class="button-yellow bingo_button middle_button"
                                   title="<?= Helper::_('Setting') ?>"
                                   href="<?= Helper::getUrl('/extend/member/' . $data['group_id']) ?>">
                                    <i class="fa fa-fw fa-gears"></i>
                                </a>
                                <a class="button-green bingo_button middle_button" title="<?= Helper::_('Export') ?>"
                                   href="javascript:void(0)"
                                   data-api="<?= Helper::getUrl('/member/export') ?>"
                                   data-toggle="modal"
                                   data-target="#export-members-modal">
                                    <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                                </a>
                            <?php
                            endif; ?>
                        </div>
                    </div>
                </div>
                <table class="table table-white table-bordered bingo_table">
                    <thead>
                    <tr>
                        <th class="text-left" style="width: 100px">
                            <input type="checkbox" id="all">
                            <label for="all" class="pl-2">ID</label>
                        </th>
                        <th><?= Helper::_('Username') ?></th>
                        <th><?= Helper::_('Email') ?></th>
                        <th><?= Helper::_('Group') ?></th>
                        <th><?= Helper::_('Create Time') ?></th>
                        <th style="width: 180px;"><?= Helper::_('Operates') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($data['pageData']['rows'] as $row) : ?>
                        <tr>
                            <td class="text-left">
                                <input type="checkbox" name="id[]" id="id_<?= $row['id'] ?>"
                                       value="<?= $row['id'] ?>">
                                <label for="id_<?= $row['id'] ?>" class="pl-2"><?= $row['id'] ?></label>
                            </td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td>
                                <a href="<?= Helper::getUrl('/members/' . $row['group']['id']) ?>">
                                    <?= $row['group']['__data'][DEFAULT_LANG]['name'] ?>
                                </a>
                            </td>
                            <td><?= $row['create_time'] ?></td>
                            <td>
                                <button class="button-gray bingo_button icon_button btn-detail"
                                        title="<?= Helper::_('View') ?>"
                                        data-toggle="modal" data-target="#detail-modal"
                                        data-api="<?= Helper::getUrl('/member/detail/' . $row['id']) ?>">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                                <button class="button-gray bingo_button icon_button btn-detail"
                                        title="<?= Helper::_('View') ?>"
                                        data-toggle="modal" data-target="#password-modal"
                                        data-id="<?= $row['id'] ?>">
                                    <i class="fa fa-key" aria-hidden="true"></i>
                                </button>
                                <a class="button-gray bingo_button icon_button" title="<?= Helper::_('Edit') ?>"
                                   href="<?= Helper::getUrl(
                                       '/member/edit/' . $row['id']
                                   ) ?>?group=<?= $row['group_id'] ?>">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <a class="button-gray bingo_button icon_button delete"
                                   title="<?= Helper::_('Delete') ?>" href="<?= Helper::getUrl('/member/delete') ?>"
                                   data-id="<?= $row['id'] ?>">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
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

<div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="edit-title-modal-label"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-title-modal-label"><?= Helper::_('Detail') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-hover table-bordered table-dark">
                    <thead>
                    <tr>
                        <th class="text-right px-3"><?= Helper::_('Key') ?></th>
                        <th class="px-3"><?= Helper::_('Val') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal"><?= Helper::_('Close') ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="password-modal" tabindex="-1" role="dialog" aria-labelledby="password-modal-label"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-title-modal-label"><?= Helper::_('Reset Password') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="set-password" action="<?= Helper::getUrl('/member/password') ?>" method="post">
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label for="password" class="col-form-label"><?= Helper::_('Password') ?></label>
                        <input type="text" name="password" id="password" class="form-control password"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password" class="col-form-label"><?= Helper::_(
                                'Confirm Password'
                            ) ?></label>
                        <input type="text" id="confirm_password" class="form-control password" autocomplete="off">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary submit-password"><?= Helper::_('Submit') ?></button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="export-members-modal" tabindex="-1" role="dialog"
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
                <form class="form-inline" action="<?= Helper::getUrl('/member/export') ?>"
                      method="post">
                    <div class="input-group">
                        <label for="group_id"></label>
                        <select class="form-control" name="group_id" id="group_id">
                            <option value="0"><?= Helper::_('All') ?></option>
                            <?php
                            foreach ($data['groups'] as $group): ?>
                                <option value="<?= $group['id'] ?>">
                                    <?= $group['__data'][DEFAULT_LANG]['name'] ?>
                                </option>
                            <?php
                            endforeach; ?>
                        </select>
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

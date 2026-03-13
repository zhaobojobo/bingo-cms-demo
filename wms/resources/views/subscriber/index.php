<?php

use Admin\Helper;

/** @var $data */
$this->insert('header', ['data' => $data]);

?>

    <main class="pb-3">
        <div class="page_title">
            <div class="list_title d-flex justify-content-between align-items-center">
                <h3>
                    <?= Helper::_('訂閱者') ?>
                </h3>
                <div class="page_breadcrumb">
                    <?= Helper::_('Current Position:') ?>
                    <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                    /
                    <?= Helper::_('訂閱者') ?>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="list_title m-0">
                        <div class="button_list d-flex justify-content-between align-items-center">
                            <form method="get" action="" class="search_form">

                            </form>

                            <div>
                                <a class="button-red bingo_button middle_button btn-batch-del"
                                   title="<?= Helper::_('Delete') ?>"
                                   href="<?= Helper::getUrl('/subscribers/batch-delete') ?>">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                <a class="button-green bingo_button middle_button" title="<?= Helper::_('Export') ?>"
                                   href="javascript:void(0)"
                                   data-api="<?= Helper::getUrl('/subscribers/export') ?>"
                                   data-toggle="modal"
                                   data-target="#export-subscribers-modal">
                                    <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-white table-bordered bingo_table sort-list" id="data-table">
                        <thead>
                        <tr>
                            <th class="text-left" style="width: 120px">
                                <input type="checkbox" id="all">
                                <label for="all" class="pl-2">ID</label>
                            </th>
                            <th><?= Helper::_('Email') ?></th>
                            <th><?= Helper::_('注冊時間') ?></th>
                            <th><?= Helper::_('已確認') ?></th>
                            <th class="text-center" style="width: 128px;"><?= Helper::_('Operates') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data['pageData']['rows'] as $row) : ?>
                            <tr>
                                <td class="text-left">
                                    <input type="checkbox" name="id[]" id="id_<?= $row['id'] ?>"
                                           value="<?= $row['id'] ?>">
                                    <label for="id_<?= $row['id'] ?>" class="pl-2"><?= $row['id'] ?></label>
                                </td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['register_time'] ?></td>
                                <td><?= $row['confirm'] ? '是' : '否' ?></td>
                                <td class="text-center">
                                    <a class="button-gray bingo_button icon_button delete"
                                       title="<?= Helper::_('Delete') ?>"
                                       href="<?= Helper::getUrl('/subscribers/delete') ?>" data-id="<?= $row['id'] ?>">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                    <?php $this->insert('pagination', ['data' => $data]); ?>

                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" id="submission-detail-modal" tabindex="-1" role="dialog"
         aria-labelledby="edit-title-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-title-modal-label"><?= Helper::_('Detail') ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">
                        <?= Helper::_('Close') ?>
                    </button>
                </div>
            </div>
        </div>
    </div>

<?php $this->insert('footer', ['data' => $data]); ?>

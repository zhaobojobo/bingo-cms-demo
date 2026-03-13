<?php

use Admin\Helper;
use Admin\Helper\PageListHelper;

/** @var $data */
$this->insert('header', ['data' => $data]);

?>

    <main class="pb-3">
        <div class="page_title">
            <div class="list_title d-flex justify-content-between align-items-center">
                <h3><?= Helper::_('Page Management') ?></h3>
                <div class="page_breadcrumb">
                    <?= Helper::_('Current Position:') ?>
                    <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                    /
                    <?= Helper::_('Page Management') ?>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="list_title m-0">
                        <div class="button_list d-flex justify-content-end align-items-center">
                            <?php
                            if (Helper::hasPermission('page-add')): ?>
                                <a class="button-blue bingo_button middle_button" title="<?= Helper::_('Add') ?>"
                                   href="<?= Helper::getUrl('/page/edit/') ?>">
                                    <i class="fa fa-plus" aria-hidden="true"></i></a>
                            <?php
                            endif ?>
                        </div>
                    </div>
                    <div class="sort-list sort-rows list-tree" data-api="<?= Helper::getUrl('/page/sort') ?>">
                        <?php
                        PageListHelper::table($data['pages'], DEFAULT_LANG); ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="authorize-modal" tabindex="-1" role="dialog"
         data-reviewers="<?= Helper::getUrl('/user/reviewers/page') ?>"
         data-editors="<?= Helper::getUrl('/user/editors/page') ?>"
         aria-labelledby="authorize-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="edit-title-modal-label"><?= Helper::_('Authorize') ?></h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    if (Helper::hasPermission('page-grant-reviewers')): ?>
                        <form id="grant-reviewers" action="<?= Helper::getUrl('/page/grant/reviewers') ?>"
                              method="post">
                            <input type="hidden" name="id" value="">
                            <label for=""><?= Helper::_('Reviewer') ?></label>
                            <div class="form-group input_normal user-checks" id="reviewer-checks">
                            </div>
                        </form>
                    <?php
                    endif ?>
                    <?php
                    if (Helper::hasPermission('page-grant-editors')): ?>
                        <form id="grant-editors" action="<?= Helper::getUrl('/page/grant/editors') ?>" method="post">
                            <input type="hidden" name="id" value="">
                            <label for=""><?= Helper::_('Editors') ?></label>
                            <div class="form-group input_normal user-checks" id="editor-checks">
                            </div>
                        </form>
                    <?php
                    endif ?>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary grant-save">
                        <?= Helper::_('Save') ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php
$this->insert('footer', ['data' => $data]); ?>

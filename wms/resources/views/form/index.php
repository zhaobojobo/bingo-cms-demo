<?php

use Admin\Helper;

/** @var $data */
$this->insert('header', ['data' => $data]);
?>

    <main class="pb-3">
        <div class="page_title">
            <div class="list_title d-flex justify-content-between align-items-center">
                <h3>
                    <?= Helper::_('Form Management') ?>
                </h3>
                <div class="page_breadcrumb">
                    <?= Helper::_('Current Position:') ?>
                    <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                    /
                    <?= Helper::_('Form Management') ?>
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
                                <?php if (Helper::hasPermission('form-edit')): ?>
                                    <a class="button-blue bingo_button middle_button" title="<?= Helper::_('Add') ?>"
                                       href="<?= Helper::getUrl('/form/edit/') ?>">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (Helper::hasPermission('form-delete')): ?>
                                    <a class="button-red bingo_button middle_button btn-batch-del"
                                       title="<?= Helper::_('Delete') ?>"
                                       href="<?= Helper::getUrl('/form/batch-delete') ?>">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                <?php endif; ?>
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
                            <th><?= Helper::_('Key Name') ?></th>
                            <th><?= Helper::_('Title') ?></th>
                            <th><?= Helper::_('Captcha') ?></th>
                            <th><?= Helper::_('To Email Address') ?></th>
                            <th class="text-center" style="width: 150px"><?= Helper::_('Submitted') ?></th>
                            <th class="text-center" style="width: 190px;"><?= Helper::_('Operates') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data['pageData']['rows'] as $row) : ?>
                            <tr>
                                <td class="text-left">
                                    <input type="checkbox" name="id[]" id="id_<?= $row->id ?>"
                                           value="<?= $row->id ?>">
                                    <label for="id_<?= $row->id ?>" class="pl-2"><?= $row->id ?></label>
                                </td>
                                <td><?= $row->cname ?></td>
                                <td>
                                    <span><?= $row->__data[DEFAULT_LANG]['title'] ?></span>
                                </td>
                                <td><?= Helper::_($data['PARAMS']['captcha_types'][$row->captcha]) ?></td>
                                <td><?= $row->email ?></td>
                                <td class="text-center">
                                    <a href="<?= Helper::getUrl('/submissions/' . $row->id) ?>"
                                       title="<?= Helper::_('View submission list') ?>">
                                        <?= $row->submit_count ?>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <?php if (Helper::hasPermission('form-fields')): ?>
                                        <a class="button-gray bingo_button icon_button"
                                           title="<?= Helper::_('Fields Management') ?>"
                                           href="<?= Helper::getUrl('/form-fields/' . $row->id) ?>">
                                            <i class="fa fa-fw fa-list" aria-hidden="true"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (Helper::hasPermission('form-edit')): ?>
                                        <a class="button-gray bingo_button icon_button" title="<?= Helper::_('Edit') ?>"
                                           href="<?= Helper::getUrl('/form/edit/' . $row->id) ?>">
                                            <i class="fa fa-fw fa-pencil" aria-hidden="true"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (Helper::hasPermission('form-delete')): ?>
                                        <a class="button-gray bingo_button icon_button delete"
                                           title="<?= Helper::_('Delete') ?>"
                                           href="<?= Helper::getUrl('/form/delete') ?>"
                                           data-id="<?= $row->id ?>">
                                            <i class="fa fa-fw fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                    <?php endif; ?>
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
    <div class="modal fade" id="form-html-modal" tabindex="-1" role="dialog" aria-labelledby="edit-title-modal-label"
         aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-title-modal-label"><?= Helper::_('Form Html Code') ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="html-code-desc">
                        <p><?= Helper::_(
                                'Please copy the code to the front-end template. You can adjust the code layout according to the design draft. And note:'
                            ) ?></p>
                        <ol>
                            <li><?= Helper::_('Do not modify the name attribute value of the form field') ?></li>
                            <li><?= Helper::_('Do not modify the form submission address') ?></li>
                            <li><?= Helper::_('Please submit the form by POST') ?></li>
                            <li><?= Helper::_('Submit the form in AJAX style') ?></li>
                        </ol>
                    </div>
                    <hr>
                    <div>
                        <?php foreach (LANGUAGES as $langId => $language) : ?>
                            <div>
                                <h4><?= $language['label'] ?></h4>
                                <pre class="form-html-code"><code id="form-code-<?= $langId ?>"></code></pre>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?= Helper::_('Close') ?></button>
                </div>
            </div>
        </div>
    </div>

<?php $this->insert('footer', ['data' => $data]); ?>

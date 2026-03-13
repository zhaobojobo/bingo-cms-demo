<?php

use Admin\Helper;

/** @var $data */
$this->insert('header', ['data' => $data]);
?>
    <main class="pb-3">
        <div class="page_title">
            <div class="list_title d-flex justify-content-between align-items-center">
                <h3><?= Helper::_('Setting Info Management') ?></h3>
                <div class="page_breadcrumb">
                    <?= Helper::_('Current Position:') ?>
                    <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                    /
                    <?= Helper::_('Setting Info Management') ?>
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
                               href="<?= Helper::getUrl('/setting/edit/') ?>">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <table class="table table-white table-bordered bingo_table">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th><?= Helper::_('Title') ?></th>
                            <th><?= Helper::_('Operates') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data['list'] as $row) : ?>
                            <tr>
                                <td class="text-center"><?= $row['id'] ?></td>
                                <td><?= $row->__data[DEFAULT_LANG]->title ?></td>
                                <td>
                                    <!--                                    <a class="button-gray bingo_button icon_button" title="-->
                                    <? //= Helper::_('View') ?><!--"-->
                                    <!--                                       href="-->
                                    <? //= Helper::getUrl('/setting/view/' . $row['id']) ?><!--">-->
                                    <!--                                        <i class="fa fa-eye" aria-hidden="true"></i>-->
                                    <!--                                    </a>-->
                                    <a class="button-gray bingo_button icon_button" title="<?= Helper::_('Edit') ?>"
                                       href="<?= Helper::getUrl('/setting/edit/' . $row['id']) ?>">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    <a class="button-gray bingo_button icon_button delete"
                                       title="<?= Helper::_('Delete') ?>"
                                       href="<?= Helper::getUrl('/setting/delete') ?>" data-id="<?= $row['id'] ?>">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!--                    --><?php //$this->insert('pagination'); ?>

                </div>
            </div>
        </div>
    </main>

<?php $this->insert('footer', ['data' => $data]); ?>

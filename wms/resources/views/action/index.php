<?php

use Admin\Helper;

/** @var $data */
$this->insert('header', ['data' => $data]);

?>

    <main class="pb-3">
        <div class="page_title">
            <div class="list_title d-flex justify-content-between align-items-center">
                <h3>
                    <?= Helper::_('Action Record') ?>
                </h3>
                <div class="page_breadcrumb">
                    <?= Helper::_('Current Position:') ?>
                    <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                    /
                    <?= Helper::_('Action Record') ?>
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
                        </div>
                    </div>
                    <table class="table table-white table-bordered bingo_table">
                        <thead>
                        <tr>
                            <th class="text-left">
                                <input type="checkbox" id="all">
                                <label for="all" class="pl-2">ID</label>
                            </th>
                            <th class="text-center"><?= Helper::_('Action') ?></th>
                            <th><?= Helper::_('Admin') ?></th>
                            <th><?= Helper::_('Action Url') ?></th>
                            <th><?= Helper::_('IP') ?></th>
                            <th class="text-center"><?= Helper::_('DateTime') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data['pageData']['rows'] as $row) : ?>
                            <tr>
                                <td class="text-left">
                                    <input type="checkbox" name="id[]" id="id_<?= $row['id'] ?>">
                                    <label for="id_<?= $row['id'] ?>" class="pl-2"><?= $row['id'] ?></label>
                                </td>
                                <td class="text-center">
                                    <?= $row['action'] ?>
                                </td>
                                <td>
                                    <?= $row['admin'] ?>
                                </td>
                                <td>
                                    <?= $row['url'] ?>
                                </td>
                                <td>
                                    <?= $row['ip'] ?>
                                </td>
                                <td class="edit-hidden text-center"
                                    data-api="<?= Helper::getUrl('/post/hidden/update/' . $row['id']) ?>">
                                    <?= $row['time'] ?>
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

<?php $this->insert('footer', ['data' => $data]); ?>
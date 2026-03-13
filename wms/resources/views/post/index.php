<?php

use Admin\Helper;
use Admin\Helper\PostListHelper;

/** @var $data */
$this->insert('header', ['data' => $data]);

?>

<main class="pb-3">
    <div class="page_title">
        <div class="list_title d-flex justify-content-between align-items-center">
            <h3>
                <?php
                if ($data['type'] == 'news') : ?>
                    <?= Helper::_('News Management') ?>
                <?php
                elseif ($data['type'] == 'product') : ?>
                    <?= Helper::_('Product Management') ?>
                <?php
                elseif ($data['type'] == 'project') : ?>
                    <?= Helper::_('Project Management') ?>
                <?php
                elseif ($data['type'] == 'service') : ?>
                    <?= Helper::_('Service Management') ?>
                <?php
                elseif ($data['type'] == 'activity') : ?>
                    <?= Helper::_('Activity Management') ?>
                <?php
                elseif ($data['type'] == 'career') : ?>
                    <?= Helper::_('Career Manage') ?>
                <?php
                elseif ($data['type'] == 'notice') : ?>
                    <?= Helper::_('Notice Manage') ?>
                <?php
                elseif ($data['type'] == 'report') : ?>
                    <?= Helper::_('Report Manage') ?>
                <?php
                elseif ($data['type'] == 'partner') : ?>
                    <?= Helper::_('Partner Manage') ?>
                <?php
                elseif ($data['type'] == 'faq') : ?>
                    <?= Helper::_('Faq Manage') ?>
                <?php
                else : ?>
                    <?= Helper::_('Post Management') ?>
                <?php
                endif ?>
            </h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <?php
                if ($data['type'] == 'news') : ?>
                    <?= Helper::_('News Management') ?>
                <?php
                elseif ($data['type'] == 'product') : ?>
                    <?= Helper::_('Product Management') ?>
                <?php
                elseif ($data['type'] == 'project') : ?>
                    <?= Helper::_('Project Management') ?>
                <?php
                elseif ($data['type'] == 'service') : ?>
                    <?= Helper::_('Service Management') ?>
                <?php
                elseif ($data['type'] == 'activity') : ?>
                    <?= Helper::_('Activity Management') ?>
                <?php
                elseif ($data['type'] == 'career') : ?>
                    <?= Helper::_('Career Manage') ?>
                <?php
                elseif ($data['type'] == 'notice') : ?>
                    <?= Helper::_('Notice Manage') ?>
                <?php
                else : ?>
                    <?= Helper::_('Post Management') ?>
                <?php
                endif ?>
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
                                <input type="text" name="key" id="search" value="<?= $data['key'] ?>"
                                       placeholder="<?= Helper::_('Search...') ?>">
                                <button type="submit" class="ml-2 button-pink bingo_button middle_button"><i
                                            class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </form>

                        <div>
                            <?php
                            if (Helper::hasPermission($data['type'] . '-fields')): ?>
                                <a class="button-yellow bingo_button middle_button"
                                   title="<?= Helper::_('Setting') ?>"
                                   href="<?= Helper::getUrl('/extend/post/' . $data['type']) ?>/<?= $data['cat'] ?>">
                                    <i class="fa fa-fw fa-gears"></i></a>
                            <?php
                            endif ?>

                            <?php
                            if (Helper::hasPermission($data['type'] . '-add')): ?>
                                <a class="button-blue bingo_button middle_button btn-add-post"
                                   data-cat="<?= $data['cat'] ?>"
                                   title="<?= Helper::_('Add') ?>"
                                   href="<?= Helper::getUrl(
                                       '/post/edit/' . $data['type'] . '/'
                                   ) ?>?cat=<?= $data['cat'] ?>">
                                    <i class="fa fa-plus" aria-hidden="true"></i></a>
                            <?php
                            endif ?>

                            <?php
                            if (Helper::hasPermission($data['type'] . '-batch-copy')): ?>
                                <a class="button-orange bingo_button middle_button btn-batch-copy"
                                   title="<?= Helper::_('Copy') ?>"
                                   href="<?= Helper::getUrl('/post/batch/copy/' . $data['type']) ?>">
                                    <i class="fa fa-clone" aria-hidden="true"></i></a>
                            <?php
                            endif ?>

                            <?php
                            if (Helper::hasPermission($data['type'] . '-export')): ?>
                                <a class="button-green bingo_button middle_button"
                                   title="<?= Helper::_('Export') ?>"
                                   href="javascript:void(0)"
                                   data-api="<?= Helper::getUrl('/post/export/' . $data['type']) ?>"
                                   data-toggle="modal"
                                   data-target="#export-posts-modal">
                                    <i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
                            <?php
                            endif ?>

                            <?php
                            if (Helper::hasPermission($data['type'] . '-batch-delete')): ?>
                                <a class="button-red bingo_button middle_button btn-batch-del"
                                   title="<?= Helper::_('Delete') ?>"
                                   href="<?= Helper::getUrl('/post/batch/delete/' . $data['type']) ?>">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <?php
                            endif ?>
                        </div>
                    </div>
                </div>
                <div class="sort-list" data-api="<?= Helper::getUrl('/post/sorts') ?>">
                    <?php
                    PostListHelper::table($data['type'], $data['pageData']['rows'], DEFAULT_LANG); ?>
                </div>
                <?php
                $this->insert('pagination', ['data' => $data]); ?>
            </div>
        </div>
    </div>
</main>
<?php
$this->insert('footer', ['data' => $data]); ?>

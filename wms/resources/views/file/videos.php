<?php

use Admin\Helper;

/** @var $data */
$this->insert('header', ['data' => $data]);

?>

<style>
    .filename {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(55, 55, 55, 0.5);
        color: white;
        padding: 0.5rem;
        font-size: 0.875em;
    }
</style>

<main class="pb-3">
    <div class="page_title">
        <div class="list_title d-flex justify-content-between align-items-center">
            <h3><?= Helper::_('Video Management') ?></h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <?= Helper::_('Video Management') ?>
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
                            <button type="button" class="button-blue bingo_button middle_button"
                                    data-toggle="modal"
                                    data-target="#files-upload-modal"
                                    data-lang="<?= DEFAULT_LANG ?>"
                                    data-url="<?= Helper::getUrl("/upload/video") ?>">
                                <i class=" fa fa-plus" aria-hidden="true"></i>
                            </button>
                            <a class="button-red bingo_button middle_button btn-batch-del-files"
                               title="<?= Helper::_('Delete') ?>"
                               href="<?= Helper::getUrl('/file/batch/delete') ?>">
                                <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row no-gutters my-4 files-table">
                    <?php
                    foreach ($data['pageData']['rows'] as $row) : ?>
                        <?php
                        $_tmp = explode('/', $row['filename']);
                        $filename = array_pop($_tmp);
                        ?>
                        <div class="col-md-4 col-lg-3 input-image">
                            <div class="box image">
                                <div class="file-check">
                                    <input class="form-control" type="checkbox" name="id[]" value="<?= $row['id'] ?>"
                                           aria-label="Check Image">
                                </div>
                                <div class="thumb video-thumb">
                                    <a href="<?= $row['link'] ?>" data-fancybox="gallery"
                                       title="<?= $filename ?>">
                                        <video src="<?= $row['link'] ?>"></video>
                                        <span class="hover-icon">
                                            <i class="fa fa-fw fa-play-circle" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                    <span class="filename"><?= $filename ?></span>
                                </div>
                                <div class="image-acts">
                                    <a class="delete" title="<?= Helper::_('Delete') ?>"
                                       href="<?= Helper::getUrl('/file/delete') ?>" data-id="<?= $row['id'] ?>">
                                        <i class="fa fa-fw fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach; ?>
                </div>

                <?php
                $this->insert('pagination', ['data' => $data]); ?>

            </div>
        </div>
    </div>
</main>

<?php
$this->insert('footer', ['data' => $data]); ?>

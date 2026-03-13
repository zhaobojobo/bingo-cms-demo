<?php

use Admin\Helper;

/**@var $data */
?>
<div class="modal fade" id="edit-title-modal" tabindex="-1" role="dialog"
     aria-labelledby="edit-title-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="edit-title-modal-label"><?= Helper::_('Title') ?></h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= Helper::getUrl('/page/title/update') ?>"
                      method="post">
                    <input type="hidden" name="id" value="">
                    <?php
                    foreach (
                        LANGUAGES as $langId => $language
                    ) : ?>
                        <div class="form-group">
                            <label for="title-<?= $langId ?>"
                                   class="col-form-label"><?= Helper::_($language) ?></label>
                            <input value="" type="text" class="form-control"
                                   name="<?= Helper::dataFieldName(
                                       $langId,
                                       'title'
                                   ) ?>" id="title-<?= $langId ?>">
                        </div>
                    <?php
                    endforeach; ?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal"><?= Helper::_('Close') ?></button>
                <button type="button"
                        class="btn btn-primary save-title"><?= Helper::_('Save') ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-category-name-modal" tabindex="-1" role="dialog"
     aria-labelledby="edit-category-name-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="edit-title-modal-label"><?= Helper::_('Name') ?></h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= Helper::getUrl('/category/name/update') ?>"
                      method="post">
                    <input type="hidden" name="id" value="">
                    <?php
                    foreach (
                        LANGUAGES as $langId => $language
                    ) : ?>
                        <div class="form-group">
                            <label for="name-<?= $langId ?>"
                                   class="col-form-label"><?= Helper::_($language) ?></label>
                            <input value="" type="text" class="form-control"
                                   name="<?= Helper::dataFieldName(
                                       $langId,
                                       'name'
                                   ) ?>" id="name-<?= $langId ?>">
                        </div>
                    <?php
                    endforeach; ?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal"><?= Helper::_('Close') ?></button>
                <button type="button"
                        class="btn btn-primary save-name"><?= Helper::_('Save') ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upload-image-only" data-backdrop="static"
     data-keyboard="false" tabindex="-1"
     role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="staticBackdropLabel"><?= Helper::_('Upload Image') ?></h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="file" class="d-block" value=""
                       data-show-preview="false">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal"><?= Helper::_('Close') ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upload-video-modal" data-backdrop="static"
     data-keyboard="false" tabindex="-1"
     role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="staticBackdropLabel"><?= Helper::_('Upload Video') ?></h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="file" class="d-block" value=""
                       data-show-preview="false">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal"><?= Helper::_('Close') ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upload-file-modal" data-backdrop="static"
     data-keyboard="false" tabindex="-1"
     role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="staticBackdropLabel"><?= Helper::_('Upload File') ?></h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="file" class="d-block" value=""
                       data-show-preview="false">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal"><?= Helper::_('Close') ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-image-modal" data-backdrop="static"
     data-keyboard="false" tabindex="-1"
     role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="staticBackdropLabel"><?= Helper::_('Edit Image') ?></h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="image-wrap">
                    <img class="the-image" src="" alt="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal"><?= Helper::_('Close') ?></button>
                <button type="button" class="btn btn-primary">Understood
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="photos-upload" data-backdrop="static"
     data-keyboard="false" tabindex="-1"
     role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="staticBackdropLabel"><?= Helper::_('Batch Upload Photos') ?></h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <!--                        <span aria-hidden="true">&times;</span>-->
                </button>
            </div>
            <div class="modal-body">
                <input type="file" class="d-block" value="" multiple>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary"
                        data-dismiss="modal"><?= Helper::_('Close') ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="content-templates-modal"
     style="z-index: 1051"
     data-api="<?= Helper::getUrl('/templates') ?>" data-backdrop="static"
     data-keyboard="false" tabindex="-1"
     role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="staticBackdropLabel"><?= Helper::_('Preset Template') ?></h5>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row templates-image"></div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-info"
                        data-dismiss="modal"><?= Helper::_('Close') ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="export-posts-modal" tabindex="-1" role="dialog" aria-labelledby="edit-title-modal-label"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-title-modal-label"><?= Helper::_('Export') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="<?= Helper::getUrl('/post/export/') ?>"
                      method="post">
                    <div class="input-group">
                        <label for="langId"></label>
                        <select class="form-control" name="langId" id="langId">
                            <option value=""><?= Helper::_('Language') ?></option>
                            <?php
                            foreach (LANGUAGES as $langId => $language): ?>
                                <option value="<?= $langId ?>"><?= $language ?></option>
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

<div class="modal fade" id="export-submissions-modal" tabindex="-1" role="dialog"
     aria-labelledby="edit-title-modal-label"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-title-modal-label"><?= Helper::_('Export') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="<?= Helper::getUrl('/submission/export/') ?>"
                      method="post">
                    <div class="input-group">
                        <label for="langId"></label>
                        <select class="form-control" name="langId" id="langId">
                            <option value=""><?= Helper::_('Language') ?></option>
                            <?php
                            foreach (LANGUAGES as $langId => $language): ?>
                                <option value="<?= $langId ?>"><?= $language ?></option>
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

<div class="modal fade" id="list-fields-modal" tabindex="-1" role="dialog"
     aria-labelledby="edit-title-modal-label"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-title-modal-label"><?= Helper::_('List fields') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <?= Helper::_('Close') ?>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="extend-field" tabindex="-1" role="dialog"
     aria-labelledby="edit-title-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="edit-title-modal-label"><?= Helper::_('Edit Field') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal"><?= Helper::_('Close') ?></button>
            </div>
        </div>
    </div>
</div>
<style>
    #list-fields-modal {
        font-size: 0.75em;
    }

    #list-fields-modal li {
        background: black;
        color: white;
    }
</style>
<div class="modal fade" id="extend-list-field" tabindex="-1" role="dialog"
     aria-labelledby="edit-title-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="edit-title-modal-label"><?= Helper::_('Edit Field') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal"><?= Helper::_('Close') ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade"
     style="font-size: 0.875em"
     id="list-item-edit-modal" tabindex="-1" role="dialog"
     aria-labelledby="edit-title-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
        <div class="modal-content" style="min-height: 75vh">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="edit-title-modal-label"><?= Helper::_('List Item') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal"><?= Helper::_('Close') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- 文件選擇面板 -->
<div class="modal fade" id="files-select-modal"
     data-backdrop="static"
     data-keyboard="false"
     tabindex="-1"
     role="dialog"
     aria-labelledby="staticBackdropLabel" aria-hidden="true"
     data-image="<?= Helper::getUrl('/modal/images/') ?>"
     data-video="<?= Helper::getUrl('/modal/videos/') ?>"
     data-file="<?= Helper::getUrl('/modal/files/') ?>"
     data-loading="0"
     data-p="1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><?= Helper::_('Select Files') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="form-inline">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" placeholder="请输入搜索关键字" value="">
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-search" type="button">搜索</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-inline">
                        <label class="mr-3"><?= Helper::_('Upload') ?></label>
                        <input type="file" class="d-block" value="" multiple data-show-preview="false">
                    </div>
                </div>
                <div class="box list my-3">
                    <div class="row no-gutters"></div>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-sm btn-primary load-more-files">
                        <?= Helper::_('load more') ?>
                    </button>
                </div>
            </div>
            <div class="modal-footer justify-content-start">
                <button type="button" class="ok btn btn-primary"
                        data-tip="<?= Helper::_('Please select at least one') ?>">
                    <?= Helper::_('Ok') ?>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 附件管理文件上傳面板 -->
<div class="modal fade" id="files-upload-modal" data-backdrop="static"
     data-keyboard="false" tabindex="-1"
     role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    <?= Helper::_('Upload Files') ?>
                </h5>
            </div>
            <div class="modal-body">
                <input type="file" class="d-block" value="" multiple>
            </div>
            <div class="modal-footer justify-content-start">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <?= Helper::_('Close') ?>
                </button>
            </div>
        </div>
    </div>
</div>

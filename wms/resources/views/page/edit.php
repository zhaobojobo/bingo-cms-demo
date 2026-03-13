<?php

use Admin\Helper;
use Admin\Ui;

/**@var $data */
$this->insert('editor_css');
$this->insert('editor_js');
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
                <a href="<?= Helper::getUrl('/pages/') ?>"><?= Helper::_('Page Management') ?></a>
                /
                <?= Helper::_('Edit') ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="<?= Helper::getUrl('/page/save') ?>"
                      id="form"
                      class="mt-4"
                      data-id="<?= $data['row']->id ?>"
                      data-model_id="<?= $data['model_id'] ?>"
                      data-extend="<?= Helper::getUrl('/profile/page') ?>">
                    <input type="hidden" name="id" value="<?= $data['row']->id ?>">

                    <?php
                    $this->insert('tab-navs-page', ['data' => $data]); ?>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab">

                            <div class="base-info d-flex justify-content-start align-items-stretch">
                                <div class="input-block p-2 mr-3">
                                    <?php
                                    $_data = array_merge(
                                        $data,
                                        [
                                            'label' => Helper::_('Image'),
                                            'image' => $data['row']->image,
                                            'name' => 'image',
                                        ]
                                    );
                                    $this->insert('image-upload', ['data' => $_data]);
                                    ?>
                                </div>
                                <div class="input-block p-2 py-3 flex-grow-1">
                                    <label for="publish_time"><?= Helper::_('Publish Time') ?></label>
                                    <input type="datetime-local" name="publish_time" id="publish_time"
                                           class="input_normal"
                                           value="<?= Helper::datetime($data['row']->publish_time, true) ?>">

                                    <label for="slug"><?= Helper::_('Slug') ?></label>
                                    <input type="text" name="slug" id="slug" class="input_normal"
                                           value="<?= $data['row']->slug ?: '' ?>">

                                </div>
                                <div class="input-block p-2 py-3 flex-grow-1 ml-3">
                                    <label for="parent_id"><?= Helper::_('Parent Page') ?></label>
                                    <select name="parent_id" id="parent_id" class="input_normal">
                                        <?php
                                        if (!$data['parent_id']) : ?>
                                            <option value=""><?= Helper::_('None') ?></option>
                                        <?php
                                        endif; ?>
                                        <?php
                                        if ($data['row']->id) : ?>
                                            <?= Ui::parentOptions(
                                                DEFAULT_LANG,
                                                $data['parents'],
                                                $data['root_id'],
                                                $data['row']->parent_id,
                                                $data['row']->id
                                            ) ?>
                                        <?php
                                        else : ?>
                                            <?= Ui::parentOptions(
                                                DEFAULT_LANG,
                                                $data['parents'],
                                                $data['root_id']
                                            ) ?>
                                        <?php
                                        endif ?>
                                    </select>
                                </div>
                            </div>

                            <hr class="ds">
                            <div class="row profile" data-lang="G"></div>
                            <div class="container-fluid">
                                <div class="row ex-links"></div>
                            </div>
                        </div>
                        <?php
                        foreach (LANGUAGES as $langId => $language) : ?>
                            <?php
                            $__data = $data['row']->__data[$langId]; ?>
                            <div class="tab-pane fade show edit-section" id="<?= $langId ?>"
                                 data-lang="<?= $langId ?>" role="tabpanel"
                                 aria-labelledby="hk_lang-tab">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-block p-2">
                                            <label for="title-<?= $langId ?>"><?= Helper::_('Title') ?></label>
                                            <input type="text" name="<?= Helper::dataFieldName($langId, 'title') ?>"
                                                   id="title-<?= $langId ?>" class="input_normal"
                                                   value="<?= $__data->title ?>">
                                            <label for="summary-<?= $langId ?>"><?= Helper::_('Summary') ?></label>
                                            <textarea name="<?= Helper::dataFieldName($langId, 'summary') ?>"
                                                      style="min-height: 167px;"
                                                      id="summary-<?= $langId ?>"
                                                      class="input_normal" rows="6"><?= $__data->summary ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-block p-2">
                                            <label for="seo_title-<?= $langId ?>"><?= Helper::_('SEO Title') ?></label>
                                            <input type="text" name="<?= Helper::dataFieldName($langId, 'seo_title') ?>"
                                                   id="seo_title-<?= $langId ?>" class="input_normal"
                                                   value="<?= $__data->seo_title ?>">
                                            <label for="seo_keywords-<?= $langId ?>"><?= Helper::_(
                                                    'SEO Keywords'
                                                ) ?></label>
                                            <input type="text"
                                                   name="<?= Helper::dataFieldName($langId, 'seo_keywords') ?>"
                                                   id="seo_keywords-<?= $langId ?>" class="input_normal"
                                                   value="<?= $__data->seo_keywords ?>">
                                            <label for="seo_description-<?= $langId ?>"><?= Helper::_(
                                                    'SEO Description'
                                                ) ?></label>
                                            <textarea name="<?= Helper::dataFieldName($langId, 'seo_description') ?>"
                                                      id="seo_description-<?= $langId ?>" class="input_normal"
                                                      rows="3"><?= $__data->seo_description ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr class="ds">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="p-2 editor-block">
                                            <label for="content-<?= $langId ?>">
                                                <?= Helper::_('Content') ?>
                                            </label>
                                            <?php
                                            $data = array_merge(
                                                $data,
                                                [
                                                    'langId' => $langId,
                                                    'content' => $data['row']->__data[$langId]->content,
                                                ]
                                            );
                                            $this->insert('editor', ['data' => $data]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <hr class="ds">
                                <div class="row profile" data-lang="<?= $langId ?>"></div>
                            </div>
                        <?php
                        endforeach; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>


<?php
if ($data['row']->id == 41): ?>
    <div class="modal fade" id="inquire-type-modal" tabindex="-1" role="dialog"
         aria-labelledby="inquire-type-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="edit-title-modal-label"><?= Helper::_('Inquire Type') ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <!--            <div class="modal-footer">-->
                <!--                <button type="button" class="btn btn-secondary"-->
                <!--                        data-dismiss="modal">--><?
                //= Helper::_('Close') ?><!--</button>-->
                <!--            </div>-->
            </div>
        </div>
    </div>
<?php
endif ?>

<?php
$this->insert('footer', ['data' => $data]); ?>

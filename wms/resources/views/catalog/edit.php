<?php

use Admin\Helper;
use Admin\Ui;

/** @var $data */
$this->insert('editor_css');
$this->insert('editor_js');
$this->insert('header', ['data' => $data]);
?>

<main class="pb-3">
    <div class="page_title">
        <div class="list_title d-flex justify-content-between align-items-center">
            <h3><?= Helper::_('Category Management') ?></h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <a href="<?= Helper::getUrl('/catalogs/') ?>"><?= Helper::_('Category Management') ?></a>
                / <?= Helper::_('Edit') ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post"
                      action="<?= Helper::getUrl('/catalog/save/' . $data['cType'] . '/' . $data['type']) ?>"
                      id="form"
                      class="mt-4"
                      data-id="<?= $data['row']->id ?>"
                      data-model_0="<?= $data['model_0'] ?>"
                      data-model_id="<?= $data['model_id'] ?>"
                      data-group="<?= $data['type'] ?>"
                      data-extend="<?= Helper::getUrl('/profile/catalog') ?>">
                    <input type="hidden" name="id" value="<?= $data['row']->id ?>">
                    <input type="hidden" name="type" value="<?= $data['type'] ?>">
                    <input type="hidden" name="content_type" value="<?= $data['cType'] ?>">

                    <?php
                    $this->insert('tab-navs-site', ['data' => $data]); ?>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                            <div class="base-info d-flex justify-content-start align-items-stretch">
                                <div class="input-block p-2 mr-3">
                                    <?php
                                    $_data = array_merge(
                                        $data,
                                        [
                                            'label' => Helper::_('Image'),
                                            'image' => $data['row']->image,
                                            'name'  => 'image',
                                        ]
                                    );
                                    $this->insert('image-upload', ['data' => $_data]);
                                    ?>
                                </div>
                                <div class="input-block p-2 py-3 flex-grow-1">
                                    <label for="parent_id"><?= Helper::_('Parent Catalog') ?></label>
                                    <select name="parent_id" id="parent_id" class="input_normal">
                                        <?php
                                        if (!$data['parent_id'] && !$data['row']->parent_id) : ?>
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
                                    <label for="slug"><?= Helper::_('Slug') ?></label>
                                    <input type="text" name="slug" id="slug" class="input_normal"
                                           value="<?= $data['row']->slug ?: '' ?>">
                                </div>
                            </div>

                            <hr class="ds">
                            <div class="row profile" data-lang="G"></div>
                        </div>
                        <?php
                        foreach (LANGUAGES as $langId => $language) : ?>
                            <div class="tab-pane fade show" id="<?= $langId ?>" role="tabpanel"
                                 aria-labelledby="hk_lang-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-block p-2">
                                            <label for="title-<?= $langId ?>"><?= Helper::_('Name') ?></label>
                                            <input type="text" name="<?= Helper::dataFieldName($langId, 'name') ?>"
                                                   id="title-<?= $langId ?>" class="input_normal"
                                                   value="<?= $data['row']->__data[$langId]->name ?>">
                                            <label for="summary-<?= $langId ?>"><?= Helper::_('Summary') ?></label>
                                            <textarea name="<?= Helper::dataFieldName($langId, 'summary') ?>"
                                                      style="min-height: 167px;"
                                                      id="summary-<?= $langId ?>" class="input_normal"
                                                      rows="6"><?= $data['row']->__data[$langId]->summary ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-block p-2">
                                            <label for="seo_title-<?= $langId ?>"><?= Helper::_('SEO Title') ?></label>
                                            <input type="text" name="<?= Helper::dataFieldName($langId, 'seo_title') ?>"
                                                   id="seo_title-<?= $langId ?>" class="input_normal"
                                                   value="<?= $data['row']->__data[$langId]->seo_title ?>">
                                            <label for="seo_keywords-<?= $langId ?>"><?= Helper::_(
                                                    'SEO Keywords'
                                                ) ?></label>
                                            <input type="text"
                                                   name="<?= Helper::dataFieldName($langId, 'seo_keywords') ?>"
                                                   id="seo_keywords-<?= $langId ?>" class="input_normal"
                                                   value="<?= $data['row']->__data[$langId]->seo_keywords ?>">
                                            <label for="seo_description-<?= $langId ?>"><?= Helper::_(
                                                    'SEO Description'
                                                ) ?></label>
                                            <textarea name="<?= Helper::dataFieldName($langId, 'seo_description') ?>"
                                                      id="seo_description-<?= $langId ?>" class="input_normal"
                                                      rows="3"><?= $data['row']->__data[$langId]->seo_description ?></textarea>
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
$this->insert('editor_js'); ?>
<?php
$this->insert('footer', ['data' => $data]); ?>

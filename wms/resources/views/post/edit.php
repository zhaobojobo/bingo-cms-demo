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
            <h3>
                <?= Helper::_('Post Management') ?>
            </h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <a href="<?= Helper::getUrl('/posts/') ?>"><?= Helper::_('Post Management') ?></a>
                / <?= Helper::_('Edit') ?>
            </div>
        </div>
    </div>

    <div class="global" data-content_id="<?= $data['row']->id ?>" data-content_type="<?= $data['row']->type ?>"></div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="<?= Helper::getUrl('/post/save/' . $data['type']) ?>" id="form"
                      class="mt-4"
                      data-id="<?= $data['row']->id ?>"
                      data-model_id="<?= $data['model_id'] ?>"
                      data-extend="<?= Helper::getUrl('/profile/post') ?>">
                    <input type="hidden" name="backListUrl" value="<?= $data['backListUrl'] ?>">
                    <input type="hidden" name="id" value="<?= $data['row']->id ?>">

                    <?php
                    $this->insert('tab-navs-post', ['data' => $data]); ?>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab">

                            <div class="base-info d-flex justify-content-start align-items-stretch">
                                <?php
                                if ($data['type']->getHasImage()): ?>
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
                                <?php
                                endif; ?>
                                <div class="input-block p-2 py-3 flex-grow-1">
                                    <label for="publish_time"><?= Helper::_('Publish Time') ?></label>
                                    <input type="datetime-local" name="publish_time" id="publish_time"
                                           class="input_normal"
                                           value="<?= Helper::datetime($data['row']->publish_time, true) ?>">

                                    <?php
                                    if ($data['type']->getHasSlug()): ?>
                                        <label for="slug"><?= Helper::_('Slug') ?></label>
                                        <input type="text" name="slug" id="slug" class="input_normal"
                                               value="<?= $data['row']->slug ?: '' ?>">
                                    <?php
                                    endif ?>
                                </div>

                                <?php
                                if ($data['cats']): ?>
                                    <div class="input-block p-2 py-3 flex-grow-1 ml-3">
                                        <?php
                                        foreach ($data['cats'] as $key => $cats): ?>
                                            <label for="cats-<?= $key ?>"><?= Helper::_('Catalog_' . $key) ?></label>
                                            <?php
                                            if ($data['type'] == 'list' && $data['cat']): ?>
                                                <select name="cats[<?= $key ?>]" id="cats-<?= $key ?>"
                                                        class="input_normal">
                                                    <option value="<?= $data['cat']->id ?>"><?= $data['cat']['__data'][DEFAULT_LANG]['name'] ?></option>
                                                </select>
                                            <?php
                                            else: ?>
                                                <select name="cats[<?= $key ?>]" id="cats-<?= $key ?>"
                                                        class="input_normal">
                                                    <option value="0"><?= Helper::_('Please Select') ?></option>
                                                    <?= Ui::catOptions($cats, $data['row']->catsId[$key][0]) ?>
                                                </select>
                                            <?php
                                            endif ?>

                                        <?php
                                        endforeach; ?>
                                    </div>
                                <?php
                                endif; ?>
                            </div>
                            <hr class="ds">
                            <div class="row profile" data-lang="G"></div>
                        </div>

                        <?php
                        foreach (LANGUAGES as $langId => $language) : ?>
                            <div class="tab-pane fade show edit-section" id="<?= $langId ?>"
                                 data-lang="<?= $langId ?>" role="tabpanel"
                                 aria-labelledby="hk_lang-tab">
                                <div class="row">
                                    <div class="col-md-6 col-lg">
                                        <div class="input-block p-2">
                                            <label for="title-<?= $langId ?>"><?= Helper::_('Title') ?></label>
                                            <input type="text" name="<?= Helper::dataFieldName($langId, 'title') ?>"
                                                   id="title-<?= $langId ?>" class="input_normal"
                                                   value="<?= $data['row']->__data[$langId]->title ?>">
                                            <?php
                                            if ($data['type']->getHasTags()): ?>
                                                <label for="tags-<?= $langId ?>"><?= Helper::_('Tags') ?></label>
                                                <input type="text"
                                                       name="<?= Helper::dataFieldName($langId, 'tags') ?>"
                                                       id="tags-<?= $langId ?>" class="input_normal"
                                                       value="<?= $data['row']->__data[$langId]->tags ?>">
                                            <?php
                                            endif; ?>
                                            <?php
                                            if ($data['type']->getHasSummary()): ?>
                                                <label for="summary-<?= $langId ?>"><?= Helper::_('Summary') ?></label>
                                                <textarea name="<?= Helper::dataFieldName($langId, 'summary') ?>"
                                                          id="summary-<?= $langId ?>" rows="5"
                                                          class="input_normal summary"><?= $data['row']->__data[$langId]->summary ?></textarea>
                                            <?php
                                            endif; ?>
                                        </div>
                                    </div>
                                    <?php
                                    if ($data['type']->getHasSeo()): ?>
                                        <div class="col-md-6 col-lg">
                                            <div class="input-block p-2">
                                                <label for="seo_title-<?= $langId ?>"><?= Helper::_(
                                                        'SEO Title'
                                                    ) ?></label>
                                                <input type="text"
                                                       name="<?= Helper::dataFieldName($langId, 'seo_title') ?>"
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
                                                <textarea
                                                        name="<?= Helper::dataFieldName($langId, 'seo_description') ?>"
                                                        id="seo_description-<?= $langId ?>" class="input_normal"
                                                        rows="5"><?= $data['row']->__data[$langId]->seo_description ?></textarea>
                                            </div>
                                        </div>
                                    <?php
                                    endif; ?>
                                </div>
                                <?php
                                if ($data['type']->getHasContent()): ?>
                                    <hr class="ds">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="p-2 editor-block">
                                                <label for="content-<?= $langId ?>"><?= Helper::_('Content') ?></label>
                                                <?php
                                                $data = array_merge($data, [
                                                    'langId' => $langId,
                                                    'content' => $data['row']->__data[$langId]->content,
                                                ]);
                                                $this->insert('editor', ['data' => $data]);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                endif; ?>
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
$this->insert('footer', ['data' => $data]); ?>

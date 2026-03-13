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
                <?= Helper::_('Form Management') ?>
            </h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <a href="<?= Helper::getUrl('/forms/') ?>"><?= Helper::_('Form Management') ?></a>
                / <?= Helper::_('Edit') ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="<?= Helper::getUrl('/form/save') ?>" id="form" class="mt-4">
                    <input type="hidden" name="id" value="<?= $data['row']->id ?>">
                    <input type="hidden" name="activity_id" value="<?= $data['activity_id'] ?>">

                    <?php $this->insert('tab-navs-site', ['data' => $data]); ?>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab">
                            <div class="row pb-4 pb-lg-0">
                                <div class="col-lg-4">
                                    <label for="cname"><?= Helper::_('Key Name') ?></label>
                                    <?php if ($data['row']->cname): ?>
                                        <input type="text" id="cname" class="input_normal"
                                               readonly value="<?= $data['row']->cname ?>">
                                    <?php else: ?>
                                        <input type="text" name="cname" id="cname" class="input_normal"
                                               value="<?= $data['cname'] ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-4">
                                    <label for="captcha"><?= Helper::_('Captcha') ?></label>
                                    <select name="captcha" id="captcha" class="input_normal">
                                        <?= Ui::options($data['PARAMS']['captcha_types'], $data['row']->captcha) ?>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label for="email"><?= Helper::_('Email') ?>
                                        <samll style="font-size: .8em;"><?= Helper::_(
                                                '(Receive email for form content)'
                                            ) ?></samll>
                                    </label>
                                    <input type="text" name="email" id="email" class="input_normal"
                                           value="<?= $data['row']->email ?>">
                                </div>
                            </div>
                            <hr style="border-top: 1px solid rgba(255, 255, 255, 0.1)">
                            <div class="row profile" data-lang="G"></div>
                        </div>

                        <?php
                        foreach (LANGUAGES as $langId => $language) : ?>
                            <div class="tab-pane fade show" id="<?= $langId ?>" role="tabpanel"
                                 aria-labelledby="hk_lang-tab">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="title-<?= $langId ?>"><?= Helper::_('Title') ?></label>
                                        <input type="text" name="<?= Helper::dataFieldName($langId, 'title') ?>"
                                               id="title-<?= $langId ?>" class="input_normal"
                                               value="<?= $data['row']->__data[$langId]->title ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="submit_btn_text-<?= $langId ?>"><?= Helper::_(
                                                'Submit Button Text'
                                            ) ?></label>
                                        <input type="text"
                                               name="<?= Helper::dataFieldName($langId, 'submit_btn_text') ?>"
                                               id="submit_btn_text-<?= $langId ?>" class="input_normal"
                                               value="<?= $data['row']->__data[$langId]->submit_btn_text ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="ok_message-<?= $langId ?>">
                                            <?= Helper::_('Success Message') ?>
                                        </label>
                                        <input name="<?= Helper::dataFieldName($langId, 'ok_message') ?>"
                                               id="ok_message-<?= $langId ?>" class="input_normal"
                                               value="<?= $data['row']->__data[$langId]->ok_message ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="description-<?= $langId ?>"><?= Helper::_('Description') ?></label>
                                        <textarea name="<?= Helper::dataFieldName($langId, 'description') ?>"
                                                  id="description-<?= $langId ?>" class="input_normal"
                                                  rows="4"><?= $data['row']->__data[$langId]->description ?></textarea>
                                    </div>
                                </div>
                                <div class="row profile" data-lang="<?= $langId ?>"></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php $this->insert('footer', ['data' => $data]); ?>

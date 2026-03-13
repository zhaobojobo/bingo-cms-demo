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
                <?= Helper::_('Form Field Management') ?>
            </h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <a href="<?= Helper::getUrl('/forms/') ?>"><?= Helper::_('Form Management') ?></a>
                /
                <a href="<?= Helper::getUrl('/form-fields/' . $data['fid']) ?>"><?= Helper::_(
                    'Form Field Management'
                ) ?></a>
                / <?= Helper::_('Edit') ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="<?= Helper::getUrl('/form-field/save') ?>" id="form" class="mt-4">
                    <input type="hidden" name="id" value="<?= $data['row']->id ?>">
                    <input type="hidden" name="form_id" value="<?= $data['fid'] ?>">

                    <?php $this->insert('tab-navs-site', ['data' => $data]); ?>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab">
                            <div class="row pb-4 pb-lg-0">
                                <div class="col-md-6 col-xl-3">
                                    <label for="name"><?= Helper::_('Field Name') ?></label>
                                    <?php if ($data['row']->name) : ?>
                                        <input type="text" id="name" class="input_normal" readonly
                                               value="<?= $data['row']->name ?>">
                                    <?php else : ?>
                                        <input type="text" name="name" id="name" class="input_normal" value="">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <label for="input"><?= Helper::_('Input Control') ?></label>
                                    <select name="input" id="input" class="input_normal">
                                        <option value=""><?= Helper::_('Please Select') ?></option>
                                        <?= Ui::options(
                                            $data['PARAMS']['front_input_types'],
                                            $data['row']->input
                                        ) ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row pb-4 pb-lg-0">
                                <div class="col-md-6 col-xl-3">
                                    <label for="col"><?= Helper::_('Layout Width') ?></label>
                                    <select name="col" id="col" class="input_normal">
                                        <option value="6"><?= Helper::_('Please Select') ?></option>
                                        <?= Ui::options($data['PARAMS']['field_cols'], $data['row']->col) ?>
                                    </select>
                                </div>
                                <div class="col-6 col-md-3 col-xl-1">
                                    <label for="required"><?= Helper::_('Required') ?></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="required" id="required"
                                               value="1"
                                               <?php if ($data['row']->required) :
                                                    ?>checked<?php
                                               endif; ?>>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3 col-xl-1">
                                    <label for="disabled"><?= Helper::_('Disabled') ?></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="disabled" id="disabled"
                                               value="1"
                                               <?php if ($data['row']->disabled) :
                                                    ?>checked<?php
                                               endif; ?>>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php foreach (LANGUAGES as $langId => $language) : ?>
                            <div class="tab-pane fade show" id="<?= $langId ?>" role="tabpanel"
                                 aria-labelledby="hk_lang-tab">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="label-<?= $langId ?>"><?= Helper::_('Label') ?></label>
                                        <input type="text" name="<?= Helper::dataFieldName($langId, 'label') ?>"
                                               id="label-<?= $langId ?>" class="input_normal"
                                               value="<?= $data['row']->__data[$langId]->label ?>">
                                        <label for="placeholder-<?= $langId ?>"><?= Helper::_('Placeholder') ?></label>
                                        <input type="text" name="<?= Helper::dataFieldName($langId, 'placeholder') ?>"
                                               id="placeholder-<?= $langId ?>" class="input_normal"
                                               value="<?= $data['row']->__data[$langId]->placeholder ?>">
                                        <label for="tip-<?= $langId ?>"><?= Helper::_('Tip') ?></label>
                                        <input type="text" name="<?= Helper::dataFieldName($langId, 'tip') ?>"
                                               id="tip-<?= $langId ?>" class="input_normal"
                                               value="<?= $data['row']->__data[$langId]->tip ?>">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php $this->insert('footer', ['data' => $data]); ?>

<?php

use Admin\Helper;
use Admin\Ui;

/** @var $data */
?>

<form method="post" action="<?= Helper::getUrl('/field/keep') ?>" id="list-field-form2" class="mt-4">
    <input type="hidden" name="id" value="<?= $data['row']->id ?>">
    <input type="hidden" name="model_id" value="<?= $data['row']->model_id ?: $data['model_id'] ?>">

    <?php
    $this->insert('tab-navs-modal-wms', ['data' => $data]); ?>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="modal-general" role="tabpanel" aria-labelledby="general-tab">
            <div class="row">
                <div class="col-md-6">
                    <label for="type"><?= Helper::_('Type') ?></label>
                    <select name="type" id="type" class="input_normal">
                        <option value=""><?= Helper::_('Please Select') ?></option>
                        <?= Ui::options($data['PARAMS']['input_types'], $data['row']->type) ?>
                    </select>
                </div>
                <?php
                if ($data['type'] == 'list'): ?>
                    <div class="col-md-6">
                        <label for="type"><?= Helper::_('Listed') ?></label>
                        <select name="listed" id="listed" class="input_normal">
                            <option value="0"><?= Helper::_('No') ?></option>
                            <option value="1" <?php
                            if ($data['row']->listed): ?>selected<?php
                            endif ?>><?= Helper::_('Yes') ?></option>
                        </select>
                    </div>
                <?php
                endif; ?>
                <div class="col-md-12">
                    <label for="name"><?= Helper::_('Name') ?></label>
                    <input type="text" name="name" id="name" class="input_normal"
                           value="<?= $data['row']->name ?>">
                </div>
            </div>
        </div>

        <?php
        foreach (LANGUAGES as $langId => $label) : ?>
            <div class="tab-pane fade show" id="modal-<?= $langId ?>" role="tabpanel"
                 aria-labelledby="hk_lang-tab">
                <div class="row">
                    <div class="col-md-6">
                        <label for="label-<?= $langId ?>"><?= Helper::_('Label') ?></label>
                        <input type="text" name="<?= Helper::dataFieldName($langId, 'label') ?>"
                               id="label-<?= $langId ?>" class="input_normal"
                               value="<?= $data['row']->__data[$langId]->label ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="default-<?= $langId ?>"><?= Helper::_('Default') ?></label>
                        <input type="text" name="<?= Helper::dataFieldName($langId, 'default') ?>"
                               id="default-<?= $langId ?>" class="input_normal"
                               value="<?= $data['row']->__data[$langId]->default ?>">
                    </div>
                </div>
            </div>
        <?php
        endforeach; ?>
    </div>
</form>

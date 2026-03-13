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
            <h3><?= Helper::_('Field Management') ?></h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <a href="<?= Helper::getUrl('/models/') ?>"><?= Helper::_('Model Management') ?></a>
                /
                <a href="<?= Helper::getUrl(
                    '/fields/' . ($data['row']->model_id ?: $data['model_id'])
                ) ?>"><?= Helper::_('Field Management') ?></a>
                / <?= Helper::_('Edit') ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="<?= Helper::getUrl('/field/save') ?>" id="form" class="mt-4">
                    <input type="hidden" name="id" value="<?= $data['row']->id ?>">
                    <input type="hidden" name="model_id" value="<?= $data['row']->model_id ?: $data['model_id'] ?>">

                    <?php $this->insert('tab-navs', ['data' => $data]); ?>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name"><?= Helper::_('Name') ?></label>
                                    <input type="text" name="name" id="name" class="input_normal"
                                           value="<?= $data['row']->name ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="type"><?= Helper::_('Type') ?></label>
                                    <select name="type" id="type" class="input_normal">
                                        <option value=""><?= Helper::_('Please Select') ?></option>
                                        <?= Ui::options($data['PARAMS']['input_types'], $data['row']->type) ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="label"><?= Helper::_('Label') ?></label>
                                    <input type="text" name="label" id="label" class="input_normal"
                                           value="<?= $data['row']->label ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="default"><?= Helper::_('Default') ?></label>
                                    <input type="text" name="default" id="default" class="input_normal"
                                           value="<?= $data['row']->default ?>">
                                </div>
                            </div>
                        </div>

                        <?php foreach (LANGUAGES as $langId => $langCode) : ?>
                            <div class="tab-pane fade show" id="<?= $langId ?>" role="tabpanel"
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
                        <?php endforeach; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php $this->insert('editor_js'); ?>
<?php $this->insert('footer', ['data' => $data]); ?>

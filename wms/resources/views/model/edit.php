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
            <h3><?= Helper::_('Model Management') ?></h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <a href="<?= Helper::getUrl('/models/') ?>"><?= Helper::_('Model Management') ?></a> / <?= Helper::_(
                    'Edit'
                ) ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="<?= Helper::getUrl('/model/save') ?>" id="form" class="mt-4">
                    <input type="hidden" name="id" value="<?= $data['row']->id ?>">

                    <?php $this->insert('tab-navs', ['data' => $data]); ?>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab">
                            <div class="row">
                                <?php if($data['row']->parent_id == 0):?>
                                    <div class="col-md-6 col-lg-4">
                                        <label for="cname"><?= Helper::_('Code Name') ?></label>
                                        <?php if ($data['row']->cname) : ?>
                                            <input type="text" id="cname" class="input_normal" readonly
                                                   value="<?= $data['row']->cname ?>">
                                        <?php else : ?>
                                            <input type="text" name="cname" id="cname" class="input_normal" value="">
                                        <?php endif; ?>
                                    </div>
                                <?php endif;?>
                                <div class="col-md-6 col-lg-4">
                                    <label for="model_group"><?= Helper::_('Group') ?></label>
                                    <select name="group" id="model_group" class="input_normal">
                                        <option value=""><?= Helper::_('Please Select') ?></option>
                                        <?php if ($data['row']) : ?>
                                            <?= Ui::options($data['groups'], $data['row']->group) ?>
                                        <?php else : ?>
                                            <option value=""><?= Helper::_('Please Select') ?></option>
                                            <?= Ui::options($data['groups']) ?>
                                        <?php endif ?>
                                    </select>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <label for="model_parent_id"><?= Helper::_('Parent Model') ?></label>
                                    <select name="parent_id" id="model_parent_id" class="input_normal"
                                            data-id="<?= $data['row'] ? $data['row']->id : 0 ?>"
                                            data-api="<?= Helper::getUrl('/model/parents') ?>">
                                        <option value=""><?= Helper::_('Please Select') ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php foreach (LANGUAGES as $langId => $langCode) : ?>
                            <div class="tab-pane fade show" id="<?= $langId ?>" role="tabpanel"
                                 aria-labelledby="hk_lang-tab">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <label for="name-<?= $langId ?>"><?= Helper::_('Name') ?></label>
                                        <input type="text" name="<?= Helper::dataFieldName($langId, 'name') ?>"
                                               id="name-<?= $langId ?>" class="input_normal"
                                               value="<?= $data['row']->__data[$langId]->name ?>">
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

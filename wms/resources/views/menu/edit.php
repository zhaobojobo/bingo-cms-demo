<?php

use Admin\Helper;

/** @var $data */
$this->insert('editor_css');
$this->insert('editor_js');
$this->insert('header', ['data' => $data]);
?>

<main class="pb-3">
    <div class="page_title">
        <div class="list_title d-flex justify-content-between align-items-center">
            <h3><?= Helper::_('Menu Management') ?></h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <a href="<?= Helper::getUrl('/menus/') ?>"><?= Helper::_('Menu Management') ?></a> / <?= Helper::_(
                    'Edit'
                ) ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="<?= Helper::getUrl('/menu/save') ?>" id="form" class="mt-4">
                    <input type="hidden" name="id" value="<?= $data['row']->id ?>">

                    <?php
                    $this->insert('tab-navs-wms', ['data' => $data]); ?>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab">
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="input-block p-2">
                                        <label for="cname"><?= Helper::_('Key Name') ?></label>
                                        <?php
                                        if ($data['row']->cname) : ?>
                                            <input type="text" id="cname" class="input_normal" readonly
                                                   value="<?= $data['row']->cname ?>">
                                        <?php
                                        else : ?>
                                            <input type="text" name="cname" id="cname" class="input_normal" value="">
                                        <?php
                                        endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        foreach (LANGUAGES as $langId => $label) : ?>
                            <div class="tab-pane fade show" id="<?= $langId ?>" role="tabpanel"
                                 aria-labelledby="hk_lang-tab">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="input-block p-2">
                                            <label for="position-<?= $langId ?>"><?= Helper::_('Position') ?></label>
                                            <input type="text" name="<?= Helper::dataFieldName($langId, 'position') ?>"
                                                   id="position-<?= $langId ?>" class="input_normal"
                                                   value="<?= $data['row']->__data[$langId]->position ?>">
                                        </div>
                                    </div>
                                </div>
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

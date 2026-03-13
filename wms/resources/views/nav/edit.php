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
            <h3><?= Helper::_('Nav Management') ?></h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <a href="<?= Helper::getUrl('/menus/') ?>"><?= Helper::_('Nav Management') ?></a>
                /
                <a href="<?= Helper::getUrl('/navs/' . ($data['row']->menu_id ?: $data['menu_id'])) ?>"><?= Helper::_(
                        'Nav Management'
                    ) ?></a> / <?= Helper::_('Edit') ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="<?= Helper::getUrl('/nav/save') ?>" id="form" class="mt-4">
                    <input type="hidden" name="id" value="<?= $data['row']->id ?>">
                    <input type="hidden" name="menu_id" value="<?= $data['row']->menu_id ?: $data['menu_id'] ?>">

                    <?php
                    $this->insert('tab-navs-site', ['data' => $data]); ?>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab">

                            <div class="base-info d-flex justify-content-start align-items-stretch">
                                <div class="input-block p-2 mr-3">
                                    <?php
                                    $_data = array_merge(
                                        $data,
                                        [
                                            'label' => Helper::_('Icon'),
                                            'image' => $data['row']->icon,
                                            'name' => 'icon',
                                        ]
                                    );
                                    $this->insert('image-upload', ['data' => $_data]);
                                    ?>
                                </div>
                                <div class="input-block p-2 py-3 flex-grow-1">
                                    <label for="parent_id"><?= Helper::_('Parent Nav') ?></label>
                                    <select name="parent_id" id="parent_id" class="input_normal">
                                        <option value=""><?= Helper::_('None') ?></option>
                                        <?php
                                        if ($data['row']->id) : ?>
                                            <?= Ui::parentOptions(
                                                DEFAULT_LANG,
                                                $data['parents'],
                                                0,
                                                $data['row']->parent_id,
                                                $data['row']->id
                                            ) ?>
                                        <?php
                                        else : ?>
                                            <?= Ui::parentOptions(
                                                DEFAULT_LANG,
                                                $data['parents']
                                            ) ?>
                                        <?php
                                        endif ?>
                                    </select>
                                    <label><?= Helper::_('Nav Text') ?></label>
                                    <div class="form-check" style="margin-bottom: 17px">
                                        <input class="form-check-input member_group" type="checkbox"
                                               <?php
                                               if (!isset($data['row']->sync_title) || $data['row']->sync_title): ?>checked<?php
                                        endif ?>
                                               id="sync-title" name="sync_title" value="1">
                                        <label class="form-check-label" for="sync-title">
                                            <?= Helper::_('Stay in sync with target page titles') ?>
                                        </label>
                                    </div>
                                    <label for="nav-type"><?= Helper::_('Type') ?></label>
                                    <select name="type" id="nav-type" class="input_normal"
                                            data-api="<?= Helper::getUrl('/nav/data/') ?>">
                                        <option value=""><?= Helper::_('Please Select') ?></option>
                                        <?= Ui::options($data['PARAMS']['nav_types'], $data['row']->type) ?>
                                    </select>
                                    <div id="nav-data"
                                         data-url="<?= $data['row']->url ?>"
                                         data-target="<?= Helper::getUrl('/nav/target') ?>"
                                         data-target_id="<?= $data['row']->target_id ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        foreach (LANGUAGES as $langId => $language) : ?>
                            <div class="tab-pane fade show" id="<?= $langId ?>" role="tabpanel"
                                 aria-labelledby="hk_lang-tab">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="input-block p-2">
                                            <label for="text-<?= $langId ?>"><?= Helper::_('Nav Text') ?></label>
                                            <input type="text" name="<?= Helper::dataFieldName($langId, 'text') ?>"
                                                   id="text-<?= $langId ?>" class="input_normal navText"
                                                   value="<?= $data['row']->__data[$langId]->text ?>">
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

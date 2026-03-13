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
            <h3>
                <?= Helper::_('Accesses Management') ?>
            </h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <a href="<?= Helper::getUrl('/accesses') ?>"><?= Helper::_('Accesses Management') ?></a>
                / <?= Helper::_('Add') ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="<?= Helper::getUrl('/accesses/update') ?>" id="form" class="mt-4">
                    <input type="hidden" name="id" value="<?= $data['object']->getId() ?>">
                    <?php
                    $this->insert('tab-navs-no-lang', ['data' => $data]); ?>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab">
                            <div class="row pb-4 pb-lg-0">
                                <div class="col-md-6 col-lg-4">
                                    <div class="input-block p-2">
                                        <label for="pid"><?= Helper::_('Parent') ?></label>
                                        <select name="pid" id="pid" class="input_normal">
                                            <option value="0"><?= Helper::_('None') ?></option>
                                            <?php
                                            foreach ($data['parents'] as $object): ?>
                                                <option value="<?= $object->getId() ?>" <?php
                                                if ($data['object']->getPid() == $object->getId()): ?>selected<?php
                                                endif ?>>
                                                    <?= $object->indent . ' ' . Helper::_($object->getName()) ?>
                                                </option>
                                            <?php
                                            endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="input-block p-2">
                                        <label for="name"><?= Helper::_('Name') ?></label>
                                        <input type="text" name="name" id="name" class="input_normal"
                                               value="<?= $data['object']->getName() ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="input-block p-2">
                                        <label for="route"><?= Helper::_('Route') ?></label>
                                        <input type="text" name="route" id="route" class="input_normal"
                                               value="<?= $data['object']->getRoute() ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="input-block p-2">
                                        <label for="access_code"><?= Helper::_('Code') ?></label>
                                        <input type="text" name="access_code" id="access_code" class="input_normal"
                                               value="<?= $data['object']->getAccessCode() ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="input-block p-2">
                                        <label for="access_group"><?= Helper::_('Group') ?></label>
                                        <input type="text" name="access_group" id="access_group" class="input_normal"
                                               value="<?= $data['object']->getAccessGroup() ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2">
                                    <div class="input-block p-2">
                                        <label for="access_type"><?= Helper::_('Type') ?></label>
                                        <select name="access_type" id="access_type" class="input_normal">
                                            <option value="0"><?= Helper::_('None') ?></option>
                                            <option value="1" <?php
                                            if ($data['object']->getAccessType() == 1): ?>selected<?php
                                            endif ?>><?= Helper::_('Create') ?></option>
                                            <option value="2" <?php
                                            if ($data['object']->getAccessType() == 2): ?>selected<?php
                                            endif ?>><?= Helper::_('Update') ?></option>
                                            <option value="3" <?php
                                            if ($data['object']->getAccessType() == 3): ?>selected<?php
                                            endif ?>><?= Helper::_('Read') ?></option>
                                            <option value="4" <?php
                                            if ($data['object']->getAccessType() == 4): ?>selected<?php
                                            endif ?>><?= Helper::_('Delete') ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2">
                                    <div class="input-block p-2">
                                        <label for="route"><?= Helper::_('Linkable') ?></label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="linkable"
                                                       <?php
                                                       if (! $data['object']->getLinkable()): ?>checked<?php
                                                endif ?>
                                                       id="linkable1" value="0">
                                                <label class="form-check-label" for="linkable1"><?= Helper::_(
                                                        'No'
                                                    ) ?></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="linkable"
                                                       <?php
                                                       if ($data['object']->getLinkable()): ?>checked<?php
                                                endif ?>
                                                       id="linkable2" value="1">
                                                <label class="form-check-label" for="linkable2"><?= Helper::_(
                                                        'Yes'
                                                    ) ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
$this->insert('footer', ['data' => $data]); ?>

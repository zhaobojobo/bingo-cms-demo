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
                <?= Helper::_('Roles Management') ?>
            </h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <a href="<?= Helper::getUrl('/roles') ?>"><?= Helper::_('Roles Management') ?></a>
                / <?= Helper::_('Add') ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="<?= Helper::getUrl('/roles/update') ?>" id="form" class="mt-4">
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
                                            <?php if (! $data['self']): ?>
                                                <option value="0"><?= Helper::_('None') ?></option>
                                            <?php endif ?>
                                            <?php
                                            foreach ($data['parents'] as $object): ?>
                                                <option value="<?= $object->getId() ?>"<?php
                                                if ($data['object']->getPid() == $object->getId()): ?> selected<?php
                                                endif ?><?php
                                                if ($data['object']->getId() == $object->getId()): ?> disabled<?php
                                                endif ?>>
                                                    <?= $object->indent . ' ' . $object->getName() ?>
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

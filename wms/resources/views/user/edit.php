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
            <h3><?= Helper::_('Account Management') ?></h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <a href="<?= Helper::getUrl('/users/') ?>"><?= Helper::_('Account Management') ?></a> / <?= Helper::_(
                    'Edit'
                ) ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="<?= Helper::getUrl('/user/save') ?>" id="form" class="mt-4">
                    <input type="hidden" name="id" value="<?= $data['row']->id ?>">

                    <?php
                    $this->insert('tab-navs-no-lang', ['data' => $data]); ?>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab">
                            <div class="row">
                                <div class="col-md-6 col-lg">
                                    <div class="input-block p-2">
                                        <label for="username"><?= Helper::_('Username') ?></label>
                                        <input <?php
                                               if (isset($data['row']->id) && $data['row']->id) : ?>readonly<?php
                                        endif ?>
                                               type="text" name="username"
                                               id="username" class="input_normal"
                                               value="<?= $data['row']->username ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg">
                                    <div class="input-block p-2">
                                        <label for="email"><?= Helper::_('Emeil') ?></label>
                                        <input type="text" name="email" id="email" class="input_normal"
                                               value="<?= $data['row']->email ?>">
                                    </div>
                                </div>

                                <?php
                                if ($data['row']->id != $data['USER']['id']): ?>
                                    <div class="col-md-6 col-lg">
                                        <div class="input-block p-2">
                                            <label for="role_id"><?= Helper::_('Role') ?></label>
                                            <select name="role_id" id="role_id" class="input_normal">
                                                <option value="0"><?= Helper::_('None') ?></option>
                                                <?php
                                                foreach ($data['roles'] as $object): ?>
                                                    <option value="<?= $object->getId() ?>" <?php
                                                    if (isset($data['row']['role_id']) && ($data['row']['role_id'] == $object->getId(
                                                            ))): ?>
                                                        selected
                                                    <?php
                                                    endif ?>
                                                    >
                                                        <?= $object->indent . ' ' . $object->getName() ?>
                                                    </option>
                                                <?php
                                                endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php
                                endif; ?>
                            </div>
                            <?php
                            if (!isset($data['row']->id) || !$data['row']->id) : ?>
                                <div class="row">
                                    <div class="col-md-6 col-lg">
                                        <div class="input-block p-2">
                                            <label for="userPassword"><?= Helper::_('Password') ?></label>
                                            <input type="password" name="password" id="userPassword"
                                                   class="input_normal" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg">
                                        <div class="input-block p-2">
                                            <label for="password_confirm"><?= Helper::_('Confirm Password') ?></label>
                                            <input type="password" name="password_confirm" id="password_confirm"
                                                   class="input_normal" value="">
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endif ?>
                            <div class="row profile" data-lang="G"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
$this->insert('footer', ['data' => $data]); ?>

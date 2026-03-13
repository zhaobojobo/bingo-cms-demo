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
            <h3><?= Helper::_('Member Management') ?></h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <a href="<?= Helper::getUrl('/members/') ?>"><?= Helper::_('Member Management') ?></a> / <?= Helper::_(
                    'Edit'
                ) ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="<?= Helper::getUrl('/member/save') ?>" id="form"
                      class="mt-4"
                      data-id="<?= $data['row']->id ?>"
                      data-model_id="<?= $data['model_id'] ?>"
                      data-extend="<?= Helper::getUrl('/profile/member') ?>">
                    <input type="hidden" name="id" value="<?= $data['row']->id ?>">
                    <input type="hidden" name="group_id" value="<?= $data['group_id'] ?>">

                    <?php
                    $this->insert('tab-navs-no-lang', ['data' => $data]); ?>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-block p-2">
                                        <label for="username"><?= Helper::_('Username') ?></label>
                                        <input type="text" name="username" id="username" class="input_normal"
                                               value="<?= $data['row']->username ?>" autocomplete="off">
                                        <label for="email"><?= Helper::_('Email') ?></label>
                                        <input type="text" name="email" id="email" class="input_normal"
                                               value="<?= $data['row']->email ?>" autocomplete="off">
                                        <label for="password"><?= Helper::_('Password') ?></label>
                                        <input type="password" name="password" id="password" class="input_normal"
                                               value="" autocomplete="new-password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="ds">
                        <div class="row profile" data-lang="G"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
$this->insert('footer', ['data' => $data]); ?>

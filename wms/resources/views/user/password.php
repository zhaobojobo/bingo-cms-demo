<?php

use Admin\Helper;

/** @var $data */
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
                <form method="post" action="<?= Helper::getUrl('/user/save-password') ?>" id="form" class="mt-4">
                    <input type="hidden" name="id" value="<?= $data['row']['id'] ?>">

                    <?php $this->insert('tab-navs-no-lang', ['data' => $data]); ?>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab">
                            <div class="row">
                                <div class="col-md-6 col-lg">
                                    <div class="input-block p-2">
                                        <label for="new_password"><?= Helper::_('New Password') ?></label>
                                        <input type="password" name="new_password" id="new_password" class="input_normal"
                                               value="">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg">
                                    <div class="input-block p-2">
                                        <label for="new_password_confirm"><?= Helper::_('Confirm New Password') ?></label>
                                        <input type="password" name="new_password_confirm" id="new_password_confirm"
                                               class="input_normal" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row profile" data-lang="G"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php $this->insert('footer', ['data' => $data]); ?>

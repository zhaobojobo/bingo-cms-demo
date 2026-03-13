<?php

use Admin\Helper;

/** @var $data */
$this->insert('header', ['data' => $data]);
?>

<main class="pb-3">
    <div class="page_title">
        <div class="list_title d-flex justify-content-between align-items-center">
            <h3><?= Helper::_('System Setting') ?></h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <?= Helper::_('System Setting') ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="<?= Helper::getUrl('/system-setting/save') ?>" id="form" class="mt-4">
                    <?php $this->insert('tab-navs-no-lang', ['data' => $data]); ?>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab">
                            <div class="row">
                                <div class="col-md-6 col-lg">
                                    <?php
                                    $setting = $data['settings']['resend_email_interval'] ?? null;
                                    ?>
                                    <h5><?= Helper::_('Resend Email Interval') ?></h5>
                                    <div class="input-block p-2">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="resend-email-interval-value">
                                                    <?= Helper::_('Value') ?>
                                                </label>
                                                <input type="number"
                                                       id="resend-email-interval-value" class="input_normal"
                                                       name="resend_email_interval[value]"
                                                       value="<?= $setting['value'] ?: 0 ?>" min="0">
                                            </div>
                                            <div class="col-2">
                                                <label for="resend-email-interval-unit">
                                                    <?= Helper::_('Time Unit') ?>
                                                </label>
                                                <select name="resend_email_interval[unit]" class="input_normal"
                                                        id="resend-email-interval-unit">
                                                    <option value="0" <?php if($setting['unit'] == '0'):?>selected<?php endif?>>
                                                        <?= Helper::_('Second') ?></option>
                                                    <option value="1" <?php if($setting['unit'] == '1'):?>selected<?php endif?>>
                                                        <?= Helper::_('Minute') ?></option>
                                                    <option value="2" <?php if($setting['unit'] == '2'):?>selected<?php endif?>>
                                                        <?= Helper::_('Hour') ?></option>
                                                    <option value="3" <?php if($setting['unit'] == '3'):?>selected<?php endif?>>
                                                        <?= Helper::_('Day') ?></option>
                                                </select>
                                            </div>
<!--                                            <div class="col-4">-->
<!--                                                <label for="resend-email-interval-public">-->
<!--                                                    --><?//= Helper::_('Public Access') ?>
<!--                                                </label>-->
<!--                                                <div class="form-check">-->
<!--                                                    <input class="form-check-input" type="checkbox"-->
<!--                                                           id="resend-email-interval-public"-->
<!--                                                           name="resend_email_interval[public]"-->
<!--                                                           value="1"-->
<!--                                                        --><?php //if (! $setting && $setting['public']): ?>
<!--                                                            checked-->
<!--                                                        --><?php //endif ?>
<!--                                                    >-->
<!--                                                </div>-->
<!--                                            </div>-->
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

<?php $this->insert('footer', ['data' => $data]); ?>

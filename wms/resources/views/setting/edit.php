<?php

use Admin\Helper;

/** @var $data */

$this->insert('editor_css');
$this->insert('editor_js');
$this->insert('header', ['data' => $data]);
$settings = $data['settings'];
?>
<style>
    .setting-tabs.nav-tabs {
        border-bottom: none;
        background: green;
    }

    .setting-tabs.nav-tabs .nav-link {
        border-radius: 0;
        border: none;
        outline: none;
        background: #2A2A2A;
        color: white;
    }

    .setting-tabs.nav-tabs .nav-link.active {
        background: transparent;
    }

    .setting-tab-content {
        border: none;
        background: none;
        padding: 0;
    }
</style>
<main class="pb-3">
    <div class="page_title">
        <div class="list_title d-flex justify-content-between align-items-center">
            <h3><?= Helper::_('Settings') ?></h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <?= Helper::_('Settings') ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="<?= Helper::getUrl('/settings/save/' . $data['file']) ?>"
                      id="form" class="mt-4">
                    <?php
                    $this->insert('tab-navs-no-lang', ['data' => $data]); ?>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab">
                            <div class="row">
                                <?php
                                foreach ($settings as $group => $_settings):?>
                                    <?php
                                    if (!preg_match('/^_[A-Z]+/', $group)): ?>
                                        <div class="col-md-6">
                                            <h5><?= Helper::_($group) ?></h5>
                                            <div class="input-block p-2">
                                                <?php
                                                foreach ($_settings as $key => $setting): ?>
                                                    <?=
                                                    $this->fetch(
                                                        'setting/form-' . $setting['type'],
                                                        [
                                                            'key' => $key,
                                                            'setting' => $setting,
                                                            'settings' => $_settings,
                                                            'languages' => $data['languages'],
                                                            'language_default' => $data['language_default'],
                                                            'lang' => DEFAULT_LANG,
                                                        ]
                                                    ); ?>
                                                <?php
                                                endforeach; ?>
                                            </div>
                                        </div>
                                    <?php
                                    endif ?>
                                <?php
                                endforeach; ?>
                                <?php
                                if ($data['file'] == 'email'): ?>
                                    <div class="col-md-6">
                                        <h5><?= Helper::_('郵件測試') ?></h5>
                                        <div class="input-block p-2">
                                            <form id="email-test-form" method="post" action="">
                                                <div class="form-group">
                                                    <label for="email-test-address">地址</label>
                                                    <input type="email" name="address" id="email-test-address"
                                                           class="form-control input_normal" value="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email-test-subject">主題</label>
                                                    <input type="text" name="subject" id="email-test-subject"
                                                           class="form-control input_normal" value="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email-test-body">內容</label>
                                                    <textarea class="form-control input_normal" id="email-test-body"
                                                              name="body" rows="5"></textarea>
                                                </div>
                                            </form>
                                            <div class="email-test-result mb-3 text-warning"
                                                 id="email-test-result"></div>
                                            <a href="<?= Helper::getUrl('/settings/email-test') ?>"
                                               class="btn btn-primary btn-email-test" id="btn-email-test">發送</a>
                                        </div>
                                    </div>
                                <?php
                                endif ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    (function () {
        $('#btn-email-test').on('click', function (e) {
            e.preventDefault();
            const that = this;
            const text = $(this).text();
            let data = {
                'address': $('#email-test-address').val(),
                'subject': $('#email-test-subject').val(),
                'body': $('#email-test-body').val()
            };
            $('#email-test-result').empty();
            $(this).text('發送中...');
            $.post($(this).attr('href'), data, function (res) {
                $(that).text(text);
                if (!res.status) {
                    $('#email-test-result').html(res.message);
                } else {
                    $('#email-test-result').html('郵件成功送出');
                }
            }, 'json');
            return false;
        })
    })();
</script>

<?php
$this->insert('footer', ['data' => $data]); ?>

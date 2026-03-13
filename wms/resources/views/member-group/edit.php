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
            <h3><?= Helper::_('Member Group Management') ?></h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <a href="<?= Helper::getUrl('/member-groups/') ?>"><?= Helper::_('Member Group Management') ?></a>
                / <?= Helper::_('Edit') ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="<?= Helper::getUrl('/member-group/save') ?>" id="form" class="mt-4">
                    <input type="hidden" name="id" value="<?= $data['row']->id ?>">

                    <?php $this->insert('tab-navs-site', ['data' => $data]); ?>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab">
                            <div class="base-info d-flex justify-content-start align-items-stretch">
                                <div class="input-block p-2 mr-3">
                                    <?php
                                    $_data = array_merge(
                                        $data,
                                        [
                                            'label' => Helper::_('Image'),
                                            'image' => $data['row']->image,
                                            'name' => 'image',
                                        ]
                                    );
                                    $this->insert('image-upload', ['data' => $_data]);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php foreach (LANGUAGES as $langId => $language) : ?>
                            <div class="tab-pane fade show" id="<?= $langId ?>" role="tabpanel"
                                 aria-labelledby="hk_lang-tab">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="input-block p-2">
                                            <label for="name-<?= $langId ?>"><?= Helper::_('Name') ?></label>
                                            <input type="text" name="<?= Helper::dataFieldName($langId, 'name') ?>"
                                                   id="name-<?= $langId ?>" class="input_normal"
                                                   value="<?= $data['row']->__data[$langId]->name ?>">
                                        </div>
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

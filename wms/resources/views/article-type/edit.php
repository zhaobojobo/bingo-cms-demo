<?php

use Admin\Helper;

/** @var $data */
$this->insert('header', ['data' => $data]);
?>

<main class="pb-3">
    <div class="page_title">
        <div class="list_title d-flex justify-content-between align-items-center">
            <h3>
                <?= Helper::_('Article Types Management') ?>
            </h3>
            <div class="page_breadcrumb">
                <?= Helper::_('Current Position:') ?>
                <a href="<?= Helper::getUrl('/') ?>"><?= Helper::_('Home') ?></a>
                /
                <a href="<?= Helper::getUrl('/system/types') ?>"><?= Helper::_('Article Types Management') ?></a>
                / <?= Helper::_('Add') ?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="<?= Helper::getUrl('/system/types/update') ?>" id="form" class="mt-4">
                    <input type="hidden" name="id" value="<?= $data['object']->getId() ?>">
                    <?php
                    $this->insert('tab-navs-no-lang', ['data' => $data]); ?>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="general" role="tabpanel"
                             aria-labelledby="general-tab">
                            <div class="row pb-4 pb-lg-0">
                                <div class="col-md-6 col-lg-4">
                                    <div class="input-block p-2">
                                        <label for="name"><?= Helper::_('Name') ?></label>
                                        <input type="text" id="name" class="input_normal"
                                               value="<?= $data['object']->getName() ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-4 pb-lg-0">
                                <div class="col-md-6 col-lg-12">
                                    <div class="input-block p-2">
                                        <label for="sticky"><?= Helper::_('Fields Option') ?></label>
                                        <div class="form-checks">
                                            <div class="form-check form-check-inline">
                                                <input <?php if($data['object']->getHasImage()):?>checked<?php endif;?> class="form-check-input" type="checkbox" name="has_image" id="option_image" value="1">
                                                <label class="form-check-label" for="option_image"><?= Helper::_('Image') ?></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input <?php if($data['object']->getHasSummary()):?>checked<?php endif;?> class="form-check-input" type="checkbox" name="has_summary" id="option_summary" value="1">
                                                <label class="form-check-label" for="option_summary"><?= Helper::_('Summary') ?></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input <?php if($data['object']->getHasContent()):?>checked<?php endif;?> class="form-check-input" type="checkbox" name="has_content" id="option_content" value="1">
                                                <label class="form-check-label" for="option_content"><?= Helper::_('Content') ?></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input <?php if($data['object']->getHasSeo()):?>checked<?php endif;?> class="form-check-input" type="checkbox" name="has_seo" id="option_seo" value="1">
                                                <label class="form-check-label" for="option_seo"><?= Helper::_('SEO') ?></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input <?php if($data['object']->getHasSlug()):?>checked<?php endif;?> class="form-check-input" type="checkbox" name="has_slug" id="option_slug" value="1">
                                                <label class="form-check-label" for="option_slug"><?= Helper::_('Slug') ?></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input <?php if($data['object']->getHasTags()):?>checked<?php endif;?> class="form-check-input" type="checkbox" name="has_tags" id="option_tags" value="1">
                                                <label class="form-check-label" for="option_tags"><?= Helper::_('Tags') ?></label>
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

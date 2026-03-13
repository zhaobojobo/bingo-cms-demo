<?php

use Admin\Helper;

/**@var $data */
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="<?= Helper::getUrl('/list-items/save') ?>"
                  class="list-item-edit-form"
                  data-id="<?= $data['iid'] ?>"
                  data-model_id="<?= $data['model_id'] ?>"
                  data-extend="<?= Helper::getUrl('/profile/list-item') ?>">
                <input type="hidden" name="field_id" value="<?= $data['fid'] ?>">
                <input type="hidden" name="id" value="<?= $data['iid'] ?>">
                <input type="hidden" name="content_id" value="0">

                <?php
                $this->insert('tab-navs-modal', ['data' => $data]); ?>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="modal-general" role="tabpanel"
                         aria-labelledby="general-tab">
                        <div class="row list-item-profile" data-lang="G"></div>
                        <div class="container-fluid">
                            <div class="row ex-links"></div>
                        </div>
                    </div>
                    <?php
                    foreach (LANGUAGES as $langId => $language) : ?>
                        <div class="tab-pane fade show edit-section" id="modal-<?= $langId ?>"
                             data-lang="<?= $langId ?>" role="tabpanel"
                             aria-labelledby="hk_lang-tab">
                            <div class="row list-item-profile" data-lang="<?= $langId ?>"></div>
                        </div>
                    <?php
                    endforeach; ?>
                </div>
            </form>
        </div>
    </div>
</div>

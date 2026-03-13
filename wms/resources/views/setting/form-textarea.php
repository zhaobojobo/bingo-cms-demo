<?php
/**
 * @var $key
 * @var $setting
 * @var $languages
 * @var $language_default
 */

use Admin\Helper;

$i18n = $setting['i18n'] ?? false;
?>
<?php
if (!$i18n): ?>
    <div class="form-group">
        <label for="<?= $key ?>"><?= Helper::_($setting['name']) ?></label>
        <textarea class="form-control input_normal" id="<?= $key ?>" name="<?= $key ?>"
                  rows="5"><?= $setting['value'] ?></textarea>
    </div>
<?php
else: ?>
    <div class="form-group">
        <nav class="d-flex justify-content-between align-items-center">
            <label for="<?= $key ?>"><?= Helper::_($setting['name']) ?></label>
            <div class="nav nav-tabs setting-tabs" id="nav-tab-<?= $key ?>" role="tablist">
                <?php
                foreach ($languages as $language => $name): ?>
                    <button class="py-1 px-2 btn-sm nav-link <?php
                    if ($language_default == $language): ?>active<?php
                    endif ?>" id="nav-<?= $key ?>-<?= $language ?>-tab" data-toggle="tab"
                            data-target="#nav-<?= $key ?>-<?= $language ?>"
                            type="button" role="tab" aria-controls="nav-<?= $key ?>-<?= $language ?>"
                            aria-selected="<?php
                            if ($language_default == $language): ?>true<?php
                            else: ?>false<?php
                            endif ?>"><?= $name ?></button>
                <?php
                endforeach; ?>
            </div>
        </nav>
        <div class="tab-content setting-tab-content" id="nav-tabContent-<?= $key ?>">
            <?php
            foreach ($languages as $language => $name): ?>
                <div class="tab-pane fade <?php
                if ($language_default == $language): ?>show active<?php
                endif ?>" id="nav-<?= $key ?>-<?= $language ?>" role="tabpanel"
                     aria-labelledby="nav-<?= $key ?>-<?= $language ?>-tab">
                    <textarea class="form-control input_normal" id="<?= $key ?>" name="<?= $key ?>[<?= $language ?>]"
                              rows="5"><?= $setting['value'] ? $setting['value'][$language] : '' ?></textarea>
                </div>
            <?php
            endforeach; ?>
        </div>
    </div>
<?php
endif ?>

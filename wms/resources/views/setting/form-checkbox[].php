<?php
/**
 * @var $key
 * @var $setting
 */

use Admin\Helper;

?>

<div class="form-group">
    <label><?= Helper::_($setting['name']) ?></label>
    <div>
        <?php
        foreach ($setting['options'] as $val => $name): ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="<?= $val ?>" name="<?= $key ?>[]"
                       <?php
                       if (in_array($val, $setting['value'])): ?>checked<?php
                endif; ?>
                       id="<?= $key ?>-<?= $val ?>">
                <label class="form-check-label" for="<?= $key ?>-<?= $val ?>">
                    <?= Helper::_($name) ?>
                </label>
            </div>
        <?php
        endforeach; ?>
    </div>
</div>

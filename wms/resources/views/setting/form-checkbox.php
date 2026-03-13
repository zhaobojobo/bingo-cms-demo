<?php
/**
 * @var $key
 * @var $setting
 */

use Admin\Helper;

?>
<div class="form-group form-check d-flex align-items-center">
    <input class="form-check-input mb-1" type="checkbox" value="1"
        <?php
        if ($setting['value']): ?> checked<?php
        endif ?> name="<?= $key ?>" id="<?= $key ?>">
    <label class="form-check-label" for="<?= $key ?>">
        <?= Helper::_($setting['name']) ?>
    </label>
</div>

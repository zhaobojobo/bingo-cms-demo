<?php
/**
 * @var $key
 * @var $setting
 * @var $settings
 */

use Admin\Helper;
$options = $setting['options'];
if (is_string($options)) {
    $k = $options;
    $_options = [];
    foreach ($settings[$k]['options'] as $value => $name) {
        if (in_array($value, $settings[$k]['value'])) {
            $_options[$value] = $name;
        }
    }
    $options = $_options;
}
?>
<div class="form-group">
    <label for="<?= $key ?>"><?= Helper::_($setting['name']) ?></label>
    <select class="form-control input_normal" id="<?= $key ?>" name="<?= $key ?>">
        <?php
        foreach ($options as $value => $name): ?>
            <option value="<?= $value ?>" <?php
            if ($setting['value'] == $value): ?>selected<?php
            endif ?>>
                <?= $name ?>
            </option>
        <?php
        endforeach; ?>
    </select>
</div>

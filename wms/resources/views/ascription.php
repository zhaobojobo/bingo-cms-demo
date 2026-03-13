<?php

use Admin\Helper; ?>
<div class="col-md-6 col-lg">
    <div class="input-block p-2">
        <label for="agency"><?= Helper::_('Agency') ?></label>
        <select name="agency" id="agency" class="input_normal">
            <option value=""><?= Helper::_('None') ?></option>
        </select>
        <label for="reviewer"><?= Helper::_('Reviewer') ?></label>
        <select name="reviewer" id="reviewer" class="input_normal">
            <option value=""><?= Helper::_('None') ?></option>
        </select>
        <label for=""><?= Helper::_('Editors') ?></label>
        <div class="form-group">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="editor1"
                       name="" value="option1">
                <label class="form-check-label" for="editor1">editor 1</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="editor2"
                       name="" value="option2">
                <label class="form-check-label" for="editor2">editor 2</label>
            </div>
        </div>
    </div>
</div>
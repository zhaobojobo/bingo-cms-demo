<?php
/**@var $data */

use Admin\Helper;

?>

<?php foreach ($data['editors'] as $i => $editor): ?>
    <div class="agency-all">
        <?php if ($editor['agency'] != null): ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input agency" type="checkbox" id="editors-agency-<?= $i ?>">
                <label class="form-check-label" for="editors-agency-<?= $i ?>"><?= $editor['agency']->getName(
                    ); ?></label>
            </div>
        <?php else: ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input agency" type="checkbox" id="editors-agency-<?= $i ?>">
                <label class="form-check-label" for="editors-agency-<?= $i ?>"><?= Helper::_('None'); ?></label>
            </div>
        <?php endif; ?>
        <div class="ml-4 users">
            <?php foreach ($editor['users'] as $k => $user): ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="editor-<?= $i ?>-<?= $k ?>" name="editors[]"
                           value="<?= $user['id'] ?>">
                    <label class="form-check-label" for="editor-<?= $i ?>-<?= $k ?>"><?= $user['username'] ?></label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>

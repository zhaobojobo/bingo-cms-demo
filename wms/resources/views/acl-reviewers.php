<?php
/**@var $data */

use Admin\Helper;

?>

<?php foreach ($data['reviewers'] as $i => $reviewer): ?>
    <div class="agency-all">
        <?php if ($reviewer['agency'] != null): ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input agency" type="checkbox" id="reviewers-agency-<?= $i ?>">
                <label class="form-check-label" for="reviewers-agency-<?= $i ?>"><?= $reviewer['agency']->getName(
                    ); ?></label>
            </div>
        <?php else: ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input agency" type="checkbox" id="reviewers-agency-<?= $i ?>">
                <label class="form-check-label" for="reviewers-agency-<?= $i ?>"><?= Helper::_('None'); ?></label>
            </div>
        <?php endif; ?>
        <div class="ml-4 users">
            <?php foreach ($reviewer['users'] as $k => $user): ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="reviewer-<?= $i ?>-<?= $k ?>" name="reviewers[]"
                           value="<?= $user['id'] ?>">
                    <label class="form-check-label" for="reviewer-<?= $i ?>-<?= $k ?>"><?= $user['username'] ?></label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>

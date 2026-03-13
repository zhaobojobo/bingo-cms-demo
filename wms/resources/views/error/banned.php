<?php

use Admin\Helper;

/** @var $data */
$this->insert('header', ['data' => $data]);
?>

<main class="pb-3">
    <div class="container py-5">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading"><?= Helper::_('Operation prohibited') ?></h4>
            <p><?= Helper::_(
                    'The current operation has been disabled.'
                ) ?><span class="timer" data-time="5"></span></p>
        </div>
    </div>
</main>
<?php
$this->insert('footer', ['data' => $data]); ?>

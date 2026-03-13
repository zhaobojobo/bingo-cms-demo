<?php

/** @var $data */
$this->insert('header', ['data' => $data]);

?>
    <main class="pb-3">
        <div class="container py-5">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading"><?= $data['title'] ?></h4>
                <p><?= $data['message'] ?></p>
            </div>
        </div>
    </main>

<?php $this->insert('footer', ['data' => $data]); ?>
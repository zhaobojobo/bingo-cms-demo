<?php
/**@var $page */ ?>

<?php
$this->layout('layouts/main');
?>

<main class="main">
    <div class="container">
        <div class="content text-center d-flex flex-column justify-content-center align-items-center"
             style="min-height: 50vh">
            <h1>訂閱確認</h1>
            <p><?= $page['message'] ?></p>
        </div>
    </div>
</main>

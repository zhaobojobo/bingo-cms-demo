<?php
/**
 * view data
 *
 * @var $site
 * @var $seo
 * @var $page
 */ ?>

<?php
$this->layout('layouts/main');
?>

<main>
    <?= $this->fetch('partials/page-header', ['nid' => 3]); ?>
    <?= $this->fetch('partials/contact'); ?>
    <?= $this->fetch('partials/other-city'); ?>
    <?= $this->fetch('partials/enquiries'); ?>
</main>

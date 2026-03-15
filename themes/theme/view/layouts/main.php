<?php
/**
 * view data
 *
 * @var $lang
 */

$site = setting('site');
?>

<!doctype html>
<html lang="<?= $lang ?>">
<!-- Html Head ------><?= $this->fetch('partials/head', ['site' => $site]); ?><!-- /Html head -->
<body>
<!-- Page Header ----><?= $this->fetch('partials/header', ['site' => $site]); ?><!-- /Page Header -->
<?= $this->section('custom_header') ?>
<!-- Page Content ---><?= $this->section('content') ?><!-- /Page Content -->
<!-- Page Footer ----><?= $this->fetch('partials/footer', ['site' => $site]); ?><!-- /Page Footer -->
<!-- Page Scripts ---><?= $this->fetch('partials/scripts'); ?><!-- /Page Scripts -->
<?= $this->section('custom_footer') ?>
</body>
</html>

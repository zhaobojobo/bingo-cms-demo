<?php

use Admin\Helper;

/**@var $data */
$this->insert('header', ['data' => $data]);
?>

<main class="pb-3" style="padding-top: 130px;">
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-xl-6 index_left">

                <div class="welcome">
                    <h2><?= Helper::_('You website is currently protected by') ?>
                        <br/>
                        <?= Helper::_('BINGO SECURITY SYSTEM') ?></h2>
                    <span>
                        <?= Helper::_('Next yearly check of system:') ?>
                        <?php
                        if (date("m") > 5) {
                            echo date("m/Y", strtotime('+1 year'));
                        } else {
                            echo date("m/Y");
                        }
                        ?>
                    </span>
                </div>

                <div class="container">
                    <?php
                    require_once 'check_size.php';
                    $size_limit = 5 * 1024 * 1024 * 1024; // 5 GB
                    $disk_used = foldersize($data['PATHS']['root']);
                    $disk_remaining = $size_limit - $disk_used;
                    format_size($disk_used);
                    format_size($disk_remaining);
                    $used_percentage = $disk_used / $size_limit * 100;
                    switch (true) {
                        case $used_percentage >= 75 && $used_percentage < 95:
                            $used_class = "bg-warning";
                            $used_textclass = "text-warning";
                            $used_text = "<br/>您的寄存容量即將滿額，請盡快聯絡我們加大容量，以免造成數據遺失。";
                            break;
                        case $used_percentage >= 95:
                            $used_class = "bg-danger";
                            $used_textclass = "text-danger";
                            $used_text = "<br/>您的寄存容量只餘下極少量，請盡快聯絡我們加大容量，以免造成數據遺失。";
                            break;
                        default:
                            $used_class = "";
                            $used_textclass = "";
                            $used_text = "";
                            break;
                    }
                    ?>

                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-6">
                            <div class="admin_check_box wow fadeInDown" data-wow-delay="0.1s">
                                <h3><?= $data['protection']['today_protection_times'] ?></h3>
                                <span><?= Helper::_('No. of times protected') ?></span>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 col-6">
                            <div class="admin_check_box wow fadeInDown" data-wow-delay="0.2s">
                                <h3><?= $data['protection']['total_protection_times'] ?></h3>
                                <span><?= Helper::_('Total no. of times protected') ?></span>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 col-6">
                            <div class="admin_check_box wow fadeInDown" data-wow-delay="0.3s">
                                <h3 class="scaning">5</h3>
                                <span><?= Helper::_('Files scanning') ?></span>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 col-6">
                            <div class="admin_check_box wow fadeInDown" data-wow-delay="0.4s">
                                <h3>0</h3>
                                <span><?= Helper::_('Risk found') ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="index_log">
                                <h4><?= Helper::_('Back-end action records') ?>
                                    <a class="more_button bingo_button middle_button"
                                       href="<?= Helper::getUrl('/actions/') ?>">
                                        <?= Helper::_('More') ?>+
                                    </a>
                                </h4>
                                <table class="table table-responsive-md bingo_table">
                                    <thead>
                                    <tr>
                                        <th><?= Helper::_('Time') ?></th>
                                        <th><?= Helper::_('Account') ?></th>
                                        <th><?= Helper::_('Action') ?></th>
                                        <th>IP</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($data['actions'] as $action) : ?>
                                        <tr>
                                            <td><?= $action['time'] ?></td>
                                            <td><?= $action['admin'] ?></td>
                                            <td><?= $action['action'] ?></td>
                                            <td><?= $action['ip'] ?></td>
                                        </tr>
                                    <?php
                                    endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 index_right">
                <div class="container mb-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="box wow fadeInRight" data-wow-delay="0.7s" style="width: 80%">
                                <div class="scale">
                                    <div class="item">
                                        <video controls muted autoplay playsinline>
                                            <source src="https://www.hk-bingo.com/video/bingo.mp4" type="video/mp4">
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script type="text/javascript" src="<?= Helper::staticUrl() ?>/js/index_code.js"></script>
<?php
$this->insert('footer', ['data' => $data]); ?>

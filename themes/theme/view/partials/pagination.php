<?php

/**@var $result */

use Site\Helper;

$numSize = 0;
$totalPage = 1;

$p = Helper::get('p', 1);

if ($result['total'] > 0) {
    $totalPage = ceil($result['total'] / $result['size']);
}

if ($p > $totalPage) {
    $p = $totalPage;
}
if ($p < 1) {
    $p = 1;
}

$start = 1;
$end = $totalPage;
if ($p - 1 > $numSize) {
    $start = $p - $numSize;
}
if ($totalPage - $p > $numSize) {
    $end = $p + $numSize;
}
?>
<div class="pages-navbar">
    <ul class="pagination">
        <?php
        if ($p > 1): ?>
            <li><a href="<?= Helper::pageLink($p - 1) ?>"><i class="fa fa-angle-left"></i></a></li>
        <?php
        else: ?>
            <li><span><i class="fa fa-angle-left"></i></span></li>
        <?php
        endif; ?>
        <?php
        if ($start != 1): ?>
            <li><a href="<?= Helper::pageLink(1) ?>">1</a></li>
        <?php
        endif; ?>
        <?php
        if ($start - 1 > 1): ?>
            <li><span class="etc">…</span></li>
        <?php
        endif; ?>
        <?php
        for ($i = $start; $i <= $end; $i++): ?>
            <?php
            if ($i == $p): ?>
                <li><span class="active"><?= $i ?></span></li>
            <?php
            else: ?>
                <li><a href="<?= Helper::pageLink($i) ?>"><?= $i ?></a></li>
            <?php
            endif; ?>
        <?php
        endfor; ?>
        <?php
        if ($totalPage - $end > 1): ?>
            <li><span class="etc">…</span></li>
        <?php
        endif; ?>
        <?php
        if ($end != $totalPage): ?>
            <li><a href="<?= Helper::pageLink($totalPage) ?>"><?= $totalPage ?></a></li>
        <?php
        endif; ?>
        <?php
        if ($p < $totalPage): ?>
            <li><a href="<?= Helper::pageLink($p + 1) ?>"><i class="fa fa-angle-right"></i></a></li>
        <?php
        else: ?>
            <li><span><i class="fa fa-angle-right"></i></span></li>
        <?php
        endif; ?>
    </ul>
</div>

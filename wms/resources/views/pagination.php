<?php

use Admin\Helper;

/**@var $data */

$numSize = 2;
$start   = 1;
if ($data['pageData']) {
    $end = $data['pageData']['totalPages'];
    if ($data['pageData']['page'] - 1 > $numSize) {
        $start = $data['pageData']['page'] - $numSize;
    }
    if ($data['pageData']['totalPages'] - $data['pageData']['page'] > $numSize) {
        $end = $data['pageData']['page'] + $numSize;
    }
}
?>

<?php if ($data['pageData']) : ?>
    <nav class="bingo_pagnation py-2">
        <ul class="pagination justify-content-center m-0">
            <?php if ($data['pageData']['page'] > 1) : ?>
                <li class="page-item">
                    <a class="page-link"
                       href="<?= Helper::pageLink(
                           $data['pageData']['page'] - 1
                       ) ?>"
                       aria-label="Previous">
                        <i class="fa fa-angle-left"></i>
                    </a>
                </li>
            <?php else : ?>
                <li class="page-item">
        <span class="page-link">
            <i class="fa fa-angle-left"></i>
        </span>
                </li>
            <?php endif; ?>
            <?php if ($start != 1) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= Helper::pageLink(1) ?>">1</a>
                </li>
            <?php endif; ?>
            <?php if ($start - 1 > 1) : ?>
                <li class="page-item">
                    <span class="page-link etc">…</span>
                </li>
            <?php endif; ?>
            <?php for ($i = $start; $i <= $end; $i++) : ?>
                <?php if ($i == $data['pageData']['page']) : ?>
                    <li class="page-item">
                        <span class="page-link active"><?= $i ?></span>
                    </li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link"
                                             href="<?= Helper::pageLink($i) ?>"><?= $i ?></a>
                    </li>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($data['pageData']['totalPages'] - $end > 1) : ?>
                <li class="page-item">
                    <span class="page-link etc">…</span>
                </li>
            <?php endif; ?>
            <?php if ($end != $data['pageData']['totalPages']) : ?>
                <li class="page-item">
                    <a class="page-link"
                       href="<?= Helper::pageLink(
                           $data['pageData']['totalPages']
                       ) ?>"><?= $data['pageData']['totalPages'] ?></a>
                </li>
            <?php endif; ?>
            <?php if ($data['pageData']['page'] < $data['pageData']['totalPages']) : ?>
                <li class="page-item">
                    <a class="page-link"
                       href="<?= Helper::pageLink(
                           $data['pageData']['page'] + 1
                       ) ?>" aria-label="Next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            <?php else : ?>
                <li class="page-item">
        <span class="page-link">
            <i class="fa fa-angle-right"></i>
        </span>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>
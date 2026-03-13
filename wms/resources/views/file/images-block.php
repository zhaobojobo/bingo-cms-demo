<?php

/**@var $data */

use Admin\Helper;

?>

<?php
foreach ($data['pageData']['rows'] as $row) : ?>
    <div class="col-6 col-sm-4 col-md-3 col-lg-2 input-image">
        <div class="box image">
            <div class="thumb image-thumb">
                <a href="javascript:void(0)">
                    <img src="<?= Helper::thumb($row['link']) ?>" data-src="<?= $row['link'] ?>" alt="">
                    <span class="check">
                        <i class="fa fa-fw fa-check-square-o" aria-hidden="true"></i>
                    </span>
                </a>
            </div>
            <div class="image-acts">
                <a class="btn-edit-image" href="javascript:void(0)">
                    <i class="fa fa-fw fa-crop" aria-hidden="true"></i>
                </a>
                <a href="<?= $row['link'] ?>" data-fancybox="gallery">
                    <i class="fa fa-fw fa-search-plus" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
<?php
endforeach; ?>

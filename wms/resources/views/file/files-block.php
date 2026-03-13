<?php

/**@var $data */

use Admin\Helper;

?>

<?php
foreach ($data['pageData']['rows'] as $row) :
    $_tmp = explode('/', $row['filename']);
    $filename = array_pop($_tmp);
    ?>
    <div class="col-md-6 col-lg-4 input-image">
        <div class="box image">
            <div class="thumb file-thumb">
                <a href="javascript:void(0)">
                    <span class="file" data-src="<?= $row['link'] ?>">
                        <span><?= Helper::fileIcon($row['link']) ?></span>
                        <span><?= $filename ?></span>
                    </span>
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

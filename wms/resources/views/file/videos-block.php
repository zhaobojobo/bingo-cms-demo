<?php

/**@var $data */

?>

<?php
foreach ($data['pageData']['rows'] as $row) : ?>
    <div class="col-sm-4 col-md-3 input-image">
        <div class="box image">
            <div class="thumb video-thumb">
                <a href="javascript:void(0)">
                    <video src="<?= $row['link'] ?>" data-src="<?= $row['link'] ?>"></video>
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
                    <i class="fa fa-fw fa-play-circle" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
<?php
endforeach; ?>

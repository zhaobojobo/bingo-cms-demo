<?php
/**@var $slides */

/**@var $id */
?>

<?php
if ($slides): ?>
    <div class="slideshow" id="<?= $id ?>">
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php
                foreach ($slides as $i => $slide): ?>
                    <div class="swiper-slide">
                        <img src="<?= $slide->image ?>" alt="<?= $i ?>">
                    </div>
                <?php
                endforeach; ?>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button swiper-button-next"></div>
            <div class="swiper-button swiper-button-prev"></div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
<?php
endif; ?>

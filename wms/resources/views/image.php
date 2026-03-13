<?php

use Admin\Helper;

/**@var $data */
?>
<div class="image-editor" id="image-editor">
    <div class="container py-3">
        <div class="row">
            <div class="col-xl-9">
                <div class="img-container"></div>
            </div>
            <div class="col-xl-3">
                <div class="docs-preview clearfix">
                    <div class="img-preview preview-lg"></div>
                    <div class="img-preview preview-md"></div>
                    <div class="img-preview preview-sm"></div>
                    <div class="img-preview preview-xs"></div>
                </div>
                <div class="docs-data">
                    <div class="input-group input-group-sm">
                        <span class="input-group-prepend">
                          <label class="input-group-text" for="dataX">X</label>
                        </span>
                        <input type="text" class="form-control" id="dataX" placeholder="x">
                        <span class="input-group-append">
                          <span class="input-group-text">px</span>
                        </span>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-prepend">
                          <label class="input-group-text" for="dataY">Y</label>
                        </span>
                        <input type="text" class="form-control" id="dataY" placeholder="y">
                        <span class="input-group-append">
                          <span class="input-group-text">px</span>
                        </span>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-prepend">
                          <label class="input-group-text" for="dataWidth">Width</label>
                        </span>
                        <input type="text" class="form-control" id="dataWidth" placeholder="width">
                        <span class="input-group-append">
                          <span class="input-group-text">px</span>
                        </span>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-prepend">
                          <label class="input-group-text" for="dataHeight">Height</label>
                        </span>
                        <input type="text" class="form-control" id="dataHeight" placeholder="height">
                        <span class="input-group-append">
                          <span class="input-group-text">px</span>
                        </span>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-prepend">
                          <label class="input-group-text" for="dataRotate">Rotate</label>
                        </span>
                        <input type="text" class="form-control" id="dataRotate" placeholder="rotate">
                        <span class="input-group-append">
                          <span class="input-group-text">deg</span>
                        </span>
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-prepend">
                          <label class="input-group-text" for="dataScaleX">ScaleX</label>
                        </span>
                        <input type="text" class="form-control" id="dataScaleX" placeholder="scaleX">
                    </div>
                    <div class="input-group input-group-sm">
                        <span class="input-group-prepend">
                          <label class="input-group-text" for="dataScaleY">ScaleY</label>
                        </span>
                        <input type="text" class="form-control" id="dataScaleY" placeholder="scaleY">
                    </div>
                </div>
                <div class="docs-toggles my-3">
                    <div class="btn-group d-flex flex-nowrap" data-toggle="buttons">
                        <label class="btn btn-primary active">
                            <input type="radio" class="sr-only" id="aspectRatio0" name="aspectRatio"
                                   value="1.7777777777777777">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="<?= Helper::_('Aspect Ratio') ?>: 16 / 9">
                            16:9
                        </span>
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio"
                                   value="1.3333333333333333">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="<?= Helper::_('Aspect Ratio') ?>: 4 / 3">
                            4:3
                        </span>
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="<?= Helper::_('Aspect Ratio') ?>: 1 / 1">
                            1:1
                        </span>
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio"
                                   value="0.6666666666666666">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="<?= Helper::_('Aspect Ratio') ?>: 2 / 3">
                            2:3
                        </span>
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="NaN">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="<?= Helper::_('Free Ratio') ?>">
                            Free
                        </span>
                        </label>
                    </div>
                </div>
                <div class="docs-buttons my-3 d-flex justify-content-between align-items-center flex-wrap">
                    <!-- <h3>Toolbar:</h3> -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move"
                                title="<?= Helper::_('Move') ?>">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
                            <span class="fa fa-fw fa-arrows"></span>
                        </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop"
                                title="<?= Helper::_('Crop') ?>">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
                            <span class="fa fa-fw fa-crop"></span>
                        </span>
                        </button>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="reset"
                                title="<?= Helper::_('Reset') ?>">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
                                <span class="fa fa-fw fa-refresh"></span>
                            </span>
                        </button>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1"
                                title="<?= Helper::_('Zoom In') ?>">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
                            <span class="fa fa-fw fa-search-plus"></span>
                        </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1"
                                title="<?= Helper::_('Zoom Out') ?>">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
                            <span class="fa fa-fw fa-search-minus"></span>
                        </span>
                        </button>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="move" data-option="-10"
                                data-second-option="0" title="<?= Helper::_('Move Left') ?>">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
                            <span class="fa fa-fw fa-arrow-left"></span>
                        </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="move" data-option="10"
                                data-second-option="0" title="<?= Helper::_('Move Right') ?>">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
                            <span class="fa fa-fw fa-arrow-right"></span>
                        </span>
                        </button>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="move" data-option="0"
                                data-second-option="-10" title="<?= Helper::_('Move Up') ?>">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
                            <span class="fa fa-fw fa-arrow-up"></span>
                        </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="move" data-option="0"
                                data-second-option="10" title="<?= Helper::_('Move Down') ?>">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
                            <span class="fa fa-fw fa-arrow-down"></span>
                        </span>
                        </button>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45"
                                title="<?= Helper::_('Rotate Left') ?>">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
                            <span class="fa fa-fw fa-rotate-left"></span>
                        </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="rotate" data-option="45"
                                title="<?= Helper::_('Rotate Right') ?>">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
                            <span class="fa fa-fw fa-rotate-right"></span>
                        </span>
                        </button>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1"
                                title="<?= Helper::_('Flip Horizontal') ?>">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
                            <span class="fa fa-fw fa-arrows-h"></span>
                        </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1"
                                title="<?= Helper::_('Flip Vertical') ?>">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
                            <span class="fa fa-fw fa-arrows-v"></span>
                        </span>
                        </button>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="crop"
                                title="<?= Helper::_('Crop') ?>">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
                            <span class="fa fa-fw fa-check"></span>
                        </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="clear"
                                title="<?= Helper::_('Clear') ?>">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
                            <span class="fa fa-fw fa-times"></span>
                        </span>
                        </button>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-method="disable"
                                title="<?= Helper::_('Disable') ?>">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
                            <span class="fa fa-fw fa-lock"></span>
                        </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-method="enable"
                                title="<?= Helper::_('Enable') ?>">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
                            <span class="fa fa-fw fa-unlock"></span>
                        </span>
                        </button>
                    </div>
                </div>

                <div class="docs-buttons d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-info cancel mb-0"><?= Helper::_('Cancel') ?></button>
                    <span>&nbsp;&nbsp;</span>
                    <button type="button" class="btn btn-success mb-0" data-method="getCroppedCanvas"
                            data-option="{ &quot;maxWidth&quot;: 4096, &quot;maxHeight&quot;: 4096 }">
                        <span class="docs-tooltip" data-toggle="tooltip" data-animation="false">
                            <?= Helper::_('Ok') ?>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <!-- Show the cropped image in modal -->
                <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true"
                     aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="getCroppedCanvasTitle"><?= Helper::_(
                                        'Cropped Result'
                                    ) ?></h5>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="<?= Helper::_('Close') ?>">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= Helper::_(
                                        'Close'
                                    ) ?></button>
                                <a class="btn btn-primary" id="download" href="javascript:void(0);"
                                   download="cropped.jpg"
                                   data-api="<?= Helper::getUrl('/crop/upload') ?>"><?= Helper::_('Save') ?></a>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal -->

            </div><!-- /.docs-buttons -->

            <div class="col-md-3">
                <!-- <h3>Toggles:</h3> -->

            </div><!-- /.docs-toggles -->
        </div>
    </div>
</div>

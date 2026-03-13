<?php

/**@var $data */

use Admin\Helper;

?>
<style>
    @-webkit-keyframes rotation {
        from {
            -webkit-transform: rotate(0deg);
        }
        to {
            -webkit-transform: rotate(360deg);
        }
    }

    .status-info .info {
        display: none;
    }

    .status-info .notice {
        display: block;
    }

    .status-info i.fa {
        font-size: 1.25rem;
    }

    .status-info .notice i.fa {
        color: red;
    }

    .status-info .waiting i.fa {
        color: blue;
    }

    .status-info .error i.fa {
        color: red;
    }

    .status-info .success i.fa {
        color: green;
    }

    .status-info .waiting i.fa {
        -webkit-transform: rotate(360deg);
        animation: rotation 3s linear infinite;
        -moz-animation: rotation 3s linear infinite;
        -webkit-animation: rotation 3s linear infinite;
        -o-animation: rotation 3s linear infinite;
    }
</style>
<div class="modal fade" id="import-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
     aria-labelledby="import-modal-label"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= Helper::_('Import Data') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= $data['import_action'] ?>" method="post">
                    <input type="hidden" name="type" value="<?= $data['type'] ?? '' ?>">
                    <div class="form-group">
                        <label for="upload-import-files">文件</label>
                        <input type="file" multiple class="form-control-file" id="upload-import-files"
                               name="import_file">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between align-items-center">
                <div class="status-info">
                    <div class="notice info">
                        <i class="fa fa-fw fa-exclamation-circle" aria-hidden="true"></i>
                        <span class="notice-message message">導入不可撤銷, 請謹慎操作!</span>
                    </div>
                    <div class="waiting info">
                        <i class="fa fa-fw fa-spinner" aria-hidden="true"></i>
                        <span class="waiting-message message">正在導入, 請稍後...</span>
                    </div>
                    <div class="error info">
                        <i class="fa fa-fw fa-times-circle" aria-hidden="true"></i>
                        <span class="error-message message"></span>
                    </div>
                    <div class="success info">
                        <i class="fa fa-fw fa-check-circle" aria-hidden="true"></i>
                        <span class="success-message message"></span>
                    </div>
                </div>
                <div></div>
                <div class="buttons">
                    <button type="button"
                            class="btn btn-primary data-import-submit">
                        <?= Helper::_('Import') ?>
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <?= Helper::_('Close') ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // 數據導入
    (function ($) {
        var modal = $('#import-modal');
        var form = modal.find('form');
        var submitBtn = modal.find('.data-import-submit');
        var $statusInfo = modal.find('.status-info');
        submitBtn.on('click', function (event) {
            event.preventDefault();
            var data = new FormData();
            submitBtn.prop('disabled', true);
            form.find('[name]').each(function (i, e) {
                switch ($(e).attr('type')) {
                    case 'radio':
                    case 'checkbox':
                        if ($(e).prop('checked')) {
                            data.set($(e).attr('name'), $(e).val());
                        }
                        break;
                    case 'file':
                        let files = $(e).prop('files');
                        data.set($(e).attr('name'), '');
                        if (files.length === 1) {
                            data.set($(e).attr('name'), files[0]);
                        } else if (files.length > 1) {
                            let k = 0;
                            for (let file of files) {
                                data.set($(e).attr('name') + '[' + k++ + ']', file);
                            }
                        }
                        break;
                    default:
                        data.set($(e).attr('name'), $(e).val());
                }
            });

            // console.log(data);

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: data,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (result, status, xhr) {
                    // console.log(result);
                    if (!result.status) {
                        $statusInfo.find('.info').hide();
                        $statusInfo.find('.error-message').text(result.message);
                        $statusInfo.find('.info.error').show();
                    }
                    if (result.status) {
                        $statusInfo.find('.info').hide();
                        $statusInfo.find('.success-message').text(result.data.count + ' 條數據已匯入');
                        $statusInfo.find('.info.success').show();
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                },
                complete: function (xhr, status) {

                }
            }).done(function () {
                submitBtn.prop('disabled', false);
            });

            return false;
        });
        modal.on('show.bs.modal', function () {
            $statusInfo.find('.info').hide();
            $statusInfo.find('.info.notice').show();
            submitBtn.prop('disabled', false);
            form[0].reset();
        });
    })(jQuery);
</script>

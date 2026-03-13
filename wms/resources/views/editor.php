<?php

use Admin\Helper;

/**@var $data */
?>
<style>
    .fr-desktop .fr-modal-wrapper div.fr-modal-body div.fr-image-list div.fr-image-container:hover svg.fr-delete-img {
        display: none;
    }

    div.fr-modal-body div.fr-image-list div.fr-image-container .fr-insert-img {
        left: 65%;
    }
</style>
<span>
    <button type="button" class="btn btn-sm btn-info btn-content-templates"
            data-toggle="modal"
            data-target="#content-templates-modal"
            data-api="<?= Helper::getUrl('/templates/') ?>"
            data-editor="content_<?= $data['langId'] ?>"
    >
        <?= Helper::_('Templates') ?>
    </button>
</span>
<textarea name="<?= Helper::dataFieldName($data['langId'], 'content') ?>"
          id="content_<?= $data['langId'] ?>" class="editor-<?= $data['langId'] ?>"><?= $data['content'] ?></textarea>
<script>
    var editors = editors || {};
    (function () {
        const editorEl = ".editor-<?= $data['langId'] ?>";
        const editorName = "content_<?= $data['langId'] ?>";
        editors[editorName] = new FroalaEditor(editorEl, {
            theme: 'dark',
            language: '<?= $data['langId'] ?>',
            fontFamily: {
                "微軟正黑體,sans-serif": '微軟正黑體',
                "Roboto,sans-serif": 'Roboto',
                "Montserrat,sans-serif": 'Montserrat',
                "'Open Sans Condensed',sans-serif": 'Open Sans Condensed'
            },
            paragraphFormat: {
                N: 'Normal',
                H1: 'Heading 1',
                H2: 'Heading 2',
                H3: 'Heading 3',
                H4: 'Heading 4',
                H5: 'Heading 5',
                H6: 'Heading 6',
                PRE: 'Code'
            },
            autofocus: true,
            fontFamilySelection: true,
            tableResizerOffset: 10,
            tableResizingLimit: 50,

            heightMin: 200,

            imageManagerLoadURL: "<?=Helper::getUrl('/froala/images/')?>",

            // Set the file upload parameter.
            fileUploadParam: 'file_data',
            // Set the file upload URL.
            fileUploadURL: '<?=Helper::getUrl("/froala/upload/file")?>',
            // Additional upload params.
            fileUploadParams: {},
            // Set request type.
            fileUploadMethod: 'POST',
            // Set max file size to 20MB.
            fileMaxSize: 20 * 1024 * 1024,
            // Allow to upload any file.
            fileAllowedTypes: ['*'],

            // Set the image upload parameter.
            imageUploadParam: 'file_data',
            // Set the image upload URL.
            imageUploadURL: '<?=Helper::getUrl("/froala/upload/image")?>',
            // Additional upload params.
            imageUploadParams: {},
            // Set request type.
            imageUploadMethod: 'POST',
            // Set max image size to 5MB.
            imageMaxSize: 8 * 1024 * 1024,
            // Allow to upload PNG and JPG.
            imageAllowedTypes: ['jpeg', 'jpg', 'png'],

            // Set the video upload parameter.
            videoUploadParam: 'file_data',
            // Set the video upload URL.
            videoUploadURL: '<?=Helper::getUrl("/froala/upload/video")?>',
            // Additional upload params.
            videoUploadParams: {},
            // Set request type.
            videoUploadMethod: 'POST',
            // Set max video size to 50MB.
            videoMaxSize: 50 * 1024 * 1024,
            // Allow to upload MP4, WEBM and OGG
            videoAllowedTypes: ['mp4', 'webm', 'ogg'],

            events: {
                'image.beforeUpload': function (images) {
                    // Return false if you want to stop the image upload.
                },
                'image.uploaded': function (response) {
                    // Image was uploaded to the server.
                },
                'image.inserted': function ($img, response) {
                    // Image was inserted in the editor.
                },
                'image.replaced': function ($img, response) {
                    // Image was replaced in the editor.
                },

                'video.beforeUpload': function (videos) {
                    // Return false if you want to stop the video upload.
                },
                'video.uploaded': function (response) {
                    // Video was uploaded to the server.
                },
                'video.inserted': function ($img, response) {
                    // Video was inserted in the editor.
                },
                'video.replaced': function ($img, response) {
                    // Video was replaced in the editor.
                },

                'image.error': function (error, response) {

                    // Bad link.
                    if (error.code == 1) {
                    }
                    // No link in upload response.
                    else if (error.code == 2) {
                    }
                    // Error during image upload.
                    else if (error.code == 3) {
                    }
                    // Parsing response failed.
                    else if (error.code == 4) {
                    }
                    // Image too text-large.
                    else if (error.code == 5) {
                    }
                    // Invalid image type.
                    else if (error.code == 6) {
                    }
                    // Image can be uploaded only to same domain in IE 8 and IE 9.
                    else if (error.code == 7) {
                    }
                    //
                    else if (error.code == 10) {
                    }
                    // Error during request.
                    else if (error.code == 11) {
                    }
                    // Missing imagesLoadURL option.
                    else if (error.code == 12) {
                    }
                    // Parsing response failed.
                    else if (error.code == 13) {
                    }
                },

                'video.error': function (error, response) {
                    // Bad link.
                    if (error.code == 1) {
                    }

                    // No link in upload response.
                    else if (error.code == 2) {
                    }

                    // Error during video upload.
                    else if (error.code == 3) {
                    }

                    // Parsing response failed.
                    else if (error.code == 4) {
                    }

                    // Video too text-large.
                    else if (error.code == 5) {
                    }

                    // Invalid video type.
                    else if (error.code == 6) {
                    }

                    // Video can be uploaded only to same domain in IE 8 and IE 9.
                    else if (error.code == 7) {
                    }

                    // Response contains the original server response to the request if available.
                },
            }
        });
        setTimeout(function () {
            var block = $(editorEl).parents('.editor-block');
            var btn = $('<div class="fr-btn-grp fr-float-left"></div>').append(block.find('[data-target="#content-templates-modal"]'));

            block.find('.fr-toolbar').find('.fr-btn-grp.fr-float-left').last().after(btn);
            // console.log($('.fr-toolbar').find('.fr-btn-grp.fr-float-left').last().after(btn));
        }, 0);
    })();
</script>

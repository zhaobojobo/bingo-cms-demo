(function () {
    $('#files-upload-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var language = button.data('lang');
        var uploadUrl = button.data('url');
        var modal = $(this);
        var message = [];
        modal.find("input[type='file']").fileinput({
            language: language,
            uploadUrl: uploadUrl,
            enableResumableUpload: false,
            uploadExtraData: {
                // 'uploadToken': 'SOME-TOKEN', // for access control / security
            },
            maxFileCount: 0,
            // allowedFileTypes: ['image'],    // allow only images
            showCancel: true,
            initialPreviewAsData: true,
            overwriteInitial: false,
            // initialPreview: [],          // if you have previously uploaded preview files
            // initialPreviewConfig: [],    // if you have previously uploaded preview files
            theme: 'fas',
            // deleteUrl: ""
        }).on('fileuploaded', function (event, data, previewId, index) {
            var status = data.response.status;
            if (status) {
                location.reload();
            } else {
                message.push(data.response.message);
            }
        }).on('filebatchuploadcomplete', function (event, preview, config, tags, extraData) {
            if (message.length > 0) {
                error(message.join('<br>'));
            }
            modal.find("input[type='file']").fileinput('clear');
            modal.find('[data-dismiss="modal"]').trigger('click');
        });
    })
})();

(function () {
    var button;
    var modal = $('#files-select-modal');
    var loadBtn = modal.find('.load-more-files');
    var fileInput = modal.find("input[type='file']");
    var loadMoreFile = function (api, q) {
        var p = modal.data('p');
        if (p <= 0) {
            alert('全部数据已加载');
        } else {
            var btnText = loadBtn.text();
            var url = api + '?p=' + p;
            if (q) {
                url = api + '?p=' + p + '&q=' + q;
            }
            modal.data('loading', 1);
            modal.find('.load-more-files').text('loading...');
            $.get(url, function (res) {
                modal.data('loading', 0);
                modal.find('.load-more-files').text(btnText);
                var pageInfo = res.data.pageInfo;
                var nextPage = pageInfo.page + 1;
                if (nextPage > pageInfo.totalPages) {
                    nextPage = 0;
                }
                modal.find('.box.list>.row').append(res.data.files);
                modal.data('p', nextPage);
            });
        }
    };
    modal.find('.load-more-files').on('click', function () {
        if (modal.data('loading') == 1) {
            error('正在加载， 请稍候...');
        } else {
            loadMoreFile(modal.data(button.data('type')), modal.find('[name="q"]').val());
        }
    });
    fileInput.on('fileuploaded', function (event, data, previewId, index) {
        var status = data.response.status;
        if (status) {
            var src = data.response.data.link;
            var thumb = data.response.data.thumb;
            var imageItem = '';
            if (button.data('type') == 'image') {
                imageItem = `<div class="col-6 col-sm-4 col-md-3 col-lg-2 input-image">
                        <div class="box image">
                            <div class="thumb image-thumb">
                                <a href="javascript:void(0)">
                                    <img src="${thumb}" data-src="${src}" alt="">
                                    <span class="check">
                                        <i class="fa fa-fw fa-check-square-o" aria-hidden="true"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="image-acts">
                                <a class="btn-edit-image" href="javascript:void(0)">
                                    <i class="fa fa-fw fa-crop" aria-hidden="true"></i>
                                </a>
                                <a href="${src}" data-fancybox="gallery">
                                    <i class="fa fa-fw fa-search-plus" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>`;
                modal.find('.box.list>.row').prepend(imageItem);
            } else if (button.data('type') == 'video') {
                var src = data.response.data.link;
                imageItem = `<div class="col-sm-4 col-md-3 input-image">
                        <div class="box image">
                            <div class="thumb video-thumb">
                                <a href="javascript:void(0)">
                                    <video src="${src}"></video>
                                    <span class="check">
                                        <i class="fa fa-fw fa-check-square-o" aria-hidden="true"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="image-acts">
                                <a class="btn-edit-image" href="javascript:void(0)">
                                    <i class="fa fa-fw fa-crop" aria-hidden="true"></i>
                                </a>
                                <a href="${src}" data-fancybox="gallery">
                                    <i class="fa fa-fw fa-search-plus" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>`;
                modal.find('.box.list>.row').prepend(imageItem);
            } else if (button.data('type') == 'file') {
                var src = data.response.data.link;
                var filename = src.replace(/^.*[\\\/]/, '');
                imageItem = `<div class="col-md-6 col-lg-4 input-image">
                        <div class="box image">
                            <div class="thumb file-thumb">
                                <a href="javascript:void(0)">
                                    <span class="file" data-src="${src}">
                                        ${filename}
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
                                <a href="${src}" data-fancybox="gallery">
                                    <i class="fa fa-fw fa-search-plus" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>`;
                modal.find('.box.list>.row').prepend(imageItem);
            }
        } else {
            error(data.response.message);
        }
    }).on('filebatchuploadcomplete', function () {
        fileInput.fileinput('reset');
    });
    modal.on('shown.bs.modal', function (event) {
        modal.data('p', 1);
        modal.data('loading', 0);
        button = $(event.relatedTarget);
        modal.find('.box.list>.row').empty();
        loadMoreFile(modal.data(button.data('type')));
        fileInput.fileinput({
            uploadUrl: function () {
                return button.data('upload')
            },
            language: button.data('lang'),
            enableResumableUpload: false,
            uploadExtraData: {
                // 'uploadToken': 'SOME-TOKEN', // for access control / security
            },
            maxFileCount: 0,
            // allowedFileTypes: ['image'],    // allow only images
            showCancel: true,
            initialPreviewAsData: false,
            overwriteInitial: true,
            // initialPreview: [],          // if you have previously uploaded preview files
            // initialPreviewConfig: [],    // if you have previously uploaded preview files
            theme: 'fas',
            // deleteUrl: ""
        });
    });
    modal.find('.btn.ok').on('click', function () {
        if (button.data('type') == 'image') {
            var $target = modal.find('.thumb.checked');
            if (button.data('more') === 0) {
                if ($target.length <= 0) {
                    error($(this).data('tip'));
                } else {
                    var $image = $target.find('img');
                    var $rel = button.parents('.input-image');
                    let thumb = $image.attr('src');
                    let image = $image.data('src');
                    var tag = $(`<div class="image-thumb"><a href="${image}" data-fancybox><img src="${thumb}" /></a></div>`);
                    var input = $rel.find("input[type='hidden']");
                    var preview = $rel.find('.preview');
                    $rel.addClass('exist');
                    input.val($image.data('src'));
                    preview.empty().append(tag);
                    modal.find('[data-dismiss="modal"]').trigger('click');
                }
            } else {
                var $targets = modal.find('.thumb.checked');
                if ($targets.length <= 0) {
                    error($(this).data('tip'));
                } else {
                    var values = [];
                    var exists = [];
                    var $rel = button.parents('.input-image');
                    var input = $rel.find("input[type='hidden']");
                    var preview = $rel.find('.preview');
                    preview.find('.image-thumb.no-content').remove();
                    var existImages = preview.find('img');
                    existImages.each(function () {
                        exists.push($(this).attr('src'));
                    });
                    var setValues = function () {
                        preview.find('img').each(function () {
                            values.push($(this).data('src'));
                        });
                        input.val(JSON.stringify(values));
                    }

                    $targets.each(function () {
                        let $item = $(this).find('img');
                        let thumb = $item.attr('src');
                        let image = $item.data('src');
                        let data = $item.data('src');
                        if (-1 == $.inArray(thumb, exists)) {
                            let tag = `<div class="image-thumb ui-sortable-handle"><button type="button" class="remove"><i class="fa fa-fw fa-remove"></i></button><a data-fancybox href="${image}"><img src="${thumb}" data-src="${data}" /></a></div>`;
                            preview.append(tag);
                        }
                    });
                    if ($targets.length > 0) {
                        $rel.addClass('exist');
                    }
                    setValues();
                    modal.find('[data-dismiss="modal"]').trigger('click');
                }
            }
        } else if (button.data('type') == 'video') {
            var $target = modal.find('.thumb.checked');
            if ($target.length <= 0) {
                error($(this).data('tip'));
            } else {
                var $image = $target.find('video');
                var src = $image.attr('src');
                var $rel = button.parents('.input-image');
                var tag = $(`<div class="image-thumb video-thumb"><a href="${src}" data-fancybox><video src="${src}"></video></a></div>`);
                var preview = $rel.find('.preview');
                $rel.addClass('exist');
                $rel.find("input[type='hidden']").val($image.data('src'));
                preview.empty().append(tag);
                modal.find('[data-dismiss="modal"]').trigger('click');
            }
        } else if (button.data('type') == 'file') {
            var $target = modal.find('.thumb.checked');
            if ($target.length <= 0) {
                error($(this).data('tip'));
            } else {
                var $image = $target.find('.file');
                var src = $image.data('src');
                var text = $image.html();
                var $rel = button.parents('.input-image');
                var tag = $(`<div class="image-thumb file-thumb"><a href="${src}" data-fancybox><span>${text}</span></a></div>`);
                var preview = $rel.find('.preview');
                $rel.addClass('exist');
                $rel.find("input[type='hidden']").val(src);
                preview.empty().append(tag);
                modal.find('[data-dismiss="modal"]').trigger('click');
            }
        }
    });
    modal.find('.box.list').on('click', '.thumb', function () {
        if (!button.data('more')) {
            $(this).parents('.input-image').siblings().find('.thumb').removeClass('checked');
        }
        $(this).toggleClass('checked');
    });
    modal.find('[name="q"]').on('keydown', function () {
        $(this).removeClass('is-invalid');
    });
    modal.find('button.btn-search').on('click', function () {
        modal.data('p', 1);
        modal.find('.box.list>.row').empty();
        loadMoreFile(modal.data(button.data('type')), modal.find('[name="q"]').val());
    });
})();

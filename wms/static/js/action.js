const $ = window.jQuery;

function timer(num, callback) {
    if (typeof callback === 'function') {
        +function () {
            var _self = arguments.callee;
            callback(num);
            if (--num >= 0) {
                window.setTimeout(function () {
                    _self();
                }, 1000);
            }
        }();
    }
    return false;
}

(function () {
    $('.timer').on('wait', function () {
        const that = this;
        const time = $(this).data('time');
        timer(time ? time : 5, function (num) {
            if (num > 0) {
                $(that).html('(<span>' + num + ' 秒后返回！</span>)');
            } else {
                history.back();
            }
        });
    }).trigger('wait');
})();

function error(message, callback) {
    layer.open({
        icon: 2, title: 'There was a problem', content: message, btn: [], end: function (index, layero) {
            layer.close(index);
            if (callback) {
                callback();
            }
        }
    });
}

function success(message, callback) {
    if (!message) {
        if (callback) {
            callback();
        }
    } else {
        layer.open({
            icon: 1, title: 'SUCCESS', content: message, btn: [], end: function (index, layero) {
                layer.close(index);
                if (callback) {
                    callback();
                }
            }
        });
    }
}

function sort(sortRows) {
    const api = sortRows.data('api');
    sortRows.find(".sortable").sortable({
        update: function (event, ui) {
            const items = $(this).find('li');
            let length = items.length;
            let sorts = {};
            items.each(function (i, n) {
                sorts[$(this).data('id')] = length--;
            });
            $.post(api, {sorts: sorts}, function (res) {
                console.log(res);
            }, 'json');
        }
    });
}

(function () {
    $(document).on('click', 'a.delete', function () {
        const that = this;
        layer.confirm('確定要刪除嗎？', {
            btn: ['確定', '再想想'] //按钮
        }, function () {
            $.post($(that).attr('href'), {'id': $(that).data('id')}, function (res) {
                if (res) {
                    if (res.status) {
                        location.reload();
                    } else {
                        error(res.message);
                    }
                }
            }, 'json');
        }, function () {

        });
        return false;
    });
})();

(function () {
    $('.switch-language').find('a').on('click', function () {
        var that = this;
        $.get($(that).data('api'), function (res) {
            location.href = $(that).attr('href');
        }, 'json');
        return false;
    });
})();

(function () {
    var $parent = $('#model_parent_id');
    var $first = $parent.find('option').first();
    $('#model_group').on('change', function () {
        if ($(this).val()) {
            $.post($parent.data('api'), {id: $parent.data('id'), group: $(this).val()}, function (res) {
                if (res) {
                    if (res.status) {
                        $parent.empty().append($first).append(res.data);
                    } else {
                        error(res.message);
                    }
                }
            }, 'json');
        } else {
            $parent.empty().append($first);
        }
    }).trigger('change');
})();

(function () {
    var $navType = $('#nav-type');
    var $navData = $('#nav-data');
    $navType.on('change', function () {
        if ($(this).val()) {
            var data = {};
            if ($(this).val() === 'customize') {
                data.url = $navData.data('url');
            } else if ($(this).val() === 'group') {
                data.url = $navData.data('url');
            } else {
                data.target_id = $navData.data('target_id');
            }
            $.get($(this).data('api') + $(this).val(), data, function (res) {
                if (res) {
                    if (res.status) {
                        $navData.empty().append(res.data);
                    } else {
                        error(res.message);
                    }
                }
            }, 'json');
        } else {
            $navData.empty();
        }
    }).trigger('change');
})();

(function () {
    var $navData = $('#nav-data');
    $(document).on('change', '[name="target_id"]', function () {
        if ($('[name="sync_title"]').prop('checked')) {
            let type = $('[name="type"]').val();
            let NavText = $('.navText');
            if (type === 'group') {
                if (!NavText.val()) {
                    NavText.val('Nav Group');
                }
            } else if (type === 'customize') {
                if (!NavText.val()) {
                    NavText.val('Customize Nav');
                }
            }
            if (type === 'page' || type === 'catalog') {
                $.get($navData.data('target') + '/' + type + '/' + $(this).val(), function (res) {
                    if (res.data.length > 0) {
                        $.each(res.data, function () {
                            $('#text-' + this.lang).val(this.text);
                        });
                    }
                });
            }
        }
    });
})();

(function () {
    var $slug = $('.edit-slug');
    var value = '';
    var moveEnd = function (obj) {
        obj.focus();
        var len = obj.value.length;
        if (document.selection) {
            var sel = obj.createTextRange();
            sel.moveStart('character', len);
            sel.collapse();
            sel.select();
        } else if (typeof obj.selectionStart == 'number' && typeof obj.selectionEnd == 'number') {
            obj.selectionStart = obj.selectionEnd = len;
        }
    };
    $slug.on('dblclick', function () {
        value = $(this).find('input').val();
        $(this).addClass('focus');
        $(this).find('span').hide();
        $(this).find('label').show().trigger('click');
        moveEnd($(this).find('input').get(0));
    });
    $slug.find('input').on('blur', function () {
        $(this).parents('.edit-slug').removeClass('focus').find('span').html($(this).val()).show();
        $(this).parent().hide();
    }).on('keydown', function (e) {
        if (e.keyCode === 13) {
            $(this).trigger('blur');
        }
    }).on('change', function () {
        var that = this;
        var slug = $(this).val();
        var api = $(this).parents('.edit-slug').data('api');
        $.post(api, {'slug': slug}, function (res) {
            if (!res.status) {
                error(res.message, function () {
                    $(that).parents('.edit-slug').find('span').html(value);
                });
            }
        }, 'json');
    });
})();

(function () {
    var $sort = $('.edit-sort');
    var value = '';
    var moveEnd = function (obj) {
        obj.focus();
        var len = obj.value.length;
        if (document.selection) {
            var sel = obj.createTextRange();
            sel.moveStart('character', len);
            sel.collapse();
            sel.select();
        } else if (typeof obj.selectionStart == 'number' && typeof obj.selectionEnd == 'number') {
            obj.selectionStart = obj.selectionEnd = len;
        }
    };
    $sort.on('dblclick', function () {
        value = $(this).find('input').val();
        $(this).addClass('focus');
        $(this).find('span').hide();
        $(this).find('label').show().trigger('click');
        moveEnd($(this).find('input').get(0));
    });
    $sort.find('input').on('blur', function () {
        $(this).parents('.edit-sort').removeClass('focus').find('span').html($(this).val()).show();
        $(this).parent().hide();
    }).on('keydown', function (e) {
        if (e.keyCode === 13) {
            $(this).trigger('blur');
        }
    }).on('change', function () {
        var that = this;
        var sort = $(this).val();
        var api = $(this).parents('.edit-sort').data('api');
        $.post(api, {'sort': sort}, function (res) {
            if (!res.status) {
                error(res.message, function () {
                    $(that).parents('.edit-sort').find('span').html(value);
                });
            }
        }, 'json');
    });
})();

(function () {
    var $statusSwitch = $('.status-switch');
    $statusSwitch.find('[type="checkbox"]').on('click', function () {
        var that = this;
        var data = {};
        data[$(this).data('status')] = Number($(this).prop('checked'));
        $.post($(this).data('api'), data, function (res) {
            if (!res.status) {
                error(res.message, function () {
                    if (res.reload) {
                        location.reload();
                    }
                });
            } else {
                $(that).next('.bingo_button').toggleClass('button-green button-red').find('i.fa').toggleClass('fa-check fa-ban');
                $(that).parent().find('.bingo_button.status2').toggleClass('d-none');
            }
        }, 'json');
    });
    $statusSwitch.on('click', '.bingo_button', function () {
        $(this).parent().find('[type="checkbox"]').trigger('click');
    });
})();

(function () {
    var $model = $('#authorize-modal');
    var $forms = $model.find('form');
    var $reviewerChecker = $model.find('#reviewer-checks');
    var $editorsChecker = $model.find('#editor-checks');

    $model.on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        $model.find('form [name="id"]').val(button.data('id'));
        $.get(button.data('finder'), function (res) {
            var reviewers = res.data.reviewers.split(',');
            var editors = res.data.editors.split(',');

            $.post($model.data('reviewers'), function (res) {
                $reviewerChecker.empty().html(res.data.html);
                setTimeout(function () {
                    $reviewerChecker.find('.users input[type="checkbox"]').each(function () {
                        if ($.inArray($(this).val(), reviewers) !== -1) {
                            $(this).trigger('click');
                        }
                    });
                }, 0);
            });
            $.post($model.data('editors'), function (res) {
                $editorsChecker.empty().html(res.data.html);
                setTimeout(function () {
                    $editorsChecker.find('.users input[type="checkbox"]').each(function () {
                        if ($.inArray($(this).val(), editors) !== -1) {
                            $(this).trigger('click');
                        }
                    });
                }, 0);
            });
        });
    });

    $model.find('.grant-save').on('click', function () {
        var n = 0;
        $forms.each(function () {
            var that = this;
            $.post($(that).attr('action'), $(that).serialize(), function (ret) {
                n = n + 1;
                if (n === $forms.length && ret.status) {
                    success('data has been saved', function () {
                        $model.find('button[data-dismiss="modal"]').trigger('click');
                    });
                }
            });
        });
    });

    $forms.on('change', 'input.agency[type="checkbox"]', function () {
        $(this).parents('.agency-all').find('.users [type="checkbox"]').prop('checked', $(this).prop('checked'));
    });
    $forms.on('change', '.users input[type="checkbox"]', function () {
        var n = $(this).parents('.users').find('input[type="checkbox"]').length;
        var c = $(this).parents('.users').find('input[type="checkbox"]:checked').length;
        if (c === 0) {
            $(this).parents('.agency-all').find('input.agency[type="checkbox"]').prop('checked', false);
        } else {
            $(this).parents('.agency-all').find('input.agency[type="checkbox"]').prop('checked', true);
        }
    });
})();

(function () {
    const $viewBtn = $('a.btn-view');
    const $previewBtn = $('form#form .btn.preview');
    const previewCallback = function (res, btn) {
        if (res.status) {
            $.get($(btn).data('api') + res.data.id, function (res) {
                window.open(res, 'preview');
            }, 'json');
        } else {
            error(res.message);
        }
    };
    const submitCallback = function (res) {
        if (res.status) {
            success(res.message, function () {
                if (res.redirect) {
                    location.href = res.redirect;
                } else {
                    location.reload();
                }
            });
        } else {
            error(res.message);
        }
    };
    const loadHistories = function () {
        const $el = $('#history_id');
        if ($el.length > 0) {
            $.get($el.data('api'), function (res) {
                $el.empty().append(res);
            });
        }
    };
    loadHistories();
    $('#load-history').on('click', function () {
        var id = $('#history_id').val();
        if (id) {
            location.href = $(this).data('api') + '?hid=' + id;
        } else {
            location.href = $(this).data('api');
        }
    });
    $(document).on('click', 'form#form button.submit', function () {
        var editors = window.editors || undefined;
        const $form = $('form#form');
        if (editors) {
            for (j = 0, len = editors.length; j < len; j++) {
                editors[j].updateElement();
            }
        }
        $.post($form.attr('action'), $form.serialize(), function (res) {
            if (res) {
                submitCallback(res);
            } else {
                error('系統錯誤');
            }
        }, 'json');
        return false;
    });
    $previewBtn.on('click', function () {
        const that = this;
        const $form = $('form#form');
        $.post($form.attr('action') + '?preview=1', $form.serialize(), function (res) {
            if (res) {
                if (res.status) {
                    $form.find('input[name="id"]').val(res.data.id);
                    previewCallback(res, that);
                } else {
                    error(res.message);
                }
            } else {
                error('系統錯誤');
            }
        }, 'json');
        return false;
    });
    $viewBtn.on('click', function () {
        $.get($(this).attr('href'), function (res) {
            window.open(res, 'preview');
        }, 'json');
        return false;
    });
})();

(function () {
    $('table #all').on('change', function () {
        $(this).parents('table').find('tbody input[name="id[]"]').prop('checked', $(this).prop('checked'));
    });
    $('.sort-list #all').on('change', function () {
        $(this).parents('.sort-list').find('input[name="id[]"]').prop('checked', $(this).prop('checked'));
    });
})();

(function () {
    $('#export-posts-modal').on('show.bs.modal', function (event) {
        var modal = $(this);
        var button = $(event.relatedTarget);
        modal.find('.btn-export').off('click').on('click', function () {
            var $form = modal.find('form');
            $form.attr('action', button.data('api'));
            if (!$form.find('[name="langId"]').val()) {
                error('Please Select Language');
            } else {
                $form.trigger('submit');
            }
        });
    });
})();

(function () {
    $('#export-members-modal').on('show.bs.modal', function (event) {
        var modal = $(this);
        var button = $(event.relatedTarget);
        modal.find('.btn-export').off('click').on('click', function () {
            var $form = modal.find('form');
            $form.attr('action', button.data('api'));
            $form.trigger('submit');
        });
    });
})();

(function () {
    $('#export-subscriber-modal').on('show.bs.modal', function (event) {
        var modal = $(this);
        var button = $(event.relatedTarget);
        modal.find('.btn-export').off('click').on('click', function () {
            var $form = modal.find('form');
            $form.attr('action', button.data('api'));
            $form.trigger('submit');
        });
    });
})();

(function () {
    $('#export-submissions-modal').on('show.bs.modal', function (event) {
        var modal = $(this);
        var button = $(event.relatedTarget);
        modal.find('.btn-export').off('click').on('click', function () {
            var $form = modal.find('form');
            $form.attr('action', button.data('api'));
            $form.trigger('submit');
        });
    });
})();

(function () {
    $('#export-donation-modal').on('show.bs.modal', function (event) {
        var modal = $(this);
        var button = $(event.relatedTarget);
        modal.find('.btn-export').off('click').on('click', function () {
            var $form = modal.find('form');
            $form.attr('action', button.data('api'));
            $form.trigger('submit');
        });
    });
})();

(function () {
    $('#message-modal').on('show.bs.modal', function (event) {
        var modal = $(this);
        modal.find('.save-message').off('click').on('click', function () {
            var $form = modal.find('form');
            $.post($form.attr('action'), $form.serialize(), function (res) {
                if (res.status) {
                    modal.find('button[data-dismiss="modal"]').trigger('click');
                    location.reload();
                } else {
                    error(res.message);
                }
            }, 'json');
        });
    });
    $('.edit-message').on('click', function () {
        var $modal = $('#message-modal');
        $.get($(this).data('api'), function (res) {
            $modal.find('input[name="id"]').val(res.data.id);
            $modal.find('input[name="key"]').val(res.data.key);
            $modal.find('input[name="en_gb"]').val(res.data.en_gb);
            $modal.find('input[name="zh_hk"]').val(res.data.zh_hk);
            $modal.find('input[name="zh_cn"]').val(res.data.zh_cn);
            $modal.find('input[name="description"]').val(res.data.description);
        }, 'json');
    });
    $('.add-message').on('click', function () {
        var $modal = $('#message-modal');
        $modal.find('form')[0].reset();
        $modal.find('form input[name="id"]').val('');
    });
})();

(function () {
    $('.btn-copy').on('click', function () {
        $.post($(this).attr('href'), function (res) {
            if (res.status) {
                if (res.redirect) {
                    location.href = res.redirect;
                } else {
                    location.reload();
                }
            } else {
                error(res.message);
            }
        }, 'json');
        return false;
    });
})();

(function () {
    $('.btn-batch-copy').on('click', function () {
        var ids = [];
        var $inputs = $('.sort-list').find('input[name="id[]"]:checked');
        if ($inputs.length === 0) {
            error('Please select target rows');
            return false;
        }
        $inputs.each(function () {
            ids.push($(this).val());
        });
        $.post($(this).attr('href'), {ids: ids}, function (res) {
            if (res.status) {
                if (res.redirect) {
                    location.href = res.redirect;
                } else {
                    location.reload();
                }
            } else {
                error(res.message);
            }
        }, 'json');
        return false;
    });
})();

(function () {
    $('.btn-batch-del').on('click', function () {
        var ids = [];
        var $inputs = $('.sort-list').find('input[name="id[]"]:checked');
        if ($inputs.length === 0) {
            error('Please select target rows');
            return false;
        }
        $inputs.each(function () {
            ids.push($(this).val());
        });
        $.post($(this).attr('href'), {ids: ids}, function (res) {
            if (res.status) {
                if (res.redirect) {
                    location.href = res.redirect;
                } else {
                    location.reload();
                }
            } else {
                error(res.message);
            }
        }, 'json');
        return false;
    });
})();

(function () {
    $('.btn-batch-del-files').on('click', function () {
        var ids = [];
        var $inputs = $('.files-table').find('input[name="id[]"]:checked');
        if ($inputs.length === 0) {
            error('Please check target files');
            return false;
        }
        $inputs.each(function () {
            ids.push($(this).val());
        });
        $.post($(this).attr('href'), {ids: ids}, function (res) {
            if (res.status) {
                if (res.redirect) {
                    location.href = res.redirect;
                } else {
                    location.reload();
                }
            } else {
                error(res.message);
            }
        }, 'json');
        return false;
    });
})();

(function () {
    var $modal = $('#password-modal');
    var $form = $modal.find('form');
    var $password = $form.find('#password');
    var $confirm = $form.find('#confirm_password');
    var $submit = $modal.find('.submit-password');
    var $inputs = $form.find('input.password');
    var valid = function (event) {
        if ($password.val() !== $confirm.val()) {
            $confirm.addClass('is-invalid');
            $submit.prop('disabled', true);
        } else {
            $confirm.removeClass('is-invalid');
            $submit.prop('disabled', false);
        }
    };
    $submit.on('click', function () {
        $.post($form.attr('action'), $form.serialize(), function (res) {
            if (res.status) {
                success(res.message, function () {
                    $modal.find('button[data-dismiss="modal"]').trigger('click');
                });
            } else {
                error(res.message);
            }
        }, 'json');
    });
    $modal.on('show.bs.modal', function (event) {
        $form.trigger('reset');
        $form.find('[name="id"]').val($(event.relatedTarget).data('id'));
        valid();
    });
    $inputs.on('keypress', valid).on('blur', valid);
})();


(function () {
    $('#detail-modal').on('show.bs.modal', function (event) {
        var modal = $(this);
        var button = $(event.relatedTarget);
        var tbody = modal.find('table tbody');
        $.get(button.data('api'), function (res) {
            console.log(res.data);
            tbody.empty();
            $.each(res.data, function (i, n) {
                tbody.append('<tr><td class="text-right px-3">' + i + '</td><td class="px-3">' + n + '</td></tr>');
            });
        }, 'json')
    });
})();

(function () {
    $('#volunteer-detail-modal').on('show.bs.modal', function (event) {
        var modal = $(this);
        var button = $(event.relatedTarget);
        var body = modal.find('.modal-body');
        $.get(button.data('api'), function (res) {
            console.log(res.data);
            body.empty().append(res.data.html);
        }, 'json')
    });
})();

(function () {
    $('#form-html-modal').on('show.bs.modal', function (event) {
        var modal = $(this);
        var button = $(event.relatedTarget);
        $.get(button.attr('href'), function (res) {
            if (res.status) {
                $.each(res.data, function (i, n) {
                    modal.find('code#form-code-' + i).empty().append(n);
                })
            } else {
                error(res.message, function () {
                    modal.find('[data-dismiss="modal"]').trigger('click');
                });
            }
        }, 'json')
    });
})();

(function () {
    var $model = $('#content-templates-modal');
    var activeEditor;
    $model.find('[data-dismiss="modal"]').on('click', function () {
        setTimeout(function () {
            if (activeEditor) {
                activeEditor.cursor.enter(true);
            }
        }, 0);
    });
    $model.on('show.bs.modal', function (event) {
        var modal = $(this);
        var button = $(event.relatedTarget);
        modal.off('click', '.templates-image a').on('click', '.templates-image a', function (e) {
            var div = '.bingo-' + $(this).data('template');
            // var langId = button.parents('.edit-section').data('lang');
            activeEditor = editors[button.data('editor')];
            $.get(button.data('api') + $(this).data('template'), function (res) {
                if (res.status) {
                    // var val = editors[langId].html.get();
                    // editors[langId].html.set(val + res.data);
                    activeEditor.html.insert(res.data);
                    setTimeout(function () {
                        var $anchor = button.parents('.edit-section').find(div).last();
                        if ($anchor.length >= 1) {
                            $("html, body").animate({scrollTop: $anchor.offset().top - 100}, 1000);
                        }
                        activeEditor.cursor.enter(true);
                    }, 500);
                } else {
                    error(res.message);
                }
            }, 'json');
        });
        $.get(modal.data('api'), function (res) {
            if (res.status) {
                modal.find('.modal-body .templates-image').empty();
                $.each(res.data, function (i, n) {
                    var img = '<div class="col-3 py-2 logo-image">' + '<a href="javascript:void(0)" data-template="' + n.template + '">' + '<img alt="" src="' + n.image + '" />' + '</a>' + '</div>';
                    modal.find('.modal-body .templates-image').append(img);
                });
            } else {
                error(res.message, function () {
                    modal.find('[data-dismiss="modal"]').trigger('click');
                });
            }
        }, 'json');
    });
})();

(function () {
    $('.submission-detail').on('click', function () {
        $(this).next('button').trigger('click');
        return false;
    });
    $('#submission-detail-modal').on('show.bs.modal', function (event) {
        var modal = $(this);
        var button = $(event.relatedTarget);
        var body = modal.find('.modal-body').empty();
        $.get(button.data('api'), function (res) {
            if (res.status) {
                body.append(res.data);
            } else {
                error(res.message, function () {
                    modal.find('[data-dismiss="modal"]').trigger('click');
                });
            }
        }, 'json');
    });
})();

(function () {
    $('input#member_group').on('change', function () {
        $(this).parents('form').find('.member-groups input[type="checkbox"]').prop('checked', $(this).prop('checked'));
    });
    $('#send-subscription').on('show.bs.modal', function (event) {
        var modal = $(this);
        var button = $(event.relatedTarget);
        var body = modal.find('.modal-body');
        body.find('form input[name="id"]').val(button.data('id'));
    });
    $('.subscription-send').on('click', function () {
        $.post($(this).attr('href'), function (res) {
            if (res.status) {
                success(res.message, function () {
                    location.reload();
                });
            } else {
                error(res.message);
            }
        }, 'json');
        return false;
    });
})();

(function () {
    var $root = $('.permissions-tree');
    var $checks = $root.find('[type="checkbox"]');
    $checks.on('click', function () {
        $(this).parent().next('.accesses').find('[type="checkbox"]').prop('checked', $(this).prop('checked'));
    });
    $checks.on('change', function () {
        var checked = $(this).prop('checked');
        var $parents = $(this).parent().parent('.accesses').prev('.form-check').find('[type="checkbox"]');
        if (checked) {
            $parents.prop('checked', checked).trigger('change');
        }
    });
})();

(function () {
    var modal = $('#service-address-modal');
    var load = function () {
        var $box = $('.service-addresses');
        if ($box.length > 0) {
            $.get($box.data('api'), function (res) {
                $box.empty().append(res.data.html);
                sort($box.find('.sort-rows'));
            });
        }
    }
    load();
    modal.on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var body = modal.find('.modal-body').empty();
        $.get(button.data('api'), function (res) {
            body.append(res.data.html);
        });
    });
    $(document).on('click', 'form#service-address-form button.submit', function () {
        const $form = $('form#service-address-form');
        $.post($form.attr('action'), $form.serialize(), function (res) {
            if (res) {
                modal.find('[data-dismiss="modal"]').trigger('click');
                load();
            } else {
                error('系統錯誤');
            }
        }, 'json');
        return false;
    });
    $(document).on('click', 'a.service-address-delete', function () {
        $.post($(this).attr('href'), {'id': $(this).data('id')}, function (res) {
            if (res) {
                if (res.status) {
                    load();
                } else {
                    error(res.message);
                }
            } else {
                error('系統錯誤');
            }
        }, 'json');
        return false;
    });
})();

(function () {
    var modal = $('#inquire-type-modal');
    var load = function () {
        var $box = $('.inquire-types');
        if ($box.length > 0) {
            $.get($box.data('api'), function (res) {
                $box.empty().append(res.data.html);
                sort($box.find('.sort-rows'));
            });
        }
    }
    load();
    modal.on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var body = modal.find('.modal-body').empty();
        $.get(button.data('api'), function (res) {
            body.append(res.data.html);
        });
    });
    $(document).on('click', 'form#inquire-type-form button.submit', function () {
        const $form = $('form#inquire-type-form');
        $.post($form.attr('action'), $form.serialize(), function (res) {
            if (res) {
                modal.find('[data-dismiss="modal"]').trigger('click');
                load();
            } else {
                error('系統錯誤');
            }
        }, 'json');
        return false;
    });
    $(document).on('click', 'a.inquire-type-delete', function () {
        $.post($(this).attr('href'), {'id': $(this).data('id')}, function (res) {
            if (res) {
                if (res.status) {
                    load();
                } else {
                    error(res.message);
                }
            } else {
                error('系統錯誤');
            }
        }, 'json');
        return false;
    });
})();

(function () {
    var modal = $('#service-center-modal');
    var load = function () {
        var $box = $('.service-centers');
        if ($box.length > 0) {
            $.get($box.data('api'), function (res) {
                $box.empty().append(res.data.html);
                sort($box.find('.sort-rows'));
            });
        }
    }
    load();
    modal.on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var body = modal.find('.modal-body').empty();
        $.get(button.data('api'), function (res) {
            body.append(res.data.html);
        });
    });
    $(document).on('click', 'form#service-center-form button.submit', function () {
        const $form = $('form#service-center-form');
        $.post($form.attr('action'), $form.serialize(), function (res) {
            if (res) {
                modal.find('[data-dismiss="modal"]').trigger('click');
                load();
            } else {
                error('系統錯誤');
            }
        }, 'json');
        return false;
    });
    $(document).on('click', 'a.service-center-delete', function () {
        $.post($(this).attr('href'), {'id': $(this).data('id')}, function (res) {
            if (res) {
                if (res.status) {
                    load();
                } else {
                    error(res.message);
                }
            } else {
                error('系統錯誤');
            }
        }, 'json');
        return false;
    });
})();

(function () {
    var $role = $('select#role_id');
    var role = $role.val();
    $('select#agency_id').on('change', function () {
        var agency = $(this).val();
        $role.find('option').each(function () {
            $(this).css({'display': ''});
            if (agency != 0) {
                $(this).prop('selected', false)
                if ($(this).data('agency') != agency) {
                    $(this).css({'display': 'none'});
                } else {
                    if ($(this).val() == role) {
                        $(this).prop('selected', true);
                    }
                }
            }
        });
    }).trigger('change');
})();


(function () {
    $('#export-messages-modal').on('show.bs.modal', function (event) {
        var modal = $(this);
        var button = $(event.relatedTarget);
        modal.find('.btn-export').off('click').on('click', function () {
            var $form = modal.find('form');
            $form.attr('action', button.data('api'));
            $form.trigger('submit');
            setTimeout(function () {
                modal.find('button[data-dismiss="modal"]').trigger('click');
            }, 1000);
        });
        modal.find('.btn-export').trigger('click');
    });
})();

(function () {
    $(document).on('click', 'button.btn-delete-image', function () {
        var placeholder = '';
        var type = $(this).data('type');
        if (type == 'image') {
            placeholder = `<div class="image-thumb no-content">No Image</div>`;
        } else if (type == 'images') {
            placeholder = `<div class="image-thumb no-content">No Images</div>`;
        } else if (type == 'video') {
            placeholder = `<div class="image-thumb video-thumb no-content">No Video</div>`;
        } else if (type == 'file') {
            placeholder = `<div class="image-thumb file-thumb no-content">No File</div>`;
        }
        $(this).parents('.input-image').find('[type="hidden"]').val('');
        $(this).parents('.input-image').removeClass('exist');
        $(this).parents('.input-image').find('.preview').empty().append(placeholder);
    });
    $(document).on('click', '.input-image button.remove', function (e) {
        let images = [];
        var input = $(this).parents('.input-image').find('input[type="hidden"]');
        var preview = $(this).parents('.preview');
        var thumb = $(this).parent();
        thumb.remove();
        preview.find('.image-thumb').each(function () {
            images.push($(this).find('img').data('src'));
        });
        if (images.length == 0) {
            preview.append(`<div class="image-thumb no-content">
                No Images
            </div>`);
        }
        input.val(JSON.stringify(images));
    });
})();

(function () {
    $('#extend-field').on('show.bs.modal', function (event) {
        var modal = $(this);
        var button = $(event.relatedTarget);
        var body = modal.find('.modal-body');
        $.get(button.data('api'), function (res) {
            if (res.status) {
                body.empty().append(res.data);
            }
        }, 'json')
    });
    $(document).on('submit', '#list-field-form', function (e) {
        e.preventDefault();
        let form = $(this);
        $.post(form.attr('action'), form.serialize(), function (res) {
            if (res.status) {
                location.reload();
            } else {
                error(res.message);
            }
        }, 'json');
        return false;
    });
})();

(function () {
    $('#list-fields-modal').on('shown.bs.modal', function (event) {
        var fieldListModal = $(this);
        var fieldListButton = $(event.relatedTarget);
        $.get(fieldListButton.data('api'), function (res) {
            fieldListModal.find('.modal-body').empty().append(res.data);
            sort(fieldListModal.find('.sort-rows'));
        }, 'json');
        $(document).off('click', '.list-field-delete').on('click', '.list-field-delete', function (e) {
            e.preventDefault();
            $.post($(this).attr('href'), {id: $(this).data('id')}, function (res) {
                if (res.status) {
                    $.get(fieldListButton.data('api'), function (res) {
                        fieldListModal.find('.modal-body').empty().append(res.data);
                    }, 'json');
                }
            }, 'json');
            return false;
        });
        $(document).off('shown.bs.modal', '#extend-list-field').on('shown.bs.modal', '#extend-list-field', function (event) {
            var fieldEditModal = $(this);
            var fieldEditButton = $(event.relatedTarget);
            var body = fieldEditModal.find('.modal-body');
            $.get(fieldEditButton.data('api'), function (res) {
                if (res.status) {
                    body.empty().append(res.data);
                } else {
                    erorr(res.message);
                }
            }, 'json');
            $(document).off('submit', '#list-field-form2').on('submit', '#list-field-form2', function (e) {
                e.preventDefault();
                let form = $(this);
                $.post(form.attr('action'), form.serialize(), function (res) {
                    if (res.status) {
                        fieldEditModal.find('[data-dismiss="modal"]').trigger('click');
                        $.get(fieldListButton.data('api'), function (res) {
                            fieldListModal.find('.modal-body').empty().append(res.data);
                        }, 'json');
                    } else {
                        error(res.message);
                    }
                }, 'json');
                return false;
            });
        });
    });
})();

(function () {
    var $rows = $('ul.sortable > li');
    $rows.each(function (i, row) {
        var that = row;
        $(row).children('div.row').find('span.children-toggle').on('click', function () {
            var $children = $(that).children('ul.sortable');

            $(this).toggleClass('open');
            $(this).find('i.fa').toggleClass('fa-plus-square-o fa-minus-square-o');

            $(that).parents('ul.sortable').height('auto');

            if ($(this).hasClass('open')) {
                var height = 0;
                $children.children('li').each(function () {
                    height += $(this).height();
                });
                $children.animate({height: height + 'px'});
            } else {
                $children.animate({height: 0 + 'px'});
            }
        });
    });
    $('.list-tree').find('.level-0').trigger('click');
})();

function loadListItems() {
    const loadData = function (container) {
        let contentId = 0;
        contentId = $('.global').data('content_id');
        if (contentId) {
            contentId = String(contentId);
        }
        const url = container.data('api') + '?contentId=' + contentId;
        $.get(url, function (res) {
            container.empty().append(res.data);
            sort(container.find('.sort-rows'));
        }, 'json');
    };
    $(document).find('.list-items-container').each(function (i, n) {
        loadData($(this));
    });
}

function loadItemProfile() {
    var $profile = $('.list-item-profile');
    var $form = $('form.list-item-edit-form');
    var id = $form.data('id');
    var model_0 = $form.data('model_0');
    var model_id = $form.data('model_id');
    var data = {id: id, model_0: model_0, model_id: model_id};
    if ($form.length > 0) {
        $.post($form.data('extend'), data, function (res) {
            if (res) {
                if (res.status) {
                    var _data;
                    var tabs = '';
                    var panes = '';
                    if (res.data) {
                        _data = res.data.C;
                        delete res.data.C;
                        $profile.each(function () {
                            var profile = res.data[$(this).data('lang')];
                            if (profile) {
                                $(this).append(profile)
                            }
                        });
                    }
                    if (_data) {
                        $.each(_data, function (i, n) {
                            var tab = JSON.parse(n.tab);
                            if ($('#model-' + tab.id + '-tab').length === 0) {
                                tabs += ` < a class = "nav-item nav-link model-tab" id = "model-${tab.id}-tab" data - toggle = "tab" href = "#model-${tab.id}" role = "tab" aria - controls = "model-${tab.id}" aria - selected = "false" > ${tab.name} < / a > `;
                            }
                            if ($('#model-' + 'tab.id').length === 0) {
                                panes += ` < div class = "tab-pane fade model-pane" id = "model-${tab.id}" role = "tabpanel" aria - labelledby = "model-${tab.id}-tab" > < div class = "row" > ${n.inputs} < / div > < / div > `;
                            }
                        });
                        $('#general-tab').after(tabs);
                        $('#general').after(panes);
                    }
                    var $g = $('[data-lang="G"]');
                    var $links = $g.find('.ex-link');
                    var $box = $g.parent().find('.ex-links');
                    if ($links.length > 0) {
                        $box.append($links).addClass('no-empty');
                        $box.find('.ex-link a').append('&nbsp;&nbsp;<i class="fa fa-pencil"></i>');
                    }
                } else {
                    error(res.message);
                }
            } else {
                error('系統錯誤');
            }
            $(document).trigger('loadListItems');
        }, 'json');
    }
}

(function () {
    $(document).on('shown.bs.modal', '#list-item-edit-modal', function (event) {
        var listItemEditModal = $(this);
        var listItemEditButton = $(event.relatedTarget);
        $.get(listItemEditButton.data('api'), function (res) {
            listItemEditModal.find('.modal-body').empty().append(res.data);
            $(document).trigger('loadItemProfile');
        }, 'json');
    });
    $(document).on('submit', 'form.list-item-edit-form', function (e) {
        e.preventDefault();
        let contentId = $('.global').data('content_id');
        $(this).find('[name="content_id"]').val(contentId ? contentId : 0);
        $.post($(this).attr('action'), $(this).serialize(), function (res) {
            $(document).find('#list-item-edit-modal').find('[data-dismiss="modal"]').trigger('click');
            $(document).trigger('loadListItems');
        }, 'json');
        return false;
    });
    $(document).on('click', 'a.list-item-delete', function (e) {
        e.preventDefault();
        $.post($(this).attr('href'), function (res) {
            $(document).trigger('loadListItems');
        }, 'json');
        return false;
    });
})();

(function () {
    var $profile = $('.profile');
    var $form = $('form[data-extend]');
    var id = $form.data('id');
    var model_0 = $form.data('model_0');
    var model_id = $form.data('model_id');
    var data = {id: id, model_0: model_0, model_id: model_id};
    if ($form.length > 0) {
        $.post($form.data('extend'), data, function (res) {
            if (res) {
                if (res.status) {
                    var _data;
                    var tabs = '';
                    var panes = '';
                    if (res.data) {
                        _data = res.data.C;
                        delete res.data.C;
                        $profile.each(function () {
                            var profile = res.data[$(this).data('lang')];
                            if (profile) {
                                $(this).append(profile)
                            }
                        });
                    }
                    if (_data) {
                        $.each(_data, function (i, n) {
                            var tab = JSON.parse(n.tab);
                            if ($('#model-' + tab.id + '-tab').length === 0) {
                                tabs += ` < a class = "nav-item nav-link model-tab" id = "model-${tab.id}-tab" data - toggle = "tab" href = "#model-${tab.id}" role = "tab" aria - controls = "model-${tab.id}" aria - selected = "false" > ${tab.name} < / a > `;
                            }
                            if ($('#model-' + 'tab.id').length === 0) {
                                panes += ` < div class = "tab-pane fade model-pane" id = "model-${tab.id}" role = "tabpanel" aria - labelledby = "model-${tab.id}-tab" > < div class = "row" > ${n.inputs} < / div > < / div > `;
                            }
                        });
                        $('#general-tab').after(tabs);
                        $('#general').after(panes);
                    }
                    var $g = $('[data-lang="G"]');
                    var $links = $g.find('.ex-link');
                    var $box = $g.parent().find('.ex-links');
                    if ($links.length > 0) {
                        $box.append($links).addClass('no-empty');
                        $box.find('.ex-link a').append('&nbsp;&nbsp;<i class="fa fa-pencil"></i>');
                    }
                } else {
                    error(res.message);
                }
            } else {
                error('系統錯誤');
            }
            $(document).trigger('loadListItems');
        }, 'json');
    }
})();

(function () {
    $('.btn-add-post').on('click', function (e) {
        if (!$(this).data('cat')) {
            e.preventDefault();
            error('請先創建分類');
            return false;
        }
        return true;
    });
})();

$(document).on('loadListItems', function () {
    loadListItems();
});

$(document).on('loadItemProfile', function () {
    loadItemProfile();
});

$('.sort-rows').on('sortable', function () {
    sort($(this));
}).trigger('sortable');

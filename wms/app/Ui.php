<?php

namespace Admin;

use App\Register;

/**
 * Class Ui
 *
 * @package App
 */
class Ui
{
    /**
     * @param      $html
     * @param null $bgImage
     */
    public static function youtube($html, $bgImage = null)
    {
        ?>
        <div class="ui-youtube" <?php
        if ($bgImage) :
            ?> style="background-image: url(<?= $bgImage ?>);" <?php
        endif ?>>
            <?php
            if ($html) : ?>
                <?= Helper::stripYtbSize($html) ?>
            <?php
            endif; ?>
        </div>
        <?php
    }

    /**
     * @param        $data
     * @param string $value
     * @param bool $_
     *
     * @return string
     */
    public static function options($data, $selected = '', $_ = true)
    {
        $options = [];
        foreach ($data as $value => $label) {
            $label = $_ ? Helper::_($label) : $label;
            $_selected = ($selected == $value ? 'selected' : '');
            $options[] = "<option value=\"{$value}\" {$_selected}>{$label}</option>";
        }

        return implode("\n", $options);
    }

    /**
     * @param        $list
     * @param string $selected
     * @param string $labelKey
     *
     * @return string
     */
    public static function listOptions($list, $selected = '', $labelKey = 'name')
    {
        $c = Register::get('container');
        $langId = $c['currentLang'];
        $options = [];
        foreach ($list as $item) {
            $_selected = $selected == $item['id'] ? ' selected' : '';
            $options[] = "<option value=\"{$item['id']}\" {$_selected}>{$item['__data'][$langId][$labelKey]}</option>";
        }

        return implode("\n", $options);
    }

    /**
     * @param        $list
     * @param        $langId
     * @param string $selected
     * @param int $disabled
     *
     * @return string
     */
    public static function parentOptions($langId, $list, $root_id = 0, $selected = '', $disabled = 0)
    {
        $options = [];
        $list = Helper::objectToArray($list);
        $list = Helper::indexAsId(Helper::treeAsList(Helper::listAsTree($list, $root_id)));
        foreach ($list as $id => $item) {
            $indent = '';
            if ($item['level'] > 0) {
                $indent = '├' . str_repeat('─', $item['level']);
            }
            $text = $indent . ($item['__data'][$langId]['title'] ?? $item['__data'][$langId]['name'] ?? $item['__data'][$langId]['text'] ?? '');
            if ($selected == $item['id']) {
                $options[] = sprintf('<option value="%s" selected>%s</option>', $item['id'], $text);
            } else {
                if ($item['id'] == $disabled || isset($list[$item['parent_id']]) && isset($list[$item['parent_id']]['disabled']) && $list[$item['parent_id']]['disabled'] == true) {
                    $list[$id]['disabled'] = true;
                    $options[] = sprintf('<option value="%s" disabled>%s</option>', $item['id'], $text);
                } else {
                    $options[] = sprintf('<option value="%s">%s</option>', $item['id'], $text);
                }
            }
        }

        return implode("\n", $options);
    }

    /**
     * @param       $list
     * @param array $selected
     * @param int $disabled
     *
     * @return string
     */
    public static function multiOptions($list, $selected = [], $disabled = 0)
    {
        $c = Register::get('container');
        $langId = $c['currentLang'];
        $langCode = $c['config']['lang']['languages'][$langId]['code'];
        $list = Helper::objectToArray($list);
        $list = Helper::indexAsId(Helper::treeAsList(Helper::listAsTree($list)));
        foreach ($list as $id => $item) {
            $indent = '';
            if ($item['level'] > 0) {
                $indent = '├' . str_repeat('─', $item['level']);
            }
            $text = $indent . ($item['__data'][$langCode]['title'] ?? $item['__data'][$langCode]['name']);
            if (in_array($item['id'], $selected)) {
                $options[] = sprintf('<option value="%s" selected>%s</option>', $item['id'], $text);
            } else {
                if ($item['id'] == $disabled || isset($list[$item['parent_id']]) && isset($list[$item['parent_id']]['disabled']) && $list[$item['parent_id']]['disabled'] == true) {
                    $list[$id]['disabled'] = true;
                    $options[] = sprintf('<option value="%s" disabled>%s</option>', $item['id'], $text);
                } else {
                    $options[] = sprintf('<option value="%s">%s</option>', $item['id'], $text);
                }
            }
        }

        return implode("\n", $options);
    }

    public static function catOptions($list, $selected = 0, $disabled = 0)
    {
        $list = Helper::objectToArray($list);
        $list = Helper::indexAsId(Helper::treeAsList(Helper::listAsTree($list)));
        foreach ($list as $id => $item) {
            $indent = '';
            if ($item['level'] > 0) {
                $indent = '├' . str_repeat('─', $item['level']);
            }
            $text = $indent . ($item['__data'][DEFAULT_LANG]['title'] ?? $item['__data'][DEFAULT_LANG]['name']);
            if ($item['id'] == $selected) {
                $options[] = sprintf('<option value="%s" selected>%s</option>', $item['id'], $text);
            } else {
                if ($item['id'] == $disabled || isset($list[$item['parent_id']]) && isset($list[$item['parent_id']]['disabled']) && $list[$item['parent_id']]['disabled'] == true) {
                    $list[$id]['disabled'] = true;
                    $options[] = sprintf('<option value="%s" disabled>%s</option>', $item['id'], $text);
                } else {
                    $options[] = sprintf('<option value="%s">%s</option>', $item['id'], $text);
                }
            }
        }

        return implode("\n", $options);
    }

    /**
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     */
    public static function textarea($field, $langId, $value)
    {
        $name = Helper::profileFieldName($langId, $field['name']);
        $value = strval($value) ?: $field['default'];
        return <<<TEXTAREA
<div class="col-12">
    <div class="input-block p-2">
        <label for="label-{$langId}">{$field['label']}</label>
        <textarea name="{$name}" id="{$name}" rows="5" class="input_normal">{$value}</textarea>
    </div>
</div>
TEXTAREA;
    }

    /**
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     */
    public static function link($field, $langId, $value)
    {
        $name = Helper::profileFieldName($langId, $field['name']);
        $value = Helper::getUrl(strval($value) ?: $field['default']);

        return <<<LINK
<div class="col-md-4 col-lg-2 ex-link">
    <a href="{$value}">{$field['label']}</a>
</div>
LINK;
    }

    public static function list($field, $langId, $value)
    {
        $listModelApi = Helper::getUrl('/extend/list/' . $field['id']);
        $listItemEditApi = Helper::getUrl('/list-items/edit/' . $field['id']);
        $itemIndexApi = Helper::getUrl('/list-items/' . $field['id']);
        $name = Helper::profileFieldName($langId, $field['name']);
        $value = $field['id'] ?: 0;
        $fieldsBtn = '';
        if (Helper::hasPermission('page-fields')) {
            $fieldsBtn = <<<FIELDSBTN
<a href="javascript:;" data-api="{$listModelApi}" class="btn btn-sm btn-primary" data-toggle="modal"
   data-target="#list-fields-modal">
    <i class="fa fa-fw fa-cog"></i>
</a href="javascript">
FIELDSBTN;
        }

        return <<<LIST
<div class="col-12">
    <div class="input-block p-2">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="m-0">{$field['label']}</h6>
            <input type="hidden" name="{$name}" value="{$value}">
            <span>
                <a href="javascript:;" data-api="{$listItemEditApi}" class="btn btn-sm btn-primary" data-toggle="modal"
                   data-target="#list-item-edit-modal">
                    <i class="fa fa-fw fa-plus"></i>
                </a href="javascript">
                {$fieldsBtn}
            </span>
        </div>
        <hr class="ds">
        <div class="list-items-container" data-api="{$itemIndexApi}"></div>
    </div>
</div>
LIST;
    }

    /**
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     */
    public static function inputText($field, $langId, $value)
    {
        $name = Helper::profileFieldName($langId, $field['name']);
        $value = strval($value) ?: $field['default'];

        return <<<INPUT_TEXT
<div class="col-12">
    <div class="input-block p-2">
        <label for="label-{$langId}">{$field['label']}</label>
        <input type="text" name="{$name}" id="{$name}" class="input_normal" value="{$value}">
    </div>
</div>
INPUT_TEXT;
    }

    /**
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     */
    public static function inputNumber($field, $langId, $value)
    {
        $name = Helper::profileFieldName($langId, $field['name']);
        $value = strval($value) ?: $field['default'];

        return <<<INPUT_NUMBER
<div class="col-12">
    <div class="input-block p-2">
        <label for="label-{$langId}">{$field['label']}</label>
        <input type="number" name="{$name}" id="{$name}" class="input_normal" value="{$value}">
    </div>
</div>
INPUT_NUMBER;
    }

    /**
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     */
    public static function inputEmail($field, $langId, $value)
    {
        $name = Helper::profileFieldName($langId, $field['name']);
        $value = strval($value) ?: $field['default'];

        return <<<INPUT_EMAIL
<div class="col-12">
    <div class="input-block p-2">
        <label for="label-{$langId}">{$field['label']}</label>
        <input type="email" name="{$name}" id="{$name}" class="input_normal" value="{$value}">
    </div>
</div>
INPUT_EMAIL;
    }

    /**
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     */
    public static function inputUrl($field, $langId, $value)
    {
        $name = Helper::profileFieldName($langId, $field['name']);
        $value = strval($value) ?: $field['default'];

        return <<<INPUT_URL
<div class="col-12">
    <div class="input-block p-2">
        <label for="label-{$langId}">{$field['label']}</label>
        <input type="url" name="{$name}" id="{$name}" class="input_normal" value="{$value}">
    </div>
</div>
INPUT_URL;
    }

    /**
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     */
    public static function inputRange($field, $langId, $value)
    {
        $name = Helper::profileFieldName($langId, $field['name']);
        $value = strval($value) ?: $field['default'];

        return <<<INPUT_RANGE
<div class="col-12">
    <div class="input-block p-2">
        <label for="label-{$langId}">{$field['label']}</label>
        <input type="range" name="{$name}" id="{$name}" class="d-block" value="{$value}">
    </div>
</div>
INPUT_RANGE;
    }

    /**
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     */
    public static function inputColor($field, $langId, $value)
    {
        $name = Helper::profileFieldName($langId, $field['name']);
        $value = strval($value) ?: $field['default'];

        return <<<INPUT_COLOR
<div class="col-12">
    <div class="input-block p-2">
        <label for="label-{$langId}">{$field['label']}</label>
        <input type="color" name="{$name}" id="{$name}" class="d-block"  value="{$value}">
    </div>
</div>
INPUT_COLOR;
    }

    /**
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     */
    public static function inputDataTime($field, $langId, $value)
    {
        $name = Helper::profileFieldName($langId, $field['name']);
        $value = strval($value) ?: $field['default'];

        return <<<INPUT_DATETIME
<div class="col-12">
    <div class="input-block p-2">
        <label for="label-{$langId}">{$field['label']}</label>
        <input type="datetime-local" name="{$name}" id="{$name}" class="d-block" value="{$value}">
    </div>
</div>
INPUT_DATETIME;
    }

    /**
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     */
    public static function inputData($field, $langId, $value)
    {
        $name = Helper::profileFieldName($langId, $field['name']);
        $value = strval($value) ?: $field['default'];

        return <<<INPUT_DATE
<div class="col-12">
    <div class="input-block p-2">
        <label for="label-{$langId}">{$field['label']}</label>
        <input type="date" name="{$name}" id="{$name}" class="d-block" value="{$value}">
    </div>
</div>
INPUT_DATE;
    }

    /**
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     */
    public static function inputTime($field, $langId, $value)
    {
        $name = Helper::profileFieldName($langId, $field['name']);
        $value = strval($value) ?: $field['default'];

        return <<<INPUT_TIME
<div class="col-12">
    <div class="input-block p-2">
        <label for="label-{$langId}">{$field['label']}</label>
        <input type="time" name="{$name}" id="{$name}" class="d-block" value="{$value}">
    </div>
</div>
INPUT_TIME;
    }

    /**
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     */
    public static function inputFile($field, $langId, $value)
    {
        $name = Helper::profileFieldName($langId, $field['name']);
        $id = 'field_' . md5($name);
        $value = strval($value) ?: $field['default'];
        $uploadUrl = Helper::getUrl("/upload/file");
        $c = Register::get('container');
        $currentLang = $c['currentLang'];
        $deleteBtnText = Helper::_('Remove');

        return <<<INPUT_IMAGE
<div class="col-12" id="{$id}">
    <div class="input-block p-2">
    <div class="input-file px-2 pb-3">
        <label for="label-{$langId}">{$field['label']}</label>
            <div class="row">
                <div class="col-6">
                    <a href="{$value}" target="_blank" title="点击查看" style="display: inline-block;margin: 0 1rem;">
                    {$value}
                </a>
                </div>
                <div class="col-6">
                    <button type="button" class="mb-4 btn btn-sm btn-primary btn-delete-file">{$deleteBtnText}</button>
                    <input type="hidden" name="{$name}" value="{$value}">
                    <input type="file" class="d-block" value="" data-show-preview="false">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
(function () {
    $("#{$id}").find("input[type='file']").fileinput({
    language: '{$currentLang}',
    uploadUrl: "{$uploadUrl}",
    enableResumableUpload: false,
    uploadExtraData: {
        // 'uploadToken': 'SOME-TOKEN', // for access control / security 
    },
    maxFileCount: 1,
    // allowedFileTypes: ['image'],    // allow only images
    showCancel: true,
    initialPreviewAsData: true,
    overwriteInitial: false,
    // initialPreview: [],          // if you have previously uploaded preview files
    // initialPreviewConfig: [],    // if you have previously uploaded preview files
    theme: 'fas',
    // deleteUrl: ""
    }).on('fileuploaded', function(event, data, previewId, index) {
        var file = data.response.data.link;
        $("#{$id}").find("input[name='{$name}']").val(file);
        $("#{$id}").find('a').attr('href', file);
    });
})();
</script>
INPUT_IMAGE;
    }

    /**
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     */
    public static function inputImage($field, $langId, $value)
    {
        $name = Helper::profileFieldName($langId, $field['name']);
        $id = 'field_' . md5($name);
        $value = strval($value) ?: $field['default'];
        $uploadUrl = Helper::getUrl("/upload/image");
        $c = Register::get('container');
        $currentLang = $c['currentLang'];

        return <<<INPUT_IMAGE
<div class="col-12" id="{$id}">
    <div class="input-block p-2">
        <label for="label-{$langId}">{$field['label']}
            <a href="{$value}" target="_blank" title="点击查看大图" style="display: inline-block;margin: 0 1rem;">
                <img style="height: 40px" src="{$value}" alt="">
            </a>
        </label>
        <input type="hidden" name="{$name}" value="{$value}">
        <input type="file" class="d-block" value="" data-show-preview="false">
    </div>
</div>
<script>
(function () {
    $("#{$id}").find("input[type='file']").fileinput({
    language: '{$currentLang}',
    uploadUrl: "{$uploadUrl}",
    enableResumableUpload: false,
    uploadExtraData: {
        // 'uploadToken': 'SOME-TOKEN', // for access control / security 
    },
    maxFileCount: 1,
    allowedFileTypes: ['image'],    // allow only images
    showCancel: true,
    initialPreviewAsData: true,
    overwriteInitial: false,
    // initialPreview: [],          // if you have previously uploaded preview files
    // initialPreviewConfig: [],    // if you have previously uploaded preview files
    theme: 'fas',
    // deleteUrl: ""
    }).on('fileuploaded', function(event, data, previewId, index) {
        var image = data.response.link;
        $("#{$id}").find("input[name='{$name}']").val(image);
        $("#{$id}").find('a').attr('href', image).find('img').attr('src', image);
    });
})();
</script>
INPUT_IMAGE;
    }

    /**
     *
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     * @deprecated
     */
    public static function inputImages($field, $langId, $value)
    {
        $name = Helper::profileFieldName($langId, $field['name']);
        $id = 'field_' . md5($name);
        $value = strval($value) ?: $field['default'];
        $uploadUrl = Helper::getUrl("/upload/image");
        $c = Register::get('container');
        $currentLang = $c['currentLang'];

        return <<<INPUT_IMAGE
<div class="col-12" id="{$id}">
    <div class="input-block p-2">
        <label for="label-{$langId}">{$field['label']}</label>
        <ul class="row no-gutters list-unstyled links mb-0 sortable ui-sortable"></ul>
        <input type="hidden" name="{$name}" value='{$value}'>
        <input type="file" multiple class="d-block" value="">
    </div>
</div>
<script>
(function() {
    var __el = $("#{$id}");
function getImages() {
    var val = __el.find("input[name='{$name}']").val();
    try {
        images = JSON.parse(val);
    } catch (e) {
        images = [];
    }
    return images;
}
function setImages(images)
{
    var links = __el.find('.links').empty();
    images.map(function(v, k){
        links.append('<li class="col-2 ui-sortable-handle"><div class="m-2" style="position:relative; border:3px solid #fff;">' +
           '<a class="d-block" data-fancybox="gallery" href="'+v+'"><img style="height: 50px;" src="'+v+'" alt=""></a>' +
           '<a class="del" style="padding: 1px 3px; wallpaper:#fff; red;position: absolute; right: -3px; top:-3px" href="javascript:void(0)"><i class="fa fa-times"></i></a>' +
           '</div></li>');
    });
    links.sortable({
        update: function (event, ui) {
            images = [];
            links.find('img').each(function() {
              images.push($(this).attr('src'));
            });
            __el.find("input[name='{$name}']").val(JSON.stringify(images));
        }
    });
    __el.find("input[name='{$name}']").val(JSON.stringify(images));
}
function delImage(image)
{
    var images = getImages();
    images.map(function(v, k){
        if(v == image) {
            images.splice(k, 1);
        }
    });
    setImages(images);
}
__el.find('.links').on('click', 'li .del', function() {
    var image = $(this).parent().find('img').attr('src');
    delImage(image);
});
setImages(getImages());
$("#{$id}").find("input[type='file']").fileinput({
    language: '{$currentLang}',
    uploadUrl: "{$uploadUrl}",
    enableResumableUpload: false,
    uploadExtraData: {
        // 'uploadToken': 'SOME-TOKEN', // for access control / security 
    },
    maxFileCount: 0,
    allowedFileTypes: ['image'],    // allow only images
    showCancel: true,
    initialPreviewAsData: true,
    overwriteInitial: true,
    // initialPreview: [],          // if you have previously uploaded preview files
    // initialPreviewConfig: [],    // if you have previously uploaded preview files
    theme: 'fas',
    // deleteUrl: ""
    }).on('fileuploaded', function(event, data, previewId, index) {
        var image = data.response.data.link;
        var images = getImages();
        console.log(getImages());
        images.push(image);
        setImages(images);
    });
})();
</script>
INPUT_IMAGE;
    }

    /**
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     */
    public static function inputVideo($field, $langId, $value)
    {
        $name = Helper::profileFieldName($langId, $field['name']);
        $id = 'field_' . md5($name);
        $value = strval($value) ?: $field['default'];
        $uploadUrl = Helper::getUrl("/upload/video");
        $c = Register::get('container');
        $currentLang = $c['currentLang'];
        $deleteBtnText = Helper::_('Remove');

        return <<<INPUT_VIDEO
<div class="col-12" id="{$id}">
    <div class="input-block p-2">
        <div class="input-video px-2 pb-3">
            <label for="label-{$langId}">{$field['label']}</label>
            <div class="row">
                <div class="col-6">
                    <video controls width="100%">
                        <source src="{$value}">
                    </video>
                </div>
                <div class="col-6">
                    <button type="button" class="mb-4 btn btn-sm btn-primary btn-delete-video">{$deleteBtnText}</button>
                    <input type="hidden" name="{$name}" value="{$value}">
                    <input type="file" class="d-block" value="" data-show-preview="false">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
(function () {
    $("#{$id}").find("input[type='file']").fileinput({
    language: '{$currentLang}',
    uploadUrl: "{$uploadUrl}",
    enableResumableUpload: false,
    uploadExtraData: {
        // 'uploadToken': 'SOME-TOKEN', // for access control / security 
    },
    maxFileCount: 1,
    allowedFileTypes: ['video'],    // allow only images
    showCancel: true,
    initialPreviewAsData: true,
    overwriteInitial: false,
    // initialPreview: [],          // if you have previously uploaded preview files
    // initialPreviewConfig: [],    // if you have previously uploaded preview files
    theme: 'fas',
    // deleteUrl: ""
    }).on('fileuploaded', function(event, data, previewId, index) {
        var video = data.response.data.link;
        $("#{$id}").find("input[name='{$name}']").val(video);
        $("#{$id}").find('video source').attr('src', video);
    });
})();
</script>
INPUT_VIDEO;
    }

    /**
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     */
    public static function inputCheckbox($field, $langId, $value)
    {
        $name = Helper::profileFieldName($langId, $field['name']);
        $value = strval($value) ?: $field['default'];
        if ($field['name'] == 'captcha_type') {
            $alphaLabel = Helper::_('Alpha and Numeric');
            $jigsawLabel = Helper::_('Jigsaw');
            $swipeLabel = Helper::_('Swipe');
            $reCaptchaLabel = Helper::_('Google reCaptcha');
            $alphaChecked = $value == 0 ? 'checked' : '';
            $swipeChecked = $value == 1 ? 'checked' : '';
            $jigsawChecked = $value == 2 ? 'checked' : '';
            $reCaptchaChecked = $value == 3 ? 'checked' : '';

            return <<<INPUT_CHECKBOX
<div class="col-12">
    <div class="input-block p-2">
        <label class="px-2" for="label-{$langId}">{$field['label']}</label>
        <div class="radios d-flex justify-content-start">
            <label class="px-2 d-flex justify-content-start align-items-center">
                <input type="radio" name="{$name}" id="{$name}1" class="d-block" {$alphaChecked} value="0">
                <span class="px-1">{$alphaLabel}</span>
            </label>
            <label class="px-2 d-flex justify-content-start align-items-center">
                <input type="radio" name="{$name}" id="{$name}2" class="d-block" {$swipeChecked} value="1">
                <span class="px-1">{$swipeLabel}</span>
            </label>
            <label class="px-2 d-flex justify-content-start align-items-center">
                <input type="radio" name="{$name}" id="{$name}3" class="d-block" {$jigsawChecked} value="2">
                <span class="px-1">{$jigsawLabel}</span>
            </label>
            <label class="px-2 d-flex justify-content-start align-items-center">
                <input type="radio" name="{$name}" id="{$name}4" class="d-block" {$reCaptchaChecked} value="3">
                <span class="px-1">{$reCaptchaLabel}</span>
            </label>
        </div>
    </div>
</div>
INPUT_CHECKBOX;
        } elseif ($field['name'] == 'defaultLang') {
            $enLabel = Helper::_('English');
            $hkLabel = Helper::_('Traditional Chinese');
            $cnLabel = Helper::_('Simplified Chinese');
            $hkChecked = $value == 'zh_hk' ? 'checked' : '';
            $enChecked = $value == 'en_us' ? 'checked' : '';
            $cnChecked = $value == 'zh_cn' ? 'checked' : '';

            return <<<INPUT_CHECKBOX
<div class="col-12">
    <div class="input-block p-2">
        <label class="px-2" for="label-{$langId}">{$field['label']}</label>
        <div class="radios d-flex justify-content-start">
            <label class="px-2 d-flex justify-content-start align-items-center">
                <input type="radio" name="{$name}" id="{$name}1" class="d-block" {$hkChecked} value="zh_hk">
                <span class="px-1">{$hkLabel}</span>
            </label>
            <label class="px-2 d-flex justify-content-start align-items-center">
                <input type="radio" name="{$name}" id="{$name}2" class="d-block" {$enChecked} value="en_us">
                <span class="px-1">{$enLabel}</span>
            </label>
            <label class="px-2 d-flex justify-content-start align-items-center">
                <input type="radio" name="{$name}" id="{$name}3" class="d-block" {$cnChecked} value="zh_cn">
                <span class="px-1">{$cnLabel}</span>
            </label>
        </div>
    </div>
</div>
INPUT_CHECKBOX;
        } else {
            $checkedEnable = $value == 1 ? 'checked' : '';
            $checkedDisable = $value == 0 ? 'checked' : '';
            $enableLabel = Helper::_('Enable');
            $disableLabel = Helper::_('Disable');

            return <<<INPUT_CHECKBOX
<div class="col-12">
    <div class="input-block p-2">
        <label class="px-2" for="label-{$langId}">{$field['label']}</label>
        <div class="radios d-flex justify-content-start">
            <label class="px-2 d-flex justify-content-start align-items-center">
                <input type="radio" name="{$name}" id="{$name}1" class="d-block" {$checkedEnable} value="1">
                <span class="px-1">{$enableLabel}</span>
            </label>
            <label class="px-2 d-flex justify-content-start align-items-center">
                <input type="radio" name="{$name}" id="{$name}2" class="d-block" {$checkedDisable} value="0">
                <span class="px-1">{$disableLabel}</span>
            </label>
        </div>
    </div>
</div>
INPUT_CHECKBOX;
        }
    }

    /**
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     */
    public static function textareaEditor($field, $langId, $value)
    {
        $label = $field['label'];
        $name = Helper::profileFieldName($langId, $field['name']);
        $id = 'field_' . md5($name);
        $fileUploadURL = Helper::getUrl("/upload/file?froala=1");
        $imageUploadURL = Helper::getUrl("/upload/image?froala=1");
        $videoUploadURL = Helper::getUrl("/upload/video?froala=1");
        $imageManagerLoadURL = Helper::getUrl('/froala/images/');
        $c = Register::get('container');
        $currentLang = $c['currentLang'];
        $tempApi = Helper::getUrl('/templates/');
        $tempBtnText = Helper::_('Templates');

        return <<<TEXTAREA_EDITOR
<div class="col-12">
    <div class="input-block editor-block p-2">
        <label for="{$id}">{$label}</label>
        <span>
            <button type="button" class="btn btn-sm btn-info btn-content-templates"
                    data-toggle="modal"
                    data-target="#content-templates-modal"
                    data-api="{$tempApi}"
                    data-editor="content_{$id}"
            >
                {$tempBtnText}
            </button>
        </span>
        <textarea name="{$name}" id="{$id}" class="editor-{$langId}">{$value}</textarea>
    </div>
</div>
<script>
    (function () {
        const editorEl = '#{$id}';
        const editorName = "content_{$id}";
        editors[editorName] = new FroalaEditor(editorEl, {
            theme: 'dark', 
            language: '{$currentLang}',
            fontFamily: {
                "Roboto": 'Roboto',
                "微軟正黑體": '微軟正黑體',
                "Montserrat": 'Montserrat',
                "'Open Sans Condensed'": 'Open Sans Condensed'
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
            
            imageManagerLoadURL: '{$imageManagerLoadURL}',

            // Set the file upload parameter.
            fileUploadParam: 'file_data',
            // Set the file upload URL.
            fileUploadURL: '{$fileUploadURL}',
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
            imageUploadURL: '{$imageUploadURL}',
            // Additional upload params.
            imageUploadParams: {},
            // Set request type.
            imageUploadMethod: 'POST',
            // Set max image size to 5MB.
            imageMaxSize: 5 * 1024 * 1024,
            // Allow to upload PNG and JPG.
            imageAllowedTypes: ['jpeg', 'jpg', 'png'],

            // Set the video upload parameter.
            videoUploadParam: 'file_data',
            // Set the video upload URL.
            videoUploadURL: '{$videoUploadURL}',
            // Additional upload params.
            videoUploadParams: {},
            // Set request type.
            videoUploadMethod: 'POST',
            // Set max video size to 50MB.
            videoMaxSize: 50 * 1024 * 1024,
            // Allow to upload MP4, WEBM and OGG
            videoAllowedTypes: ['mp4', 'webm', 'ogg'],

            events: {
                'file.beforeUpload': function (files) {
                // Return false if you want to stop the file upload.
                },
                'file.uploaded': function (response) {
                // File was uploaded to the server.
                },
                'file.inserted': function (file, response) {
                // File was inserted in the editor.
                },
                'file.error': function (error, response) {
                    console.log(response);
                    console.log(error);
                    // Bad link.
                    if (error.code == 1) {}
                    
                    // No link in upload response.
                    else if (error.code == 2) {}
                    
                    // Error during file upload.
                    else if (error.code == 3) {}
                    
                    // Parsing response failed.
                    else if (error.code == 4) {}
                    
                    // File too text-large.
                    else if (error.code == 5) {}
                    
                    // Invalid file type.
                    else if (error.code == 6) {}
                    
                    // File can be uploaded only to same domain in IE 8 and IE 9.
                    else if (error.code == 7) {}
                // Response contains the original server response to the request if available.
                },
                'image.beforeUpload': function (images) {
                    // Return false if you want to stop the image upload.
                },
                'image.uploaded': function (response) {
                    // Image was uploaded to the server.
                },
                'image.inserted': function (img, response) {
                    // Image was inserted in the editor.
                },
                'image.replaced': function (img, response) {
                    // Image was replaced in the editor.
                },

                'video.beforeUpload': function (videos) {
                    // Return false if you want to stop the video upload.
                },
                'video.uploaded': function (response) {
                    // Video was uploaded to the server.
                },
                'video.inserted': function (video, response) {
                    // Video was inserted in the editor.
                },
                'video.replaced': function (video, response) {
                    // Video was replaced in the editor.
                },

                'image.error': function (error, response) {
                    console.log(error);
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
                    console.log(response);
                    console.log(error);
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
TEXTAREA_EDITOR;
    }

    /**
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     */
    public static function imageSelect($field, $langId, $value)
    {
        $c = Register::get('container');
        $currentLang = $c['currentLang'];
        $name = Helper::profileFieldName($langId, $field['name']);
        $title = Helper::_('Click to view bigger image');
        $editBtnText = Helper::_('Edit');
        $changeBtnText = Helper::_('Change');
        $uploadBtnText = Helper::_('Select');
        $deleteBtnText = Helper::_('Remove');
        $uploadUrl = Helper::getUrl("/upload/image");
        $exist = Helper::fileExists($value) ? 'exist' : '';
        if (Helper::fileExists($value)) {
            $thumb = Helper::thumb($value);
            $preview = <<<THUMB_PREVIEW
            <div class="image-thumb"><a href="{$value}" data-fancybox title="{$title}">
                <img src="{$thumb}" data-src="{$value}" alt="thumb preview">
            </a></div>
THUMB_PREVIEW;
        } else {
            $preview = <<<THUMB_PREVIEW
            <div class="image-thumb no-content">
                No Image
            </div>
THUMB_PREVIEW;
        }

        return <<<INPUT_IMAGE2
<div class="col-12">
    <div class="input-block p-2">
        <div class="input-image input-field px-2 pb-3 {$exist}">
            <div class="mb-2 d-flex align-items-center">
                <label class="mb-0">{$field['label']}</label>
                <div class="buttons">
                    <button type="button" class="btn btn-sm btn-primary btn-edit-image">
                        {$editBtnText}
                    </button>
                    <button type="button" class="btn btn-sm btn-primary btn-delete-image" data-type="image">
                        {$deleteBtnText}
                    </button>
                    <button type="button" class="btn btn-sm btn-primary btn-select-files" id="btn-select-image"
                            data-type="image"
                            data-more="0"
                            data-upload="{$uploadUrl}"
                            data-lang="{$currentLang}"
                            data-toggle="modal" 
                            data-target="#files-select-modal">
                        <span class="ch">{$changeBtnText}</span>
                        <span class="up">{$uploadBtnText}</span>
                    </button>
                </div>
            </div>
            <div class="preview d-flex flex-wrap">{$preview}</div>
            <input type="hidden" name="{$name}" value="{$value}">
        </div>
    </div>
</div>
INPUT_IMAGE2;
    }

    public static function imagesSelect($field, $langId, $value)
    {
        $c = Register::get('container');
        $currentLang = $c['currentLang'];
        $name = Helper::profileFieldName($langId, $field['name']);
        $changeBtnText = Helper::_('Change');
        $uploadBtnText = Helper::_('Select');
        $deleteBtnText = Helper::_('Remove');
        $uploadUrl = Helper::getUrl("/upload/image");
        $exist = '';
        $preview = <<<THUMB_PREVIEW
            <div class="image-thumb no-content">
                No Images
            </div>
THUMB_PREVIEW;
        $value = htmlspecialchars_decode($value);
        if ($value) {
            $values = json_decode($value);
            if (!is_array($values)) {
                $values = [];
            }
            if (count($values) > 0) {
                $exist = 'exist';
                $preview = '';
                foreach ($values as $item) {
                    $thumb = Helper::thumb($item);
                    $preview .= <<<THUMB_PREVIEW
                    <div class="image-thumb ui-sortable-handle">
                        <button type="button" class="remove"><i class="fa fa-fw fa-remove"></i></button>
                        <a data-fancybox href="{$item}">
                            <img src="{$thumb}" data-src="{$item}" alt="">
                        </a>
                    </div>
THUMB_PREVIEW;
                }
            }
        }

        $value = htmlspecialchars($value);

        return <<<IMAGES_PREVIEW
<div class="col-12">
    <div class="input-block p-2">
        <div class="input-image input-field px-2 pb-3 {$exist}">
            <div class="mb-2 d-flex align-items-center">
                <label class="mb-0">{$field['label']}</label>
                <div class="buttons">
                    <button type="button" class="btn btn-sm btn-primary btn-delete-image" data-type="images">
                        {$deleteBtnText}
                    </button>
                    <button type="button" class="btn btn-sm btn-primary btn-select-files" id="btn-select-images"
                            data-type="image"
                            data-more="1"
                            data-upload="{$uploadUrl}"
                            data-lang="{$currentLang}"
                            data-toggle="modal" 
                            data-target="#files-select-modal">
                        <span class="ch">{$changeBtnText}</span>
                        <span class="up">{$uploadBtnText}</span>
                    </button>
                </div>
            </div>
            <div class="preview d-flex flex-wrap sortable ui-sortable">{$preview}</div>
            <input type="hidden" name="{$name}" value="{$value}">
        </div>
    </div>
</div>
<script>
    $('.input-image').find('.preview.sortable').sortable({
            update: function (event, ui) {
                let images = [];
                var wrap = $('.input-images');
                var input = wrap.find('input[type="hidden"]');
                var preview = wrap.find('.preview');
                preview.find('.image-thumb').each(function() {
                    images.push($(this).find('img').data('src'));
                });
                input.val(JSON.stringify(images));
            }
        });
</script>
IMAGES_PREVIEW;
    }

    public static function videoSelect($field, $langId, $value)
    {
        $c = Register::get('container');
        $currentLang = $c['currentLang'];
        $name = Helper::profileFieldName($langId, $field['name']);
        $title = Helper::_('Click to view bigger image');
        $changeBtnText = Helper::_('Change');
        $uploadBtnText = Helper::_('Select');
        $deleteBtnText = Helper::_('Remove');
        $uploadUrl = Helper::getUrl("/upload/video");
        $exist = Helper::fileExists($value) ? 'exist' : '';
        if (Helper::fileExists($value)) {
            $preview = <<<THUMB_PREVIEW
        <div class="image-thumb video-thumb">
            <a href="{$value}" data-fancybox title="{$title}">
                <video src="{$value}" data-src="{$value}"></video>
            </a>
        </div>
THUMB_PREVIEW;
        } else {
            $preview = <<<THUMB_PREVIEW
        <div class="image-thumb video-thumb no-content">
            No Video
        </div>
THUMB_PREVIEW;
        }

        return <<<VIDEO_PREVIEW
            <div class="col-12">
                <div class="input-block p-2">
                    <div class="input-image input-field px-2 pb-3 {$exist}">
                        <div class="mb-2 d-flex align-items-center">
                            <label class="mb-0">{$field['label']}</label>
                            <div class="buttons">
                                <button type="button" class="btn btn-sm btn-primary btn-delete-image" data-type="video">
                                    {$deleteBtnText}
                                </button>
                                <button type="button" class="btn btn-sm btn-primary btn-select-files" id="btn-select-video"
                                        data-type="video"
                                        data-upload="{$uploadUrl}"
                                        data-lang="{$currentLang}"
                                        data-more="0"
                                        data-toggle="modal" 
                                        data-target="#files-select-modal">
                                    <span class="ch">{$changeBtnText}</span>
                                    <span class="up">{$uploadBtnText}</span>
                                </button>
                            </div>
                        </div>
                        <div class="preview d-flex flex-wrap">{$preview}</div>
                        <input type="hidden" name="{$name}" value="{$value}">
                    </div>
                </div>
            </div>
VIDEO_PREVIEW;
    }

    public static function fileSelect($field, $langId, $value)
    {
        $c = Register::get('container');
        $currentLang = $c['currentLang'];
        $name = Helper::profileFieldName($langId, $field['name']);
        $changeBtnText = Helper::_('Change');
        $uploadBtnText = Helper::_('Select');
        $deleteBtnText = Helper::_('Remove');
        $uploadUrl = Helper::getUrl("/upload/file");
        $exist = Helper::fileExists($value) ? 'exist' : '';
        if (Helper::fileExists($value)) {
            $_tmp = explode('/', $value);
            $filename = array_pop($_tmp);
            $preview = <<<THUMB_PREVIEW
        <div class="image-thumb file-thumb"><a href="{$value}" data-fancybox><span>{$filename}</span></a></div>
THUMB_PREVIEW;
        } else {
            $preview = <<<THUMB_PREVIEW
        <div class="image-thumb file-thumb no-content">
            No File
        </div>
THUMB_PREVIEW;
        }

        return <<<FILE_PREVIEW
            <div class="col-12">
                <div class="input-block p-2">
                    <div class="input-image input-field px-2 pb-3 {$exist}">
                        <div class="mb-2 d-flex align-items-center">
                            <label class="mb-0">{$field['label']}</label>
                            <div class="buttons">
                                <button type="button" class="btn btn-sm btn-primary btn-delete-image" data-type="file">
                                    {$deleteBtnText}
                                </button>
                                <button type="button" class="btn btn-sm btn-primary btn-select-files" id="btn-select-file"
                                        data-type="file"
                                        data-more="0"
                                        data-upload="{$uploadUrl}"
                                        data-lang="{$currentLang}"
                                        data-toggle="modal"
                                        data-target="#files-select-modal">
                                    <span class="ch">{$changeBtnText}</span>
                                    <span class="up">{$uploadBtnText}</span>
                                </button>
                            </div>
                        </div>
                        <div class="preview d-flex flex-wrap">{$preview}</div>
                        <input type="hidden" name="{$name}" value="{$value}">
                    </div>
                </div>
            </div>
FILE_PREVIEW;
    }
}

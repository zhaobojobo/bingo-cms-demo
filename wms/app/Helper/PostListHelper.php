<?php


namespace Admin\Helper;


use Admin\Helper;
use App\Register;
use Admin\Models\Catalog;
use Admin\Models\CatalogMap;

class PostListHelper
{
    private static function api($name, $type, $row)
    {
        switch ($name) {
            case 'update-title':
                return Helper::getUrl('/post/title/update/' . $row['id']);
            case 'update-slug':
                return Helper::getUrl('/post/slug/update/' . $row['id']);
            case 'status-review':
                return Helper::getUrl('/post/review/update/' . $row['id']);
            case 'status-hidden':
                return Helper::getUrl('/post/hidden/update/' . $row['id']);
            case 'update-sort':
                return Helper::getUrl('/post/sort/update/' . $row['id']);
            case 'preview':
                return Helper::getUrl('/post/preview/' . $row['id']);
            case 'finder':
                return Helper::getUrl('/post/find/' . $row['id']);
            case 'copy':
                return Helper::getUrl('/post/copy/' . $type . '/' . $row['id']);
            case 'edit':
                return Helper::getUrl('/post/edit/' . $type . '/' . $row['id']);
            case 'delete':
                return Helper::getUrl('/post/delete/' . $type);
            case 'extend':
                return Helper::getUrl('/extend/post/' . $type);
            default:
        }

        return '';
    }

    private static function actions($type, $row)
    {
        ?>
        <?php
        if (Helper::hasPermission($type . '-preview')): ?>
            <a class="button-gray bingo_button icon_button btn-view"
               title="<?= Helper::_('Preview') ?>"
               href="<?= self::api('preview', $type, $row) ?>"
            ><i class="fa fa-fw fa-eye" aria-hidden="true"></i></a>
        <?php
        endif ?>
        <?php
        if (Helper::hasPermission($type . '-copy')): ?>
            <a class="button-gray bingo_button icon_button btn-copy"
               title="<?= Helper::_('Copy') ?>"
               href="<?= self::api('copy', $type, $row) ?>">
                <i class="fa fa-clone" aria-hidden="true"></i>
            </a>
        <?php
        endif ?>
        <?php
        if (Helper::hasPermission($type . '-edit')): ?>
            <a class="button-gray bingo_button icon_button"
               title="<?= Helper::_('Edit') ?>"
               href="<?= self::api('edit', $type, $row) ?>"
            ><i class="fa fa-fw fa-pencil" aria-hidden="true"></i></a>
        <?php
        endif ?>
        <?php
        if (Helper::hasPermission($type . '-delete')): ?>
            <a class="button-gray bingo_button icon_button delete"
               title="<?= Helper::_('Delete') ?>"
               href="<?= self::api('delete', $type, $row) ?>" data-id="<?= $row['id'] ?>"
            ><i class="fa fa-fw fa-trash-o" aria-hidden="true"></i></a>
        <?php
        endif ?>
        <?php
    }

    private static function header($type)
    { ?>
        <div class="row no-gutters th">
            <div class="col-1">
                <input type="checkbox" id="all">
                <label for="all" class="pl-2">ID</label>
            </div>
            <div class="col justify-content-center"><?= Helper::_('Sort') ?></div>
            <div class="col-2"><?= Helper::_('Title') ?></div>
            <div class="col justify-content-center">
                <?= Helper::_('Publish Time') ?>
                <?php
                $url = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?'));
                ?>
                <span class="d-flex flex-column sorts">
                    <?php
                    if (Helper::get('sort') == 'publish_time' && Helper::get('order') == 'asc'): ?>
                        <a class="sort sort-asc active" href="<?= $url ?>">
                        <i class="fa fa-fw fa-caret-up"></i>
                    </a>
                    <?php
                    else: ?>
                        <a class="sort sort-asc" href="<?= $url ?>?sort=publish_time&order=asc">
                        <i class="fa fa-fw fa-caret-up"></i>
                    </a>
                    <?php
                    endif ?>
                    <?php
                    if (Helper::get('sort') == 'publish_time' && Helper::get('order') == 'desc'): ?>
                        <a class="sort sort-desc active" href="<?= $url ?>">
                            <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                    <?php
                    else: ?>
                        <a class="sort sort-desc" href="<?= $url ?>?sort=publish_time&order=desc">
                            <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                    <?php
                    endif ?>
                </span>
            </div>
            <div class="col justify-content-center">
                <?= Helper::_('Update Time') ?>
                <?php
                $url = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?'));
                ?>
                <span class="d-flex flex-column sorts">
                    <?php
                    if (Helper::get('sort') == 'update_time' && Helper::get('order') == 'asc'): ?>
                        <a class="sort sort-asc active" href="<?= $url ?>">
                        <i class="fa fa-fw fa-caret-up"></i>
                    </a>
                    <?php
                    else: ?>
                        <a class="sort sort-asc" href="<?= $url ?>?sort=update_time&order=asc">
                        <i class="fa fa-fw fa-caret-up"></i>
                    </a>
                    <?php
                    endif ?>
                    <?php
                    if (Helper::get('sort') == 'update_time' && Helper::get('order') == 'desc'): ?>
                        <a class="sort sort-desc active" href="<?= $url ?>">
                            <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                    <?php
                    else: ?>
                        <a class="sort sort-desc" href="<?= $url ?>?sort=update_time&order=desc">
                            <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                    <?php
                    endif ?>
                </span>
            </div>
            <div class="col"><?= Helper::_('Catalog') ?></div>
            <div class="col-1 justify-content-center"><?= Helper::_('Review') ?></div>
            <div class="col-1 justify-content-center"><?= Helper::_('Hidden') ?></div>
            <div class="col-2"><?= Helper::_('Operates') ?></div>
        </div>
        <?php
    }

    private static function row($type, $row, $level, $toggle, $langId)
    {
        ?>
        <div class="row no-gutters">
            <div class="col-1">
                <input type="checkbox" name="id[]" id="id_<?= $row['id'] ?>" value="<?= $row['id'] ?>">
                <label for="id_<?= $row['id'] ?>" class="pl-2"><?= $row['id'] ?></label>
            </div>
            <div class="col edit-sort" data-api="<?= self::api('update-sort', $type, $row) ?>">
                <span><?= $row['sort'] ?></span>
                <label><input class="form-control" type="number" value="<?= $row['sort'] ?>"></label>
            </div>
            <div class="col-2 edit-title">
                <span class="row-title"><?= $row['__data'][$langId]['title'] ?></span>
                <button class="d-none" type="button"
                        data-toggle="modal" data-target="#edit-title-modal"
                        data-api="<?= self::api('update-title', $type, $row) ?>"
                        data-id="<?= $row['id'] ?>"
                        data-lang="<?= $langId ?>"
                ></button>
            </div>
            <div class="col justify-content-center">
                <?= $row['publish_time'] ?>
            </div>
            <div class="col justify-content-center">
                <?= $row['update_time'] ?>
            </div>
            <div class="col">
                <?php
                $map  = new CatalogMap();
                $cats = $map->catalogsId($row['id'], $row['type']); ?>
                <?php
                if ($cats): ?>
                    <?php
                    $model = new Catalog(); ?>
                    <?php
                    foreach ($cats as $i => $cat): $cat = $model->find($cat); ?>
                        <a href="<?= Helper::getUrl('/posts/' . $cat->content_type . '/' . $cat->id) ?>">
                            <?= strip_tags($cat->__data[$langId]['name']) ?>
                        </a>
                        <?php
                        if ($i < count($cats) - 1): ?><span>,&nbsp;</span><?php
                        endif ?>
                    <?php
                    endforeach; ?>
                <?php
                endif; ?>
            </div>
            <div class="col-1 edit-review justify-content-center">
                <div class="form-check status-switch">
                    <label for="reviewStatus"></label>
                    <input class="form-check-input" type="checkbox" id="reviewStatus"
                           data-status="review"
                           data-api="<?= self::api('status-review', $type, $row) ?>"
                        <?php
                        if ($row['review']): ?>
                            checked
                        <?php
                        endif ?>
                    >
                    <?php
                    if ($row['review']): ?>
                        <span class="button-green bingo_button icon_button">
                        <i class="fa fa-fw fa-check" aria-hidden="true"></i>
                    </span>
                    <?php
                    else: ?>
                        <span class="button-red bingo_button icon_button">
                         <i class="fa fa-fw fa-ban" aria-hidden="true"></i>
                    </span>
                    <?php
                    endif; ?>
                </div>
            </div>
            <div class="col-1 edit-hidden justify-content-center">
                <div class="form-check status-switch">
                    <label for="hiddenStatus"></label>
                    <input class="form-check-input" type="checkbox" id="hiddenStatus"
                           data-status="hidden"
                           data-api="<?= self::api('status-hidden', $type, $row) ?>"
                        <?php
                        if ($row['hidden']): ?>
                            checked
                        <?php
                        endif ?>
                    >
                    <?php
                    if ($row['hidden']): ?>
                        <span class="button-green bingo_button icon_button">
                        <i class="fa fa-fw fa-check" aria-hidden="true"></i>
                    </span>
                    <?php
                    else: ?>
                        <span class="button-red bingo_button icon_button">
                         <i class="fa fa-fw fa-ban" aria-hidden="true"></i>
                    </span>
                    <?php
                    endif; ?>
                </div>
            </div>
            <div class="col-2">
                <?php
                self::actions($type, $row); ?>
            </div>
        </div>
        <?php
    }

    private static function rows($type, $data, $level, $langId)
    {
        ?>
        <?php
        if ($data): ?>
            <ul class="list-unstyled sortable ui-sortable">
                <?php
                foreach ($data as $item): ?>
                    <li data-id="<?= $item['id'] ?>" class="ui-sortable-handle">
                        <?php
                        $toggle = false;
                        if (isset($item->children)) {
                            $toggle = true;
                        }
                        self::row($type, $item, $level, $toggle, $langId) ?>
                        <?php
                        if (isset($item->children)): ?>
                            <?php
                            self::rows($type, $item->children, $level + 1, $langId);
                            ?>
                        <?php
                        endif; ?>
                    </li>
                <?php
                endforeach; ?>
            </ul>
        <?php
        endif; ?>
        <?php
    }

    public static function table($type, $data, $langId, $level = 0)
    {
        self::header($type);
        self::rows($type, $data, $level, $langId);
    }
}

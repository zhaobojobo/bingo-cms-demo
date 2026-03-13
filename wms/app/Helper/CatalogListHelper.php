<?php


namespace Admin\Helper;

use Admin\Helper;
use App\Register;

class CatalogListHelper
{
    private static function api($name, $row)
    {
        switch ($name) {
            case 'update-name':
                return Helper::getUrl('/catalog/name/update/' . $row['id']);
            case 'update-slug':
                return Helper::getUrl('/catalog/slug/update/' . $row['id']);
            case 'status-ban-delete':
                return Helper::getUrl('/catalog/ban-delete/' . $row['id']);
            case 'status-ban-children':
                return Helper::getUrl('/catalog/ban-children/' . $row['id']);
            case 'finder':
                return Helper::getUrl('/catalog/find/' . $row['id']);
            case 'extend':
                return Helper::getUrl(
                    '/extend/catalog/' . $row['content_type'] . '/' . $row['type'] . '/' . $row['id']
                );
            case 'edit':
                return Helper::getUrl('/catalog/edit/' . $row['content_type'] . '/' . $row['type'] . '/' . $row['id']);
            case 'Subcatalog':
                return Helper::getUrl(
                        '/catalog/edit/' . $row['content_type'] . '/' . $row['type'] . '/'
                    ) . '?parent_id=' . $row['id'];
            case 'delete':
                return Helper::getUrl('/catalog/delete');
            default:
        }

        return '';
    }

    private static function actions($row)
    {
        $c = Register::get('container');
        ?>
        <!--
        <?php
        if (Helper::hasPermission($row['content_type'] . '-' . $row['type'] . '-fields')): ?>
            <a class="button-gray bingo_button icon_button"
               title="<?= Helper::_('Fields') ?>"
               href="<?= self::api('extend', $row) ?>"
            ><i class="fa fa-fw fa-gears" aria-hidden="true"></i></a>
        <?php
        endif ?>
        -->
        <?php
        if (Helper::hasPermission($row['content_type'] . '-' . $row['type'] . '-add')): ?>
            <a class="button-gray bingo_button icon_button btn-children"
               title="<?= Helper::_('Add Subcatalog') ?>"
               href="<?= self::api('Subcatalog', $row) ?>"
            ><i class="fa fa-fw fa-plus" aria-hidden="true"></i></a>
        <?php
        endif ?>
        <?php
        if (Helper::hasPermission($row['content_type'] . '-' . $row['type'] . '-edit')): ?>
            <a class="button-gray bingo_button icon_button"
               title="<?= Helper::_('Edit') ?>"
               href="<?= self::api('edit', $row) ?>"
            ><i class="fa fa-fw fa-pencil" aria-hidden="true"></i></a>
        <?php
        endif ?>
        <?php
        if (Helper::hasPermission($row['content_type'] . '-' . $row['type'] . '-delete')): ?>
            <a class="button-gray bingo_button icon_button delete"
               title="<?= Helper::_('Delete') ?>"
               href="<?= self::api('delete', $row) ?>" data-id="<?= $row['id'] ?>"
            ><i class="fa fa-fw fa-trash-o" aria-hidden="true"></i></a>
        <?php
        endif ?>
        <?php
    }

    private static function header()
    { ?>
        <div class="row no-gutters th">
            <div class="col-1 justify-content-center"><?= Helper::_('ID') ?></div>
            <div class="col-3"><span><?= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?></span><?= Helper::_('Name') ?></div>
            <div class="col-2"><?= Helper::_('Slug') ?></div>
            <div class="col-2 justify-content-center"><?= Helper::_('Ban Delete') ?></div>
            <div class="col-2 justify-content-center"><?= Helper::_('Ban Subcatalog') ?></div>
            <div class="col-2"><?= Helper::_('Operates') ?></div>
        </div>
        <?php
    }

    private static function row($row, $level, $toggle, $langId)
    {
        ?>
        <div class="row no-gutters">
            <div class="col-1 justify-content-center"><?= $row['id'] ?></div>
            <div class="col-3 edit-catalog-name">
                <?php
                if ($toggle): ?>
                    <span class="children-toggle level-<?= $level ?>">
                        <i class="fa fa-fw fa-plus-square-o"></i>
                    </span>
                <?php
                else: ?>
                    <span><?= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?></span>
                <?php
                endif ?>
                <span class="row-title">
                    <a href=""></a>
                    <?= str_repeat(
                        '─',
                        $level
                    ) . ' ' . '<a href="' . Helper::getUrl(
                        '/posts/'
                    ) . $row['content_type'] . '/' . $row['id'] . '">' . strip_tags(
                        $row['__data'][$langId]['name']
                    ) . '</a>' ?>
                </span>
                <button class="d-none" type="button"
                        data-toggle="modal" data-target="#edit-catalog-name-modal"
                        data-api="<?= self::api('update-name', $row) ?>"
                        data-id="<?= $row['id'] ?>"
                        data-lang="<?= $langId ?>"
                ></button>
            </div>
            <div class="col-2 edit-slug" data-api="<?= self::api('update-slug', $row) ?>">
                <span><?= $row['slug'] ?></span>
                <label><input class="form-control" type="text" value="<?= $row['slug'] ?>"></label>
            </div>
            <div class="col-2 edit-ban-delete justify-content-center">
                <div class="form-check status-switch">
                    <label for="hasBanDelete"></label>
                    <input class="form-check-input" type="checkbox" id="hasBanDelete"
                           data-status="ban_delete"
                           data-api="<?= self::api('status-ban-delete', $row) ?>"
                        <?php
                        if ($row['ban_delete']): ?>
                            checked
                        <?php
                        endif ?>
                    >
                    <?php
                    if ($row['ban_delete']): ?>
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
            <div class="col-2 edit-ban-children justify-content-center">
                <div class="form-check status-switch">
                    <label for="hasBanSubcatalog"></label>
                    <input class="form-check-input" type="checkbox" id="hasBanSubcatalog"
                           data-status="ban_children"
                           data-api="<?= self::api('status-ban-children', $row) ?>"
                        <?php
                        if ($row['ban_children']): ?>
                            checked
                        <?php
                        endif ?>
                    >
                    <?php
                    if ($row['ban_children']): ?>
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
                self::actions($row); ?>
            </div>
        </div>
        <?php
    }

    private static function rows($data, $level, $langId)
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
                        self::row($item, $level, $toggle, $langId) ?>
                        <?php
                        if (isset($item->children)): ?>
                            <?php
                            self::rows($item->children, $level + 1, $langId);
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

    public static function table($data, $langId, $level = 0)
    {
        self::header();
        self::rows($data, $level, $langId);
    }
}

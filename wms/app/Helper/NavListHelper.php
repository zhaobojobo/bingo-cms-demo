<?php


namespace Admin\Helper;


use Admin\Helper;
use App\Register;

class NavListHelper
{
    private static function api($menu_id, $name, $row)
    {
        switch ($name) {
            case 'update-title':
                return Helper::getUrl('/nav/title/update/' . $row['id']);
            case 'finder':
                return Helper::getUrl('/nav/find/' . $row['id']);
            case 'edit':
                return Helper::getUrl('/nav/edit/' . $menu_id . '/' . $row['id']);
            case 'status-hidden':
                return Helper::getUrl('/nav/hidden/update/' . $row['id']);
            case 'delete':
                return Helper::getUrl('/nav/delete');
            default:
        }

        return '';
    }

    private static function actions($menu_id, $row)
    {
        ?>
        <?php
        if (Helper::hasPermission('nav-edit')): ?>
            <a class="button-gray bingo_button icon_button"
               title="<?= Helper::_('Edit') ?>"
               href="<?= self::api($menu_id, 'edit', $row) ?>"
            ><i class="fa fa-fw fa-pencil" aria-hidden="true"></i></a>
        <?php
        endif ?>
        <?php
        if (Helper::hasPermission('nav-delete')): ?>
            <a class="button-gray bingo_button icon_button delete"
               title="<?= Helper::_('Delete') ?>"
               href="<?= self::api($menu_id, 'delete', $row) ?>" data-id="<?= $row['id'] ?>"
            ><i class="fa fa-fw fa-trash-o" aria-hidden="true"></i></a>
        <?php
        endif ?>
        <?php
    }

    private static function header()
    { ?>
        <div class="row no-gutters th">
            <div class="col-1">
                <input type="checkbox" id="all">
                <label for="all" class="pl-2">ID</label>
            </div>
            <div class="col-8"><span><?= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?></span><?= Helper::_('Nav') ?>
            </div>
            <div class="col-1 justify-content-center"><?= Helper::_('Hidden') ?></div>
            <div class="col-2"><?= Helper::_('Operates') ?></div>
        </div>
        <?php
    }

    private static function row($menu_id, $row, $level, $toggle, $langId)
    {
        ?>
        <div class="row no-gutters">
            <div class="col-1">
                <input type="checkbox" name="id[]" id="id_<?= $row['id'] ?>" value="<?= $row['id'] ?>">
                <label for="id_<?= $row['id'] ?>" class="pl-2"><?= $row['id'] ?></label>
            </div>
            <div class="col-8 edit-text">
                <?php
                if ($toggle): ?>
                    <span class="children-toggle level-<?= $level ?>"><i class="fa fa-fw fa-plus-square-o"></i></span>
                <?php
                else: ?>
                    <span><?= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?></span>
                <?php
                endif ?>
                <span class="row-title"><?= str_repeat('─', $level) . ' ' . $row['__data'][$langId]['text'] ?></span>
                <button class="d-none" type="button"
                        data-toggle="modal" data-target="#edit-title-modal"
                        data-api="<?= self::api($menu_id, 'update-title', $row) ?>"
                        data-id="<?= $row['id'] ?>"
                        data-lang="<?= $langId ?>"
                ></button>
            </div>
            <div class="col-1 edit-hidden justify-content-center">
                <div class="form-check status-switch">
                    <label for="hiddenStatus"></label>
                    <input class="form-check-input" type="checkbox" id="hiddenStatus"
                           data-status="hidden"
                           data-api="<?= self::api($menu_id,'status-hidden', $row) ?>"
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
                self::actions($menu_id, $row); ?>
            </div>
        </div>
        <?php
    }

    private static function rows($menu_id, $data, $level, $langId)
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
                        self::row($menu_id, $item, $level, $toggle, $langId) ?>
                        <?php
                        if (isset($item->children)): ?>
                            <?php
                            self::rows($menu_id, $item->children, $level + 1, $langId);
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

    public static function table($menu_id, $data, $langId, $level = 0)
    {
        self::header();
        self::rows($menu_id, $data, $level, $langId);
    }
}

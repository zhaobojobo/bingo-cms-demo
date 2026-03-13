<?php


namespace Admin\Helper;

use Admin\Helper;
use App\Register;

class PageListHelper
{
    private static function api($name, $row)
    {
        switch ($name) {
            case 'update-title':
                return Helper::getUrl('/page/title/update/' . $row['id']);
            case 'update-slug':
                return Helper::getUrl('/page/slug/update/' . $row['id']);
            case 'status-shortcut':
                return Helper::getUrl('/page/shortcut/update/' . $row['id']);
            case 'status-ban-delete':
                return Helper::getUrl('/page/ban-delete/' . $row['id']);
            case 'status-ban-children':
                return Helper::getUrl('/page/ban-children/' . $row['id']);
            case 'status-review':
                return Helper::getUrl('/page/review/update/' . $row['id']);
            case 'status-hidden':
                return Helper::getUrl('/page/hidden/update/' . $row['id']);
            case 'preview':
                return Helper::getUrl('/page/preview/' . $row['id']);
            case 'finder':
                return Helper::getUrl('/page/find/' . $row['id']);
            case 'copy':
                return Helper::getUrl('/page/copy/' . $row['id']);
            case 'extend':
                return Helper::getUrl('/extend/page/' . $row['id']);
            case 'edit':
                return Helper::getUrl('/page/edit/' . $row['id']);
            case 'subpage':
                return Helper::getUrl('/page/edit/') . '?parent_id=' . $row['id'];
            case 'delete':
                return Helper::getUrl('/page/delete');
            default:
        }

        return '';
    }

    private static function actions($row)
    {
        $c = Register::get('container');
        ?>
        <?php
        if (Helper::hasPermission('page-fields')): ?>
            <a class="button-gray bingo_button icon_button"
               title="<?= Helper::_('Fields') ?>"
               href="<?= self::api('extend', $row) ?>"
            ><i class="fa fa-fw fa-gears" aria-hidden="true"></i></a>
        <?php
        endif ?>
        <?php
        if (Helper::hasPermission('page-add')): ?>
            <a class="button-gray bingo_button icon_button btn-children"
               title="<?= Helper::_('Add Subpage') ?>"
               href="<?= self::api('subpage', $row) ?>"
            ><i class="fa fa-fw fa-plus" aria-hidden="true"></i></a>
        <?php
        endif ?>
        <?php
        if (Helper::hasPermission('page-preview')): ?>
            <a class="button-gray bingo_button icon_button btn-view"
               title="<?= Helper::_('Preview') ?>"
               href="<?= self::api('preview', $row) ?>"
            ><i class="fa fa-fw fa-eye" aria-hidden="true"></i></a>
        <?php
        endif ?>
        <?php
        if (Helper::hasPermission('page-copy')): ?>
            <a class="button-gray bingo_button icon_button btn-copy"
               title="<?= Helper::_('Copy') ?>"
               href="<?= self::api('copy', $row) ?>">
                <i class="fa fa-clone" aria-hidden="true"></i>
            </a>
        <?php
        endif ?>
        <?php
        if (Helper::hasPermission('page-edit')): ?>
            <a class="button-gray bingo_button icon_button"
               title="<?= Helper::_('Edit') ?>"
               href="<?= self::api('edit', $row) ?>"
            ><i class="fa fa-fw fa-pencil" aria-hidden="true"></i></a>
        <?php
        endif ?>
        <?php
        if (Helper::hasPermission('page-delete')): ?>
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
            <div class="col-3"><span><?= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?></span><?= Helper::_('Title') ?></div>
            <div class="col"><?= Helper::_('Slug') ?></div>
            <div class="col justify-content-center"><?= Helper::_('Review') ?></div>
            <div class="col justify-content-center"><?= Helper::_('Hidden') ?></div>
            <div class="col justify-content-center"><?= Helper::_('Ban Delete') ?></div>
            <div class="col justify-content-center"><?= Helper::_('Ban Subpage') ?></div>
            <div class="col-2"><?= Helper::_('Operates') ?></div>
        </div>
        <?php
    }

    private static function row($row, $level, $toggle, $langId)
    {
        ?>
        <div class="row no-gutters">
            <div class="col-1 justify-content-center"><?= $row['id'] ?></div>
            <div class="col-3 edit-title">
                <?php
                if ($toggle): ?>
                    <span class="children-toggle level-<?= $level ?>"><i class="fa fa-fw fa-plus-square-o"></i></span>
                <?php
                else: ?>
                    <span><?= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?></span>
                <?php
                endif ?>
                <span class="row-title"><?= str_repeat('─', $level) . ' ' . $row['__data'][$langId]['title'] ?></span>
                <button class="d-none" type="button"
                        data-toggle="modal" data-target="#edit-title-modal"
                        data-api="<?= self::api('update-title', $row) ?>"
                        data-id="<?= $row['id'] ?>"
                        data-lang="<?= $langId ?>"
                ></button>
            </div>
            <div class="col edit-slug" data-api="<?= self::api('update-slug', $row) ?>">
                <span><?= $row['slug'] ?></span>
                <label><input class="form-control" type="text" value="<?= $row['slug'] ?>"></label>
            </div>
            <div class="col edit-review justify-content-center">
                <div class="form-check status-switch">
                    <label for="reviewStatus"></label>
                    <input class="form-check-input" type="checkbox" id="reviewStatus"
                           data-status="review"
                           data-api="<?= self::api('status-review', $row) ?>"
                        <?php if ($row['review']): ?>checked<?php endif ?>
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
            <div class="col edit-hidden justify-content-center">
                <div class="form-check status-switch">
                    <label for="hiddenStatus"></label>
                    <input class="form-check-input" type="checkbox" id="hiddenStatus"
                           data-status="hidden"
                           data-api="<?= self::api('status-hidden', $row) ?>"
                        <?php
                        if ($row['hidden']): ?>
                            checked
                        <?php
                        endif ?>
                    >
                    <span class="status2 button-green bingo_button icon_button <?php if (! $row['hidden']): ?>d-none<?php endif; ?>">
                        <?= Helper::_('Hidden') ?>
                    </span>
                    <span class="status2 button-red bingo_button icon_button <?php if ($row['hidden']): ?>d-none<?php endif; ?>">
                        <?= Helper::_('Shown') ?>
                    </span>
                </div>
            </div>
            <div class="col edit-ban-delete justify-content-center">
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
                    <span class="status2 button-green bingo_button icon_button <?php if (! $row['ban_delete']): ?>d-none<?php endif; ?>">
                        <?= Helper::_('Banned Delete') ?>
                    </span>
                    <span class="status2 button-red bingo_button icon_button <?php if ($row['ban_delete']): ?>d-none<?php endif; ?>">
                        <?= Helper::_('Not Banned Delete') ?>
                    </span>
                </div>
            </div>
            <div class="col edit-ban-children justify-content-center">
                <div class="form-check status-switch">
                    <label for="hasBanSubpage"></label>
                    <input class="form-check-input" type="checkbox" id="hasBanSubpage"
                           data-status="ban_children"
                           data-api="<?= self::api('status-ban-children', $row) ?>"
                        <?php
                        if ($row['ban_children']): ?>
                            checked
                        <?php
                        endif ?>
                    >
                    <span class="status2 button-green bingo_button icon_button <?php if (! $row['ban_children']): ?>d-none<?php endif; ?>">
                        <?= Helper::_('Banned Subpage') ?>
                    </span>
                    <span class="status2 button-red bingo_button icon_button <?php if ($row['ban_children']): ?>d-none<?php endif; ?>">
                        <?= Helper::_('Not Banned Subpage') ?>
                    </span>
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

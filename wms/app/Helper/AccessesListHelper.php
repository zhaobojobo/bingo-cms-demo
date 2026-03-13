<?php

namespace Admin\Helper;

use Admin\Helper;

class AccessesListHelper
{
    private static function actions($row)
    {
        ?>
        <a class="button-gray bingo_button icon_button"
           title="<?= Helper::_('Edit') ?>"
           href="<?= Helper::getUrl('/accesses/edit/' . $row->getId()) ?>"
        ><i class="fa fa-pencil" aria-hidden="true"></i></a>
        <a class="button-gray bingo_button icon_button delete"
           title="<?= Helper::_('Delete') ?>"
           href="<?= Helper::getUrl('/accesses/delete') ?>"
           data-id="<?= $row->getId() ?>"
        ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
        <?php
    }

    private static function header()
    { ?>
        <div class="row no-gutters th">
            <div class="col-1 text-center"><?= Helper::_('ID') ?></div>
            <div class="col-2"><?= Helper::_('Name') ?></div>
            <div class="col-3"><?= Helper::_('Code') ?></div>
            <div class="col-1"><?= Helper::_('Type') ?></div>
            <div class="col-2"><?= Helper::_('Route') ?></div>
            <div class="col-1"><?= Helper::_('Linkable') ?></div>
            <div class="col-2">
                <?= Helper::_('Operates') ?>
            </div>
        </div>
        <?php
    }

    private static function row($row, $level, $toggle)
    { ?>
        <div class="row no-gutters">
            <div class="col-1 text-center"><?= $row->getId() ?></div>
            <div class="col-2">
                <?php
                if ($toggle): ?>
                    <span class="children-toggle"><i class="fa fa-fw fa-plus-square-o"></i></span>
                <?php
                else: ?>
                    <span><?= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?></span>
                <?php
                endif ?>
                <span class="row-title"><?= str_repeat('─', $level) . ' ' . Helper::_($row->getName()) ?></span>
            </div>
            <div class="col-3"><?= $row->getAccessCode() ?></div>
            <div class="col-1"><?= $row->getAccessType() ?></div>
            <div class="col-2"><?= $row->getRoute() ?></div>
            <div class="col-1"><?= Helper::_($row->showLinkable()) ?></div>
            <div class="col-2">
                <?php
                self::actions($row); ?>
            </div>
        </div>
        <?php
    }

    private static function rows($data, $level)
    {
        ?>
        <?php
        if ($data): ?>
            <ul class="list-unstyled sortable ui-sortable">
                <?php
                foreach ($data as $item): ?>
                    <li data-id="<?= $item->getId() ?>" class="ui-sortable-handle">
                        <?php
                        $toggle = false;
                        if (isset($item->children)) {
                            $toggle = true;
                        }
                        self::row($item, $level, $toggle) ?>
                        <?php
                        if (isset($item->children)): ?>
                            <?php
                            self::rows($item->children, $level + 1);
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

    public static function table($data, $level = 0)
    {
        self::header();
        self::rows($data, $level);
    }
}
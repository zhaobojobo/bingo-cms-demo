<?php

use Admin\Helper;

/**@var $data */
?>

<ul class="wow fadeInUp">

    <li>
        <span class="small">PERMISSION</span>
        <span><?= Helper::_('PERMISSION') ?></span>
        <ul class="submenu">
            <li><i class="fa fa-caret-down" aria-hidden="true"></i>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/accesses') ?>"><?= Helper::_('Accesses') ?></a>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/agencies') ?>"><?= Helper::_('Agencies') ?></a>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/roles') ?>"><?= Helper::_('Roles') ?></a>
            </li>
        </ul>
    </li>
    <li>
        <span class="small">NAVIGATION</span>
        <span><?= Helper::_('NAVIGATION') ?></span>
        <ul class="submenu">
            <li><i class="fa fa-caret-down" aria-hidden="true"></i>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/menus/') ?>"><?= Helper::_('Navigation Menu') ?></a>
            </li>
        </ul>
    </li>
    <li>
        <span class="small">PAGE</span>
        <span><?= Helper::_('PAGE') ?></span>
        <ul class="submenu">
            <li><i class="fa fa-caret-down" aria-hidden="true"></i>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/pages/') ?>"><?= Helper::_('Page Management') ?></a>
            </li>
            <?php
            foreach ($data['SHORTCUTS'] as $page):?>
                <li>
                    <a href="<?= Helper::getUrl('/page/edit/' . $page['id']) ?>">
                        <?= $page->__data[DEFAULT_LANG]->title ?>
                    </a>
                </li>
            <?php
            endforeach; ?>
        </ul>
    </li>
    <li>
        <span class="small">NEWS</span>
        <span><?= Helper::_('NEWS') ?></span>
        <ul class="submenu">
            <li><i class="fa fa-caret-down" aria-hidden="true"></i>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/categories/news') ?>">
                    <?= Helper::_('Category Management') ?>
                </a>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/posts/news') ?>"><?= Helper::_('News Management') ?></a>
            </li>
        </ul>
    </li>
    <li>
        <span class="small">PRODUCT</span>
        <span><?= Helper::_('PRODUCT') ?></span>
        <ul class="submenu">
            <li><i class="fa fa-caret-down" aria-hidden="true"></i>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/categories/product') ?>"><?= Helper::_(
                        'Category Management'
                    ) ?></a>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/posts/product') ?>"><?= Helper::_('Product Management') ?></a>
            </li>
        </ul>
    </li>
    <li>
        <span class="small">PROJECT</span>
        <span><?= Helper::_('PROJECT') ?></span>
        <ul class="submenu">
            <li><i class="fa fa-caret-down" aria-hidden="true"></i>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/categories/project') ?>"><?= Helper::_(
                        'Category Management'
                    ) ?></a>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/posts/project') ?>"><?= Helper::_('Project Management') ?></a>
            </li>
        </ul>
    </li>
    <li>
        <span class="small">ALBUM</span>
        <span><?= Helper::_('ALBUM') ?></span>
        <ul class="submenu">
            <li><i class="fa fa-caret-down" aria-hidden="true"></i>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/albums/') ?>"><?= Helper::_('Album Management') ?></a>
            </li>
        </ul>
    </li>
    <li>
        <span class="small">SLIDE</span>
        <span><?= Helper::_('SLIDE') ?></span>
        <ul class="submenu">
            <li><i class="fa fa-caret-down" aria-hidden="true"></i>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/slides/') ?>"><?= Helper::_('Slide Management') ?></a>
            </li>
        </ul>
    </li>
    <li>
        <span class="small">MEMBER</span>
        <span><?= Helper::_('MEMBER') ?></span>
        <ul class="submenu">
            <li><i class="fa fa-caret-down" aria-hidden="true"></i>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/member-groups/') ?>"><?= Helper::_('Group Management') ?></a>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/members/') ?>"><?= Helper::_('Member Management') ?></a>
            </li>
        </ul>
    </li>
    <li>
        <span class="small">SUBSCRIBER</span>
        <span><?= Helper::_('SUBSCRIBER') ?></span>
        <ul class="submenu">
            <li><i class="fa fa-caret-down" aria-hidden="true"></i>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/subscriber-groups/') ?>">
                    <?= Helper::_('Group Management') ?>
                </a>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/subscribers/') ?>">
                    <?= Helper::_('Subscriber Management') ?>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <span class="small">SUBSCRIPTION</span>
        <span><?= Helper::_('SUBSCRIPTION') ?></span>
        <ul class="submenu">
            <li><i class="fa fa-caret-down" aria-hidden="true"></i>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/subscription/categories/') ?>">
                    <?= Helper::_('Category Management') ?>
                </a>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/subscriptions/') ?>">
                    <?= Helper::_('Subscription Management') ?>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <span class="small">DONATION</span>
        <span><?= Helper::_('DONATION') ?></span>
        <ul class="submenu">
            <li><i class="fa fa-caret-down" aria-hidden="true"></i>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/categories/donation-project') ?>">
                    <?= Helper::_('Donation Project Category Management') ?>
                </a>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/donation-projects/') ?>">
                    <?= Helper::_('Donation Project Management') ?>
                </a>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/donations/') ?>">
                    <?= Helper::_('Donation Records') ?>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <span class="small">ACTIVITY</span>
        <span><?= Helper::_('ACTIVITY') ?></span>
        <ul class="submenu">
            <li><i class="fa fa-caret-down" aria-hidden="true"></i>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/categories/activity') ?>"><?= Helper::_(
                        'Category Management'
                    ) ?></a>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/activities/') ?>"><?= Helper::_('Activity Management') ?></a>
            </li>
        </ul>
    </li>
    <li>
        <span class="small">FORM</span>
        <span><?= Helper::_('FORM') ?></span>
        <ul class="submenu">
            <li><i class="fa fa-caret-down" aria-hidden="true"></i>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/forms/') ?>"><?= Helper::_('Form Management') ?></a>
            </li>
        </ul>
    </li>
    <li>
        <span class="small">FILE</span>
        <span><?= Helper::_('FILE') ?></span>
        <ul class="submenu">
            <li><i class="fa fa-caret-down" aria-hidden="true"></i>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/file/images/') ?>"><?= Helper::_('Image Management') ?></a>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/file/videos/') ?>"><?= Helper::_('Video Management') ?></a>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/file/files/') ?>"><?= Helper::_('File Management') ?></a>
            </li>
        </ul>
    </li>
    <li>
        <span class="small">SETTING</span>
        <span><?= Helper::_('SETTING') ?></span>
        <ul class="submenu">
            <li><i class="fa fa-caret-down" aria-hidden="true"></i>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/setting/edit/2') ?>"><?= Helper::_('Contact Info') ?></a>
            </li>
            <?php
            if (Helper::isSuper()): ?>
                <li>
                    <a href="<?= Helper::getUrl('/setting/edit/1') ?>">
                        <?= Helper::_('System Setting') ?></a>
                </li>
                <li>
                    <a href="<?= Helper::getUrl('/setting/edit/4') ?>"><?= Helper::_('Email Setting') ?></a>
                </li>
            <?php
            endif ?>
        </ul>
    </li>
    <li>
        <span class="small">ACCOUNT</span>
        <span><?= Helper::_('ACCOUNT') ?></span>
        <ul class="submenu">
            <li><i class="fa fa-caret-down" aria-hidden="true"></i>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/users/') ?>"><?= Helper::_('Account Management') ?></a>
            </li>
            <li>
                <a href="<?= Helper::getUrl('/user/user') ?>"><?= Helper::_('My Account') ?></a>
            </li>
        </ul>
    </li>
    <?php
    if ($_SESSION['user']['id'] == 1): ?>
        <li>
            <span class="small">SYSTEM</span>
            <span><?= Helper::_('SYSTEM') ?></span>
            <ul class="submenu">
                <li><i class="fa fa-caret-down"
                       aria-hidden="true"></i></li>
                <li>
                    <a href="<?= Helper::getUrl('/models/') ?>">
                        <?= Helper::_('Model Management') ?>
                    </a>
                </li>
                <li>
                    <a href="<?= Helper::getUrl('/catalogs/') ?>"><?= Helper::_('Catalog Management') ?></a>
                </li>
                <li>
                    <a href="<?= Helper::getUrl('/posts/') ?>"><?= Helper::_('Post Management') ?></a>
                </li>
                <li>
                    <a href="<?= Helper::getUrl('/lists/') ?>"><?= Helper::_('List Data') ?></a>
                </li>
                <li>
                    <a href="<?= Helper::getUrl('/fragments/') ?>"><?= Helper::_('Fragment Data') ?></a>
                </li>
                <li>
                    <a href="<?= Helper::getUrl('/settings/') ?>"><?= Helper::_('Setting') ?></a>
                </li>
                <li>
                    <a href="<?= Helper::getUrl('/actions/') ?>"><?= Helper::_('Action Record') ?></a>
                </li>
                <li>
                    <a href="<?= Helper::getUrl('/messages/') ?>"><?= Helper::_('Language Package') ?></a>
                </li>
            </ul>
        </li>
    <?php
    endif; ?>
</ul>

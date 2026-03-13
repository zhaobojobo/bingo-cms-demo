<?php
/**
 * view data
 *
 * @var $site
 * @var $seo
 * @var $page
 */ ?>

<?php
$langData = langNavs(['en-GB' => 'EN', 'zh-HK' => '繁', 'zh-CN' => '简'], true);
$navs = navs('main');
?>

<header class="sticky-top header block">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="brand">
                <a class="navbar-brand mb-0 h1" href="<?= url('/') ?>"
                   style="background-image:url('<?= $site['BASE']['LOGO'] ?>')"></a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php foreach ($navs as $nav):
                        $current = isCurrent($nav);
                        ?>
                        <?php if (empty($nav->children)): ?>
                        <li class="nav-item">
                            <?php if ($current): ?>
                                <a class="nav-link active" aria-current="page"
                                   href="<?= navUrl($nav) ?>"><?= $nav->text ?></a>
                            <?php else: ?>
                                <a class="nav-link"
                                   href="<?= navUrl($nav) ?>"><?= $nav->text ?></a>
                            <?php endif ?>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <?php if ($current): ?>
                                <a class="nav-link active dropdown-toggle" href="<?= navUrl($nav) ?>" role="button"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $nav->text ?>
                                </a>
                            <?php else: ?>
                                <a class="nav-link dropdown-toggle" href="<?= navUrl($nav) ?>" role="button"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $nav->text ?>
                                </a>
                            <?php endif ?>
                            <ul class="dropdown-menu">
                                <?php foreach ($nav->children as $child): ?>
                                    <li>
                                        <?php if (isCurrent($child)): ?>
                                            <a class="dropdown-item current"
                                               href="<?= navUrl($child) ?>"><?= $child->text ?></a>
                                        <?php else: ?>
                                            <a class="dropdown-item"
                                               href="<?= navUrl($child) ?>"><?= $child->text ?></a>
                                        <?php endif ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endif ?>
                    <?php endforeach; ?>
                </ul>
                <div class="lang-switcher">
                    <div class="dropdown">
                        <a class="nav-link current-lang dropdown-toggle" data-bs-toggle="dropdown" href="#"
                           role="button" aria-expanded="false">
                            <i class="bi bi-globe"></i>
                            <span class="mx-1"><?= $langData['currentLang']['text'] ?></span>
                        </a>
                        <ul class="dropdown-menu lang-list">
                            <?php foreach ($langData['langNavs'] as $langNav): ?>
                                <li><a class="dropdown-item" href="<?= $langNav['url'] ?>">
                                        <?= $langNav['text'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

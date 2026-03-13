<?php

use App\Register;
use App\Setting;
use Site\Helper;
use Site\Models\Catalog;
use Site\Models\CatalogMap;
use Site\Models\Form;
use Site\Models\ListItem;
use Site\Models\Menu;
use Site\Models\Nav;
use Site\Models\Page;
use Site\Models\Post;


/***
 * 換行符轉換 <p>
 *
 */
function nl2p($text): string
{
    $text = strip_tags($text);
    $lines = explode(PHP_EOL, $text);
    foreach ($lines as $i => $line) {
        $line = trim($line);
        if (strlen($line) == 0) {
            unset($lines[$i]);
        } else {
            $lines[$i] = $line;
        }
    }

    return '<p>' . implode("</p>\n<p>", $lines) . "</p>\n";
}

/**
 * 翻譯文本
 *
 */
function t($message, $params = [])
{
    return Helper::_($message, $params);
}

/**
 * 設置數據獲取
 *
 */
function setting($file, $group = '', $key = '')
{
    $model = new Setting($file);

    return $model->getValues($group, $key);
}

function favicon()
{
    $site = setting('site');

    return $site['BASE']['FAVICON'];
}

function seo($page, $lang): array
{
    $site = setting('site');
    $titles = [];
    $pageTitle = $page['seo_title'] ?: $page['title'] ?? $page['name'];
    $siteTitle = $site['BASE']['TITLE'][$lang];
    if ($pageTitle) {
        $titles[] = $pageTitle;
    }
    if ($siteTitle) {
        $titles[] = $siteTitle;
    }

    return [
        'title' => implode(' | ', $titles),
        'description' => $page['seo_description'] ?: $page['summary'] ?: $site['BASE']['DESCRIPTION'][$lang],
        'keywords' => $page['seo_keywords'] ?: $site['BASE']['KEYWORDS'][$lang]
    ];
}

function copyright($lang)
{
    $site = setting('site');

    return $site['BASE']['COPYRIGHT'][$lang];
}

/**
 * Url 地址生成
 *
 */
function url($route): string
{
    return Helper::getUrl($route);
}

/**
 * 頁面 URl 生成
 *
 */
function pageUrl($page): string
{
    if (is_numeric($page)) {
        $page = page($page);
    }

    $path = Helper::getPageUrlPath($page);

    return Helper::getUrl('/' . $path);
}

/**
 * 分類 URl 生成
 *
 */
function catUrl($cat): string
{
    if (is_numeric($cat)) {
        $cat = cat($cat);
    }

    $path = Helper::getCatUrlPath($cat);

    return Helper::getUrl('/' . $path);
}

/**
 * 文章 URl 生成
 *
 */
function articleUrl($article): string
{
    $path = Helper::getArticleUrlPath($article);

    return Helper::getUrl('/' . $path);
}

/**
 * 導航 URl 生成
 *
 */
function navUrl($nav, $null = 'javascript:void(0)')
{
    switch ($nav['type']) {
        case 'page':
            $model = new Page();
            $page = $model->find($nav['target_id']);
            $url = pageUrl($page);
            break;
        case 'catalog':
            $model = new Catalog();
            $cat = $model->find($nav['target_id']);
            $url = catUrl($cat);
            break;
        case 'customize':
            $url = $nav['url'] ? url($nav['url']) : $null;
            break;
        default:
            $url = $null;
    }

    return $url;
}

/**
 * 主題鏈接路徑
 *
 */
function themePath(): string
{
    $c = Register::get('container');

    return SUB_DIR . '/themes/' . $c['config']['theme'];
}

/**
 * 文件鏈接地址
 *
 */
function fileLink($url): string
{
    return SUB_DIR . $url;
}

/**
 * 多語言導航菜單
 *
 */
function langNavs($labels = [], $raw = false)
{
    $c = Register::get('container');
    $languages = $c['languages'];
    $navs = [];
    if ($raw) {
        foreach ($languages as $langId => $language) {
            $navs[$langId] = [
                'text' => $labels[$langId] ?? $language,
                'url' => Helper::getLangUrl($langId),
                'active' => $c['currentLang'] == $langId
            ];
        }

        return ['currentLang' => $navs[$c['currentLang']], 'langNavs' => $navs];
    }
    foreach ($languages as $langId => $language) {
        if ($c['currentLang'] == $langId) {
            $navs[] = sprintf(
                '<li class="current"><a href="%s">%s</a></li>',
                Helper::getLangUrl($langId),
                $labels[$langId] ?? $language
            );
        } else {
            $navs[] = sprintf(
                '<li><a href="%s">%s</a></li>',
                Helper::getLangUrl($langId),
                $labels[$langId] ?? $language
            );
        }
    }

    return implode('', $navs);
}

/**
 * 獲取菜单
 *
 */
function menu($cname)
{
    $model = new Menu();

    return $model->findByName($cname);
}

/**
 * 獲取導航
 *
 */
function navs($cname, $pid = 0): array
{
    $model = new Nav();
    $menu = menu($cname);

    return $menu ? $model->navsOfMenu($menu->id, $pid) : [];
}

function findNav($nid)
{
    $model = new Nav();

    return $model->findNav($nid);
}

function findNavTarget($nid)
{
    $model = new Nav();

    return $model->findNavTarget($nid);
}

/**
 * 檢測導航是否是當前頁面
 *
 */
function isCurrent($nav): bool
{
    $result = false;
    $c = Register::get('container');
    if ($nav->children) {
        foreach ($nav->children as $child) {
            $result = url($c['uri']) == navUrl($child);
            if ($result) {
                break;
            }
        }
    } else {
        $result = url($c['uri']) == navUrl($nav);
    }

    return $result;
}

/**
 * 獲取頁面
 *
 */
function page($id)
{
    $model = new Page();

    return $model->find($id);
}

/**
 * 獲取父頁面
 *
 */
function pageParent($id)
{
    $model = new Page();
    $page = $model->find($id);

    return $model->find($page['parent_id']);
}

/**
 * 獲取祖先頁面
 *
 */
function pageParents($id): array
{
    $parents = [];
    $model = new Page();
    $page = $model->find($id);
    while ($parent = $model->find($page['parent_id'])) {
        array_unshift($parents, $parent);
        $page = $parent;
    }

    return $parents;
}

/**
 * 獲取根頁面
 *
 */
function pageRoot($id)
{
    $parents = pageParents($id);
    if ($parents) {
        return array_shift($parents);
    }

    return null;
}

/**
 * 獲取子頁面
 *
 */
function pageChildren($id): array
{
    $model = new Page();

    return $model->children($id, SORT_ORDER_DESC);
}

/**
 * 獲取後代頁面
 *
 */
function pageDescendants($id): array
{
    $descendants = [];
    $model = new Page();

    $children = $model->children($id);
    if ($children) {
        $descendants = array_merge($descendants, $children);
        foreach ($children as $child) {
            $descendants = array_merge($descendants, pageDescendants($child->id));
        }
    }

    return $descendants;
}

/**
 * 獲取分類樹
 *
 */
function cats($type = '', $catType = '', $pid = 0): array
{
    $model = new Catalog();
    $where = '';
    $params = [];
    if ($type) {
        $where .= 'content_type=:content_type';
        $params['content_type'] = $type;
    }
    if ($catType) {
        $where .= ' AND type=:type';
        $params['type'] = $catType;
    }
    if ($pid) {
        $where .= ' AND parent_id=:parent_id';
        $params['parent_id'] = $pid;
    }
    $cats = $model->findAll($where, $params, SORT_ORDER_ASC);

    return Helper::listAsTree($cats, intval($pid));
}

/**
 * 獲取分類
 *
 */
function cat($id)
{
    $model = new Catalog();

    return $model->find($id);
}

/**
 * 獲取父分類
 *
 */
function catParent($id)
{
    $model = new Catalog();
    $cat = $model->find($id);

    return $model->find($cat['parent_id']);
}

/**
 * 獲取祖先分類
 *
 */
function catParents($id): array
{
    $parents = [];
    $model = new Catalog();
    $cat = $model->find($id);
    while ($parent = $model->find($cat['parent_id'])) {
        array_unshift($parents, $parent);
        $cat = $parent;
    }

    return $parents;
}

/**
 * 獲取根分類
 *
 */
function catRoot($id)
{
    $parents = catParents($id);
    if ($parents) {
        return array_shift($parents);
    }

    return null;
}

/**
 * 獲取子分類
 *
 */
function catChildren($id): array
{
    $model = new Catalog();

    return $model->children($id);
}

/**
 * 獲取後代分類
 *
 */
function catDescendants($id): array
{
    $descendants = [];
    $model = new Catalog();

    $children = $model->children($id);
    if ($children) {
        $descendants = array_merge($descendants, $children);
        foreach ($children as $child) {
            $descendants = array_merge($descendants, catDescendants($child->id));
        }
    }

    return $descendants;
}

/**
 * 獲取文章分類
 *
 */
function catOfArticle($article, $catType)
{
    $model = new CatalogMap();
    $id = $model->catIdOfType($article->id, $catType);
    $model = new Catalog();

    return $model->find($id);
}

/**
 * 獲取分類下文章數量
 *
 */
function postsCount($cat)
{
    $model = new Post();

    return $model->postsCount($cat);
}

/**
 * 獲取文章
 *
 */
function article($id)
{
    $model = new Post();
    $row = $model->find($id);
    if ($row['review'] == 0) {
        $row = $model->getCache($row['id']);
    }

    return $row;
}

/**
 * 獲取文章列表
 *
 */
function articles($pageSize = 0, $cat = 0, $where = '', $params = [], $search = '', $sort = SORT_ORDER_DESC)
{
    if ($where) {
        $where .= ' AND hidden=:hidden';
    } else {
        $where = 'hidden=:hidden';
    }
    $params['hidden'] = 0;
    if ($cat) {
        $catModel = new Catalog();
        $catIds = $catModel->allCatIds($cat);
        if ($catIds) {
            $mapModel = new CatalogMap();
            $contentsId = $mapModel->contentsId($catIds);
            $inClause = Helper::inClause('id', $contentsId);
            if ($where == '') {
                $where = $inClause['where'];
                $params = $inClause['params'];
            } else {
                $where .= ' AND ' . $inClause['where'];
                $params = array_merge($params, $inClause['params']);
            }
        }
    }

    if ($search) {
        return search($pageSize, $cat, $where, $params, $search, $sort);
    }

    $model = new Post();

    if ($pageSize) {
        return $model->findPage(Helper::get('p', 1), $pageSize, $where, $params, $sort);
    }

    return $model->findAll($where, $params, $sort);
}

/**
 * 搜索
 *
 */
function search($pageSize = 0, $type = '', $cats = [], $where = '', $params = [], $search = '', $sort = '')
{
    // 搜索
    $c = Register::get('container');
    $lang = $c['currentLang'];
    $dataSql = "SELECT post_id FROM post_data";
    $dataWhere = ' WHERE lang=:lang';
    $params['lang'] = $lang;
    if ($search) {
        $dataWhere .= ' AND (title LIKE :search || summary LIKE :search || content LIKE :search)';
        $params['search'] = '%' . $search . '%';
    }
    $dataSql .= $dataWhere . " GROUP BY post_id";

    if ($where) {
        $where .= " AND type='{$type}'";
    } else {
        $where = "type='{$type}'";
    }

    // 目录
    $mapModel = new CatalogMap();
    if ($cats) {
        foreach ($cats as $type => $_cats) {
            if ($_cats) {
                $contentsId = $mapModel->contentsId($_cats);
                $inClause = Helper::inClause('id', $contentsId);
                if ($where == '') {
                    $where = $inClause['where'];
                    $params = $inClause['params'];
                } else {
                    $where .= ' AND ' . $inClause['where'];
                    $params = array_merge($params, $inClause['params']);
                }
            }
        }
    }

    if (!$sort) {
        $sort = SORT_ORDER_DESC;
    }

    if (!$pageSize) {
        $sql = "SELECT post.id FROM ($dataSql) a LEFT JOIN post ON post.id=a.post_id WHERE {$where} ORDER BY {$sort}";
        $sth = $c['db']->query($sql, $params);
        $rows = $sth->fetchAll();
        $model = new Post();
        foreach ($rows as &$row) {
            $row = $model->find($row['id']);
        }

        return $rows;
    } else {
        $sql = "SELECT COUNT(*) AS total FROM ($dataSql) a LEFT JOIN post ON post.id=a.post_id WHERE {$where}";

        $sth = $c['db']->query($sql, $params);
        $total = $sth->fetchColumn();
        $totalPages = ceil($total / $pageSize);

        if (!$total > 0) {
            return [
                'rows' => [],
                'page' => 1,
                'size' => $pageSize,
                'total' => 0,
                'totalPages' => 1,
            ];
        }

        $p = Helper::get('p', 1);
        $offset = ($p - 1) * $pageSize;
        $startRow = $offset;
        $endRow = $offset + ($pageSize - 1);
        if ($p == $totalPages) {
            $endRow = $total - 1;
        }

        $sql = "SELECT post.id FROM ($dataSql) a LEFT JOIN post ON post.id=a.post_id WHERE {$where} ORDER BY {$sort} LIMIT {$pageSize} OFFSET {$offset}";
        $sth = $c['db']->query($sql, $params);
        $rows = $sth->fetchAll();

        $model = new Post();
        foreach ($rows as &$row) {
            $row = $model->find($row['id']);
        }

        return [
            'rows' => $rows,
            'page' => $p,
            'size' => $pageSize,
            'total' => $total,
            'totalPages' => $totalPages,
            'startRow' => $startRow,
            'endRow' => $endRow,
        ];
    }
}

/**
 * 最近發布
 *
 */
function latest($type, $cats = [], $exclude = 0, $limit = 0)
{
    $where = 'type=:type AND hidden=:hidden AND (review=:review || cache=:cache)';
    $params = ['type' => $type, 'hidden' => 0, 'review' => 1, 'cache' => 1];

    if ($cats) {
        $mapModel = new CatalogMap();
        $contentsId = $mapModel->contentsId($cats);
        $inClause = Helper::inClause('id', $contentsId);
        $where .= ' AND ' . $inClause['where'];
        $params = array_merge($params, $inClause['params']);
    }

    if ($exclude) {
        $where .= " AND id <> :exclude";
        $params['exclude'] = $exclude;
    }

    $model = new Post();

    return $model->findSome($where, $params, 'publish_time DESC', $limit);
}

/**
 * 相關發布
 *
 */
function related($type, $cats = [], $exclude = 0, $limit = 0)
{
    $where = 'type=:type AND hidden=:hidden AND (review=:review || cache=:cache)';
    $params = ['type' => $type, 'hidden' => 0, 'review' => 1, 'cache' => 1];

    if ($cats) {
        $mapModel = new CatalogMap();
        $contentsId = $mapModel->contentsId($cats);
        $inClause = Helper::inClause('id', $contentsId);
        $where .= ' AND ' . $inClause['where'];
        $params = array_merge($params, $inClause['params']);
    }

    if ($exclude) {
        $where .= " AND id <> :exclude";
        $params['exclude'] = $exclude;
    }

    $model = new Post();

    return $model->findSome($where, $params, 'rand()', $limit);
}

/**
 * 表單
 *
 */
function bingoForm($tag_id, $form_id)
{
    $model = new Form();
    $form = $model->find($form_id);

    $script = <<<SCRIPT
\n<script>
(function (Q) {
    var form = Q("form#{$tag_id}");
    var button = form.find("button.submit");
    form.on('submit', function (e) {
        e.preventDefault();
        return false;
    });
    button.on('click', function (e) {
        alert('加载中, 请稍后');
        e.preventDefault();
        return false;
    });
})(jQuery);
</script>
SCRIPT;

    switch ($form->captcha) {
        case 'null':
        case 'an':
            $script .= generateCaptchaScript($tag_id, $form->action);
            break;
        case 'grc_v2':
            $script .= generateReCaptchaV2Script($tag_id, $form->action);
            break;
        case 'grc_v3':
            $script .= generateReCaptchaV3Script($tag_id, $form->action);
            break;
    }

    echo $script;
}

function generateCaptchaScript($tag_id, $action)
{
    return <<<AN_SCRIPT
<script>
(function (Q) {
    Q(document).ready(function(Q){
        var form = Q("form#{$tag_id}");
        var button = form.find("button.submit");
        button.off('click').on('click', function (e) {
            e.preventDefault();
            if (button.hasClass("disabled")) {
                alert("Submitting, do not click repeatedly");
            } else {
                button.addClass("disabled");
                Q.post(
                    "{$action}",
                    form.serialize(),
                    function (result) {
                        alert(result.message);
                        button.removeClass("disabled");
                        if (result.status) {
                            location.reload();
                        }
                    },
                    "json"
                );
            }
            return false;
        });
    });
})(jQuery);
</script>
AN_SCRIPT;
}

function generateReCaptchaV2Script($tag_id, $action)
{
    $key = setting('site', 'GOOGLE_RECAPTCHA', 'SITE_KEY');
    return <<<GRCV2_SCRIPT
\n<script>
var onloadCallback = function() {
    grecaptcha.render('recaptcha', {
        'sitekey' : '{$key}'
    });
};
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
\n<script>
(function (Q) {
    Q(document).ready(function(Q){
        var form = Q("form#{$tag_id}");
        var button = form.find("button.submit");
        button.off('click').on('click', function (e) {
            e.preventDefault();
            button.addClass('disabled');
            Q.post(form.attr('action'), form.serialize(), function (result) {
                button.removeClass('disabled');
                if (result.message) {
                    window.alert(result.message);
                }
                if (result.status) {
                    if (result.location) {
                        location.href = result.location;
                    } else {
                        location.reload();
                    }
                }
            }, 'json');
            return false;
        });
    });
})(jQuery);
</script>
GRCV2_SCRIPT;
}

function generateReCaptchaV3Script($tag_id, $action)
{
    $key = setting('site', 'GOOGLE_RECAPTCHA', 'SITE_KEY');
    return <<<GRCV3_SCRIPT
\n<script>
(function (Q) {
    Q(document).ready(function(Q){
        var form = Q("form#{$tag_id}");
        var button = form.find("button.submit");
        button.off('click').on('click', function (e) {
            e.preventDefault();
            if (typeof (window.grecaptcha) === "undefined") {
                window.alert('Google reCAPTCHA is not loaded!');
            } else {
                window.grecaptcha.ready(function () {
                    window.grecaptcha.execute('{$key}', {action: 'submit'}).then(function (token) {
                        if (button.hasClass('disabled')) {
                            window.alert('Submitting, do not click repeatedly');
                        } else {
                            button.addClass('disabled');
                            var data = form.serialize() + '&token=' + token;
                            Q.post(form.attr('action'), data, function (result) {
                                button.removeClass('disabled');
                                if (result.message) {
                                    window.alert(result.message);
                                }
                                if (result.status) {
                                    if (result.location) {
                                        location.href = result.location;
                                    } else {
                                        location.reload();
                                    }
                                }
                            }, 'json');
                        }
                    });
                });
            }
            return false;
        });
    });
})(jQuery);
</script>
GRCV3_SCRIPT;
}

/**
 * 字符驗證碼
 *
 */
function captchaImage($height = '40px'): string
{
    $title = Helper::_('Click to change another image');

    return sprintf(
        '<img src="%s/captcha.jpg" class="captcha" alt="Captcha image" title="%s" style="cursor:pointer;height: %s">',
        SUB_DIR,
        $title,
        $height
    );
}

/**
 * 導航是否激活
 *
 */
function isActiveNav($page, $nav): bool
{
    $type = $page->type;
    if ($type == 'category') {
        $type = 'catalog';
    }

    return $type == $nav->type && $page->id == $nav->target_id;
}

/**
 * 會員是否登入
 *
 */
function isLogin(): bool
{
    return !empty($_SESSION['member']);
}

/**
 * 自動表單渲染
 *
 */
function form($name): string
{
    $model = new Form();
    $form = $model->findOne("cname=:cname", ['cname' => $name]);

    return $model->html($form);
}

/**
 * 获取列表类型的数据
 *
 */
function getList($field, $postId = 0)
{
    $model = new ListItem();

    return $model->getFieldData($field, $postId)['data'];
}

/**
 * 截取摘要
 *
 */
function summary($summary, $len): string
{
    $text = mb_substr($summary, 0, $len);
    if (mb_strlen($summary) <= $len) {
        return $text;
    }

    return $text . '...';
}

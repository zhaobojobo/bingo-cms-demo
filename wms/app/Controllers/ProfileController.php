<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\Catalog;
use Admin\Models\Category;
use Admin\Models\Field;
use Admin\Models\History;
use Admin\Models\ListItem;
use Admin\Models\Model;
use Admin\Models\Page;
use Admin\Models\Post;
use Admin\Profile;
use Admin\ProfileUi;
use App\Exceptions\LoginException;
use App\Member\Member;

/**
 * Class ProfileController
 *
 * @package Admin\Controllers
 */
class ProfileController extends BaseController
{
    /**
     * @param $type
     */
    public function load($type)
    {
        $id = Helper::post('id', 0);
        $model_0 = Helper::post('model_0', 0);
        $model_id = Helper::post('model_id', 0);

        $modelModel = new Model();
        $Field = new Field();

        $views = [];

        $cFields = [];
        $_cFields = [];
        if ($model_0) {
            $cModels = $modelModel->children($model_0);
            foreach ($cModels as $model) {
                $cFields[$model['tab']] = $Field->findAll("model_id={$model['id']}", [], SORT_ORDER_DESC);
            }
            foreach ($cFields as $tab => $fields) {
                foreach ($fields as $field) {
                    $_cFields[$tab][$field->name] = $field;
                }
            }
        }

        $iFields = [];
        $_iFields = [];
        if ($model_id) {
            $iModels = $modelModel->children($model_id);
            foreach ($iModels as $model) {
                $iFields[$model['tab']] = $Field->findAll("model_id={$model['id']}", [], SORT_ORDER_DESC);
            }
            foreach ($iFields as $tab => $fields) {
                foreach ($fields as $field) {
                    if (!$field->label) {
                        $field->label = $field->__data[DEFAULT_LANG]['label'];
                    }
                    $_iFields[$tab][$field->name] = $field;
                }
            }
        }

        $result = [];
        if ($model_0 && $model_id) {
            foreach ($_cFields as $tab => $fields) {
                $result[$tab] = array_merge($fields, $_iFields[$tab]);
            }
        } else {
            $result = $model_0 ? $_cFields : ($model_id ? $_iFields : []);
        }

        foreach ($result as $tab => $fields) {
            foreach ($fields as $i => $field) {
                $fields[$i] = Helper::objectToArray($field);
            }
            if ($tab == 'G') {
                if ($id) {
                    $fields = $this->fillData($type, $id, $fields, false);
                }
                $views['G'] = ProfileUi::render($fields);
            } elseif ($tab == 'L') {
                if ($id) {
                    $fields = $this->fillData($type, $id, $fields, true);
                }
                $views = array_merge($views, ProfileUi::renderLang($fields));
            } else {
                if ($id) {
                    $fields = $this->fillData($type, $id, $fields, false);
                }
                $tab = json_encode(['name' => $model->__data[$this->c['currentLang']]->name]);
                $inputs = ProfileUi::render($fields);

                $views['C'][$model->id] = ['tab' => $tab, 'inputs' => $inputs];
            }
        }

        $this->success($views);
    }

    /**
     * @param      $type
     * @param      $id
     * @param      $fields
     * @param bool $lang
     *
     * @return mixed
     */
    public function fillData($type, $id, $fields, $lang = false)
    {
        $profile = [];
        $model = $this->getModel($type);
        if (isset($_SESSION['hid']) && $_SESSION['hid']) {
            $hModel = new History();
            $history = $hModel->find($_SESSION['hid']);
            if ($history) {
                $data = json_decode($history['content_data'], true);
                $profile = $data['__profile'] ?? [];
            }
        }
        if ($lang) {
            $data = [];
            foreach (LANGUAGES as $langId => $language) {
                if (isset($profile[$langId])) {
                    $data[$langId] = $profile[$langId];
                } else {
                    $data[$langId] = $model->findLang($id, $langId);
                }
                foreach ($fields as &$field) {
                    $fieldName = $field['name'];
                    $field['value'][$langId] = $data[$langId][$fieldName] ?? ($field['__data'][$langId]['default'] ?? '');
                }
            }
        } else {
            if (isset($profile['all'])) {
                $data = $profile['all'];
            } else {
                $data = $model->findLang($id, '');
            }
            foreach ($fields as $k => $field) {
                $fieldName = $field['name'];
                $fields[$k]['value'] = $data[$fieldName] ?? '';
            }
        }

        return $fields;
    }

    /**
     * @param $type
     *
     * @return Profile|null
     */
    public function getModel($type)
    {
        switch ($type) {
            case 'page':
                return (new Page())->profile;
                break;
            case 'catalog':
                return (new Catalog())->profile;
                break;
            case 'category':
                return (new Category())->profile;
                break;
            case 'post':
                return (new Post())->profile;
                break;
            case 'list-item':
                return (new ListItem())->profile;
                break;
            default:
                throw new LoginException('Unexpected value');
        }
    }
}

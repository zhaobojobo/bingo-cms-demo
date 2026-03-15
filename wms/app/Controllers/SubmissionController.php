<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\Form;
use Admin\Models\FormField;
use Admin\Models\Submission;
use Exception;
use LogicException;

/**
 * Class SubmissionController
 *
 * @package Admin\Controllers
 */
class SubmissionController extends BaseController
{
    public $permission = 'SUBMISSION';

    /**
     * @param $fid
     *
     * @return false|string
     * @throws Exception
     */
    public function index($fid)
    {
        $form = $this->model(Form::class)->find($fid);
        $model = $this->model(Submission::class);
        $page = intval(Helper::get('p', 1));
        $pageData = $model->findPage($page, 12, "form_id={$fid}");
        $this->assign(['need_review' => 0]);
        $this->assign(['form_id' => $fid]);
        $this->assign(['pageData' => $pageData, 'form' => $form]);

        return $this->render('submission/index');
    }

    /**
     * @param $id
     */
    public function delete()
    {
        $id = Helper::post('id');
        $model = $this->model(Submission::class);
        $this->success($model->remove($id));
    }

    public function batchDelete($fid)
    {
        $model = $this->model(Submission::class);

        $ids = $_POST['ids'];
        try {
            foreach ($ids as $id) {
                $model->remove($id);
            }
        } catch (Exception $e) {
            throw new LogicException($e->getMessage());
        }

        $this->success(true, '/submissions/' . $fid);
    }

    /**
     * @param $id
     */
    public function detail($id)
    {
        $model = $this->model(Submission::class);
        $row = $model->find($id);
        $form = $this->model(Form::class)->find($row['form_id']);

        $fields = $this->model(FormField::class)->findAll("form_id={$form['id']}");
        $fields = array_column($fields, null, 'name');

        $detail = [];
        $data = json_decode($row['data'], true);
        foreach ($data as $key => $value) {
            if (isset($fields[$key])) {
                $detail[$key]['label'] = $fields[$key]['__data'][$row['lang']]['label'];
                $detail[$key]['placeholder'] = $fields[$key]['__data'][$row['lang']]['placeholder'];
                if ($fields[$key]['input'] == 'file') {
                    $detail[$key]['value'] = sprintf(
                        '<a target="_blank" href="%s">%s</a>',
                        Helper::getUrl('/attachment/' . $value),
                        $value
                    );
                } else if($fields[$key]['input'] == 'input.checkbox') {
                    $detail[$key]['value'] = implode(',', $value);
                }else {
                    $detail[$key]['value'] = $value;
                }
            }
        }
        $row['data'] = $detail;
        $row['form'] = $form['__data'][$row['lang']]['title'];

        $html = $this->render('submission/detail', ['row' => $row]);

        $this->success($html);
    }

    /**
     * @param $fid
     */
    public function export($fid)
    {
        $langId = $_POST['langId'];
        $model = $this->model(Submission::class);
        $where = "form_id={$fid}";
        if ($langId) {
            $where .= " AND lang='{$langId}'";
        }
        $submissions = $model->findAll($where);

        $data = [];
        $keys = ['id', 'submit_time', 'submit_ip'];
        foreach ($submissions as $i => $submission) {
            $data[$i]['id'] = $submission['id'];
            $data[$i]['submit_time'] = $submission['submit_time'];
            $data[$i]['submit_ip'] = $submission['submit_ip'];
            $_data = json_decode($submission['data'], true);
            $keys = array_merge($keys, array_keys($_data));
            $data[$i] = array_merge($data[$i], $_data);
        }

        $keys = array_unique($keys);

        $rows[] = implode(',', $keys);
        foreach ($data as $row) {
            $rows[] = implode(',', $row);
        }
        $content = implode("\n", $rows);
        $filename = 'submissions' . '_' . date('Y-m-d_His');
        if ($langId) {
            $filename .= '_' . $langId;
        }
        header("Content-Type: application/vnd.ms-excel; charset=GB2312");
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename={$filename}.csv ");
        header("Content-Transfer-Encoding: binary ");
        die($content);
    }

    /**
     * @param $id
     */
    public function review($id)
    {
        $model = $this->model(Submission::class);
        $ret = $model->updateStatus($_POST, $id);
        $this->success($ret);
    }
}

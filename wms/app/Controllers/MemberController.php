<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\Model;
use App\Member\Member;
use App\Member\MemberGroup;
use App\Member\MemberSetting;
use Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * Class MemberController
 *
 * @package Admin\Controllers
 */
class MemberController extends BaseController
{
    /**
     * @return false|string
     * @throws Exception
     */
    public function index($group = 0)
    {
        $model = new Member();
        $where = '';
        $params = [];
        if ($group) {
            $where = 'group_id=:group_id';
            $params = ['group_id' => $group];
        }
        $data = $model->findPage(intval(Helper::get('p', 1)), 10, $where, $params);
        foreach ($data['rows'] as $row) {
            $row->group = (new MemberGroup())->find($row->group_id);
        }
        $this->assign(['pageData' => $data, 'group_id' => $group]);

        return $this->render('member/index');
    }

    /**
     * @param int $id
     *
     * @return false|string
     * @throws Exception
     */
    public function edit($id = 0)
    {
        $this->checkPermission('MEMBER.EDIT');
        $model = $this->model(Member::class);

        $group = Helper::get('group', 0);
        $row = $model->init();
        if ($id) {
            $row = $model->find($id);
            $group = $row['group_id'];
        }

        $contentModel = $this->model(Model::class)->findOne("type='member' AND parent_id=0 AND subtype='{$group}'");

        $this->assign(['row' => $row, 'group_id' => $group]);
        $this->assign(['model_id' => $contentModel ? $contentModel['id'] : 0]);

        return $this->render('member/edit');
    }

    public function save()
    {
        $id = Helper::post('id');
        $model = $this->model(Member::class);
        if ($id) {
            $this->action('Update');
            $ret = $model->update($_POST, $id);
        } else {
            $this->action('Create');
            $ret = $model->create($_POST);
        }
        $this->success($ret, '/members/0');
    }

    public function password()
    {
        $id = Helper::post('id');
        $model = $this->model(Member::class);
        $ret = $model->update(['password' => $_POST['password']], $id);
        $message = Helper::_('Password has been updated.');
        $this->success($ret, '/members/', $message);
    }

    /**
     * @param $id
     */
    public function detail($id)
    {
        $model = $this->model(Member::class);
        $this->success($model->detail($id));
    }

    public function export()
    {
        $filename = 'members_export_' . date('Y-m-d_His') . '.xlsx';
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: public");
        header("Expires: 0");
        $model = new Member();
        $spreadsheet = $model->export();
        $write = IOFactory::createWriter($spreadsheet, IOFactory::WRITER_XLSX);
        $write->save('php://output');
    }

    public function delete()
    {
        $this->checkPermission('member-delete');
        $id = Helper::post('id');
        $model = $this->model(Member::class);
        $this->success($model->remove($id));
    }
}

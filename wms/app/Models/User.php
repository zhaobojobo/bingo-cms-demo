<?php

namespace Admin\Models;

use stdClass;
use App\Exceptions\LoginException;
use App\Exceptions\NormalException;
use Admin\Helper;
use Exception;
use App\Domain\Permission\Role\RoleFinder;
use App\Domain\Permission\Agency\AgencyFinder;
use App\Infrastructure\Domain\Permission\Role\PdoRoleFinderRepository;
use App\Infrastructure\Domain\Permission\Agency\PdoAgencyFinderRepository;

/**
 * Class User
 *
 * @package Admin\Models
 */
class User extends \Admin\Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'user';
        $this->idField = 'id';
    }

    /**
     * @param $data
     *
     * @return int
     */
    public function create($data)
    {
        try {
            $data = $this->validate($data, 'create');
            $data = $this->inputFilter($data);
            $data['id'] = null;

            return $this->query->create($this->table, $data);
        } catch (Exception $e) {
            throw new NormalException($e->getMessage());
        }
    }

    /**
     * @param        $data
     * @param string $scenes
     *
     * @return array
     */
    public function validate($data, $scenes = 'all')
    {
        if ($scenes == 'create') {
            if (!$data['username']) {
                throw new NormalException(Helper::_('Please enter user name'));
            }
            if ($this->findOne("username='{$data['username']}'")) {
                throw new NormalException(Helper::_('Username has been used'));
            }
            if (!$data['email']) {
                throw new NormalException(Helper::_('Please enter user email'));
            }
            if (!$data['role_id']) {
                throw new NormalException(Helper::_('Please select role'));
            }
            if (!Helper::isEmail($data['email'])) {
                throw new NormalException(Helper::_('Please enter the correct email address'));
            }
            if (!$data['password']) {
                throw new NormalException(Helper::_('Please enter user Password'));
            }
            if ($data['password'] != $data['password_confirm']) {
                throw new NormalException(Helper::_('Passwords entered twice are inconsistent'));
            }
            unset($data['password_confirm']);
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            return $data;
        } elseif ($scenes == 'update') {
            if (!$data['email']) {
                throw new NormalException(Helper::_('Please enter user email'));
            }
            if (!Helper::isEmail($data['email'])) {
                throw new NormalException(Helper::_('Please enter the correct email address'));
            }
            if (!$data['role_id']) {
                throw new NormalException(Helper::_('Please select role'));
            }
            unset($data['username']);

            return $data;
        } elseif ($scenes == 'password') {
            // $user = $this->find($data['id']);
            // if (!password_verify($data['password'], $user['password'])) {
            //     throw new NormalException(Helper::_('Current password is wrong'));
            // }
            if (!$data['new_password']) {
                throw new NormalException(Helper::_('Please enter New Password'));
            }
            if ($data['new_password'] != $data['new_password_confirm']) {
                throw new NormalException(Helper::_('Passwords entered twice are inconsistent'));
            }

            return [
                'password' => password_hash($data['new_password'], PASSWORD_DEFAULT),
            ];
        }

        return $data;
    }

    public function getAuthorizeUsers()
    {
        $users = $this->findAll('id<>:id AND username<>:username', ['id' => 1, 'username' => 'admin']);

        return $users;
    }

    public function getReviewers($code = 'review')
    {
        $reviewers = [];
        $users = $this->findAll('id<>:id', ['id' => 1]);
        foreach ($users as $user) {
            $reviewers[$user['agency_id']][] = $user;
        }
        ksort($reviewers);
        $users = $reviewers;
        $reviewers = [];
        $repository = new PdoAgencyFinderRepository($this->c['pdo']);
        $service = new AgencyFinder($repository);
        foreach ($users as $aid => $_users) {
            if ($aid == 0) {
                $reviewers[$aid]['agency'] = null;
            } else {
                $reviewers[$aid]['agency'] = $service->findOneOfId($aid);
            }
            $reviewers[$aid]['users'] = $_users;
        }

        return $reviewers;
    }

    public function getEditors($agencies, $code = 'edit')
    {
        $users = [];
        if ($agencies) {
            foreach ($agencies as $agency) {
                $users = array_merge(
                    $users,
                    $this->findAll(
                        'id<>:id AND (agency_id=0 OR agency_id=:agency_id)',
                        ['id' => 1, 'agency_id' => $agency]
                    )
                );
            }
        } else {
            $users = array_merge(
                $users,
                $this->findAll(
                    'id<>:id AND agency_id=0',
                    ['id' => 1]
                )
            );
        }

        $editors = [];
        foreach ($users as $i => $user) {
            if (Helper::hasPermission($code, $user)) {
                $editors[$user['id']] = $user;
            }
        }

        return $editors;
    }

    public function appendPermission($id, $permission)
    {
        $user = $this->find($id);
        $user['permission'] = json_decode($user['permission'], true);
        if (false === ($pos = array_search($permission, $user['permission']))) {
            $user['permission'][] = $permission;
        }
        $data = ['permission' => array_values($user['permission'])];

        return $this->update($data, $id, 'updatePermission');
    }

    public function removePermission($id, $permission)
    {
        $user = $this->find($id);
        $user['permission'] = json_decode($user['permission'], true);
        if ($pos = array_search($permission, $user['permission'])) {
            unset($user['permission'][$pos]);
        }
        $data = ['permission' => array_values($user['permission'])];

        return $this->update($data, $id, 'updatePermission');
    }

    public function hasPermission($permission, $id)
    {
        $user = $this->find($id);
        $user['permission'] = json_decode($user['permission'], true);

        return array_search($permission, $user['permission']) !== false;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function inputFilter($data)
    {
        if (isset($data['permission']) && $data['permission']) {
            $data['permission'] = json_encode($data['permission']);
        } else {
            $data['permission'] = json_encode([]);
        }

        return $data;
    }

    /**
     * @param $data
     * @param $id
     *
     * @return int
     */
    public function update($data, $id, $scenes = 'update')
    {
        unset($data['username']);
        try {
            unset($data['id']);
            $data = $this->validate($data, $scenes);
            $data = $this->inputFilter($data);

            return $this->query->update($this->table, $data, 'id=:id', ['id' => $id]);
        } catch (Exception $e) {
            throw new NormalException($e->getMessage());
        }
    }

    /**
     *
     * @param $id
     *
     * @return int
     */
    public function remove($id)
    {
        if ($id == 1) {
            throw new NormalException(Helper::_('Prohibit deleting system maintenance account'));
        }
        if ($id == $_SESSION['user']['id']) {
            throw new NormalException(Helper::_('Prohibit deleting the current login account'));
        }

        return $this->query->delete($this->table, 'id=:id', ['id' => $id]);
    }

    /**
     * @param $data
     * @param $id
     *
     * @return mixed
     */
    public function password($data, $id)
    {
        try {
            $data = $this->validate($data, 'password');
            try {
                unset($data['id']);
                $this->db->beginTransaction();
                $this->query->update($this->table, $data, 'id=:id', ['id' => $id]);
                $this->db->commit();

                return true;
            } catch (Exception $e) {
                $this->db->rollBack();

                throw new NormalException($e->getMessage());
            }
        } catch (Exception $e) {
            throw new NormalException($e->getMessage());
        }
    }

    public function logout()
    {
        session_destroy();
        setcookie('PREVIEW_KEY', '', 0);
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function login($data)
    {
        $data = $this->validate($data, 'login');
        $where = "username=:username";
        $user = $this->query->find($this->table, $where, ['username' => $data['username']]);
        if (!$user) {
            throw new LoginException(Helper::_('We cannot find an account with that username or password'));
        }
        $user = $this->outputFilter($user);
        $verify = password_verify($data['password'], $user['password']);
        if (!$verify) {
            throw new LoginException(Helper::_('We cannot find an account with that username or password'));
        }
        if ($data['key'] != 'bingo') {
            throw new LoginException(Helper::_('Key error'));
        }
        $_SESSION['user'] = $user;

        return $user;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function outputFilter($data)
    {
        if ($data['permission']) {
            $_permissions = [];
            $data['permission'] = json_decode($data['permission'], true);
            foreach ($data['permission'] as $permission) {
                $_permission = explode('.', $permission);
                $_permissions[$_permission[0]][] = $_permission[1];
            }
            $data['permission'] = $_permissions;
        }

        return $data;
    }
}

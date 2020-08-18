<?php
/**
 * Created by PhpStorm.
 * User: Gtech-pc
 * Date: 06.08.2020
 * Time: 15:19
 */

namespace App\Services;


use App\Models\Admin;
use App\Repositories\Repository;

/**
 * Class AdminService
 * @package App\Services
 */
class AdminService
{
    protected $model;

    public function __construct(Admin $admin)
    {

        $this->model = new Repository($admin);
    }

    /**
     * creating a new resource/admin
     * @param $request
     */
    public function make($request)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $this->model->create($data);
    }

    /**
     * updating a new resource/admin
     * @param $request
     * @param $id
     */
    public function update($request, $id)
    {
        $admin = [];
        $admin['name'] = $request->name;
        $admin['email'] = $request->email;
        $this->model->update($admin, $id);
    }

    /**
     *
     * @param $request
     * @param $id
     */
    public function updatePassword($request, $id)
    {
        $data = [];
        $data['password'] = bcrypt($request->password);
        $this->model->update($data, $id);
    }
}

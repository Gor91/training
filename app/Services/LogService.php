<?php
/**
 * Created by PhpStorm.
 * User: Gtech-pc
 * Date: 06.08.2020
 * Time: 15:19
 */

namespace App\Services;


use App\Models\Email;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;


/**
 * Class LogService
 * @package App\Services
 */
class LogService
{
    /**
     * @var Repository
     */
    protected $model;


    /**
     * LogService constructor.
     * @param Email $log
     */
    public function __construct(Email $log)
    {
        $this->model = new Repository($log);
    }


    /**
     * @return Repository[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {

        $logs = $this->model->with([
            'admin' => function ($query) {
                $query->select(['name', 'id']);
            },
            'account' => function ($query) {
                $query->select(['id', 'name', 'surname', 'father_name']);
            }])->get();

        if (!$logs)
            throw new ModelNotFoundException('User not found by ID ');
        return $logs;

    }


    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $log = $this->model->with([
            'admin' => function ($query) {
                $query->select(['name', 'id']);
            },
            'account' => function ($query) {
                $query->select(['id', 'name', 'surname', 'father_name']);
            }])
            ->where('id', $id)
            ->first();
        if (!$log)
            throw new ModelNotFoundException('show chi eghel ');
        return $log;
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: Gtech-pc
 * Date: 06.08.2020
 * Time: 15:19
 */

namespace App\Services;


use App\Models\Courses;
use App\Models\Profession;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CourseService
{
    /**
     * @var Repository
     */
    protected $model;


    /**
     * CourseService constructor.
     * @param Courses $course
     */
    public function __construct(Courses $course)
    {
        $this->model = new Repository($course);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getCourses($id)
    {
        $spec = Profession::select('specialty_id')->where('account_id', $id)->first();

        $courses = Courses::whereRaw('JSON_CONTAINS(`specialty_ids`,  \'["' . $spec->specialty_id . '"]\')')
            ->where('status', "=", "active")->get();

        $result = (!empty($courses)) ? $courses : __('messages.noting');
        if (!$courses)
            throw new ModelNotFoundException('User not found by ID ');
        return $result;
    }


    /**
     * @return Repository[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {

        $messages = $this->model->all();

        if (!$messages)
            throw new ModelNotFoundException('User not found by ID ');
        return $messages;

    }
}

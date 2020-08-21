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

        $courses = Courses::whereRaw('JSON_CONTAINS(`specialty_ids`,  \'["' . $spec->specialty_id . '"]\')')->get();

        if (!$courses)
            throw new ModelNotFoundException('User not found by ID ');
        return $courses;
    }
}

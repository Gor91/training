<?php
/**
 * Created by PhpStorm.
 * User: Gtech-pc
 * Date: 06.08.2020
 * Time: 15:19
 */

namespace App\Services;


use App\Models\Book;
use App\Models\Courses;
use App\Models\Profession;
use App\Models\Tests;
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
     * @param $id
     * @return mixed
     */
    public function getCoursesInfo($id)
    {
        $spec = Profession::select('specialty_id')->where('account_id', $id)->first();

        $courses = Courses::select('id','name', 'credit')->whereRaw('JSON_CONTAINS(`specialty_ids`,  \'["' . $spec->specialty_id . '"]\')')
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

    public function getBookById($id)
    {
        $book = Book::select('id', 'title', 'path')
            ->where('id', $id)
            ->first();
        $result = (!empty($book)) ? $book : __('messages.noting');
        if (!$book)
            throw new ModelNotFoundException('User not found by ID ');
        return $result;
    }

    public function getTestsById($id)
    {
        $tests = Tests::where('courses_id', $id)
            ->get();
        $result = (!empty($tests)) ? $tests : __('messages.noting');
        if (!$tests)
            throw new ModelNotFoundException('User not found by ID ');
        return $result;
    }
}

<?php


namespace App\Services;


use App\Models\Account;
use App\Models\AccountCourse;
use App\Models\Message;
use App\Models\Tests;
use App\Models\User;
use App\Notifications\ManageUserStatus;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AccountCourseService
{
    /**
     * @var Repository
     */
    private $model;


    /**
     * AccountCourseService constructor.
     * @param AccountCourse $accountCourse
     */
    public function __construct(AccountCourse $accountCourse)
    {
        $this->model = new Repository($accountCourse);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTestResult($id, $account_id, $model)
    {

        $answers = Tests::select('answers')->where('courses_id', $id)
            ->get();
        $test_answers = [];
        foreach ($answers as $index => $answer) {
            $ans = json_decode($answer->answers);
            foreach ($ans as $i => $an) {
                if (!empty($an->check))
                    $test_answers[$index + 1][$i + 1] = true;
            }
        }
        $account_answers = [];
        foreach ($model as $index => $item) {
            $i = explode("_", $index);
            $account_answers[$i[0]][$i[1]] = true;
        }
        $deff = [];
        foreach ($test_answers as $i => $ta) {
            if (array_diff_assoc($ta, $account_answers[$i])) {
                $deff[] = $i;
            }
        }
        $percent = ((count($account_answers) - count($deff)) / count($account_answers)) * 100;
        $count = $this->getCountOfTest($id, $account_id);

        $account_course = [];
        $account_course['account_id'] = $account_id;
        $account_course['course_id'] = $id;
        $status = ($percent >= 80) ? 'success' : 'unsuccess';
        $account_course['status'] = $status;
        $account_course['percent'] = $percent;
        $account_course['test'] = json_encode($account_answers);

        if (empty($count->count)) {
            $c = 1;
            $account_course['count'] = $c;
            $ca = $this->model->create($account_course);
        } elseif ($count->count < 4) {
            $c = $count->count + 1;
            $account_course['count'] = $c;
            $ca = $this->model->update($account_course, $count->id);
            if ($count->count === 3 && $status === 'unsuccess') {
                AccountService::updateUserByParam('pending', $account_id, 'status');
                $message = Message::where('key', 'unsuccess_test')->first();
                $account = Account::where('id', $account_id)->first();
                $user = User::select('email')->where('account_id', $account_id)->first();

                $user->notify(new ManageUserStatus($user, $account, $message));
            }
        }

        if (!$ca)
            throw new ModelNotFoundException('Account course not created!');
        return $percent;
    }

    public function getTestsResult($id)
    {

        $tests = $this->model->with(['course' => function ($query) {
            $query->select('id', 'name', 'credit');

        }])->where('account_id', $id)
            ->get();

        if (!$tests)
            throw new ModelNotFoundException('Account course not get!');
        return $tests;
    }

//todo  inchi get
    public function getTestById($a_id, $id)
    {
        $test = [];
        $tests = $this->model->with(['course' => function ($query) {
            $query->select('id', 'name', 'credit');
        }, 'account' => function ($query) {
            $query->select('id', 'name', 'surname', 'father_name', 'phone');
        }])->where(['account_id' => $a_id, 'course_id' => $id])
            ->first();
        $random_tests = [];
        $random_test = json_decode($tests->random_test);
        if (!empty($random_test))
            $random_tests = Tests::whereIn('id', $random_test)->get();
        $test['test'] = $tests;
        $test['random_tests'] = $random_tests;

        if (!$tests)
            throw new ModelNotFoundException('Account course not get!');
        return $test;
    }

    public function getAccountById($id)
    {
        $account = Account::select('id', 'name', 'surname', 'father_name', 'phone')
            ->with(['user' => function ($query) {
                $query->select('id', 'account_id', 'email');
            }])
            ->where('id', $id)->first();
        if (!$account)
            throw new ModelNotFoundException('Account not get!');
        return $account;
    }

    public function getCountOfTest($id, $account_id)
    {
        return $this->model->selected(['id', 'count', 'percent'])
            ->where('account_id', $account_id)
            ->where('course_id', $id)->first();

    }

}

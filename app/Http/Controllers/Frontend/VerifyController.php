<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Repository;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    protected $model;

    /**
     * @var Repository
     */


    public function __construct(User $user)
    {
        $this->model = new Repository($user);

    }

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function verify(Request $request)
    {

        try {
            $user = $this->model->show((int)$request->id);;
            if (md5($user->email) === $request->key) {
                $data['email_verified_at'] = date('Y-m-d H:i:s');
                $this->model->update($data, $request->id);
                return response()->json(['success' => 'verify'], 200);
            }
        } catch (\Exception $exception) {
//            dd($exception);
            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }
}

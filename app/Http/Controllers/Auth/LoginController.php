<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::BACKEND;

    public function showLoginForm()
    {
        return view("auth.login");
    }

    public function doLogin(AdminRequest $request)
    {
        try {   // create our user data for the authentication
            $userdata = array(
                'email' => $request->get('email'),
                'password' => $request->get('password')
            );
            // attempt to do the login

            if (Auth::guard('admin')->attempt($userdata)) {

                $user = Auth::guard('admin')->user();
                $request->session()->put('u_id', $user->id);
                return Redirect::to('backend/dashboard');
            } else {
                $errors = new MessageBag(['password' => [Lang::get('auth.invalid')]]);
                return back()->withErrors($errors);
            }
        } catch (\Exception $exception) {

            dd($exception);
            logger()->error($exception);
            return redirect('backend')->with('error',
                Lang::get('messages.wrong'));
        }
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();
        Session::flush();
        return Redirect::to('/backend/login/'); // redirect the user to the login screen
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    protected function guard() // And now finally this is our custom guard name
    {
        return Auth::guard('admin');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getLoginAction()
    {
        return view('admin.login');
    }

    public function postLoginAction()
    {
        $rules = array('username' => 'required', 'password' => 'required');
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return redirect('admin/login')->withErrors(array("Введите логин и пароль."));
        }
        $auth = Auth::attempt(array(
            'email' => Input::get('username'),
            'password' => Input::get('password'),
            'isAdmin' => true,
        ), false);
        if(! $auth){
            return redirect('admin/login')->withErrors(array("Ошибка авторизации."));
        }
        return redirect('/admin');
    }

    public function getRegisterAction()
    {
        return view('admin.register');
    }

    public function postRegisterAction()
    {
        $rules = array(
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password-confirmation' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return redirect('admin/register')->withErrors(array("Не все поля были заполнены."));
        }
        if(Input::get('password') != Input::get('password-confirmation')){
            return redirect('admin/register')->withErrors(array("Введенные пароли не совпадают."));
        }
        User::create([
            'name' => Input::get('username'),
            'email' => Input::get('email'),
            'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
            'isAdmin' => true,
        ]);
        return redirect('/admin');
    }

    public function logoutAction()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}

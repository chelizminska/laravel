<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\User;
use Illuminate\Http\Request;
use App\Fish;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function indexAction()
    {
        return view('admin.home');
    }

    public function getLoginFormAction()
    {
        return view('admin.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function postLoginFormAction(Request $request)
    {
        $user = User::where('name', '=', $request['userName'])->get();
        if (isset($user[0])){
            if (password_verify($request['password'], $user[1]->password)) {
                return redirect()->route('admin');
            }
            else{
                return "Неверное имя пользователя или пароль.";
            }
        }
        else{
            return "Неверное имя пользователя или пароль.";
        }
    }

    public function addAction()
    {
        //return view('admin.add');
    }

    public function contentManagementAction()
    {
        return view('admin.contents');
    }

    public function contentEditingAction()
    {
        return view('admin.content_editing');
    }

    public function storeAction(Fish $fish, Page $page, Request $request)
    {
        //dd($request->all());
        $page->create(['title' => $request['name'], 'content' => $request['content']]);
        $fish->create(['name' => $request['name'], 'content_href' => '/fishes/'.$request['name']]);

        return redirect()->route('admin');
    }
}

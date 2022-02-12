<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view("login/index");
    }

    public function login()
    {
        $this->validate(request(), [
            "email" => "required|string",
            "password" => "required|string",
            "is_remember" => "integer"
        ]);

        $user = request(["email", "password"]);
        $is_remember = boolval(request("is_remember"));

        // 登录成功
        if (\Auth::attempt($user, $is_remember)) {
            return redirect("/posts");
        }

        // 返回上一页
        return \Redirect::back()->withErrors("帐密错误");
    }

    public function logout()
    {
        \Auth::logout();
        return redirect("/login");
    }
}

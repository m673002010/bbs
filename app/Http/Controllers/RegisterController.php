<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    public function index() 
    {
        return view("register/index");
    }

    public function register() 
    {
        $this->validate(request(), [
            "username" => "required|string|max:16|min:3",
            "email" => "required|string|max:32|min:5",
            "password" => "required|string|max:16|min:3",
        ]);
        
        $username = request("username");
        $email = request("email");
        $password = bcrypt(request("password"));

        $res = User::create(compact("username", "email", "password"));

        return redirect("/login");
    }
}

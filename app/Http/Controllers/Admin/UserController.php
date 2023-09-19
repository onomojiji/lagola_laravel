<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // get all list of users
    public function index(){
        $users = User::orderBy("name")->get();
        return view("users.index", ["users" => $users]);
    }

    // get new user form
    public function create(){
        return view("users.create");
    }

    // store a new user
    public function store(Request $request){

        $request->validate([
            'name' => 'required|min:3',
            'phone' => 'required|min:9|max:9|unique:users',
            'password' => 'required|min:6',
            'confirm' => 'required|min:6',
        ]);

        if ($request->password != $request->confirm){
            return redirect()->route("users.create")->with("fail", "Les mots de passe sont différents.");
        }

        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'admin' => 1
        ]);

        return redirect()->route('users.create')->with("success", "Utilisateur enregistré avecsuccès.");
    }
}

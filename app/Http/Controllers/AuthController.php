<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $user = User::where('Email', '=', $request->email)->first();
        if ($user && Hash::check($request->password, $user->Password)) {
            setcookie("id", $user->Id);
            setcookie("email", $user->Email);
            setcookie("name", $user->Username);
            setcookie("isAdmin", $user->isAdmin);

            if ($user->isAdmin == 0) {
                return redirect('home');
            } else {
                return redirect('admin');
            }
        }
        return view('login', [
            'errorMessage' => 'Something went wrong. Check your login credentials and try again.'
        ]);
    }

    public function registration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        setcookie("id", $check->Id);
        setcookie("email", $data['email']);
        setcookie("name", $data['name']);

        return redirect("home");
    }

    public function create(array $data)
    {
        return User::create([
            'Username' => $data['name'],
            'Email' => $data['email'],
            'Password' => Hash::make($data['password'])
        ]);
    }


    public function autoLogin()
    {
        if (isset($_COOKIE["name"])) {
            if ($_COOKIE['isAdmin'] == 0) {
                return redirect('home');
            } else {
                return redirect('admin');
            }
        }
        return view('login');
    }

    public function showUser()
    {
        return view('profil', [
            'name' => $_COOKIE['name'],
            'email' => $_COOKIE['email'],
        ]);
    }


    public function signOut()
    {
        setcookie('name', '', 1);
        setcookie('email', '', 1);
        setcookie('id', '', 1);
        setcookie('isAdmin', '', 1);
        return view('login');
    }

    public function update(Request $request)
    {
        DB::update('UPDATE `user` SET Email = \'' . $request->email . '\', Username = \'' . $request->name . '\' WHERE Id = ' . $_COOKIE['id'] . ';');
        setcookie('name', $request->name);
        setcookie('email', $request->email);
        return redirect('profil')->with('successMessage', 'Your profil has been updated 🎉🎉🎉');
    }
}

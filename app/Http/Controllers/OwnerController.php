<?php

namespace App\Http\Controllers;

use App\Video;
use App\Course;
use App\Level;
use App\Teacher;
use App\User;
use App\Education;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function getLogin()
    {
        return view('admin.login');
    }

    function login(Request $data)
    {
        $this->validate($data , [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!Auth::attempt(['email' => $data['email'] , 'password' => $data['password'] , 'role' => 1]))
        {
            return redirect()->back();
        }
        else{
            return redirect('/admin');
        }
    }

    function addAdmin(Request $data)
    {
        $this->validate($data, [
            'email' => 'required|unique:admins',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);

        $admin = new Admin();
        $admin->email = $data['email'];
        $admin->password = bcrypt($data['password']);
        $admin->save();
        return view('admin.login');
    }

    function Index()
    {
        return view('admin.index');
    }

    function getAddAdmin()
    {
        return view('admin.add-admin');
    }

    function SignOut()
    {
        Auth::logout();
        return redirect('/');
    }
}

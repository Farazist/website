<?php

namespace App\Http\Controllers;

use App\Video;
use App\Course;
use App\Level;
use App\Transaction;
use App\User;
use App\Delivery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Carbon;
use Illuminate\Support\Facades\DB;

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

    function getReportTransactionsGroupByMonth()
    {
        $transactions = Transaction::select(DB::raw('YEAR(created_at) as y, MONTH(created_at) as m, count(id) as c'))->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))->orderBy(DB::raw('YEAR(created_at)'), 'asc')->orderBy(DB::raw('MONTH(created_at)'), 'asc')->take(6)->get();

        return response()->json($transactions);
    }

    function getReportDeliveriesGroupByMonth()
    {
        $deliveries = Delivery::select(DB::raw('YEAR(created_at) as y, MONTH(created_at) as m, count(id) as c'))->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))->orderBy(DB::raw('YEAR(created_at)'), 'asc')->orderBy(DB::raw('MONTH(created_at)'), 'asc')->take(6)->get();

        return response()->json($deliveries);
    }

    function getReportUsersGroupByMonth()
    {
        $deliveries = User::select(DB::raw('YEAR(created_at) as y, MONTH(created_at) as m, count(id) as c'))->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))->orderBy(DB::raw('YEAR(created_at)'), 'asc')->orderBy(DB::raw('MONTH(created_at)'), 'asc')->take(6)->get();

        return response()->json($deliveries);
    }

    function SignOut()
    {
        Auth::logout();
        return redirect('/');
    }
}

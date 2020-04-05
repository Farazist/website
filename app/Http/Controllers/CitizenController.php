<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class CitizenController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getAllForAdmin()
	{
		$citizens = User::where('role', '3')->get();

		return view('admin.citizens', [
			'citizens' => $citizens,
		]);
    }

    public function getCitizenTransactions($id)
	{
		$citizen = User::find($id);

		return view('admin.transactions', [
			'citizen' => $citizen,
		]);
    }

    public function getCitizenDeliveries($id)
	{
		$citizen = User::find($id);

		return view('admin.deliveries', [
			'citizen' => $citizen,
		]);
    }

    public function getCitizenDeliveryItems($citizen_id, $delivery_id)
	{
		$citizen = User::find($citizen_id);
		$items = Delivery::find($delivery_id)->items;

		return view('admin.items', [
			'citizen' => $citizen,
			'items' => $items,
		]);
    }

    function SignOut()
    {
        Auth::logout();
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\City;
use App\Province;
use App\System;
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

		foreach ($citizens as $citizen) {

            $citizen->created_date = jdate('Y/m/j', strtotime($citizen->created_at));
		}
		
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
	
	public function EditGet($citizen_id)
	{
		$citizen = User::find($citizen_id);
		$provinces = Province::all();
		$cities = City::all();
		$systems = System::all();

		if (!$citizen) {
            return redirect()->back()->with([
				'message' => 'شهروند پیدا نشد',
			]);
		}

		return view('admin.citizen_form', [
			'citizen' => $citizen,
			'provinces' => $provinces,
			'cities' => $cities,
			'systems' => $systems,
		]);
	}

	public function EditPost(Request $request)
	{
        $this->validate($request,[
            'name' => 'required|max:120',
        ]);

        $citizen = User::find($request['id']);
        $citizen->name = $request['name'];
        $citizen->city_id = $request['city_id'];
        $citizen->address = $request['address'];
        $citizen->role = $request['role'];
        $citizen->system_id = $request['system_id'];
        $citizen->image = $request['image'];
        $citizen->wallet = $request['wallet'];
        $citizen->update();

        return redirect('admin/citizens')->with([
			'message' => 'شهروند ویرایش شد',
		]);
	}

	public function DeleteGet($citizen_id)
	{
		$citizen = User::find($citizen_id);
		if (!$citizen) {
            return redirect()->back()->with([
				'message' => 'شهروند پیدا نشد',
			]);
		}
		$citizen->delete();
		return redirect()->back()->with([
			'message' => 'شهروند با موفقیت حذف گردید',
		]);
	}
}

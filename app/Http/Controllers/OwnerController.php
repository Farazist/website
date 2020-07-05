<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\City;
use App\Province;
use App\System;
use App\User;
use App\Item;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getAllForAdmin()
	{
		$owners = User::where('role', '2')->get();

		foreach ($owners as $owner) {

            $owner->created_date = jdate('Y/m/j', strtotime($owner->created_at));
		}
		
		return view('admin.owners', [
			'owners' => $owners,
		]);
    }

    public function getOwnerTransactions($id)
	{
		$owner = User::find($id);

		return view('admin.transactions', [
			'owner' => $owner,
		]);
    }

    public function getOwnerDeliveries($id)
	{
		$owner = User::find($id);

		return view('admin.deliveries', [
			'owner' => $owner,
		]);
    }

    public function getOwnerDeliveryItems($owner_id, $delivery_id)
	{
		$owner = User::find($owner_id);
		$items = Delivery::find($delivery_id)->items;

		return view('admin.items', [
			'owner' => $owner,
			'items' => $items,
		]);
    }

    function SignOut()
    {
        Auth::logout();
        return redirect('/');
	}
	
	public function EditGet($owner_id)
	{
		$owner = User::find($owner_id);
		$provinces = Province::all();
		$cities = City::all();
		$systems = System::all();

		if (!$owner) {
            return redirect()->back()->with([
				'message' => 'مالک پیدا نشد',
			]);
		}

		return view('admin.owner_form', [
			'owner' => $owner,
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

        $owner = User::find($request['id']);
        $owner->name = $request['name'];
        $owner->city_id = $request['city_id'];
        $owner->address = $request['address'];
        $owner->role = $request['role'];
        $owner->system_id = $request['system_id'];
        $owner->image = $request['image'];
        $owner->wallet = $request['wallet'];
        $owner->update();

        return redirect('admin/owners')->with([
			'message' => 'مالک ویرایش شد',
		]);
	}

	public function DeleteGet($owner_id)
	{
		$owner = User::find($owner_id);

		if (!$owner) {
            return redirect()->back()->with([
				'message' => 'مالک پیدا نشد',
			]);
		}

		$owner->delete();

		return redirect()->back()->with([
			'message' => 'مالک با موفقیت حذف گردید',
		]);
	}
}

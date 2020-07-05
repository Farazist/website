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

class ItemController extends Controller
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
	
	public function AddGet($owner_id)
    {
        $owner = User::find($owner_id);
        return view('admin.item_form')->with([
            'owner' => $owner,
        ]);
    }

    public function AddPost(Request $request, $owner_id)
    {
        $this->validate($request, [
            'name' => 'max:60',
            'price' => 'numeric|min:0',
        ]);

        $item = new Item();
        $item->owner_id = $owner_id;
        $item->name = $request['name'];
        $item->price = $request['price'];
        $item->image = $request['image'];
        $item->save();

        return redirect("admin/owners/$owner_id/items")->with([
            'message' => 'پسماند افزوده شد',
        ]);
    }

    public function getByOwner($owner_id)
    {
        $owner = User::find($owner_id);
        $items = $owner->items;

        return view('admin.owner_items', [
            'owner' => $owner,
            'items' => $items,
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

	public function EditGet($owner_id, $item_id)
	{
		$owner = User::find($owner_id);
		$item = Item::find($item_id);

		if (!$item) {
            return redirect()->back()->with([
				'message' => 'پسماند پیدا نشد',
			]);
		}

		return view('admin.item_form', [
			'owner' => $owner,
			'item' => $item,
		]);
	}

	public function EditPost(Request $request, $owner_id)
	{
		$this->validate($request, [
            'name' => 'max:60',
            'price' => 'numeric|min:0',
        ]);

        $item = Item::find($request['id']);
		$item->name = $request['name'];
        $item->price = $request['price'];
        $item->image = $request['image'];
        $item->update();

        return redirect("admin/owners/$owner_id/items")->with([
			'message' => 'پسماند ویرایش شد',
		]);
	}

	public function DeleteGet($owner_id, $item_id)
	{
		$item = Item::find($item_id);

		if (!$item) {
            return redirect()->back()->with([
				'message' => 'پسماند پیدا نشد',
			]);
		}

		$item->delete();

		return redirect()->back()->with([
			'message' => 'پسماند با موفقیت حذف گردید',
		]);
	}
}

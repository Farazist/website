<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\System;
use App\Group;
use App\City;
use App\Province;
use App\User;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function getAllForAdmin()
    {
        $systems = System::orderBy('created_at', 'desc')->get();

        return view('admin.systems', [
            'systems' => $systems,
        ]);
    }

    public function getSingle($name)
    {
        $name = str_replace('-', ' ', $name);

        $system = System::where('name', $name)->first();

        if (!$system) {
            return redirect()->back()->with([
                'message' => 'امکانات پیدا نشد',
            ]);
        }

        $id = $system->id;

        $i3classes = I3class::where('system_id', '=', $id)->orderBy('state', 'asc')->get();

        foreach ($i3classes as $i3class) {
            $this->fixClassInformation($i3class);
        }

        return view('client.system', [
            'system' => $system,
            'i3classes' => $i3classes,
        ]);
    }

    public function AddGet()
    {
        $provinces = Province::all();
        $cities = City::all();
        $owners = User::where('role', '2')->get();

        return view('admin.system_form')->with([
            'provinces' => $provinces,
            'cities' => $cities,
            'owners' => $owners,
        ]);
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|unique:systems',
            'name' => 'required|max:120',
            'lat' => 'numeric|nullable',
            'lng' => 'numeric|nullable',
            'morning_start_time' => 'numeric|nullable',
            'morning_end_time' => 'numeric|nullable',
            'afternoon_start_time' => 'numeric|nullable',
            'afternoon_end_time' => 'numeric|nullable',
            'address' => 'required',
        ]);

        $system = new System();
        $system->id = $request['id'];
        $system->name = $request['name'];
        $system->owner_id = $request['owner_id'];
        $system->city_id = $request['city_id'];
        $system->address = $request['address'];
        $system->activation_type = $request['activation_type'];
        $system->state = $request['state'];
        $system->lat = $request['lat'];
        $system->lng = $request['lng'];
        $system->morning_start_time = $request['morning_start_time'];
        $system->morning_end_time = $request['morning_end_time'];
        $system->afternoon_start_time = $request['afternoon_start_time'];
        $system->afternoon_end_time = $request['afternoon_end_time'];
        $system->image = $request['image'];
        $system->save();

        return redirect('/admin/systems')->with([
            'message' => 'دستگاه افزوده شد',
        ]);
    }

    public function EditGet($system_id)
    {
        $system = System::find($system_id);
        $provinces = Province::all();
        $cities = City::all();
        $owners = User::where('role', '2')->get();

        if (!$system) {
            return redirect()->back()->with([
                'message' => 'دستگاه پیدا نشد',
            ]);
        }
        return view('admin.system_form', [
            'system' => $system,
			'provinces' => $provinces,
			'cities' => $cities,
			'owners' => $owners,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120',
            'lat' => 'numeric|nullable',
            'lng' => 'numeric|nullable',
            'morning_start_time' => 'numeric|nullable',
            'morning_end_time' => 'numeric|nullable',
            'afternoon_start_time' => 'numeric|nullable',
            'afternoon_end_time' => 'numeric|nullable',
            'address' => 'required',
        ]);

        $system = System::find($request['id']);
        $system->name = $request['name'];
        $system->owner_id = $request['owner_id'];
        $system->city_id = $request['city_id'];
        $system->address = $request['address'];
        $system->activation_type = $request['activation_type'];
        $system->state = $request['state'];
        $system->lat = $request['lat'];
        $system->lng = $request['lng'];
        $system->morning_start_time = $request['morning_start_time'];
        $system->morning_end_time = $request['morning_end_time'];
        $system->afternoon_start_time = $request['afternoon_start_time'];
        $system->afternoon_end_time = $request['afternoon_end_time'];
        $system->image = $request['image'];
        $system->update();

        return redirect('/admin/systems')->with([
            'message' => 'دستگاه ویرایش شد',
        ]);
    }

    public function DeleteGet($system_id)
	{
		$system = System::find($system_id);
		if (!$system) {
            return redirect()->back()->with([
				'message' => 'دستگاه پیدا نشد',
			]);
		}
		$system->delete();
		return redirect()->back()->with([
			'message' => 'دستگاه با موفقیت حذف گردید',
		]);
	}
}

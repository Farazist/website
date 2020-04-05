<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\System;
use App\Group;
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
        return view('admin.system_form');
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            'caption' => 'required',
        ]);

        $system = new System();
        $system->title = $request['title'];
        $system->caption = $request['caption'];
        $system->image = $request['image'];
        $system->save();

        return redirect('/admin/system')->with([
            'message' => 'امکانات افزوده شد',
        ]);
    }

    public function EditGet($system_id)
    {
        $system = System::find($system_id);
        if (!$system) {
            return redirect()->route('admin.system.all.get')->with([
                'message' => 'امکانات پیدا نشد',
            ]);
        }

        return view('admin.system_form', [
            'system' => $system,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            'caption' => 'required',
        ]);

        $system = System::find($request['id']);
        $system->title = $request['title'];
        $system->caption = $request['caption'];
        $system->image = $request['image'];
        $system->update();

        return redirect('/admin/system')->with([
            'message' => 'امکانات ویرایش شد',
        ]);
    }

    public function DeleteGet($id)
    {
        $system = System::find($id);

        if (!$system) {
            return redirect()->route('admin.blog.topics.get')->with([
                'message' => 'امکانات پیدا نشد',
            ]);
        }

        $system->delete();

        return redirect()->back()->with([
            'message' => 'امکانات حذف شد',
        ]);
    }
}

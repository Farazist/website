<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Counter;
use App\Group;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function getAllForAdmin()
    {
        $counters = Counter::orderBy('created_at', 'desc')->get();

        return view('admin.counters', [
            'counters' => $counters,
        ]);
    }

    public function AddGet()
    {
        return view('admin.counter_form');
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120',
            'value' => 'required',
            'icon' => 'required',
        ]);

        $counter = new Counter();
        $counter->name = $request['name'];
        $counter->value = $request['value'];
        $counter->icon = $request['icon'];
        $counter->save();

        return redirect('/admin/counter')->with([
            'message' => 'امکانات افزوده شد',
        ]);
    }

    public function EditGet($counter_id)
    {
        $counter = Counter::find($counter_id);
        if (!$counter) {
            return redirect()->route('admin.counter.all.get')->with([
                'message' => 'امکانات پیدا نشد',
            ]);
        }

        return view('admin.counter_form', [
            'counter' => $counter,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120',
            'value' => 'required',
            'icon' => 'required',
        ]);

        $counter = Counter::find($request['id']);
        $counter->name = $request['name'];
        $counter->value = $request['value'];
        $counter->icon = $request['icon'];
        $counter->update();

        return redirect('/admin/counter')->with([
            'message' => 'امکانات ویرایش شد',
        ]);
    }

    public function DeleteGet($id)
    {
        $counter = Counter::find($id);

        if (!$counter) {
            return redirect()->route('admin.blog.topics.get')->with([
                'message' => 'امکانات پیدا نشد',
            ]);
        }

        $counter->delete();

        return redirect()->back()->with([
            'message' => 'امکانات حذف شد',
        ]);
    }
}

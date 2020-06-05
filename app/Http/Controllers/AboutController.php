<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\About;
use App\Group;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function getAllForAdmin()
    {
        $abouts = About::orderBy('created_at', 'desc')->get();

        return view('admin.abouts', [
            'abouts' => $abouts,
        ]);
    }

    public function getSingle($name)
    {
        $name = str_replace('-', ' ', $name);

        $about = About::where('name', $name)->first();

        if (!$about) {
            return redirect()->back()->with([
                'message' => 'امکانات پیدا نشد',
            ]);
        }

        $id = $about->id;

        $i3classes = I3class::where('about_id', '=', $id)->orderBy('state', 'asc')->get();

        foreach ($i3classes as $i3class) {
            $this->fixClassInformation($i3class);
        }

        return view('client.about', [
            'about' => $about,
            'i3classes' => $i3classes,
        ]);
    }

    public function AddGet()
    {
        return view('admin.about_form');
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            'caption' => 'required',
        ]);

        $about = new About();
        $about->title = $request['title'];
        $about->caption = $request['caption'];
        $about->image = $request['image'];
        $about->save();

        return redirect('/admin/about')->with([
            'message' => 'امکانات افزوده شد',
        ]);
    }

    public function EditGet($about_id)
    {
        $about = About::find($about_id);
        if (!$about) {
            return redirect()->back()->with([
                'message' => 'امکانات پیدا نشد',
            ]);
        }

        return view('admin.about_form', [
            'about' => $about,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            'caption' => 'required',
        ]);

        $about = About::find($request['id']);
        $about->title = $request['title'];
        $about->caption = $request['caption'];
        $about->image = $request['image'];
        $about->update();

        return redirect('/admin/abouts')->with([
            'message' => 'امکانات ویرایش شد',
        ]);
    }

    public function DeleteGet($id)
    {
        $about = About::find($id);

        if (!$about) {
            return redirect()->route('admin.blog.topics.get')->with([
                'message' => 'امکانات پیدا نشد',
            ]);
        }

        $about->delete();

        return redirect()->back()->with([
            'message' => 'امکانات حذف شد',
        ]);
    }
}

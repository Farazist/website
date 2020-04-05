<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Image;
use App\Group;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function getAllForAdmin()
    {
        $images = Image::orderBy('created_at', 'desc')->get();

        return view('admin.images', [
            'images' => $images,
        ]);
    }

    public function SingleGet($name)
    {
        $name = str_replace('-', ' ', $name);

        $image = Image::where('name', $name)->first();

        if (!$image) {
            return redirect()->back()->with([
                'message' => 'امکانات پیدا نشد',
            ]);
        }

        $id = $image->id;

        $i3classes = I3class::where('image_id', '=', $id)->orderBy('state', 'asc')->get();

        foreach ($i3classes as $i3class) {
            $this->fixClassInformation($i3class);
        }

        return view('client.image', [
            'image' => $image,
            'i3classes' => $i3classes,
        ]);
    }

    public function AddGet()
    {
        return view('admin.image_form');
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            'caption' => 'required',
        ]);

        $image = new Image();
        $image->title = $request['title'];
        $image->caption = $request['caption'];
        $image->image = $request['image'];
        $image->save();

        return redirect('/admin/image')->with([
            'message' => 'امکانات افزوده شد',
        ]);
    }

    public function EditGet($image_id)
    {
        $image = Image::find($image_id);
        if (!$image) {
            return redirect()->route('admin.image.all.get')->with([
                'message' => 'امکانات پیدا نشد',
            ]);
        }

        return view('admin.image_form', [
            'image' => $image,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            'caption' => 'required',
        ]);

        $image = Image::find($request['id']);
        $image->title = $request['title'];
        $image->caption = $request['caption'];
        $image->image = $request['image'];
        $image->update();

        return redirect('/admin/image')->with([
            'message' => 'امکانات ویرایش شد',
        ]);
    }

    public function DeleteGet($id)
    {
        $image = Image::find($id);

        if (!$image) {
            return redirect()->route('admin.blog.topics.get')->with([
                'message' => 'امکانات پیدا نشد',
            ]);
        }

        $image->delete();

        return redirect()->back()->with([
            'message' => 'امکانات حذف شد',
        ]);
    }
}

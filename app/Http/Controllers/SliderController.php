<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\System;
use App\Slider;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function getAllForAdmin()
    {
        $sliders = Slider::orderBy('order', 'desc')->get();
        $images = Image::all();;

        return view('admin.sliders', [
            'sliders' => $sliders,
            'images' => $images,
        ]);
    }

    public function getBySystem($system_id)
    {
        $system = System::find($system_id);
        $sliders = $system->sliders;

        return view('admin.sliders', [
            'system' => $system,
            'sliders' => $sliders,
        ]);
    }

    public function AddGet($system_id)
    {
        $system = System::find($system_id);
        return view('admin.slider_form')->with([
            'system' => $system,
        ]);
    }

    public function AddPost(Request $request, $system_id)
    {
        $this->validate($request, [
            'title' => 'max:60',
            'caption' => 'max:120',
        ]);

        $slider = new Slider();
        $slider->system_id = $system_id;
        $slider->title = $request['title'];
        $slider->caption = $request['caption'];
        $slider->url = $request['url'];
        $slider->image = $request['image'];
        $slider->save();

        return redirect("admin/systems/$system_id/sliders")->with([
            'message' => 'اسلایدر افزوده شد',
        ]);
    }

    public function EditGet($id)
    {
        $slider = Slider::find($id);

        if (!$slider) {
            return redirect('admin/slider')->with([
                'message' => 'دانشجو پیدا نشد',
            ]);
        }

        return view('admin.slider_form', [
            'slider' => $slider,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'max:60',
            'caption' => 'max:120',
        ]);

        $slider = Slider::find($request['id']);
        $slider->title = $request['title'];
        $slider->caption = $request['caption'];
        $slider->url = $request['url'];
        $slider->image = $request['image'];
        $slider->update();

        return redirect('admin/slider-image')->with([
            'message' => 'اسلایدر ویرایش شد',
        ]);
    }

    public function DeleteGet($system_id, $slider_id)
    {
        $slider = Slider::find($slider_id);

        if (!$slider) {
            return redirect()->back()->with([
                'message' => 'اسلایدر پیدا نشد',
            ]);
        }

        $slider->delete();

        return redirect()->back()->with([
            'message' => 'اسلایدر حذف شد',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Service;
use App\Group;
use App\I3class;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getAllForAdmin()
    {
        $services = Service::orderBy('created_at', 'desc')->get();

        return view('admin.services', [
            'services' => $services,
        ]);
    }

    public function getAllForClient()
    {
        $services = Service::select('services.*')
            ->join('groups', 'groups.id', '=', 'services.group_id')
            ->where('groups.name', '<>', 'ICDL')
            ->orderBy('created_at', 'desc')->get();

        return view('client.services', [
            'services' => $services,
        ]);
    }

    public function SingleGet($name)
    {
        $name = str_replace('-', ' ', $name);

        $service = Service::where('name', $name)->first();

        if (!$service) {
            return redirect()->back()->with([
                'message' => 'امکانات پیدا نشد',
            ]);
        }

        $id = $service->id;

        $i3classes = I3class::where('service_id', '=', $id)->orderBy('state', 'asc')->get();

        foreach ($i3classes as $i3class) {
            $this->fixClassInformation($i3class);
        }

        return view('client.service', [
            'service' => $service,
            'i3classes' => $i3classes,
        ]);
    }

    public function AddGet()
    {
        return view('admin.service_form');
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            'caption' => 'required',
        ]);

        $service = new Service();
        $service->title = $request['title'];
        $service->caption = $request['caption'];
        $service->image = $request['image'];
        $service->save();

        return redirect('/admin/service')->with([
            'message' => 'امکانات افزوده شد',
        ]);
    }

    public function EditGet($service_id)
    {
        $service = Service::find($service_id);
        if (!$service) {
            return redirect()->route('admin.service.all.get')->with([
                'message' => 'امکانات پیدا نشد',
            ]);
        }

        return view('admin.service_form', [
            'service' => $service,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            'caption' => 'required',
        ]);

        $service = Service::find($request['id']);
        $service->title = $request['title'];
        $service->caption = $request['caption'];
        $service->image = $request['image'];
        $service->update();

        return redirect('/admin/service')->with([
            'message' => 'امکانات ویرایش شد',
        ]);
    }

    public function DeleteGet($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return redirect()->route('admin.blog.topics.get')->with([
                'message' => 'امکانات پیدا نشد',
            ]);
        }

        $service->delete();

        return redirect()->back()->with([
            'message' => 'امکانات حذف شد',
        ]);
    }
}

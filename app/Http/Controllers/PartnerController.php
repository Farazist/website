<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Partner;
use App\Group;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function getAllForAdmin()
    {
        $partners = Partner::orderBy('created_at', 'desc')->get();

        return view('admin.partners', [
            'partners' => $partners,
        ]);
    }

    public function AddGet()
    {
        return view('admin.partner_form');
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120'
        ]);

        $partner = new Partner();
        $partner->name = $request['name'];
        $partner->url = $request['url'];
        $partner->image = $request['image'];
        $partner->save();

        return redirect('/admin/partner')->with([
            'message' => 'همکار افزوده شد',
        ]);
    }

    public function EditGet($partner_id)
    {
        $partner = Partner::find($partner_id);
        
        if (!$partner) {
            return redirect()->route('admin.partner.all.get')->with([
                'message' => 'همکار پیدا نشد',
            ]);
        }

        return view('admin.partner_form', [
            'partner' => $partner,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120'
        ]);

        $partner = Partner::find($request['id']);
        $partner->name = $request['name'];
        $partner->url = $request['url'];
        $partner->image = $request['image'];
        $partner->update();

        return redirect('/admin/partner')->with([
            'message' => 'همکار ویرایش شد',
        ]);
    }

    public function DeleteGet($id)
    {
        $partner = Partner::find($id);

        if (!$partner) {
            return redirect()->route('admin.blog.topics.get')->with([
                'message' => 'همکار پیدا نشد',
            ]);
        }

        $partner->delete();

        return redirect()->back()->with([
            'message' => 'همکار حذف شد',
        ]);
    }
}

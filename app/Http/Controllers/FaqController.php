<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Faq;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function getAllForAdmin()
    {
        $faqs = Faq::all();

        return view('admin.faqs', [
            'faqs' => $faqs,
        ]);
    }

    public function getAllForClient()
    {
        $faqs = Faq::all();

        return view('client.faqs', [
            'faqs' => $faqs,
        ]);
    }

    public function AddGet()
    {

        return view('admin.faqs_form');
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'question' => 'required'
        ]);

        $faq = new faq();
        $faq->question = $request['question'];
        $faq->answer = $request['answer'];
        $faq->save();

        return redirect('/admin/faqs')->with([
            'message' => 'سوال افزوده شد',
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

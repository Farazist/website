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

    public function EditGet($faq_id)
    {
        $faq = Faq::find($faq_id);
        
        if (!$faq) {
            return redirect()->back()->with([
                'message' => 'سوال پیدا نشد',
            ]);
        }

        return view('admin.faqs_form', [
            'faq' => $faq,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required'
        ]);

        $faq = Faq::find($request['id']);
        $faq->question = $request['question'];
        $faq->answer = $request['answer'];
        $faq->update();

        return redirect('/admin/faqs')->with([
            'message' => 'سوال ویرایش شد',
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

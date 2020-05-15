<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Events\commentCreated;
use App\I3class;
use App\Page;
use App\Category;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Storage;
use File;

class PageController extends Controller
{
    public function AllGetForAdmin()
    {
        $pages = Page::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.pages', [
            'pages' => $pages,
        ]);
    }

    public function SingleGet($title)
    {
        $title = str_replace('-', ' ', $title);
        $page = Page::where('title', $title)->first();

        if (!$page) {
            return redirect('/blog')->with([
                'message' => 'برگه پیدا نشد',
            ]);
        }

        return view('client.page', [
            'page' => $page
        ]);
    }

    public function AddGet()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();

        return view('admin.page_form', [
            'categories' => $categories,
            'employees' => $employees,
        ]);
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            'body' => 'required',
            'description' => 'required|max:128',
            'keywords' => 'required|max:128',
        ]);

        $page = new Page();
        $page->title = $request['title'];
        $page->body = $request['body'];
        $page->description = $request['description'];
        $page->keywords = $request['keywords'];
        $page->image = $request['image'];
        $page->save();

        return redirect('admin/pages')->with([
            'message' => 'برگه درج شد',
        ]);
    }

    public function EditGet($page_id)
    {
        $page = Page::find($page_id);

        $categories = Category::orderBy('name', 'desc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();

        if (!$page) {
            return redirect('admin/pages')->with([
                'message' => 'برگه پیدا نشد',
            ]);
        }

        return view('admin.page_form', [
            'page' => $page,
            'categories' => $categories,
            'employees' => $employees,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            'body' => 'required',
            'description' => 'required|max:128',
            'keywords' => 'required|max:128',
        ]);

        $page = Page::find($request['id']);
        $page->title = $request['title'];
        $page->body = $request['body'];
        $page->description = $request['description'];
        $page->keywords = $request['keywords'];
        $page->image = $request['image'];
        $page->update();

        return redirect('/admin/pages')->with([
            'message' => 'برگه ویرایش شد',
        ]);
    }

    public function DeleteGet($page_id)
    {
        $page = Page::find($page_id);

        if (!$page) {
            return redirect()->route('admin.blog.pages.get')->with([
                'message' => 'برگه پیدا نشد',
            ]);
        }

        $page->delete();

        return redirect()->back()->with([
            'message' => 'برگه حذف شد',
        ]);
    }
}

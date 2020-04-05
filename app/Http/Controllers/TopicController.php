<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Events\commentCreated;
use App\Topic;
use App\Category;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Storage;
use File;

class TopicController extends Controller
{
    public function getAllForAdmin()
    {
        $topics = Topic::orderBy('created_at', 'desc')->paginate(20);

        foreach ($topics as $topic) {

            $topic->created_time = jdate('H:i:s', strtotime($topic->created_at));
            $topic->created_date = jdate('l j F Y', strtotime($topic->created_at));
        }

        return view('admin.topics', [
            'topics' => $topics,
        ]);
    }

    public function getAllForClient()
    {
        $topics = Topic::orderBy('created_at', 'desc')->paginate(12)->onEachSide(1);

        foreach ($topics as $topic) {

            $topic->body = strip_tags($this->shortenText($topic->body, 20));
            $topic->created_date = jdate('l j F Y', strtotime($topic->created_at));
        }

        $categories = Category::orderBy('name', 'desc')->get();

        return view('client.topics', [
            'topics' => $topics,
            'categories' => $categories,
        ]);
    }

    public function SingleGet($category, $id)
    {
        $topic = Topic::find($id);

        if (!$topic) {
            return redirect('/blog')->with([
                'message' => 'پست پیدا نشد',
            ]);
        }

        $topic->created_date = jdate('l j F Y', strtotime($topic->created_at));

        $new_topics = Topic::where('id', '!=', $topic->id)->orderBy('created_at', 'desc')->take(3)->get();
        foreach ($new_topics as $new_topic) {
            $new_topic->created_date = jdate('l j F Y', strtotime($new_topic->created_at));
        }

        $categories = Category::orderBy('name', 'desc')->get();

        return view('client.topic', [
            'topic' => $topic,
            'new_topics' => $new_topics,
            'categories' => $categories,
        ]);
    }

    public function AddGet()
    {
        return view('admin.topic_form');
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            'body' => 'required',
            'description' => 'required|max:128',
            'keywords' => 'required|max:128',
        ]);

        $topic = new Topic();
        $topic->title = $request['title'];
        $topic->body = $request['body'];
        $topic->description = $request['description'];
        $topic->keywords = $request['keywords'];
        $topic->image = $request['image'];
        $topic->save();

        return redirect('admin/blog')->with([
            'message' => 'پست درج شد',
        ]);
    }

    public function EditGet($topic_id)
    {
        $topic = Topic::find($topic_id);

        if (!$topic) {
            return redirect('admin/blog')->with([
                'message' => 'پست پیدا نشد',
            ]);
        }

        return view('admin.topic_form', [
            'topic' => $topic,
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

        $topic = Topic::find($request['id']);
        $topic->title = $request['title'];
        $topic->body = $request['body'];
        $topic->description = $request['description'];
        $topic->keywords = $request['keywords'];
        $topic->image = $request['image'];
        $topic->update();

        return redirect('/admin/blog')->with([
            'message' => 'پست ویرایش شد',
        ]);
    }

    public function DeleteGet($topic_id)
    {
        $topic = Topic::find($topic_id);

        if (!$topic) {
            return redirect()->route('admin.blog.topics.get')->with([
                'message' => 'پست پیدا نشد',
            ]);
        }

        $topic->delete();

        return redirect()->back()->with([
            'message' => 'پست حذف شد',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Group;
use App\About;
use App\Service;
use App\Employee;
use App\User;
use App\Topic;
use App\Counter;
use App\Category;
use App\Partner;
use App\Video;
use App\Image;
use App\Page;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function index()
    {
        $sliders = Slider::orderBy('id', 'desc')->get();
        $employees = Employee::all();
        $abouts = About::all();
        $counters = Counter::all();
        $services = Service::all();
        $partners = Partner::all();
        $images = Image::all();
        $topics = Topic::orderBy('created_at', 'desc')->take(2)->get();

        foreach ($topics as $topic) {

            $topic->body = strip_tags($this->shortenText($topic->body, 10));
            $topic->created_date = jdate('l j F Y', strtotime($topic->created_at));
        }

        return view('client.index')->with([
            'employees' => $employees,
            'sliders' => $sliders,
            'counters' => $counters,
            'abouts' => $abouts,
            'services' => $services,
            'partners' => $partners,
            'images' => $images,
            'topics' => $topics,
        ]);
    }

    function help()
    {
        $page = Page::where('title', 'راهنما')->first();
        return view('client.page')->with([
            'page' => $page
        ]);
    }

    function groups()
    {
        $groups = Group::where('parent_id', '=', '0')->get();
        return view('client.groups', ['groups' => $groups]);
    }

    function courses($name)
    {
        $name = str_replace('-', ' ', $name);

        $group = Group::where('name_en', $name)->first();

        if (!$group) {
            return redirect()->back()->with([
                'message' => 'دوره آموزشی پیدا نشد',
            ]);
        }

        foreach ($group->courses as $course) {
            $course->explanation = strip_tags($this->shortenText($course->explanation, 64));
            $this->fixClassInformation($course);
        }

        return view('client.courses', [
            'group' => $group
        ]);
    }

    function course($group_name, $course_name)
    {
        $course_name = str_replace('-', ' ', $course_name);

        $course = Course::query()->where('name', $course_name)->first();

        return view('client.course', [
            'course' => $course
        ]);
    }

    function aboutUs()
    {
        return view('client.about-us');
    }
    function contactUs()
    {
        return view('client.about-us');
    }

    function logout()
    {
        Auth::logout();
        return redirect('/')->with([
            'message'=>'از حساب کاربری خارج شدید'
            ]);
    }
}

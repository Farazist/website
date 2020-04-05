<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\Course;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function search(Request $data)
    {
        $categories = Category::all();
        $user = Auth::guard('user')->user();
        $search_item = $data['search_item'];
        $courses = Course::query()
            ->where('title', 'LIKE', "%{$search_item}%")
            ->orWhere('announcement', 'LIKE', "%{$search_item}%")
            ->orWhere('headlines', 'LIKE', "%{$search_item}%")
            ->get();
        return view('user.search-result' , ['courses' => $courses , 'user' => $user , 'search_item' => $search_item , 'categories' => $categories]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Category;
use App\Topic;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $topics = Topic::all();
        $categories = Category::all();

        return response()->view('sitemap.index', [
            'topics' => $topics,
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }

    public function topics()
    {
        $topics = Topic::latest()->get();
        return response()->view('sitemap.topics', [
            'topics' => $topics,
        ])->header('Content-Type', 'text/xml');
    }

    public function categories()
    {
        $categories = Category::all();
        return response()->view('sitemap.categories', [
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }
}

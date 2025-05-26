<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPosts;

class PagesController extends Controller
{
    public function home() {

        //get x most recent posts
        $posts = BlogPosts::orderBy('date', 'desc')->take(5)->get();

        return view('home', compact('posts'));
    }     

    public function about() {

        return view('about');
    }
}

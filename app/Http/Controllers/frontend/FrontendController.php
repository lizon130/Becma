<?php

namespace App\Http\Controllers\frontend;

use App\Models\Blog;
use App\Models\News;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Gallery_photo;
use App\Models\Gallery_video;
use App\Models\NewsBanner;
use Illuminate\Http\Request;
use App\Models\Executive_commitee;
use App\Http\Controllers\Controller;
use App\Models\Event;

class FrontendController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        $blogs = Blog::latest()->get();
        $executives = Executive_commitee::latest()->get();
        $partners = Partner::latest()->get();
        $news = News::latest()->take(3)->get();
        $newsBanner = NewsBanner::latest()->get();
        $events = Event::latest()->get();
        $images = Gallery_photo::latest()->get();
        $videos = Gallery_video::latest()->get();
        return view('frontend.pages.home', compact('services','blogs','executives','partners','news','newsBanner','events','images','videos'));
    }

    // service

    public function allService(){
        $services = Service::latest()->get();
        return view('frontend.pages.service.all-service',compact('services'));
    }

    public function serviceDetails($id) {
        $service = Service::findOrFail($id);  // Fetch service by ID
        return view('frontend.pages.service.details', compact('service'));
    }

    // news

    public function allNews(){
        $news = News::latest()->get();
        return view('frontend.pages.news.all-news',compact('news'));
    }

    public function newsDetails($id) {
        $news = News::findOrFail($id);  // Fetch service by ID
        return view('frontend.pages.news.details', compact('news'));
    }


    // blog

    public function allblogs(){
        $blogs = Blog::latest()->get();
        return view('frontend.pages.blog.all-blog',compact('blogs'));
    }

    public function blogDetails($id) {
        $blogs = Blog::findOrFail($id);  // Fetch service by ID
        return view('frontend.pages.blog.details', compact('blogs'));
    }

}

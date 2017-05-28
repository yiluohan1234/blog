<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Navs;
use Illuminate\Support\Facades\View;
use App\Http\Model\Article;
use App\Http\Model\Links;
use App\Http\Model\Category;

class CommonController extends Controller
{
    public function __construct()
    {
    	$navs = Navs::all();
    	//点击量最高的6篇文章
        $hot = Article::orderby('art_view','desc')->take(5)->get();
        //最新文章8条
        $new = Article::orderby('art_view','desc')->take(8)->get();
    	View::share('navs',$navs);
    	View::share('hot',$hot);
    	View::share('new',$new);

    }
}

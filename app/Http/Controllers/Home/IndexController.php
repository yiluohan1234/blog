<?php

namespace App\Http\Controllers\Home;
use App\Http\Model\Navs;
use App\Http\Model\Article;
use App\Http\Model\Links;
use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;
use TomLingham\Searchy\Facades\Searchy;

class IndexController extends CommonController
{

    public function index()
    {
        //文章列表5篇（带分页）
        $data = Article::orderby('art_time','desc')->paginate(6);
        //获得cate_id对应的name
        $id_name = self::getCategoryName($data);
            
        //点击量最高的3篇文章(站长推荐)
        $hots = Article::orderby('art_view','desc')->take(3)->get();

        $categorys = Category::orderby('cate_id', 'desc')->get();
        //dd($categorys);
        
        //按month分类
        $months = $this->getMonth();
       
    	return view('home.index',compact('data', 'id_name', 'hots', 'categorys', 'months'));
    }

    public function cate($cate_id)
    {    	
        $field = Category::find($cate_id);
        //查看次数自增 
        Category::where('cate_id',$cate_id)->increment('cate_view');
        //图文列表5篇（带分页）
        $data = Article::where('cate_id',$cate_id)->orderby('art_time','desc')->paginate(4); 
    	
        //获得cate_id对应的name
        $id_name = self::getCategoryName($data);
        //点击量最高的3篇文章(站长推荐)
        $hots = Article::orderby('art_view','desc')->take(3)->get();

        $categorys = Category::orderby('cate_id', 'desc')->get();

        //按month分类
        $months = $this->getMonth();

        return view('home.list',compact('field','data', 'id_name', 'categorys', 'hots', 'months'));
    }

    public function article($art_id)
    { 
        $field = Article::join('category','article.cate_id','=','category.cate_id')->where('art_id',$art_id)->first();
        
        $category_id = $field->cate_id;
        $category_name = Category::find($category_id)['cate_name'];
        $field['cate_name'] = $category_name;

        //查看次数自增 
        Article::where('art_id',$art_id)->increment('art_view');
        
        $categorys = Category::orderby('cate_id', 'desc')->get();

        //点击量最高的3篇文章(站长推荐)
        $hots = Article::orderby('art_view','desc')->take(3)->get();

        //按month分类
        $months = $this->getMonth();
        return view('home.details',compact('field','categorys', 'hots', 'months'));
    }

    //获得cate_id对应的name
    public function getCategoryName($data)
    {
        $id_name = array();
        foreach($data as $p)
        {
            $category_id = $p->cate_id;
            $category_name = Category::find($category_id)['cate_name'];
            if (in_array($category_id, $id_name))
            {
                continue;
            }
            else
            {
                $id_name[$category_id] = $category_name;
            }
        }
        return $id_name;
    }
    
    //获取分类月份
    public function getMonth()
    {
        $field_month = Article::orderby('art_time', 'desc')->get();
        
        $month_aritcle = array();
        foreach($field_month as $p)
        {
            $month = date('Y-m',$p->art_time);

            if (in_array($month,$month_aritcle))
            {
                continue;
            }
            
            array_push($month_aritcle, $month);
        }

        
        return $month_aritcle;
    }

    public function achieve($month)
    {
        // $field = Category::find($cate_id);
        // //查看次数自增 
        // Category::where('cate_id',$cate_id)->increment('cate_view');
        
        $data = Article::where('art_time_month', 'like', $month)->orderby('art_time','desc')->paginate(4); 
        //获得cate_id对应的name
        $id_name = self::getCategoryName($data);
        //点击量最高的3篇文章(站长推荐)
        $hots = Article::orderby('art_view','desc')->take(3)->get();

        $categorys = Category::orderby('cate_id', 'desc')->get();

        //按month分类
        $months = $this->getMonth();

        return view('home.achieve',compact('data', 'id_name', 'categorys', 'hots', 'months'));
    }
    public function search()
    {
        $keyword=  Input::get('keyword');
        
        $data = Article::where('art_title', 'LIKE', '%'.$keyword.'%')->orWhere('art_tag', 'LIKE', '%'.$keyword.'%')->orderby('art_time', 'desc')->get();
        $id_name = self::getCategoryName($data);
        //点击量最高的3篇文章(站长推荐)
        $hots = Article::orderby('art_view','desc')->take(3)->get();

        $categorys = Category::orderby('cate_id', 'desc')->get();
        //dd($data);
        //按month分类
        $months = $this->getMonth();


        if ($data->isEmpty())
        {
            return view('home.searchnoresult',compact('hots','categorys', 'months','id_name'));
        }
        else
        {
            return view('home.search', compact('data','hots','categorys', 'months','id_name'));
        }
        //return view('home.searchnoresult',compact('hots','categorys', 'months','id_name'));
        
    }
    
}

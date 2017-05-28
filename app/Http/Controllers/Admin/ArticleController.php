<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;
use App\Http\Model\Article;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
	//全部文章列表
    public function index()
    {
        $data = Article::orderby('art_id','desc')->paginate(5);
        //dd($data->links());
    	return view('admin.article.index',compact('data'));
    }

    //post admin/category/create 添加文章
    public function create()
    {
    	$data = (new Category)->tree();
        return view('admin.article.add',compact('data'));
    }
    //post admin/article 添加文章提交
    public function store()
    {
        $input = Input::except('_token');
        $input['art_time'] = time();
        $input['art_time_month'] = date('Y-m',time());

         //验证的规则
        $rules = [
            'art_title'=>'required',
            'art_content'=>'required',
        ];
        //输出错误信息
        $message = [
            'art_title.required' => '文章名称不能为空',
            'art_content.required' => '文章内容不能为空',
            ];
        //输入，规则，自定义信息
        $validator = Validator::make($input,$rules,$message);

        if ($validator->passes())
        {
           $ret = Article::create($input);
           if ($ret)
            {
                return redirect('admin/article');
            }
            else
            {
                return back()->with('errors','数据填充失败,请稍后重试');
            }
        }
        else
        {
            return back()->withErrors($validator);
        }
    }
    //编辑文章
    public function edit($art_id)
    {
        $data = (new Category)->tree();
        $field = Article::find($art_id);
        return view('admin.article.edit',compact('data','field'));
    }
    //更新文章
    public function update($art_id)
    {
        $input = Input::except('_token','_method');
        $ret = Article::where('art_id',$art_id)->update($input);
        if ($ret)
        {
            return redirect('admin/article');
        }
        else
        {
            return back()->with('errors','文章信息更新失败,请稍后重试');
        }
    }
    //delete admin/category/[category] 删除文章
    public function destroy($art_id)
    {
        $ret = Article::where('art_id',$art_id)->delete();
        
        if ($ret)
        {
            $data = [
                'status' =>0,
                'msg' => '文章删除成功',
            ];
        }
        else
        {
            $data = [
                'status' =>1,
                'msg' => '文章删除失败,请稍后重试',
            ];
        }
        return $data;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Links;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends CommonController
{
    //get admin/links 全部友情链接列表
    public function index()
    {
    	$data = Links::orderby('link_order','asc')->get();
    	return view('admin.links.index',compact('data'));
    }
    public function changeorder()
    {
        $input = Input::all();
        $links = Links::find($input['link_id']);
        $links->link_order = $input['link_order'];
        $ret = $links->update();
        if ($ret)
        {
            $data = [
                'status' => 0,
                'msg' => '友情链接排序更新成功',
            ];
        }
        else
        {
            $data = [
                'status' => 1,
                'msg' => '友情链接排序更新失败，请稍后重试',
            ];
        }
        return $data;
    }
    //post admin/links/create 添加友情链接
    public function create()
    {
    	$data = [];
        return view('admin.links.add',compact('data'));
    }
    //post admin/links 添加友情链接提交
    public function store()
    {
        $input = Input::except('_token');
        //dd($input);
        //验证的规则
        $rules = [
            'link_name'=>'required',
            'link_url'=>'required',
        ];
        //输出错误信息
        $message = [
            'link_name.required' => '友情链接名称不能为空',
            'link_url.required' => '友情链接URL不能为空',
            ];
        //输入，规则，自定义信息
        $validator = Validator::make($input,$rules,$message);

        if ($validator->passes())
        {
           $ret = Links::create($input);
           if ($ret)
           {
            return redirect('admin/links');
           }
           else
           {
                return back()->with('errors','友情链接填充失败,请稍后重试');
           }
        }
        else
        {
            return back()->withErrors($validator);
        }
        
    }
    //put admin/links/[links]更新友情链接
    public function update($link_id)
    {
        $input = Input::except('_token','_method');
        $ret = Links::where('link_id',$link_id)->update($input);
        if ($ret)
        {
            return redirect('admin/links');
        }
        else
        {
            return back()->with('errors','友情链接更新失败,请稍后重试');
        }
    }
    //get admin/links/{links}/edit编辑友情链接
    public function edit($link_id)
    {
        $field = Links::find($link_id);
        return view('admin.links.edit',compact('field'));
    }
    //delete admin/links/[links] 删除友情链接
    public function destroy($link_id)
    {
        $ret = Links::where('link_id',$link_id)->delete();
        
        if ($ret)
        {
            $data = [
                'status' =>0,
                'msg' => '友情链接删除成功',
            ];
        }
        else
        {
            $data = [
                'status' =>1,
                'msg' => '友情链接删除失败,请稍后重试',
            ];
        }
        return $data;
    }
    public function show()
    {

    }
}

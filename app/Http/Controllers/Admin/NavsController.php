<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Navs;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends CommonController
{
    //get admin/navs 全部自定义导航列表Navs
    public function index()
    {
    	$data = Navs::orderby('nav_order','asc')->get();
    	return view('admin.navs.index',compact('data'));
    }
    public function changeorder()
    {
        $input = Input::all();
        $navs = Navs::find($input['nav_id']);
        $navs->nav_order = $input['nav_order'];
        $ret = $navs->update();
        if ($ret)
        {
            $data = [
                'status' => 0,
                'msg' => '自定义导航排序更新成功',
            ];
        }
        else
        {
            $data = [
                'status' => 1,
                'msg' => '自定义导航排序更新失败，请稍后重试',
            ];
        }
        return $data;
    }
    //post admin/navs/create 添加自定义导航
    public function create()
    {
    	$data = [];
        return view('admin.navs.add',compact('data'));
    }
    //post admin/navs 添加自定义导航提交
    public function store()
    {
        $input = Input::except('_token');
        //dd($input);
        //验证的规则
        $rules = [
            'nav_name'=>'required',
            'nav_url'=>'required',
        ];
        //输出错误信息
        $message = [
            'nav_name.required' => '自定义导航名称不能为空',
            'nav_url.required' => '自定义导航URL不能为空',
            ];
        //输入，规则，自定义信息
        $validator = Validator::make($input,$rules,$message);

        if ($validator->passes())
        {
           $ret = Navs::create($input);
           if ($ret)
           {
            return redirect('admin/navs');
           }
           else
           {
                return back()->with('errors','自定义导航填充失败,请稍后重试');
           }
        }
        else
        {
            return back()->withErrors($validator);
        }
        
    }
    //put admin/navs/[navs]更新自定义导航
    public function update($nav_id)
    {
        $input = Input::except('_token','_method');
        $ret = Navs::where('nav_id',$nav_id)->update($input);
        if ($ret)
        {
            return redirect('admin/navs');
        }
        else
        {
            return back()->with('errors','自定义导航更新失败,请稍后重试');
        }
    }
    //get admin/navs/{navs}/edit编辑自定义导航
    public function edit($nav_id)
    {
        $field = Navs::find($nav_id);
        return view('admin.navs.edit',compact('field'));
    }
    //delete admin/navs/[navs] 删除自定义导航
    public function destroy($nav_id)
    {
        $ret = Navs::where('nav_id',$nav_id)->delete();
        
        if ($ret)
        {
            $data = [
                'status' =>0,
                'msg' => '自定义导航删除成功',
            ];
        }
        else
        {
            $data = [
                'status' =>1,
                'msg' => '自定义导航删除失败,请稍后重试',
            ];
        }
        return $data;
    }
    public function show()
    {

    }
}

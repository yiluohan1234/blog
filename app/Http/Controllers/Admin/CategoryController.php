<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
	//get admin/category 全部分类列表
    public function index()
    {
    	$data = (new Category)->tree();
    	return view('admin.category.index')->with('data',$data);
    }

    public function changeorder()
    {
        $input = Input::all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $ret = $cate->update();
        if ($ret)
        {
            $data = [
                'status' => 0,
                'msg' => '分类排序更新成功',
            ];
        }
        else
        {
            $data = [
                'status' => 1,
                'msg' => '分类排序更新失败，请稍后重试',
            ];
        }
        return $data;
    }
    

    //post admin/category/create 添加分类
    public function create()
    {
        //读取顶级分类
        $data = Category::where('cate_pid',0)->get();

        return view('admin/category/add',compact('data'));
    }

    //post admin/category 添加分类提交
    public function store()
    {
        $input = Input::except('_token');
        //dd($input);
        //验证的规则
        $rules = [
            'cate_name'=>'required',
            'cate_order'=>'required',
        ];
        //输出错误信息
        $message = [
            'cate_name.required' => '分类名称不能为空',
            'cate_order.required' => '分类排序不能为空',
            ];
        //输入，规则，自定义信息
        $validator = Validator::make($input,$rules,$message);

        if ($validator->passes())
        {
           $ret = Category::create($input);
           if ($ret)
           {
            return redirect('admin/category');
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

    //put admin/category/[category]更新分类
    public function update($cate_id)
    {
        $input = Input::except('_token','_method');
        $ret = Category::where('cate_id',$cate_id)->update($input);
        if ($ret)
        {
            return redirect('admin/category');
        }
        else
        {
            return back()->with('errors','分类信息更新失败,请稍后重试');
        }
    }
    //get admin/category/{category}/edit编辑分类
    public function edit($cate_id)
    {
        $field = Category::find($cate_id);
        $data = Category::where('cate_pid',0)->get();
        return view('admin.category.edit',compact('field','data'));
    }
    //get admin/category/[category]
    public function show()
    {

    }
    //delete admin/category/[category] 删除分类
    public function destroy($cate_id)
    {
        $ret = Category::where('cate_id',$cate_id)->delete();
        
        Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
        if ($ret)
        {
            $data = [
                'status' =>0,
                'msg' => '分类删除成功',
            ];
        }
        else
        {
            $data = [
                'status' =>1,
                'msg' => '分类删除失败,请稍后重试',
            ];
        }
        return $data;
    }
    
}

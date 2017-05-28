<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends CommonController
{
    //get admin/config 全部配置项列表config
    public function index()
    {
    	$data = Config::orderby('conf_order','asc')->get();
        foreach ($data as $k=>$v){
            switch ($v->field_type){
                case 'input':
                    $data[$k]->_html = '<input type="text" class="lg" name="conf_content[]" value="'.$v->conf_content.'">';
                    break;
                case 'textarea':
                    $data[$k]->_html = '<textarea type="text" class="lg" name="conf_content[]">'.$v->conf_content.'</textarea>';
                    break;
                case 'radio':
                    //1|开启,0|关闭
                    $arr = explode(',',$v->field_value);
                    $str = '';
                    foreach($arr as $m=>$n){
                        //1|开启
                        $r = explode('|',$n);
                        $c = $v->conf_content==$r[0]?' checked ':'';
                        $str .= '<input type="radio" name="conf_content[]" value="'.$r[0].'"'.$c.'>'.$r[1].'　';
                    }
                    $data[$k]->_html = $str;
                    break;
            }


        }
    	return view('admin.config.index',compact('data'));
    }
    //配置文件修改
    public function changeContent()
    {
        $input = Input::all();
        foreach($input['conf_id'] as $k => $v)
        {
            Config::where('conf_id',$v)->update(['conf_content'=>$input['conf_content'][$k]]);
        }
        $this->putFile();
        return back()->with('errors','配置更新成功');
    }
    //将配置写入文件
    public function putFile()
    {
        $config = Config::pluck('conf_content','conf_name')->all();
        $path = base_path().'\config\web.php';
        $str = '<?php return '.var_export($config,true).';';
        file_put_contents($path,$str);
    }

    public function changeorder()
    {
        $input = Input::all();
        $configs = Config::find($input['conf_id']);
        $configs->conf_order = $input['conf_order'];
        $ret = $configs->update();
        if ($ret)
        {
            $data = [
                'status' => 0,
                'msg' => '配置项排序更新成功',
            ];
        }
        else
        {
            $data = [
                'status' => 1,
                'msg' => '配置项排序更新失败，请稍后重试',
            ];
        }
        return $data;
    }
    //post admin/config/create 添加配置项
    public function create()
    {
        return view('admin.config.add',compact('data'));
    }
    //post admin/config 添加配置项提交
    public function store()
    {
        $input = Input::except('_token');
        //dd($input);
        //验证的规则
        $rules = [
            'conf_name'=>'required',
            'conf_title'=>'required',
        ];
        //输出错误信息
        $message = [
            'conf_name.required' => '配置项名称不能为空',
            'conf_title.required' => '配置项标题不能为空',
            ];
        //输入，规则，自定义信息
        $validator = Validator::make($input,$rules,$message);

        if ($validator->passes())
        {
           $ret = Config::create($input);
           if ($ret)
           {
            return redirect('admin/config');
           }
           else
           {
                return back()->with('errors','配置项填充失败,请稍后重试');
           }
        }
        else
        {
            return back()->withErrors($validator);
        }
        
    }
    //put admin/config/[config]更新配置项
    public function update($conf_id)
    {
        $input = Input::except('_token','_method');
        $ret = Config::where('conf_id',$conf_id)->update($input);
        if ($ret)
        {
            $this->putFile();
            return redirect('admin/config');
        }
        else
        {
            return back()->with('errors','配置项更新失败,请稍后重试');
        }
    }
    //get admin/config/{config}/edit编辑配置项
    public function edit($conf_id)
    {
        $field = Config::find($conf_id);
        return view('admin.config.edit',compact('field'));
    }
    //delete admin/config/[config] 删除配置项
    public function destroy($conf_id)
    {
        $ret = Config::where('conf_id',$conf_id)->delete();
        
        if ($ret)
        {
            $this->putFile();
            $data = [
                'status' =>0,
                'msg' => '配置项删除成功',
            ];
        }
        else
        {
            $data = [
                'status' =>1,
                'msg' => '配置项删除失败,请稍后重试',
            ];
        }
        return $data;
    }
    public function show()
    {

    }
}

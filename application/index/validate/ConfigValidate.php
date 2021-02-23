<?php
namespace app\index\validate;
use think\Validate;

class ConfigValidate extends Validate{

    protected $regex = [
        'name' => '/^[a-zA-z_]{1,}$/i',
    ];

    protected $rule = array(
        'name'          => 'require|regex:name',
        'title'         => 'require',
        'sort'          => 'number',
        'type'          => 'require',
    );
    
    protected $message = array(
        'name.require'  => '参数名不能为空',
        'name.regex'    => '请输入正确参数名(字母或_)',
        'title.require' => '标题不能为空',
        'sort.number'   => '排序请使用数字',
        'type.require'  => '请填写配置类型',
    );
   

    // install 新增时验证场景定义
    public function sceneInstall(){
        
        return $this->only(array('name','title','sort','type'));
    }

    // update 修改时验证场景定义
    public function sceneUpdate(){
        
        return $this->only(array('name','title','sort','type'));
    }
}
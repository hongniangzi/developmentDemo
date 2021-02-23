<?php
namespace app\index\validate;
use think\Validate;

class RuleValidate extends Validate{

    protected $rule = array(
        'title'       => 'require',
        'route'       => 'require',
    );
    
    protected $message = array(
        'title.require'   => '标题不能为空',
        'route.require'   => '路由链接不想填写 可填"null"值',
        
    );
   

    // install 新增时验证场景定义
    public function sceneInstall(){
        
        return $this->only(array('title','route'));
    }
}
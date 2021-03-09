<?php
namespace app\admin\validate;
use think\Validate;

class GroupValidate extends Validate{

    protected $rule = array(
        'title'       => 'require',
    );
    
    protected $message = array(
        'title.require'   => '分组名称不能为空',
    );
   

    // install 新增时验证场景定义
    public function sceneInstall(){
        
        return $this->only(array('title'));
    }
}
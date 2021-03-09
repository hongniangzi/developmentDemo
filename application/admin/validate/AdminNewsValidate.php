<?php
namespace app\admin\validate;
use think\Validate;

class AdminNewsValidate extends Validate{

    protected $regex = [];

    protected $rule = array(
        'id'            => 'require|number',
        'column_id'     => 'require|number',
        'title'         => 'require',
        'cover_img'     => 'require|number',
        'content'       => 'require',
    );
    
    protected $message = array(
        'column_id.require' => '栏目Id参数错误 #1',
        'column_id.require' => '栏目Id参数错误 #2',
        'id.require'        => 'Id参数错误 #1',
        'id.number'         => 'Id参数错误 #2',

        'title.require'     => '标题不能为空',
        'cover_img.require' => '请上传封面图',
        'cover_img.number'  => '封面图参数错误',
        'content.require'   => '请输入必要的文本内容',
    );
   

    // add 新增时验证场景定义
    public function sceneAdd(){
        
        return $this->only(array('title','content'));
    }

    // update 修改时验证场景定义
    public function sceneUpdate(){
        
        return $this->only(array('id','column_id','title','cover_img','content'));
    }
}
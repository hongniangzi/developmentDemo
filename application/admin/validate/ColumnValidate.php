<?php
namespace app\admin\validate;
use think\Validate;

class ColumnValidate extends Validate{
    protected $regex = [];

    protected $rule = array(
        'id'            => 'require|number',
        'title'         => 'require',
        'rout_name'     => 'require',
        'sort'          => 'number',
        'cover_width'   => 'require|number',
        'cover_height'  => 'require|number',
        'cover_img_tips'=> 'require',
        'small_icon'    => 'number',
        'big_icon'      => 'number',
    );
    
    protected $message = array(
        'id.require'            => 'Id丢失',
        'title.require'         => '栏目名称不能为空',         
        'id.number'             => '请使用正确的Id值',
        'rout_name.require'     => '路由标识不能为空',
        'sort.number'           => '排序项请输入纯数字',
        'cover_width.require'   => '请注意填写封面图宽度',
        'cover_width.number'    => '请注意封面图宽度必须为数字',
        'cover_height.require'  => '请注意填写封面图高度',
        'cover_height.number'   => '请注意封面图高度必须为数字',
        'cover_img_tips.require'=> '请注意填写封面图文字提示',
        'small_icon.number'     => '小图标参数错误',
        'big_icon.number'       => '栏目背景图参数错误',
    );
   

    // add 新增时验证场景定义
    public function sceneAdd(){
        
        return $this->only(array('title','rout_name','model_select','sort',
        'cover_width','cover_height','cover_img_tips','small_icon','big_icon'));
    }

    // edit 修改时验证场景定义
    public function sceneEdit(){
        
        return $this->only(array('id','title','rout_name','model_select','sort',
        'cover_width','cover_height','cover_img_tips','small_icon','big_icon'));
    }
}

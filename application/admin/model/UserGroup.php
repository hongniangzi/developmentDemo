<?php
namespace app\admin\model;
use think\Model;

class UserGroup extends Model{


    // 自动完成, 只在新增的时候有效
    protected $insert = array('create_time');

    protected $update = array('update_time');

    //自动完成 格式set字段Attr
    protected function setCreateTimeAttr(){
        return time();
    }
    protected function setUpdateTimeAttr(){
        return time();
    }

    // 新增
    public function addGroup($data){
        if(!empty($data['id'])){
            // 重新修改
            $res = $this->isUpdate(true)->allowField(true)->save($data);
            return $res ? $this->id : false;
        }else{
            // 新增
            $res = $this->data($data)->allowField(true)->save();
            return $res ? $this->id : false;
        }
        
    }

    // 获取分组信息
    public function getGroup($map=array(),$field=true,$order='id desc',$limit=''){
        
        return $this->field($field)->where($map)->order($order)->limit($limit)->select()->toArray();
    }

     // 删除分组
     public function deleteGroup($data){
        return $this->where($data)->delete();
    }
    
}
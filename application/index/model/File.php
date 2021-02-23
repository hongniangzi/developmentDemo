<?php
namespace app\index\model;
use think\Model;

class File extends Model{
    protected $auto = array('create_time');

    //自动完成 格式set字段Attr
    public function setCreateTimeAttr(){
        return time();
    }

    // 新增
    public function addFile($data){
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

    // 获取Log日志信息
    public function getFile($map=array(),$field=true,$order='',$limit=''){
        
        $order = 'id desc';
        return $this->field($field)->where($map)->order($order)->limit($limit)->select()->toArray();
    }


}
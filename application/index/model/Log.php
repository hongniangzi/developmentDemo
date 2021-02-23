<?php
namespace app\index\model;
use think\Model;
use think\Validate;

class Log extends Model{
    protected $auto = array('create_time','ip');

    //自动完成 格式set字段Attr
    public function setCreateTimeAttr(){
        return time();
    }
    public function setIpAttr(){
        return get_real_ip();
    }

    // 新增
    public function addLog($data){
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
    public function getLog($map=array(),$field=true,$order='',$limit=''){
        
        $order = 'id desc';
        return $this->field($field)->where($map)->order($order)->limit($limit)->select()->toArray();
    }

    // 分页获取
    public function getPage($map=array(),$field=true,$order='',$p=1,$num=10){
 
        $order = 'id desc';
        return $this->field($field)->where($map)->order($order)->page($p,$num)->select()->toArray();
    }


}
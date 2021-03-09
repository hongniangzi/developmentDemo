<?php
namespace app\admin\model;
use think\Model;
use think\Validate;

class User extends Model{
    protected $auto = array('last_login','ip');

    // 自动完成, 只在新增的时候有效
    protected $insert = array('create_time','pwd');


    //自动完成 格式set字段Attr
    protected function setCreateTimeAttr(){
        return time();
    }
    protected function setLastLoginAttr(){
        return time();
    }
    protected function setPwdAttr($pwd){
        return md5(base64_encode($pwd));
    }
    protected function setIpAttr(){
        return get_real_ip();
    }

    // 新增
    public function addUser($data){
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

    // 获取用户信息
    public function getUser($map=array(),$field=true,$order='id desc',$limit=''){
        
        return $this->field($field)->where($map)->order($order)->limit($limit)->select()->toArray();
    }
    
    // 删除用户
    public function deleteUser($data){
        return $this->where($data)->delete();
    }

}
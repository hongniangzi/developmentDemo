<?php
namespace app\index\model;
use think\Model;

class Rule extends Model{


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
    public function addRule($data){
        if(!empty($data['id'])){
            // 重新修改
            $res = $this->isUpdate(true)->allowField(true)->save($data);
            
            if($res){
                $this->cacheRule();
                return  $this->id;
            }else{
                return false;
            }

        }else{
            // 新增
            $res = $this->data($data)->allowField(true)->save();
    
            if($res){
                $this->cacheRule();
                return  $this->id;
            }else{
                return false;
            }
        }
        
    }

    // 获取路由权限规则
    public function getRule($map=array(),$field=true,$order='level asc, id asc',$limit=''){
        
        return $this->field($field)->where($map)->order($order)->limit($limit)->select()->toArray();
    }

    // 删除路由权限规则
    public function deleteRule($data){
        return $this->where($data)->delete();
    }

    // 更新权限路由缓存
    protected function cacheRule(){
        $rule = $this->getRule();
        cache('pgy_rule',$rule,6*60*24); // 权限路由信息储存24小时
    }
    
}
<?php
namespace app\index\model;
use think\Model;

class Config extends Model{

    // 自动完成, 只在新增的时候有效
    protected $insert = array('create_time');


    //自动完成 格式set字段Attr
    protected function setCreateTimeAttr(){
        return time();
    }
    

    // 新增
    public function addSystemConfig($data){
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
    
    /**
     * 批量新增修改
     * @param   array   $data   id+需更新的值
     * @return  array           所影响的所有数据   
     */
    public function allAddSystemConfig($data){
        if(!empty($data)){
            return  $this->saveAll($data)->toArray();

        }
    }

    // 获取系统配置信息
    public function getSystemConfig($map=array(),$field=true,$order='id desc',$limit=''){
        
        return $this->field($field)->where($map)->order($order)->limit($limit)->select()->toArray();
    }

    // 分页获取
    public function getPage($map=array(),$field=true,$order='id desc',$p=1,$num=10){
 
        return $this->field($field)->where($map)->order($order)->page($p,$num)->select()->toArray();
    }
    
    // 删除配置
    public function deleteSystemConfig($data){
        return $this->where($data)->delete();
    }

}
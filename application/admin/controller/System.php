<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://0731pgy.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: wanglun <573075930@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;
use app\admin\validate\ConfigValidate;
use app\admin\model\Config as SystemConfig;
use think\Page;

/**
 * 平台管理端系统配置类
 */
class System extends Home{
    
    public function initialize(){
        // 登录态检测
        $this->is_login();
        
        // 权限检测
        $rule = $this->checkUrl();
        if($rule){
            echo json_encode($rule);die;
        }
    }

    /**
     * 参数配置列表
     * @param   $data['p]       页码
     * @return  $list,$page     数据列表,翻页
     */
    public function configValue(){
        
        $data = $this->param();
        $SystemConfig = new SystemConfig();

        $data['p'] = !empty($data['p'])? $data['p']:1;
        $listRows = 20;
        if(!empty($data['group'])){
            $where[] = array('group','=',$data['group']);
            $param = "/group/".$data['group'];
        }else{
            $where = '';
            $param = '';
        }
        if(!empty($data['name'])){
            $param .= "/name/".$data['name'];
            $where[] = array('name','like',"%".$data['name']."%");
        }

        $list = $SystemConfig->getPage($where,'','',$data['p'],$listRows);
        $total = $SystemConfig->where($where)->count();
        // 1.当前页数据,2.路由,3.总记录数,4.每页记录数,5.页码
        $page = new Page($list,$this->url.$param,$total,$listRows,$data['p']);

        $this->assign('group_id',!empty($data['group'])?$data['group']:'');
        $this->assign('list',$list);
        $this->assign('page',$page);
        return $this->fetch($this->url);
    }

    /**
     * 新增/编辑参数配置
     * @param   string  $data['id']     参数配置ID
     * @return  array|array             新增/编辑结果|编辑详细
     */
    public function addConfigValue(){

        $data = $this->param();
        $SystemConfig = new SystemConfig();

        if($this->isAjax()){

            $result['Msg'] = 0;
            $Configvalidate = new ConfigValidate();
            $res = $SystemConfig->getSystemConfig(array('name'=>$data['name']),'id');
            if(empty($data['id'])){
                $type = '新增';
                $scene = 'install';
                if(!empty($res[0])){
                    $result['Msg'] = '此参数名已存在';
                    return json($result);
                }
            }else{
                if($res[0]['id']!=$data['id']){
                    $result['Msg'] = '此参数名已存在';
                    return json($result);
                }
                $type = '编辑';
                $scene = 'update';
            }
            // validate验证
            if(!$Configvalidate->scene($scene)->check($data)){
                $result['Msg'] = $Configvalidate->getError();
            }else{
               
                $Nickname = session('Nickname');
                $where = $data;
                $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户{$type}一个配置【".$data['title']."】");
                $result = $this->addUpdate($SystemConfig,'addSystemConfig', $logArtion ,$where,$type);
            }
            return json($result);

        }else{

            if(!empty($data['id'])){
                $return = $SystemConfig->getSystemConfig(array('id'=>$data['id']));
                $info = $return[0];
            }else{
                $info = array();
            }
            $this->assign('info',$info);
            return $this->fetch($this->url);
        }
    }

    /**
     * 删除系统配置
     * @param   int     $id     系统配置ID
     * @return  array           删除结果
     */
    public function delConfigValue(){

        $data = $this->param();
        $SystemConfig = new SystemConfig();
        $result['status'] = 0;
        if(empty($data['id'])){
            $result['Msg'] = '配置ID丢失';
            return json($result);
        }

        $Nickname = session('Nickname');
        $where = array('id' => $data['id']);
        $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户删除一个配置【ID: ".$data['id']."】");
        $result = $this->addUpdate($SystemConfig,'deleteSystemConfig', $logArtion ,$where,'删除');

        if($result['status']==1){
            $this->success($result['Msg'],'/system/configValue');
        }else{
            $this->error($result['Msg']);
        }
    }

    /**
     * 平台设置列表+更新动作
     * @param   array   $data           配置的ID以及对应的数值 (更新动作)
     * @param   int     $data['group']  平台设置分类显示的分类数值 (列表)
     * @return  array                   配置更新的结果
     * @return  array   $list           列表数据
     */
    public function platformSettings(){

        $data = $this->param();
        $SystemConfig = new SystemConfig();

        if($this->isAjax()){
            unset($data['_ajax']);
            foreach($data as $key =>$val){
                $where[] = array('id'=>(int) explode('|',$key)[1],'value'=>$val);
            }
            $Nickname = session('Nickname');
            $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户更新平台设置");
            $result = $this->addUpdate($SystemConfig,'allAddSystemConfig', $logArtion ,$where,'更新');
            return json($result);

        }else{
            $data['group'] = empty($data['group'])?1:$data['group'];
            $list = $SystemConfig->getSystemConfig(array('group'=>$data['group']),true,'sort asc');
            
            $this->assign('group_id',$data['group']);
            $this->assign('list',$list);
            return  $this->fetch($this->url);
        }
    }

    /**
     * 上传图片
     * 上传图片的过渡函数
     * 
     */
    public function uploadImg(){
        return (new \app\admin\controller\File())->imgUpload();

    }
}
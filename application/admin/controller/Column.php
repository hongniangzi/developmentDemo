<?php
namespace app\admin\controller;
use app\admin\validate\ColumnValidate as ColumnValidate;
use app\admin\model\Column as ColumnModel;
use think\Page;

class Column extends Home{

    public function initialize(){
        // 登录态检测
        $this->is_login();
        
        // 权限检测
        $rule = $this->checkUrl();
        $this->assign('url',$this->url);
        
        if($rule){
            echo json_encode($rule);die;
        }
    }

    /**
     * 栏目列表管理
     */
    public function columnList(){

        if($this->isAjax()){
            $column = (new ColumnModel)->getColumn('',true,'id asc');
            $result['status'] = 0;
            if($column){
                $result['status'] = 1;
                $result['Msg'] = array('main'=>1,'name'=>C('WEB_SITE_TITLE'),'children'=>recursiveColumnList($column));
            }else{
                $result['Msg'] = '您暂未设置网站栏目';
            }
            return json($result);
        }else{
            return $this->fetch($this->url);
        }
    }  
    
    /**
     * 新增栏目
     * @param   array   $data   数据新增集
     * @return  array           新增结果
     */
    public function columnAdd(){
        $data = $this->param();
        if($this->isAjax()){
            $result['status'] = 0;
            $validate = new ColumnValidate();
            if(!$validate->scene('add')->check($data)){
                $result['Msg'] = $validate->getError();
            }else{

                // 新增栏目
                $Nickname = session('Nickname');
                $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户新增栏目【{$data['title']}】");
                $result = $this->addUpdate(new ColumnModel(),'addColumn', $logArtion ,$data,$type='新增');
                
            }
            return json($result);
        }else{
            $this->assign('pid',!empty($data['pid'])?$data['pid']:0);
            return $this->fetch($this->url);
        }
    }

    /**
     * 编辑栏目
     * @param   array   $data   数据编辑集
     * @return  array           编辑处理结果
     */
    public function columnEdit(){
        $ColumnModel = new ColumnModel();
        $data = $this->param();

        if($this->isAjax()){
            $result['status'] = 0;
            $validate = new ColumnValidate();
            if(!$validate->scene('edit')->check($data)){
                $result['Msg'] = $validate->getError();
            }else{
                // 编辑栏目
                $Nickname = session('Nickname');
                $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户编辑栏目【{$data['title']}】");
                $result = $this->addUpdate($ColumnModel,'addColumn', $logArtion ,$data,$type='编辑');
            }
            return json($result);
        }else{
            if(empty($data['id'])){
                $this->error('ID参数错误');
            }
            $info = $ColumnModel->getColumn(array('id'=>$data['id']));
            if(empty($info)){
                $this->error('未找到该栏目');
            }else{
               $this->assign('info',$info[0]);
            }
            return $this->fetch($this->url);
        }
    }

    /**
     * 栏目状态设置
     * @param   int     $data['id']     栏目ID
     * @param   int     $data['status'] 栏目状态
     * @return  array                    状态处理结果
     */
    public function columnStatus(){
        $data = $this->param();
        $result['status'] = 0;
        if(!array_key_exists('status',$data) || empty($data['id'])){
            $result['Msg'] = '参数错误';
            return json($result);
        }
       
        switch($data['status']){
            case "1":
                $hint = '启用';
                break;
            case "0":
                $hint = '禁用';
                break;
            default:
                $hint = '';
                $result['Msg'] = '状态参数错误';
                return json($result);
        }

        $save['id'] = $data['id'];
        $save['status'] = $data['status'];
        if((new ColumnModel)->addColumn($save)){
            $result['status'] = 1;
            $result['Msg'] = "{$hint}成功";
        }else{
            $result['Msg'] = "{$hint}失败";
        }
        return json($result);
    }
 
    
}
<?php
namespace app\index\controller;
use app\index\model\Rule as Rules;
use app\index\model\UserGroup;
use app\index\validate\RuleValidate;
use app\index\validate\GroupValidate;

/**
 * 管理员权限类
 */
class Rule extends Home{
    // __construct
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
    

    // 用户权限管理
    // public function authority(){
    //     var_dump('这是用户权限管理');
        
    //     return $this->fetch('Rule/authority');
    // }

    // 权限分组列表
    public function authorityGroupList(){
        
        // 列表
        $group = (new UserGroup())->getGroup();
        $this->assign('list',$group);
        return $this->fetch('Rule/authorityGroupList');
        
    }

    // 权限分组(新增)
    public function authorityGroupAdd(){
        
        if($this->isPost()){
            $data = $this->param();
            $validate = new GroupValidate();
            $result['status'] = 0;

            // 验证码数据
            if(!$validate->scene('install')->check($data)){
                $result['Msg'] = $validate->getError();

            }else{
                // 新增分组
                $Nickname = session('Nickname');
                $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户新增权限分组【{$data['title']}】");
                $result = $this->addUpdate(new UserGroup(),'addGroup', $logArtion ,$data,$type='新增');
            }
            return json($result);

        }else{
            
            return $this->fetch('Rule/authorityGroupAdd');
        }
       
    }

    // 权限分组(修改)
    public function authorityGroupEdit(){
        
        $data = $this->param();
        $validate = new GroupValidate();
        $result['Msg'] = 0;

        if($this->isPost()){
            // 验证码数据
            if(!$validate->scene('install')->check($data)){
                $result['Msg'] = $validate->getError();

            }else{
                $Nickname = session('Nickname');
                $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户修改权限分组【{$data['title']}】");
                $result = $this->addUpdate(new UserGroup(),'addGroup', $logArtion ,$data,$type='修改');
            }
            return json($result);

        }else{
            
            $info = (new UserGroup())->where(array('id'=>$data['id']))->select();
            $this->assign('info',$info[0]);
            return $this->fetch('Rule/authorityGroupEdit');
        }
    }

    // 权限分组(删除)
    public function authorityGroupDlete(){
        $data= $this->param();

        if(isset($data['id'])){
            // 删除规则
            $Nickname = session('Nickname');
            $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户删除权限分组【ID:{$data['id']}】");
            $result = $this->addUpdate(new UserGroup(),'deleteGroup', $logArtion ,$data,$type='删除');
            
            if($result){
                $this->error($result['Msg']);
            }else{
                $this->success($result['Msg']);
            }
        }else{
            $this->error('用户ID丢失!');
        }
    }
    

    // 路由规则列表
    public function authorityList(){

        $data = $this->param();
        $pid = isset($data['pid'])?$data['pid']:0;

        $rule = (new Rules())->getRule(array('pid'=>$pid));

        $this->assign('list',$rule);
        $this->assign('pid',$pid);
        return $this->fetch('Rule/authorityList');
    }

    // 路由在规则管理(新增)
    public function setAuthority(){
        
        if($this->isPost()){
            $data = $this->param();
            $validate = new RuleValidate();
            $Rules = new Rules();
            $result['status'] = 0;

            // 验证码数据
            if(!$validate->scene('install')->check($data)){
                $result['Msg'] = $validate->getError();

            }else{
                // 新增规则
                $Nickname = session('Nickname');
                $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户新增权限路由规则【{$data['title']}】");
                $result = $this->addUpdate($Rules,'addRule', $logArtion ,$data,$type='新增');

                // 更新规则缓存
                $rule = $Rules->getRule();
                cache(PGYRULE,$rule,6*60*24); // 权限路由信息储存24小时
            }
            return json($result);
            

        }else{
        
            $data = $this->param();
            $this->assign('pid',$data['pid']);
            return $this->fetch('Rule/setAuthority');
        }
    }

    // 路由在规则管理(编辑)
    public function editAuthority(){

        if($this->isPost()){

            $data = $this->param();
            $validate = new RuleValidate();
            $Rules = new Rules();
            $result['status'] = 0;

            // 验证码数据
            if(!$validate->scene('install')->check($data)){
                $result['Msg'] = $validate->getError();

            }else{
                // 新增规则
                $Nickname = session('Nickname');
                $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户编辑权限路由规则【{$data['title']}】");
                $result = $this->addUpdate($Rules,'addRule', $logArtion ,$data,$type='编辑');

                // 更新规则缓存
                $rule = $Rules->getRule();
                cache(PGYRULE,$rule,6*60*24); // 权限路由信息储存24小时
            }
            return json($result);
            
        }else{ 

            $data = $this->param();
            $info = (new Rules)->getRule(array('id'=>$data['id']));
            $this->assign('info',$info[0]);
            return $this->fetch('Rule/editAuthority');
        }
    }

    // 路由在规则管理(删除)
    public function AuthorityDlete(){
        $data= $this->param();

        if(isset($data['id'])){
            $Rules = new Rules();
            // 删除规则
            $Nickname = session('Nickname');
            $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户删除权限路由规则【ID:{$data['id']}】");
            $result = $this->addUpdate($Rules,'deleteRule', $logArtion ,$data,$type='删除');
            
            // 更新规则缓存
            $rule = $Rules->getRule();
            cache(PGYRULE,$rule,6*60*24); // 权限路由信息储存24小时

            if($result){
                $this->error($result['Msg']);
            }else{
                $this->success($result['Msg']);
            }
        }
    }

    // 用户访问授权设置
    public function accessAuthority(){
        $data= $this->param();

        if($this->isPost()){
    
            
            $result['status'] = 0;
            if(empty($data['id'])){
                $result['Msg']='用户ID丢失!';
                return json($result);
            }
            
            $rule ='';
            foreach($data['rule'] as $key =>$val){
                $rule .= $val.',';
            }    
            
            $Nickname = session('Nickname');
            $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}设置用户组访问授权【ID:{$data['id']}】");
            $result = $this->addUpdate(new UserGroup(),'addGroup', $logArtion ,array('id'=>$data['id'],'rule'=>substr($rule,0,-1)),$type='设置');

            return json($result);
        }else{

            $user_group = (new UserGroup)->getGroup(array('id'=>$data['id'],'status'=>1));
            if(!empty($user_group[0])){
                // 路由规则信息
                $rule = (new Rules())->getRule(array('status'=>1));

                $this->assign('rule',indexRecursiveRule($rule));
                $this->assign('user_group',$user_group[0]);
            }else{
                $this->error('该分组被禁用或为不存在分组');
            }
            return $this->fetch('rule/accessAuthority');
        }
    }

} 
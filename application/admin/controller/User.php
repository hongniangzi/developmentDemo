<?php
namespace app\admin\controller;
use app\admin\model\User as Users;
use app\admin\model\UserGroup;
use app\admin\model\Log;
use app\admin\validate\UserValidate;
use \think\Page;

/**
 * 管理员动作类
 */
class User extends Home{
    public function initialize(){
        // 登录态检测
        $this->is_login();
        
        // 权限检测
        $rule = $this->checkUrl();
        if($rule){
            echo json_encode($rule);die;
        }
    }

    // 退出登录
    public function logOut(){
        session('Nickname',null);
        $this->redirect('/login/login');
    }

    // 平台管理中心首页
    public function center(){
        return $this->fetch('User/center');
    }
    
    // 新增管理用户
    public function addUser(){

        if($this->isPost()){
            $data = $this->param();
            $User = new Users();
            $validate = new UserValidate();
            $result['status'] = 0; 

            if($data['password']!=$data['password_confirm'] || empty($data['password'])){
                $result['Msg'] = "两次密码不一致";
                return json($result);
            }

            $where = array('username'=>$data['username'],'pwd'=>$data['password'],'phone'=>$data['phone'],'email'=>$data['email']);
            if (!$validate->scene('install')->check($where)) {
                $result['Msg'] = $validate->getError();
            }else{
                $uname = $User->getUser(array('username'=>$data['username']),'username');
                if(!empty($uname[0]['username'])){
                    $result['Msg'] ="{$data['username']}已存在";
                }else{

                    // 新增管理用户
                    $Nickname = session('Nickname');
                    $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}新增管理用户{$data['username']}");
                    $result = $this->addUpdate( $User,'addUser', $logArtion ,$where,$type='新增');

                }
            }
            return json($result);

        }else{
            return $this->fetch('User/addUser');
        }
        
    }

    // 用户列表
    public function listUser(){
        
        // 用户列表
        $list = (new Users())->getUser();
        $this->assign('list',$list);
        return $this->fetch('User/listUser');
    }

    // 用户编辑
    public function editUser(){
       
        $data = $this->param();
        if($this->isPost()){

            $validate = new UserValidate();
            $result['status'] = 0;

            if(empty($data['id'])){
                $result['Msg'] = "用户ID丢失!";
                return json($result);
            }elseif($data['id']==1 && $data['status']==0){
                $result['Msg']='admin最高权限管理者不允许被禁用!';
                return json($result);
            }
            // 验证码数据
            if(!$validate->scene('update')->check($data)){
                $result['Msg'] = $validate->getError();

            }else{
                // 编辑用户
                $Nickname = session('Nickname');
                $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}修改管理用户信息【{$data['username']}】");
                $result = $this->addUpdate(new Users(),'addUser', $logArtion ,$data,$type='修改');
            }
            return json($result);

        }else{
            // var_dump('这是编辑用户管理');

            $info = (new Users())->getUser(array('id'=>$data['id']));
            $this->assign('info',$info[0]);
            return $this->fetch('User/editUser');
        }
    }

    // 修改用户密码
    public function editUserPwd(){
        $data = $this->param();

        if($this->isPost()){
            if($data['password']==$data['password_confirm'] && !empty($data['password'])){
                // 验证码数据
                $validate = new UserValidate();
                if(!$res = $validate->scene('updatepwd')->check(array('pwd'=>$data['password']))){
                    $result['Msg'] = $validate->getError();

                }else{

                    $Nickname = session('Nickname');
                    $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}修改管理用户密码【ID:{$data['id']}】");
                    $result = $this->addUpdate(new Users(),'addUser', $logArtion ,array('id'=>$data['id'],'pwd'=>$data['password']),$type='修改');
                }

            }else{
                $result['status'] = 0;
                $result['Msg'] = "两次密码不一致!";
            }
            return json($result);
        }
    }
    
    // 删除用户
    public function dleteUser(){
        $data= $this->param();

        if(isset($data['id'])){
            // 删除用户
            $Nickname = session('Nickname');
            $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}用户删除子管理用户【ID:{$data['id']}】");
            $result = $this->addUpdate(new Users(),'deleteUser', $logArtion ,$data,$type='删除');
            
            if($result){
                $this->error($result['Msg']);
            }else{
                $this->success($result['Msg']);
            }
        }else{
            $this->error('用户ID丢失!');
        }
    }

    // 用户授权分组
    public function authorizationUser(){
        $data = $this->param();

        if($this->isPost()){
           
            $result['status'] = 0;
            if(empty($data['id'])){
                $result['Msg']='用户ID丢失!';
                return json($result);
            }elseif($data['id']==1){
                $result['Msg']='admin最高权限管理者不允许修改!';
                return json($result);
            }
            $group ='';
            foreach($data['group'] as $key =>$val){
                $group .= $val.',';
            }    
            
            $Nickname = session('Nickname');
            $logArtion = array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"{$Nickname['username']}设置管理用户授权分组【ID:{$data['id']}】");
            $result = $this->addUpdate(new Users(),'addUser', $logArtion ,array('id'=>$data['id'],'group'=>substr($group,0,-1)),$type='设置');
           
            // 刷新登录态session
            if($Nickname['id']==$data['id']){
                $where = array('id'=>$data['id']);
                $u = (new Users())->getUser($where);
                $Nickname = $u[0];
                unset($Nickname['pwd']);
                session('Nickname',$Nickname);
            }
            
            return json($result);
        }else{
            // var_dump('这是用户分组授权页面');

            $user = (new Users())->getUser(array('id'=>$data['id'],'status'=>1),'id,username,group');
            if(!empty($user[0])){
                // 分组列表值
                $group = (new UserGroup())->getGroup();
                $this->assign('group',$group);
                $this->assign('user',$user[0]);
            }else{
                $this->error('该用户被禁用或为不存在用户');

            }

            return $this->fetch("User/authorizationUser");

        }
        
    }

    // 用户行为
    public function log(){
        $data = $this->param();
        $Log = new Log();
        $data['p'] = !empty($data['p'])? $data['p']:1;
        $listRows = 20;

        $list = $Log->getPage('','','id desc',$data['p'],$listRows);
        $total = $Log->count();
        // 1.当前页数据,2.路由,3.总记录数,4.每页记录数,5.页码
        $page = new Page($list,$this->url,$total,$listRows,$data['p']);
        
        // var_dump($total);
        $this->assign('list',$list);
        $this->assign('page',$page);
        return $this->fetch($this->url);

    }
}
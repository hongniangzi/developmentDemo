<?php
namespace app\admin\controller;
use app\admin\model\User as Users;
use app\admin\validate\UserValidate;
use think\Db;

/**
 * 管理员登录类
 * 
 */
class Login extends Home{

    /**
     * 管理者用户登录
     * 
     */
    public function login(){
        $Nickname_session = session('Nickname');

        if($this->isPost()){
            $data = $this->param();
            $User = new Users();
            $validate = new UserValidate();
            $result['status'] = 0;
            
            if($Nickname_session){$result['Msg']='请先退出后登录'; return json($result);}
            if(!checkVerify($data['code'])){$result['Msg']='验证码不正确'; return json($result);}

            $where = array('username'=>$data['username'],'status'=>1); 
            if ($validate->scene('login')->check($where)) {// 验证数据正确性
                $u = (new Users())->getUser($where);
                if(empty($u)){
                    $result['Msg'] = '没有此用户或用户已被禁用!';
                    return json($result);
                }
                
                // 验证用户密码
                if($this->isVerific($data['password'],$u[0]['pwd'])){
                    // 后台操作日志
                    logArtion(array('fun'=>__CLASS__.'\\'.__FUNCTION__,'action'=>"管理员{$data['username']}登录后台"));
                    // 记录session
                    $Nickname = $u[0];
                    unset($Nickname['pwd']);
                    session('Nickname',$Nickname);
                    $result = array('status'=>1,'Msg'=>'成功登录');

                    // 更新登录IP等信息
                    $this->loginDateUpdate($Nickname['id']);
                }else{
                    $result['Msg'] = '用户名或密码不正确';
                }
            }else{
                $result['Msg'] = $validate->getError();
            }
            
            return json($result);

        }else{

            if($Nickname_session){
                $this->redirect('/user/center');
            }else{
                return $this->fetch('Login/login');
            }
            
        }
        
    }

    /**
     * 验证码输出
     * 
     */
    public function verify(){
        (new \think\verify\Verify())->showImage();
        
    }

    // 验证密码真实性
    protected function isVerific($password='',$pwd){
        $p = isset($password)? md5(base64_encode($password)): '' ;
        return $p===$pwd? true:false;
    }

    // 登录更新IP等信息
    protected function loginDateUpdate($id){
        if($id){
            $where = array('id'=>$id,'login_num'=>array('inc',1));
            (new Users())->addUser($where);

        }
    }

}
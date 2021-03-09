<?php
namespace app\admin\controller; 
use think\Controller;
use think\Request;


class Home extends Controller{

    protected $url;

    public function checkUrl(){
        $url = $this->request->url();
        if($url=='/'){
            // 首页无需检测

        }else{
            // 其他页面需检测
            $u = explode('/',substr($url,1));
            $route = preg_replace(array('/\.html+?/','/(\?.+)|(\?)/'),array('',''),$u[0].'/'.$u[1]);
            $this->url = "/{$route}";
            $this->assign('url',$this->url);
            define('PGYRULE', 'pgy_rule');

            // 管理者权限检测start
            $rule = cache(PGYRULE);
            if(!$rule){
                $rule = (new \app\admin\model\Rule())->getRule();
                cache(PGYRULE,$rule,6*60*24); // 权限路由信息储存24小时
            }
            // 确定是否需要检测($r有值需要检测,没有则不需要检测)
            $r ='';
            foreach($rule as $key =>$val){
                if($route==$val['route']){
                    $r = $val;
                }
            }
            
            if($r){
                $Nickname = session('Nickname');
                $user_group = (new \app\admin\model\UserGroup())->field('id,rule')->whereIn('id',$Nickname['group'])->select()->toArray();
                $groups ='';
                foreach($user_group as $key =>$value){
                    $groups .= $value['rule'].',';
                }
                $groups_str = substr($groups,0,-1);
                // 排除顶级管理员权限受限
                if(empty($groups_str) && $Nickname['id']!=1){
                    if($this->isAjax()){
                        $result = array('status'=>0,'Msg'=>'无权限访问');
                        return $result;
                    }else{
                        $this->error('无访问权限');
                    }
                }elseif($Nickname['id']!=1){
                    // 排除顶级管理员权限受限
                    $group = explode(',',$groups_str);
                    if(!in_array($r['id'],$group)){
                        // 权限不足
                        if($this->isAjax()){
                            $result = array('status'=>0,'Msg'=>'无权限访问');
                            return $result;
                        }else{
                            // return '无权限访问,这不是ajax,直接跳走';
                            // $this->redirect('/user/center');
                            $this->error('无访问权限');
                        }
                        
                    }
                }
            }
            
            // 管理者权限检测end
        }
        
    }

    public function is_login(){
        // 检测用户是否登录状态
        if(!session('Nickname')){
            return $this->redirect('/login/login');
        }
    }

    // 数据新增修改删除
    protected function addUpdate($class,$fun,$logArtion,$data,$type='新增'){
        $result['status'] = 0;

        try{
            $id = $class->$fun($data);
            
        }catch(\Exception $e){
            // 操作失败 记录LOG日志文件
            indexLogFile($e);

            $result['Msg'] = "失败原因可能:{$e->getMessage()}";
            return ($result);
        }
        if(!empty($id)){
            // 记录新增动作
            $Nickname = session('Nickname');
            logArtion($logArtion);

            $result['status'] = 1;
            $result['Msg'] = "{$type}成功√";
        }else{
            $result['Msg'] = "{$type}失败";
        }
        return $result;
    }

    // 递归获取相关联的父级栏目及自身栏目详情
    protected static function getCategoryInfo($id=''){
        if(!$id){
            return false;
        }
        static $category;

        $cate = (new \app\admin\model\Column())->getColumn(array('id'=>$id),true);
        if(!empty($cate)){
            $category[] = $cate[0];
            if($cate[0]['pid']!=0){
                self::getCategoryInfo($cate[0]['pid']);
            }else{
                // 按相反顺序重新排序
                $category = array_reverse($category);
            }
        }
        return $category;
    }

    // 模板位置
    // 输出本栏目column数据以及栏目层级数据
    protected function templateLocation($column_id=''){
        if(!$column_id){
            return $this->error('该栏目未找到相应模块 - '.__CLASS__.'\\'.__FUNCTION__);
        }
        $category = (new \app\admin\model\Column())->getColumn(array('id'=>$column_id));
        
        $this->assign('category',$category[0]);
        $this->assign('cate_location',self::getCategoryInfo($column_id));
    }


    
    protected function method(){
        return $this->request->method();
    }
    protected function param(){
        return $this->request->param();
    }
    protected function get(){
        return $this->request->get();
    }
    protected function post(){
        return $this->request->post();
    }
    protected function file($file){
        return $this->request->file($file);
    }
    protected function isGet(){
        return $this->request->isGet();
    }
    protected function isPost(){
        return $this->request->isPost();
    }
    protected function isAjax(){
        return $this->request->isAjax();
    }

}
<?php
namespace app\index\controller;
use app\admin\model\Column as ColumnModel; 
use think\Controller;
use think\Request;


class Home extends Controller{

    protected $nav;
    protected $url;

    public function initialize(){
        $ColumnModel = new ColumnModel();
        $where_column[] = ['is_nav','eq',1];
        $where_column[] = ['status','eq',1];
        $column = $ColumnModel->getColumn($where_column,true,'id asc');
        $childColumn = recursionGetClildrenColumn($column);
        if($childColumn){
            $childColumn = array_merge(array([
                "title" => '首页',
                "url"   => 'index',
            ]),$childColumn);
            $this->nav = $childColumn;
        }
        
        $u = substr($this->request->url(),1);
        $this->url = preg_replace(array('/\.html+?/','/(\?.+)|(\?)/'),array('',''),$u);
        foreach($this->nav as $key => $val){
            if($this->url=='' && $val['url']=='index'){
                $this->nav[$key]['hov'] = 1;
            }else{
                if($this->url==$val['url']){
                    $this->nav[$key]['hov'] = 1;
                }else{
                    $this->nav[$key]['hov'] = 0;
                }
            }
            
        }
        $this->assign('nav',array_values($this->nav));
    }

    // public function is_login(){
    //     // 检测用户是否登录状态
    //     if(!session('userInfo')){
    //         return $this->redirect('/index/login');
    //     }
    // }

    // 递归获取当前顶级栏目下的第一个子栏目(递归第一个子栏目)
    // protected static function getCategoryInfo($id=''){
    //     if(!$id){
    //         return false;
    //     }
    //     static $category;

    //     $cate = (new ColumnModel())->getColumn(array('pid'=>$id),true,'id asc');
    //     if(!empty($cate)){
    //         foreach($cate as $key =>$value){
    //             if($value['status']==1 && $value['is_nav']==1){
    //                 $category = $value;
    //                 $c = self::getCategoryInfo($value['id']);
    //                 if($c==false){
    //                     return $category;
    //                 }else{
    //                     return self::getCategoryInfo($value['id']);
    //                 }
    //                 break;
    //             }
    //         }
    //         return false;
    //     }else{
    //         return false;
    //     }
    // }
 
    // 递归获取各列表栏目当前位置
    protected static function getCateLocation($id=''){
        if(!$id){
            return false;
        }
        static $category;
        $cate = (new ColumnModel())->getColumn(array('pid'=>$id),true,'id asc');
        foreach($cate as $key =>$value){
            if($value['status']==1 && $value['is_nav']==1){
                $category[] = $value;
                self::getCateLocation($value['id']);
                break;
            }
        }
        return $category;
    }

    // 各栏目模板位置
    // 各栏目数据(最低级category栏目)以及导航位置
    protected function articleTemplateLocation($data=''){
        if(!$data['column_id']){
            return $this->error('该栏目Id参数传输错误');
        }
        $category = (new ColumnModel())->getColumn(array('id'=>$data['column_id']),true);
        if($category[0]['status']==1 && $category[0]['is_nav']==1){
            $cate_location = self::getCateLocation($data['column_id']);
            
            if($cate_location){
                $cate_num = count($cate_location);
                $cate_location>1? $category[0]=$cate_location[$cate_num-1]:'';
            }else{
                $cate_location = $category;
            }
            if($category[0]['status']==1 && $category[0]['is_nav']==1){
                $this->assign('cate_location',$cate_location);
                $this->assign('category',$category[0]);
                $this->url = 'lists_'.$category[0]['rout_name'];
            }else{
                $this->error('页面已关闭 #2');
            }
        }else{
            $this->error('页面已关闭 #1');
        }
        
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
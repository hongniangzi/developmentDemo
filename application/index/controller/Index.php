<?php
namespace app\index\controller;
use app\boss\model\ReleaseBoss;

class Index extends Home{

    protected $category;
    protected $url;

    public function initialize(){
        $this->category = array(
            array(
                "title" => '首页',
                "url"   => 'index',
            ),
            array(
                "title" => '平台介绍',
                "url"   => 'introduction',
            ),
            array(
                "title" => '商务合作',
                "url"   => 'cooperation',
            ),
            array(
                "title" => '关于我们',
                "url"   => 'about',
            ),
            array(
                "title" => '加入我们',
                "url"   => 'join',
            ),
        );
        $u = substr($this->request->url(),1);
        $this->url = preg_replace(array('/\.html+?/','/(\?.+)|(\?)/'),array('',''),$u);
        foreach($this->category as $key => $val){
            if($this->url=='' && $val['url']=='index'){
                $this->category[$key]['hov'] = 1;
            }else{
                if($this->url==$val['url']){
                    $this->category[$key]['hov'] = 1;
                }else{
                    $this->category[$key]['hov'] = 0;
                }
            }
            
        }
    }

    public function index(){
        
        $this->assign('title','首页--测试demo');
        $this->assign('keywords','');
        $this->assign('description','');
        $this->assign('category',$this->category);
        return $this->fetch($this->url);
    }
}
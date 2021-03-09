<?php
namespace app\index\controller;

/**
 * 首页
 */
class Index extends Home{


    public function index(){
        
        $this->assign('title','首页--'.C('WEB_SITE_TITLE'));
        $this->assign('keywords','');
        $this->assign('description','');
        $this->assign('nav',$this->nav);
        return $this->fetch($this->url);
    }
}
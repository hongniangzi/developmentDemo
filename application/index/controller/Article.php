<?php
namespace app\index\controller;

/**
 * 前端其他页面
 */
class Article extends Home{

    public function news(){
        $data = $this->param();
        self::articleTemplateLocation($data);

        return $this->fetch($this->url);
    }

    public function cases(){
        $data = $this->param();
        self::articleTemplateLocation($data);

        return $this->fetch($this->url);
    }
    
    public function about(){
        $data = $this->param();
        self::articleTemplateLocation($data);

        return $this->fetch($this->url);
    }

    public function message(){
        $data = $this->param();
        self::articleTemplateLocation($data);

        return $this->fetch($this->url);
    }
}
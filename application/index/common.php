<?php
// 操作失败日志记录(文件中)
function indexLogFile($e=''){
    $content = '【'.date('Y-m-d H:i:s').'】出错文件：'.$e->getFile().'---'.$e->getLine().'；可能原因:'.$e->getMessage()."\r\n";
    $path = $_SERVER['DOCUMENT_ROOT'].'/Log/index/';
    $txt = ''; 
    if(!is_dir($path)){
        mkdir($path);
    }else{
        $path = $path.date('Y-m-d',time()).'.log';
        if(!is_file($path)) {
            fopen($path, "w");
             
        }
    }
    
    // 函数支持版本(PHP 5)
    file_put_contents($path, $content,FILE_APPEND);
}

function recursionGetClildrenColumn($column=[],$pid=0,$level=1){
    if(!$column){
        return false;
    }
    $category=[];
    $i=0;
    foreach($column as $key =>$value){
        if($pid==$value['pid']){
            $id = $value['id'];
            $category[$i]['id'] = $value['id'];
            $category[$i]['pid'] = $value['pid'];
            $category[$i]['title'] = $value['title'];
            $category[$i]['url'] = $value['rout_name'];
            $category[$i]['level'] = $level;
            unset($column[$key]);
            $category[$i]['children'] = recursionGetClildrenColumn($column,$id,$level+1);
            $i++;
        }
    }
    return $category;
}
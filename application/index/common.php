<?php

// 日志动作记录(表中)
function logArtion($data=array()){
    if(!empty($data)){
        $where = array(
            'fun'       => $data['fun'],
            'action'    => $data['action'],
        );
        $log = (new app\index\model\Log())->addLog($where);
        return isset($log)? true:false;
      
    }
    return false;
}
// 操作失败日志记录(文件中)
function indexLogFile($e=''){
    $content = '【'.date('Y-m-d H:i:s').'】出错文件：'.$e->getFile().'---'.$e->getLine().'；可能原因:'.$e->getMessage()."\r\n";
    $path = $_SERVER['DOCUMENT_ROOT'].'/Log/Index/';
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
// 多选分裂验证
function explodeCheck($user_group,$group_id){

    if(empty($user_group) || empty($group_id)){
        return false;
    }
    $u = explode(',',$user_group);
    if(in_array($group_id,$u)){
        return true;
    }else{
        return false;
    }
}
/**
 * 递归循环
 * @param   array   $cate   栏目初始数据
 * @param   int     $id     栏目id
 * @param   int     $level  栏目级数    
 * @return  array   $data   栏目整合排序集合
 */
function indexRecursiveRule($cate_list=array(), $id=0, $level=1){
    $data = array();
    $index = 0;
    foreach($cate_list as $k => $v){
        if($v['pid'] == $id){
            $v['userLevel'] = $level;
            $data[$index] = $v;
            unset($cate_list[$k]);
            // 开始循环递归
            $data[$index]['list'] = indexRecursiveRule($cate_list,$v['id'],$level+1);
            $index++;
        }
    }
    return $data;
}

/**
 * 系统配置获取配置分组
 * @param   string  $group      分组校验
 * @return  array|boolean       全部分组|校验对错
 */
function getConfigGroup($group=''){
    $system_group = C('WEB_SYSTEM_GROUP');
    $group_arr = explode("\n",$system_group);
   
    foreach($group_arr as $key =>$val){
        $group_arr_level_2 = explode(":",$val);
        $g[] = $group_arr_level_2;
        if($group){
            if(in_array($group,$group_arr_level_2)){
                return $group_arr_level_2[1];
            }
        }   
    }
    return $g;
}

/**
 * 系统配置获取配置类型
 * @param   string  $type   字符类型校验
 * @return  array|boolean   全部分组|校验对错
 */
function getConfigType($type=''){
    $type_arr = array(
        array('type' => 'string','des' => '字符'),
        array('type' => 'int','des' => '数字'),
        array('type' => 'boolean','des' => '单选'),
        array('type' => 'select','des' => '枚举'),
        array('type' => 'textarea','des' => '文本'),
        array('type' => 'file','des' => '文件上传')
    );
    if($type){
        foreach($type_arr as $key =>$val){
            if($val['type']==$type){
                return $val['des'];
            }
        }
        return false;
    }else{
        return $type_arr;
    }
}

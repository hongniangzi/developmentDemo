<?php

// 日志动作记录(表中)
function logArtion($data=array()){
    if(!empty($data)){
        $where = array(
            'fun'       => $data['fun'],
            'action'    => $data['action'],
        );
        $log = (new app\admin\model\Log())->addLog($where);
        return isset($log)? true:false;
      
    }
    return false;
}
// 操作失败日志记录(文件中)
function indexLogFile($e=''){
    $content = '【'.date('Y-m-d H:i:s').'】出错文件：'.$e->getFile().'---'.$e->getLine().'；可能原因:'.$e->getMessage()."\r\n";
    $path = $_SERVER['DOCUMENT_ROOT'].'/Log/admin/';
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
 * 后台栏目管理列表树数据整理
 * @param   array       $column         原始栏目数据
 * @param   int         $id             父级ID即为子栏目pid
 * @param   int         $level          栏目层级
 * @param   string      $color          颜色继承(灰色) 
 * @param   string      $default_color  颜色继承(彩色)    
 */
function recursiveColumnList($column=array(), $id=0, $level=1,$color='',$default_color=''){
    "{ 'name': '人口','bg_color': 'color1',
        'children': [
        { 'name': '本地劳动力变化本地劳动力变化-本地劳动力变化本地劳动力变化','bg_color': 'color1',
            'children':[
            {'name': '123', 'id':45, 'status':0, 'bg_color':'color1'},
            {'name': '456', 'id':45, 'status':1, 'bg_color':'color1'}
            ]
        },
        { 'name': '年轻城市分布年轻城市分布','bg_color': 'color1'}
        ]
    },";
    
    $list = array();
    $i = 0;
    $close = 0;
    foreach($column as $key =>$value){  
        if($value['pid']==$id){
            if($id==0){
                $default_color = "color".($i+1);
            }

            if($color=='color-gray'){

            }elseif($value['is_nav']==0 || $value['status']==0){
                $color = 'color-gray';
                $close = 1;
            }else{
                $color = $default_color;
            }
            $list[$i]['name'] = $value['title'];
            $list[$i]['bg_color'] = $color;
            $list[$i]['id'] = $value['id'];
            $list[$i]['status'] = $value['status'];
            $list[$i]['rout_name'] = $value['rout_name'];
            $list[$i]['sort'] = $value['sort'];
            $list[$i]['is_release'] = $value['is_release'];
            unset($column[$key]);
            $list[$i]['children'] = recursiveColumnList($column, $value['id'], $level+1, $color,$default_color);
            $i++;
            
        }
        if($close){
            $color = '';
        }
    }
    return $list;
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

// /**
//  * 获取模型类型
//  * @param   int   $info     模型对应的唯一值table_number
//  * @return  array           模型数据
//  */
// function getModelType($info=''){
//     // table_number为唯一值
//     $model_arr = array(
//         array(
//             'table_name'  => '无',
//             'table_title' => '自定义(开发模型)',
//             'table_number'=> 1
//         ),
//         array(
//             'table_name'  => 'pgy_article',
//             'table_title' => '文章模型',
//             'table_number'=> 2
//         ),
//         array(
//             'table_name'  => 'pgy_case',
//             'table_title' => '案例模型',
//             'table_number'=> 3
//         ),
//         array(
//             'table_name'  => 'pgy_case',
//             'table_title' => 'banner模型',
//             'table_number'=> 4
//         ),
//         array(
//             'table_name'  => 'pgy_message',
//             'table_title' => '留言模型',
//             'table_number'=> 5
//         ),
//         array(
//             'table_name'  => 'pgy_recruitment',
//             'table_title' => '招聘模型',
//             'table_number'=> 6
//         )
//     );
//     if($info){
//         foreach($model_arr as $key =>$val){
//             if($val['table_number']==$info){
//                 return $val;
//             }
//         }
//         return false;
//     }else{
//         return $model_arr;
//     }
// }
<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://0731pgy.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: wanglun <573075930@qq.com>
// +----------------------------------------------------------------------

// Route::get('think', function () {
//     return 'hello,ThinkPHP5!';
// });

// Route::rule("news/:id", "index/Article/news");

return [
    // 平台宣传
    ""                      =>  "index/Index/index",
    "index"                 =>  "index/Index/index",
    "introduction"          =>  "index/Index/introduction", // 公司介绍
    "cooperation"           =>  "index/Index/cooperation", // 商务合作
    "about"                 =>  "index/Index/about", // 关于我们
    "join"                  =>  "index/Index/join", // 加入我们
    "weChatMiniProgram"     =>  "index/Index/weChatMiniProgram", // 职业者登录引导页

    // 平台管理端
    "login/login"           =>  "admin/Login/login",
    "login/verify"          =>  "admin/Login/verify", // 验证码

    "user/logOut"           =>  "admin/User/logOut", // 退出登录
    "user/center"           =>  "admin/User/center", // 平台管理中心
    "user/listUser"         =>  "admin/User/listUser", // 用户管理列表
    "user/addUser"          =>  "admin/User/addUser",   // 新增管理用户
    "user/editUser"         =>  "admin/User/editUser", // 用户管理列表
    "user/deleteUser"       =>  "admin/User/deleteUser", // 编辑用户
    'user/editUserPwd'      =>  "admin/User/editUserPwd", // 修改用户密码
    "user/dleteUser"        =>  "admin/User/dleteUser", // 删除用户
    "user/authorizationUser"=>  "admin/User/authorizationUser", // 用户分组授权
    "user/log"              =>  "admin/User/log", // 用户行为

    "rule/authorityList"    =>  "admin/Rule/authorityList", // 路由权限规则列表
    "rule/setAuthority"     =>  "admin/Rule/setAuthority", // 路由权限权限管理(新增)
    "rule/editAuthority"    =>  "admin/Rule/editAuthority", // 路由权限权限管理(编辑)   
    "rule/AuthorityDlete"   =>  "admin/Rule/AuthorityDlete", // 路由权限权限管理(删除)  
    "rule/authorityGroupList"=> "admin/Rule/authorityGroupList", // 权限分组列表
    "rule/authorityGroupAdd" => "admin/Rule/authorityGroupAdd", // 权限分组(新增)
    "rule/authorityGroupEdit"=> "admin/Rule/authorityGroupEdit", // 权限分组(编辑)
    "rule/authorityGroupDelete"=> "admin/Rule/authorityGroupDelete", // 权限分组(删除)
    "rule/accessAuthority"  =>  "admin/Rule/accessAuthority", // 访问授权设置

    "system/platformSettings"   => "admin/System/platformSettings", // 平台设置 
    "system/configValue"        => "admin/System/configValue", // 系统参数配置
    "system/addConfigValue"     => "admin/System/addConfigValue", // 新增配置
    "system/delConfigValue"     => "admin/System/delConfigValue", // 删除配置
    "system/uploadImg"          => "admin/System/uploadImg", // 后台统一图片上传

    "column/columnList"         => "admin/Column/columnList", // 栏目设置管理
    "column/columnAdd"          => "admin/Column/columnAdd", // 新增栏目
    "column/columnEdit"         => "admin/Column/columnEdit", // 编辑栏目
    "column/columnStatus"       => "admin/Column/columnStatus", // 状态修改

    "adminNews/newsList"        => "admin/AdminNews/newsList", // 新闻 (自定义栏目)
    "adminNews/newsAdd"         => "admin/AdminNews/newsAdd", // 
    "adminNews/newsSetStatus"   => "admin/AdminNews/newsSetStatus",//
    "adminNews/newsDel"         => "admin/AdminNews/newsDel",//


    // 前台
    "news"          => "index/Article/news?column_id=1", // 新闻 (自定义栏目)
    "cases"         => "index/Article/cases?column_id=2", 
    "about"         => "index/Article/about?column_id=3",
    "message"       => "index/Article/message?column_id=7",
];


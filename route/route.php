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

// Route::rule('hello/:name', 'firm/Index/hello');

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
    "login/login"           =>  "index/Login/login",
    "login/verify"          =>  "index/Login/verify", // 验证码

    "user/logOut"           =>  "index/User/logOut", // 退出登录
    "user/center"           =>  "index/User/center", // 平台管理中心
    "user/listUser"         =>  "index/User/listUser", // 用户管理列表
    "user/addUser"          =>  "index/User/addUser",   // 新增管理用户
    "user/editUser"         =>  "index/User/editUser", // 用户管理列表
    "user/deleteUser"       =>  "index/User/deleteUser", // 编辑用户
    'user/editUserPwd'      =>  "index/User/editUserPwd", // 修改用户密码
    "user/dleteUser"        =>  "index/User/dleteUser", // 删除用户
    "user/authorizationUser"=>  "index/User/authorizationUser", // 用户分组授权
    "user/log"              =>  "index/User/log", // 用户行为

    "rule/authorityList"    =>  "index/Rule/authorityList", // 路由权限规则列表
    "rule/setAuthority"     =>  "index/Rule/setAuthority", // 路由权限权限管理(新增)
    "rule/editAuthority"    =>  "index/Rule/editAuthority", // 路由权限权限管理(编辑)   
    "rule/AuthorityDlete"   =>  "index/Rule/AuthorityDlete", // 路由权限权限管理(删除)  
    "rule/authorityGroupList"=> "index/Rule/authorityGroupList", // 权限分组列表
    "rule/authorityGroupAdd" => "index/Rule/authorityGroupAdd", // 权限分组(新增)
    "rule/authorityGroupEdit"=> "index/Rule/authorityGroupEdit", // 权限分组(编辑)
    "rule/authorityGroupDelete"=> "index/Rule/authorityGroupDelete", // 权限分组(删除)
    "rule/accessAuthority"  =>  "index/Rule/accessAuthority", // 访问授权设置

    "system/platformSettings"   => "index/System/platformSettings", // 平台设置 
    "system/configValue"        => "index/System/configValue", // 系统参数配置
    "system/addConfigValue"     => "index/System/addConfigValue", // 新增配置
    "system/delConfigValue"     => "index/System/delConfigValue", // 删除配置
    "system/uploadImg"          => "index/System/uploadImg", // 后台统一图片上传


];

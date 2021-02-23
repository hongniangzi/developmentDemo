<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


// 获取浏览器IP地址
function get_real_ip(){
    $ip=false;
    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if($ip){
                array_unshift($ips, $ip); $ip = FALSE;
            }
            for($i = 0; $i < count($ips); $i++){
                if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])){
                    $ip = $ips[$i];
                    break;
                }
            }
    }
    return($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}

// 通过GET请求发送json
function do_get($url, $params) {
	$url = "{$url}?" . http_build_query($params);

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

	curl_setopt($ch, CURLOPT_TIMEOUT, 60);

	curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	$result = curl_exec($ch);

	curl_close($ch);
	
	return $result;
}

function do_post($url, $data) {
	$ch = curl_init();
	$header = "Accept-Charset: utf-8";
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$tmpInfo = curl_exec($ch);
	if (curl_errno($ch)) {
		return false;
	} else {
		return $tmpInfo;
	}
}

/**
 * 检验数据的真实性，并且获取解密后的明文.
 * @param $encryptedData string 加密的用户数据
 * @param $iv string 与用户数据一同返回的初始向量
 * @param $data string 解密后的原文
 *
 * @return int 成功0，失败返回对应的错误码
 */
function decryptData($encryptedData, $iv, &$data, $sessionKey, $appid) {
	if (strlen($sessionKey) != 24) {
		return -41001;
	}
	$aesKey = base64_decode($sessionKey);

	if (strlen($iv) != 24) {
		return -41002;
	}
	$aesIV = base64_decode($iv);

	$aesCipher = base64_decode($encryptedData);

	$result = openssl_decrypt($aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);

	$dataObj = json_decode($result);
	
	if ($dataObj == NULL) {
		return -41003;
	}
	if ($dataObj->watermark->appid != $appid) {
		return -41004;
	}
	$data = $result;
	return 0;
}

/**
 * 获取image图片地址
 * @param	int		$id		文件ID
 * @return	string			文件路径
 */
function getImagePath($id){
	$img = (new app\index\model\File())->getFile(array('id'=>$id));
	return !empty($img[0]) ? $img[0]['path_name']:'';
}

/**
 * 检验验证码正确性
 * @param	string	$code	验证码
 * @return	bool			true|false
 */
function checkVerify($code){
	if(empty($_SESSION['Verify'])){
		return false;
	}
	if(strtolower($code)==strtolower($_SESSION['Verify'])){
		unset($_SESSION['Verify']);
		return true;
	}else{
		return false;
	}
}

/**
 * 大C获取系统配置值
 * @param	string	$name	配置参数
 * @return	string			配置值	
 */
function C($name=''){
	if($name){
		$conf = (new \app\index\model\Config())->getSystemConfig(array('name'=>$name),'value');
		if(!empty($conf[0])){
			return $conf[0]['value'];
		}
	}
	return false;
}

/**
 * 字符串转数组
 * @param   string  $str    待转化字符串,一级分割为\n,二级分割为:
 * @return  array           转化后的数组
 */
function strInArr($str=''){
    if($str){
        $str_level_1 = explode("\n",$str);
        foreach($str_level_1 as $key =>$val){
            $str_level_2 = explode(":",$val);
            $s[] = $str_level_2;
            
        }
        return $s;
    }
    
    return false;
}

/**
 * 发送短信验证码
 * @param	int		$phone		手机号
 * @return	array				处理结果
 */
function sendCode($phone=''){
	$result['status'] = 0;

	if ($phone == '') {
		$result['Msg'] = '手机号不能为空';
	}else{
		$rand = rand(100000, 999999);
		$con = array(
			'phone' => $phone,
			'rand'  => $rand,
			'code'  => 'SMS_204415286',
			'name'	=> '椒粉科技',
		);
		include_once dirname(__DIR__).'/thinkphp/library/Vendor/SmsDemo/api_demo/SmsDemo.php';
		$SmsDemo = new \SmsDemo();
		$msg = $SmsDemo::sendSms($con);
	
		if ($msg->Code == 'OK') {
			cache('pgy_' . $phone . $rand, $rand, 60 * 15);
	
			$result['status'] = '1';
			$result['Msg'] = $msg->Code;
		} else {
			$result['Msg'] = $msg->Message;
		}
	}
	return $result;
}

/**
 * @param	string	$url	当前路由URL
 * @return	array			栏目一维数组
 */
function leftCategory($url=''){
	define('PGYCATE', 'pgy_cate');
	$rule = cache(PGYRULE);
	$url = $url?substr($url,1):'';
	
	$pid_arr = array();
	$url_pid = 0;
	foreach($rule as $key =>$value){
		if($value['route']==$url){
			$url_pid = $value['pid'];
			$pid_arr[] = $value['id'];
		}
		if($value['route_type']==2){
			// route_type为2是动作类规则,栏目中不给于显示
			unset($rule[$key]);
		}
	}
	$rule = array_values($rule);
	$rule_len = count($rule);
	if($url_pid!=0){
		for($i=0; $i<$rule_len; $i++){
			if($rule[$i]['id']==$url_pid){
				$pid_arr[] = $rule[$i]['id'];
				$url_pid = $rule[$i]['pid'];
				if($rule[$i]['pid']!=0){
					$i=0;
				}
				
			}
		}
	}

	$pgy_cate = cache(PGYCATE);
	$hov_index = '';
	if($url=='user/center'){
		// 平台首页高亮
		$hov_index = 'hov';
	}elseif(empty($pid_arr) && $pgy_cate){
		return $pgy_cate;
	}
	// 递归栏目
	$cate = indexRecursiveRule($rule);
	$cate_str = '<ul>
		<li class="'.$hov_index.'"><a href="'.url('/user/center').'" class="name"><i><img src="/static/index/images/c01.png"></i><b>管理首页</b></a></li>';
	foreach($cate as $key_1 =>$val_1){
		// 第一层
		$route_1 = $val_1["route"]=="null"?"javascript:;":url('/'.$val_1["route"]);
		$down_1 = $val_1['list']?'down':'';
		$display_1 = in_array($val_1['id'],$pid_arr)?'display:block':'display:none';
		$hov_1 = in_array($val_1['id'],$pid_arr)?'hov':'';
		$icon_1 = !empty($val_1['icon'])?'<i><img src="'.$val_1['icon'].'"></i>':'';
		$cate_str .= '<li class="'.$hov_1.'">
				<a href="'.$route_1.'" class="name '.$down_1.'">'.$icon_1.'<b>'.$val_1['title'].'</b></a>
				<dl style="'.$display_1.'">';
		if(!empty($val_1['list'])){
			foreach($val_1['list'] as $key_2 =>$val_2){
				// 第二层
				$route_2 = $val_2["route"]=="null"?"javascript:;":url('/'.$val_2["route"]);
				$down_2 = $val_2['list']?'down':'';
				$display_2 = in_array($val_2['id'],$pid_arr)?'display:block':'display:none';
				$hov_2 = in_array($val_2['id'],$pid_arr)?'hov':'';
				$icon_2 = !empty($val_2['icon'])?'<i><img src="'.$val_2['icon'].'"></i>':'';
				$cate_str .= '<dd class="'.$hov_2.'">
						<a href="'.$route_2.'" class="tits '.$down_2.'">'.$icon_2.'<b>'.$val_2['title'].'</b></a>
						<ol style="'.$display_2.'">';
				if(!empty($val_2['list'])){
					foreach($val_2['list'] as $key_3 =>$val_3){
						// 第三层
						$route_3 = $val_3["route"]=="null"?"javascript:;":url('/'.$val_3["route"]);
						$down_3 = $val_3['list']?'down':'';
						$hov_3 = in_array($val_3['id'],$pid_arr)?'hov':'';
						$icon_3 = !empty($val_3['icon'])?'<i><img src="'.$val_3['icon'].'"></i>':'';
						$cate_str .= '<li class="'.$hov_3.'"><a href="'.$route_3.'" class="tit '.$down_3.'">'.$icon_3.'<b>'.$val_3['title'].'</b></a></li>';
					}
					$cate_str .= '</ol>';
				}
				$cate_str .= '</dd>';
			}
			$cate_str .= '</dl>';
		}
		$cate_str .= '</li>';
	}
	$cate_str .= '</ul>';
	cache(PGYCATE,$cate_str,60*60*24);
	return $cate_str;
}

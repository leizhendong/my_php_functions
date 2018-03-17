<?php
/*
|--------------------------------------------------------------------------
| 助手函数文件
|--------------------------------------------------------------------------
*/

if(!function_exists('replace_value')){
	/**
	 * 数据过滤 按照格式替换
	 * @param  array &$data 需要过滤的数据
	 * @param  array $arr   替换或添加的规则
	 * @param  string $suffix 替换后的数据下标后缀
	 * @return ''
	 *
	 * @Author 李振东 lzdong@foxmail.com 2018-03-17
	 */
	function replace_value(array &$data, array $arr, string $suffix="")
	{
	    $arr=['arr'=>$arr, 'suffix'=>$suffix];
        array_walk($data,function(&$v,$k,$arr){
            $suffix='';
            extract($arr);
	        foreach ($arr as $key=> $val) {
	            if(array_key_exists($key,$v)){
                    if(is_array($val)){
                        $v[$key.$suffix]=$val[$v[$key]];
                    }else{
                        $v[$key.$suffix]=date($val,$v[$key]);
                    }
	            }
	        }
        },$arr);
	}
}



if (!function_exists('responseMessage')) {
	/**
	 * 统一返回请求  (封装response)
	 * @param Array $obj
	 *      数组 $obj
	 *          'url'=>    链接
	 *          'msg'=>    提示信息
	 *          'code'=>   状态码
	 *          'data'=>   返回主信息
	 *          'header'=> 头信息
	 *          'value'=>  值
	 * @return mixed   返回数据 默认返回json类型
	 */
	function responseMessage($obj)
	{
	    $msg = '成功';    $url = '';      $data = '';   $code = 1;
	    $header = 'Content-Typeaa';
	    $value = 'application/json';
	    extract($obj);
	    $msg = is_array($msg) ? json_encode($msg) : trans($msg)??$msg ;

	    $res['status']  = $code;
	    $res['msg']     = $msg;
	    $res['url']     = $url;
	    $res['data']    = $data;

	    return response($content = $res, $status = 200)->header($header, $value);
	}
}

if (!function_exists('respS')) {
	/**
	 * 成功跳转
	 * @param string $msg
	 * @param string $route
	 * @return \Illuminate\Http\RedirectResponse
	 */
	function respS($msg = '', $route = '')
	{
	    $msg = trans($msg)?trans($msg):trans('res.success');
	    return $route?redirect($route)->with('msg_ok', $msg):redirect()->back()->with('msg_ok', $msg);
	}
}

if (!function_exists('respF')) {
	/**
	 * 失败跳转
	 * @param string $msg
	 * @param string $route
	 * @return \Illuminate\Http\RedirectResponse
	 */
	function respF($msg = '', $route = '')
	{
	    $msg = trans($msg)?trans($msg):trans('res.fail');
	    return $route?redirect($route)->with('msg_no', $msg):redirect()->back()->with('msg_no', $msg);
	}
}

if (!function_exists('getIp')) {
	/**
	 * [getIp 获取用户IP]
	 * @return [type] [description]
	 */
	function getIp(){
	    $onlineip='';
	    if(getenv('HTTP_CLIENT_IP')&&strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown')){
	        $onlineip=getenv('HTTP_CLIENT_IP');
	    } elseif(getenv('HTTP_X_FORWARDED_FOR')&&strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),'unknown')){
	        $onlineip=getenv('HTTP_X_FORWARDED_FOR');
	    } elseif(getenv('REMOTE_ADDR')&&strcasecmp(getenv('REMOTE_ADDR'),'unknown')){
	        $onlineip=getenv('REMOTE_ADDR');
	    } elseif(isset($_SERVER['REMOTE_ADDR'])&&$_SERVER['REMOTE_ADDR']&&strcasecmp($_SERVER['REMOTE_ADDR'],'unknown')){
	        $onlineip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $onlineip;
	}
}

if (!function_exists('is_Mobile')) {
	/**
	 * [is_Mobile 判断移动端]
	 * @return boolean [description]
	 */
	function is_Mobile()
	{
	    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
	    {
	        return true;
	    }
	    if (isset ($_SERVER['HTTP_VIA']))
	    {
	        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
	    }
	    if (isset ($_SERVER['HTTP_USER_AGENT']))
	    {
	        $clientkeywords = array ('nokia',
	            'sony',
	            'ericsson',
	            'mot',
	            'samsung',
	            'htc',
	            'sgh',
	            'lg',
	            'sharp',
	            'sie-',
	            'philips',
	            'panasonic',
	            'alcatel',
	            'lenovo',
	            'iphone',
	            'ipod',
	            'blackberry',
	            'meizu',
	            'android',
	            'netfront',
	            'symbian',
	            'ucweb',
	            'windowsce',
	            'palm',
	            'operamini',
	            'operamobi',
	            'openwave',
	            'nexusone',
	            'cldc',
	            'midp',
	            'wap',
	            'mobile'
	        );
	        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
	        {
	            return true;
	        }
	    }
	    if (isset ($_SERVER['HTTP_ACCEPT']))
	    {
	        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
	        {
	            return true;
	        }
	    }
	    return false;
	}
}
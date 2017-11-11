<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Library\Ucpaas;

if( !function_exists('get_cache')){
	function get_cache($cache_name){
		switch($cache_name){
			case 'wechat_key':
				break;
			default:
				return Cache::get($cache_name);
		}
	}
}
if( !function_exists('set_cache')){
	function set_cache($cache_name,$data,$forever = 1){
		Cache::forever($cache_name,$data);
	}
}
if( !function_exists('get_sys_cache') ){
	function get_sys_cache($name,$sign='',$remember = true){
		// $cache = Cache::remember()
		switch($name){
			case 'scheme':
				return Cache::remember('scheme_'.$sign,6000,function()use ($sign){
					return DB::table('schemes')->where('id',$sign)->first();
				});
				break;
			case 'authorized_wechat':
				return Cache::remember('authorized_wechat_'.$sign,6000,function() use($sign){
					return DB::table('authorized_wechat')->where('AuthorizerAppid',$sign)->first();
				});
				break;
			case 'device_mac':
				//以MAC为标识的设备的缓存 只要设备增删改都要清除
				return Cache::remember('device_mac_'.$sign,6000,function() use($sign){
					return DB::table('devices')->where('mac',$sign)->first();
				});
				break;
			case 'device':
				return Cache::remember('device_'.$sign,6000,function()use($sign){
					return DB::table('devices')->where('id',$sign)->first();
				});
				break;
			case 'LOCATION_NUM':
				return Cache::get('LOCATION_NUM');
				break;
			default:
			//authtypes
				return Cache::remember($name.'_'.$sign,6000,function()use ($sign,$name){
					return DB::table($name.'s')->where('id',$sign)->first();
				});

		}
	}
}
if( !function_exists('http_get') ){
	function http_get($url){
		$curl      = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, FALSE);
		curl_setopt($curl, CURLOPT_NOBODY, FALSE);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, FALSE);
		$data = curl_exec($curl);
		// curl_exec($curl);
		$httpCode = curl_getinfo($curl,CURLINFO_HTTP_CODE);
		curl_close($curl);
	    return $httpCode;
	}
}
if( !function_exists('http_post') ){
	function http_post($url,$data){
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close ( $ch );
		return $result;
	}
}
if( ! function_exists('timestamp_date') ){
	function timestamp_date($date,$flag='start'){
		$split_date = explode('-',$date);
		if($flag=='start'){
			$date= mktime(0,0,0,$split_date[1],$split_date[2],$split_date[0]);
		}else{
			$date= mktime(23,59,59,$split_date[1],$split_date[2],$split_date[0]);
		}
		return $date;
	}
}

if( ! function_exists('mylog') ){
	function mylog($data_str_to_log){
		if(is_array($data_str_to_log)) $data_str_to_log = json_encode($data_str_to_log);
		Log::debug(date('H:i:s',time()).' --- '.$data_str_to_log);
	}
}
if(! function_exists('getMillisecond')){
	function getMillisecond() {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
    }
}

if( !function_exists('send_ucpaas_msg')){
	function send_ucpaas_msg($to,$msg,$template){
		$options['accountsid'] = config('managesetting.sms_sid');
        $options['token'] = config('managesetting.sms_token');
        $ucpass     = new Ucpaas($options);
        $sms_appid = config('managesetting.sms_appid');
        // $sms_template = config('managesetting.sms_template');
        $res = $ucpass->templateSMS($sms_appid,$to,$template,$msg);
        Log::debug('send msg:'.$res);
        return $res;
	}
}
if( !function_exists('today_start_timestamp') ){
	function today_start_timestamp(){
		$dt = date('Y-m-d',time());
		format_timestamp_from_date($dt,'start');
		return $dt;
	}
}
if( !function_exists('today_end_timestamp') ){
	function today_end_timestamp(){
		$dt = date('Y-m-d',time());
		format_timestamp_from_date($dt,'end');
		return $dt;
	}
}
if( !function_exists('format_timestamp_from_date')){
	function format_timestamp_from_date(&$date,$flag='start'){
		$split_date = explode('-',$date);
		if($flag=='start'){
			$date= mktime(0,0,0,$split_date[1],$split_date[2],$split_date[0]);
		}else{
			$date= mktime(23,59,59,$split_date[1],$split_date[2],$split_date[0]);
		}
	}
}
if( !function_exists('format_mac') ){
	function format_mac($mac){
		/*
		* 返回以冒号分隔的小写MAC
		*/
		$mac=strtolower($mac);
		$amac=str_split($mac,2);
		$smac=join(":",$amac);
		return $smac;
	}
}

if( !function_exists('array_index_shift')){
	function array_index_shift($index,$arr){
		if(isset($arr[$index]))
			unset($arr[$index]);
		return array_values($arr);
	}
}

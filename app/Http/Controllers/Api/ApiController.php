<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
	public function __construct(){
		//
	}
    //
    public function test_my_decrypt(){
        $en_str = 'sQmbFxSWzAlUy0kSLFFSKhDUsADMxwSZtlGVrNWZoNEL1EDOURETXxyMywySYUPMsQnchR349U';
        echo $this->my_decrypt($en_str);
    }
    public function my_decrypt($str){
        
        
        $str = str_replace("\r\n", '', $str);
        $str = str_replace("\r", '', $str);
        $str = str_replace("\n", '', $str);
        
        
        $len_rev = strlen($str);
        

        $x_index = trim($str[1]);
        if( is_numeric($x_index) ){
            $x_length = $str[2];
            if( is_numeric($x_length )){
                
                // $ret = '';
                $ret=$str[0].substr($str,3,$x_index-1).substr($str,$x_index+$x_length+2);
                mylog('after slice:'.$ret);
               
                return base64_decode(strrev($ret));
            }else{
                return 'Wrong Format length';
            }
        }else{
            return 'Wrong Format index';
        }
    }


    public function test_my_encrypt(){
        $str = 'iamnicetomeetyou';
        //==ALk5WRs4EVDZELwwSZtlGVrNWZoNEL1EDOURETXxyNywSMsQnchZAW7ER353U
        echo $this->my_encrypt($str);
    }
    public function my_encrypt($str){
        $bs64_str = base64_encode($str);
        $revstr = strrev($bs64_str);

        //encrypt the string 
        $max = 0;
        if(strlen($bs64_str) <= 9){
            $max = strlen($bs64_str)-1;
        }else{
            $max = 9;
        }

        $x_index =  mt_rand(3,$max);
        $x_length = mt_rand(2,9);

        $x_str = $this->create_rand_length($x_length);

        return $this->my_conn_str($revstr,$x_index,$x_length,$x_str);
    }
    private function create_rand_length($length){
        $rand_scope = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $scope_length = strlen($rand_scope);
        $ret = '';
        for($i = 0;$i<$length;$i++){

            $j = mt_rand(0,$scope_length-1);
            $ret.=$rand_scope[$j];
        }
       
        return $ret;
    }
    private function my_conn_str($str,$x_index,$x_length,$x_str){
        $ret = $str[0].$x_index.$x_length;
        //切出从索引1到插入的索引位
        $sliced = substr($str,1,$x_index-1);
        //插入位的后面
        $end = substr($str,$x_index);
        $ret .= $sliced.$x_str.$end;
        return $ret;
    }
}

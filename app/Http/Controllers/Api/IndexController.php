<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends ApiController
{
	public function __construct(){
		parent::__construct();
		DB::connection()->enableQueryLog();
        // DB::getQueryLog()
	}
    //
    public function index(){
    	echo '403 forbidden';
    }
    public function ping(){
    	
    	$ret = ['type'=>''];
    	if(!isset($_GET['key']) || null == $_GET['key']){
    		//
    		mylog('no key get');
    	}else{
    		$key = rawurldecode($_GET['key']);
    		$info = $this->my_decrypt($key);
    		
    		$info_arr = explode( '|||',$info);
    		mylog($info_arr);
    		if(!isset($info_arr[6]) || empty($info_arr[6])){
    			//
    			mylog('no player code get');
    		}else{
    			//find the latest cmd of this player
    			$latest_cmd = DB::table('cmdlists')->where([
    				['player_code',$info_arr[6]],
    				['create_time','>=',time()-10],
    				['status',0],
    				])->orderBy('id','desc')->first();
    			mylog(json_encode(DB::getQueryLog()));
    			if($latest_cmd){
    				//
    				$ret = ['type'=>$latest_cmd->type,'cmd'=>$latest_cmd->cmd];
    				DB::table('cmdlists')->where('id',$latest_cmd->id)->update(['status'=>1]);
    			}
    			
	    		
    		}
    		
    	}
    	mylog($ret);
    	$response = $this->my_encrypt(json_encode($ret));
		mylog($response);
		echo $response;
    }
    public function test_xx(){
    	echo substr('nicetomeeyou',3,4);#etom
    	$encrypted_string = '=98UWbvhWbvFZ2A92ZXJnZ4ATMxcTMwIDf8xHO4gzNxIDMxUTM8xHfwIDf8xXY00mL9GZ5fS55Eq55 Sp5SCo58xHfwIDf8xHMywHf8BjM';
    	echo 'after decrypt:'.$this->my_decrypt($encrypted_string);

    	$str = 'iamnicetomeetyou';
        //==ALk5WRs4EVDZELwwSZtlGVrNWZoNEL1EDOURETXxyNywSMsQnchZAW7ER353U
        echo $this->my_encrypt($str);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{

	public $isAdmin = 0 ;
    public $user_id;
    public $page;//分页时每页显示数量
    public $theme;
    public $background ;
    public $db_prefix;
    public $show_info;
	public function __construct(){
    	//所有admin中的类都继承这个方法，一些仅有的变量都在这里进行设置
    	$this->page =  config('myconfig.page',15);
    	$this->theme = config('myconfig.theme','se7en');
    	$this->background = config('myconfig.background','admin');
    	$this->db_prefix = config('database.connections.mysql.prefix');

    	$this->middleware(function ($request, $next) {
    		//验证superadmin
	        $this->user= Auth::user();
	        $this->user_id = $this->user->id;
	        if($this->user->id == 1){
	        	mylog('Iam super admin');
	        	$this->isAdmin = 1;
	        }
            $this->show_info = 0;
            if(isset($_GET['show_info']) && null != $_GET['show_info']){
                $this->show_info = $_GET['show_info'];

            }
            View::share('show_info',$this->show_info);
            View::share('isAdmin',$this->isAdmin);
            View::share('user',$this->user);
            View::share('background',$this->background);
	        return $next($request);
	    });
        // DB::connection()->enableQueryLog();
        // DB::getQueryLog()
    }
    //
    public function index(){
    	
    	return view('admin.'.$this->theme.'.index',[]);
    }
    public function logout(){
    	Auth::logout();
    	return Redirect::to($this->background);
    }
    public function loginas($userid){
        Auth::loginUsingId($userid);
        return Redirect::to($this->background);
    }
}

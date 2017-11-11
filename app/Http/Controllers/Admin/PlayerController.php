<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use Redirect;

class PlayerController extends AdminController
{
    public function __construct(){
        parent::__construct();
        // DB::connection()->enableQueryLog();
        // DB::getQueryLog()
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $players = DB::table('player')->orderBy('id','desc')->orderBy('status','desc')->get();
        return view('admin.'.$this->theme.'.playerindex',['players'=>$players]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.'.$this->theme.'.playercreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate( $request ,[
            'name'=>'required',
            'player_code'=>'required',
            ]);
        //check if the code has storead
        $if_exists = DB::table('player')->where('player_code',$request->get('player_code'))->first();
        if($if_exists){
            return Redirect::back()->withErrors('已经存在');
        }else{
            $id = DB::table('player')->insertGetId(['name'=>$request->get('name'),'player_code'=>$request->get('player_code'),'create_user_id'=>$this->user_id]);
            if($id){
                return Redirect::to($this->background.'/player');
            }else{
                return Redirect::back()->withErrors('保存失败');
            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $player = DB::table('player')->where('id',$id)->first();
        return view('admin.'.$this->theme.'.playershow',['player'=>$player]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::table('player')->where('id',$id)->delete();
        return Redirect::to($this->background.'/player');
    }

    public function player_play(){
        $player_code = isset($_GET['player_code']) && !empty($_GET['player_code']) ? $_GET['player_code'] : '';
        $player_status = isset($_GET['player_status']) && !empty($_GET['player_status']) ? $_GET['player_status'] : '';
        mylog('player_code'.$player_code);
        if(!$player_code){
            mylog('no player code');
            echo -1;
        }else{
            if($player_status == 1)
                $cmd = '"set_property","pause",false';
            else
                $cmd = '"set_property","pause",true';
            $data = ['type'=>'exe_cmd','cmd'=>$cmd,'create_time'=>time(),'player_code'=>$player_code];
            $id = DB::table('cmdlists')->insertGetId($data);
            mylog('return id:'.$id);
            if($id){
                echo 1;
            }else{
                echo 0;
            }
        }
        
    }

    public function player_play_ctrl(){
        $player_code = isset($_GET['player_code']) && !empty($_GET['player_code']) ? $_GET['player_code'] : '';
        $flag  = isset($_GET['flag']) && !empty($_GET['flag']) ? $_GET['flag'] : '';
        if(!$player_code){
            mylog('no player code');
            echo -1;
        }else{
            if($flag == -1)
                $cmd = '"playlist-prev"';
            else
                $cmd = '"playlist-next"';
            $data = ['type'=>'exe_cmd','cmd'=>$cmd,'create_time'=>time(),'player_code'=>$player_code];
            $id = DB::table('cmdlists')->insertGetId($data);
            mylog('return id:'.$id);
            if($id){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
}

@extends('admin.se7en.tpl')

@section('content')

<div class="row">
<!-- Striped Table -->
<div class="col-lg-12 col-md-12 col-xs-12">
<div class="widget-container fluid-height clearfix">
	<div class="heading">
    	<i class="icon-table"></i>{{ $player->name }}
	</div>

	<div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              
              <div class="col-lg-12">
                
                <div class="widget-content padded">
                  <div class="row">
                    <button class="btn btn-default-outline" onclick="player_play(1);"><i class="icon-home"></i>播放</button>
                    <button class="btn btn-default-outline" onclick="player_play(0);"><i class="icon-home"></i>暂停</button>
                    <button class="btn btn-primary-outline" onclick="player_play_ctrl(-1);"><i class="icon-user"></i>上一首</button>
                    <button class="btn btn-success-outline"onclick="player_play_ctrl(1);"><i class="icon-cog"></i>下一首</button>
                    <button class="btn btn-info-outline"><i class="icon-cloud-download"></i>Download</button>
                    <button class="btn btn-warning-outline"><i class="icon-warning-sign"></i>Warning</button>
                    <button class="btn btn-danger-outline"><i class="icon-trash"></i>Delete</button>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
</div>
</div>
<!-- end Striped Table -->
</div><!--row-->

@endsection

@section('scripts')
<script>
$('#player').addClass('current');
function player_play(status){
	$.get('/{{ $background }}/player_play?player_code={{ $player->player_code }}&player_status='+status,function(res){
		if(res == 1)
			layer.msg('正在执行,请稍侯~');
		else
			layer.msg('执行失败,请稍候再试...');
	})
}
function player_play_ctrl(flag){
	$.get('/{{ $background }}/player_play_ctrl?player_code={{ $player->player_code }}&flag='+flag,function(res){
		if(res == 1)
			layer.msg('正在执行,请稍侯~');
		else
			layer.msg('执行失败,请稍候再试...');
	})
}
</script>
@endsection
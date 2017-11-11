@extends('admin.se7en.tpl')

@section('content')

<div class="row">
<!-- Striped Table -->
<div class="col-lg-12 col-md-12 col-xs-12">
<div class="widget-container fluid-height clearfix">
	<div class="heading">
    	<i class="icon-table"></i>添加播放器
	</div>

	<div class="widget-content padded">
		@if(count($errors)>0)

		<ul>
			@foreach($errors->all() as $error)
			<li color="red">{{ $error }}</li>
			@endforeach
		</ul>
		@endif
        <form action="{{ URL('/'.$background.'/player') }}" class="form-horizontal" method="POST">
        	{{ csrf_field() }}
         	<div class="form-group">
	            <label class="control-label col-md-2">播放器名称</label>
	            <div class="col-md-7">
	            	<input class="form-control" placeholder="" type="text" name="name">
	            </div>
          	</div>
			<div class="form-group">
	            <label class="control-label col-md-2">播放器编码</label>
	            <div class="col-md-7">
	            	<input class="form-control" placeholder="" type="text" name="player_code">
	            </div>
          	</div>
          	

          	<div class="form-group">
	            <label class="control-label col-md-2"></label>
	            <div class="col-md-7">
	            	<button class="btn btn-primary" type="submit">提交</button>
	            </div>
          	</div>

      </form>
	</div>
</div>
</div>
<!-- end Striped Table -->
</div><!--row-->

@endsection

@section('scripts')
<script>
$('#player').addClass('current');
</script>
@endsection
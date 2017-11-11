@extends('admin.se7en.tpl')

@section('content')

<div class="row">
<!-- Striped Table -->
<div class="col-lg-12 col-md-12 col-xs-12">
<div class="widget-container fluid-height clearfix">
  <div class="heading">
    <i class="icon-table"></i>播放器管理
    
      <a href="{{ URL('/'.$background.'/player/create') }}" class="btn btn-primary-outline pull-right">添加播放器</a>
    
  </div>
  <div class="widget-content padded clearfix">
    <table class="table table-striped">
      <thead>
      	<th></th>
        <th>播放器名称</th>
        <th>播放器标识</th>
        
        <th>操作</th>
        
      </thead>

      <tbody>
      	@foreach($players as $player)
      		<tr>
      			<td></td>
      			<td>{{ $player->name }}</td>
            	<td>{{ $player->player_code }}</td>
            
      			<td>
      				<div class="btn-group">
                      <button class="btn btn-xs btn-default-outline dropdown-toggle" data-toggle="dropdown">管理<span class="caret"></span></button>
                      <ul class="dropdown-menu">
                      	
                        <li>
                          <a href="{{ URL('/'.$background.'/player/'.$player->id.'/edit') }}"><i class="icon-edit"></i>修改</a>
                        </li>
                        <li>
                          <a href="{{ URL('/'.$background.'/player/'.$player->id) }}"><i class="icon-edit"></i>进入管理</a>
                        </li>
                        
                       
                      	<li>
                      		<a href="javascript:;" onclick="confirmdel({{ $player->id }});"><i class="icon-remove"></i>删i除</a>
							<form id="del_{{ $player->id }}" action="{{ URL('/'.$background.'/player/'.$player->id) }}" method="POST" style="display:inline">
								{{ csrf_field() }}
								<input name="_method" value="DELETE" type="hidden">
								
							</form>
						</li>
						
                        
                      </ul>
                    </div>
      			</td>
      		</tr>
      	@endforeach
        
        
      </tbody>
    </table>
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
<script>



function confirmdel(id){
	layer.confirm('确定要删除？', {
	  btn: ['确定','取消'] //按钮
	}, function(){
		$('#del_'+id).submit();
	}, function(){
	
	});
}
</script>
@endsection
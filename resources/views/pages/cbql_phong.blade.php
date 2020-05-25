@extends('master')
@section('content')
<div class="list_phong">
	<h3 style="">
         <i class="fa fa-arrow-circle-o-right"></i>
            Danh sách phòng
    </h3>
	<table class="table table-bordered table-striped datatable" id="table_export">
		<tr>
			<th>Số phòng</th>
			<th>Số người đk hiện tại</th>
			<th>Số người tối đa</th>
			<th>Giới tính</th>
			<th>Xem</th>
		</tr>
		@foreach($ttphong as $p)
		<tr>
			<td>{{$p->sophong}}</td>
			<td>{{$p->sncur}}</td>
			<td>{{$p->snmax}}</td>
			<td>@if($p->gioitinh=="nam")
					{{"Nam"}}
				@else {{"Nữ"}}
				@endif
			</td>
			<td><a href="{{route('cbql_ttphong',$p->id)}}"><button>Xem thông tin</button></a></td>
		</tr>
		@endforeach
	</table>
</div>
<div class="row">
	<div class="col-xs-6 col-left"></div>
	<div class="col-xs-6 col-right">
		<div class="dataTables_paginate paging_bootstrap">
			{!! $ttphong->links() !!}
		</div>
	</div>
</div>
@endsection

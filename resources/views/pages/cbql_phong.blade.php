@extends('master')
@section('content')
<div class="list_phong">
	<h3 style="">
         <i class="fa fa-arrow-circle-o-right"></i>
            Danh sách phòng
    </h3>
	<form action="{{url('cbql_them_phong')}}" method="post" class="form-inline ">
		@csrf
		<label for="">Số phòng:</label>
		<input name="sophong" type="number" min="0" required class="form-control"/>
		<label for="">Số người tối đa:</label>
		<input name="snmax" required  Type="number" min="0" class="form-control"/>
		<label for="">Phòng cho:</label>
		<select name="gioitinh" class="form-control">
			<option value="Nam">Nam</option>
			<option value="Nữ">Nữ</option>
		</select>
		<button class="btn btn-success" type="submit">Thêm phòng +</button>
	</form>
	<hr>
	<table class="table table-bordered table-striped datatable" id="table_export">
		<tr>
			<th>STT</th>
			<th>Số phòng</th>
			<th>Số người đk hiện tại</th>
			<th>Số người tối đa</th>
			<th>Giới tính</th>
			<th>Khu KTX</th>
			<!-- <th>Xem</th> -->
		</tr>
		@foreach($ttphong as $key => $p)
		<tr>
			<td>{{$key + 1}}</td>
			<td>{{$p->sophong}}</td>
			<td>{{$p->sncur}}</td>
			<td>{{$p->snmax}}</td>
			<td>@if($p->gioitinh=="nam")
					{{"Nam"}}
				@else {{"Nữ"}}
				@endif
			</td>
			<td>{{$p->khuktx->tenkhu}}</td>
			<!-- <td><a href="{{route('cbql_ttphong',$p->id)}}"><button>Xem thông tin</button></a></td> -->
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

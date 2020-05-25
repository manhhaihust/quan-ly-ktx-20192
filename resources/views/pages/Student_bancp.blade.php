@extends('master')
@section('content')
	<h3 style="">
         	<i class="fa fa-arrow-circle-o-right"></i>
                Danh sách thành viên trong phòng           
    </h3>
    @if(count($list)==0)
    	<h4 class="thongbaoNull">Danh sách thành viên phòng trống</h4>
    @else
	<div class="lsdk">
		<table class="table table-bordered table-striped datatable" id="table_export">
			<tr>
				<th>Tên</th>
				<th>Mã số sinh viên</th>
				<th>Ngày sinh</th>
				<th>Lớp</th>
				<th>Khóa</th>
			</tr>
			@foreach($list as $l)
			<tr>
				<td>{{$l->name}}</td>
				<td>{{$l->mssv}}</td>
				@foreach($ttsv as $t)
					@if($l->mssv == $t->mssv)
						<td>{{$t->nssv}}</td>
						<td>{{$t->lop}}</td>
						<td>{{$t->khoa}}</td>
					@endif
				@endforeach
			</tr>
			@endforeach
		</table>
	</div>
	@endif
@endsection
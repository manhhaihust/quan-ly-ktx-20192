@extends('master')
@section('content')
	<h3 style="">
         <i class="fa fa-arrow-circle-o-right"></i>
            Danh sách sinh viên
    </h3>
    @if(count($list)==0)
    	<h4 class="thongbaoNull">Phòng chưa có sinh viên đăng ký</h4>
    @else
	<table class="table table-bordered table-striped datatable" id="table_export">
		<tr>
			<th>Mssv</th>
			<th>Họ tên</th>
			<th>Trạng thái đăng ký</th>
			<th>Xem thông tin</th>
			<th>Xóa sinh viên</th>
		</tr>
		@foreach($list as $l)
		<tr>
			<td>{{$l->mssv}}</td>
			<td>{{$l->name}}</td>
			<td>
					<span @if($l->trangthaidk=="registered")
								class="label label-warning"
							@elseif($l->trangthaidk=="success")
								class="label label-success"
							@elseif($l->trangthaidk=="cancelled")
								class="label label-danger"
							@else class="label label-success"
							@endif
							style="font-size: 15px;">{{$l->trangthaidk}}</span>
				</td>
			<td><a href="{{route('get_cbql_ttsv',$l->mssv)}}"><button>Xem</button></a></td>
			<td><a href="{{route('get_cbql_xoasv',$l->mssv)}}"><button>Xóa</button></a></td>
		</tr>
		@endforeach
	</table>
	@endif
@endsection

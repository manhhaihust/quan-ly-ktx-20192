@extends('master')
@section('title','List manager')
@section('content')
	<h3 style="">
        <i class="entypo-right-circled"></i>
        Cán bộ quản lý
    </h3>        
    <table class="table table-bordered datatable" id="table_export">
        <thead>
            <tr>
            	<th width="100"><div>Ảnh</div></th>
                <th><div>Tên</div></th>
                <th><div>E-mail</div></th>
                <th><div>Xem thông tin</div></th>
                <th><div>Xóa tài khoản</div></th>
            </tr>
        </thead>
        <tbody>
        	@foreach($manager as $temp)
        		<tr>
        			<td><img src="img/{{$temp->image}}"></td>
        			<td>{{$temp->name}}</td>
        			<td>{{$temp->email}}</td>
                    <td><a href="{{route('admin_details_cb',$temp->id)}}"><button>Xem</button></a></td>
                    <td><a href="{{route('admin_delete_cb',$temp->id)}}"><button>Xóa</button></a></td>
        		</tr>
        	@endforeach
        </tbody>
    </table>
@endsection
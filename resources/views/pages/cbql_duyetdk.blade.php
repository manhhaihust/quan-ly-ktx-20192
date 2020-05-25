@extends('master')
@section('content')
    <h3 style="">
         <i class="fa fa-arrow-circle-o-right"></i>
            Danh sách sinh viên đăng ký phòng        
    </h3>
    @if(count($list)==0)
        <h4 class="thongbaoNull">Danh sách sinh viên đăng ký trống</h4>
    @else
    <table class="table table-bordered table-striped datatable" id="table_export">
        <tr>
            <th>Mssv</th>
            <th>Họ tên</th>
            <th>Phòng</th>
            <th>Trạng thái đăng ký</th>
            <th>Ngày đăng ký</th>
            <th>Xem thông tin</th>
            <th>Chấp nhận</th>
            <th>Hủy bỏ</th>
        </tr>
        @foreach($list as $l)
        <tr>
            <td>{{$l->mssv}}</td>
            <td>{{$l->name}}</td>
            <td>
                @foreach($ttphong as $t)
                    @if($t->id==$l->id_phong)
                        {{$t->sophong}}
                    @endif
                @endforeach
            </td>
            <td>{{$l->trangthaidk}}</td>
            <td>{{$l->ngaydk}}</td>
            <td><a href="{{route('get_cbql_ttsv',$l->mssv)}}"><button>Xem</button></a></td>
            <td><a href="{{route('get_cbql_duyetdk',$l->mssv)}}"><button>Duyệt</button></a></td>
            <td><a href="{{route('get_cbql_huydk',$l->mssv)}}"><button>Hủy</button></a></td>
        </tr>
        @endforeach
    </table>
    @endif
@endsection
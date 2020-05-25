@extends('master')
@section('content')
    <div class="container-content">
        @if(isset($ttphong))
            <div class="list_phong">
                <h3 style="">
                    <i class="fa fa-arrow-circle-o-right"></i>
                    Danh sách phòng
                </h3>
                @if(Session::has('flag'))
                    <div class="error"><p>{{Session::get('message')}}</p></div>
                @endif
                <table class="table table-bordered table-striped datatable" id="table_export">
                    <tr>
                        <th>Số phòng</th>
                        <th>Số người đk hiện tại</th>
                        <th>Số người tối đa</th>
                        <th>Giới tính</th>
                        <th>Đăng ký</th>
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
                            <td><a href="{{route('get_student_dkphong',$p->id)}}"><button>Đăng ký</button></a></td>
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
        @else
            <h3 style="">
                <i class="fa fa-arrow-circle-o-right"></i>
                Danh sách khu ở
            </h3>
            <table class="table table-bordered table-striped datatable" id="table_export">
                <tr>
                    <th>STT</th>
                    <th>Tên Khu ở</th>
                    <th>Giá phòng</th>
                    <th>Danh sách phòng</th>
                </tr>
                @foreach($ttkhu as $k)
                    <tr>
                        <td>{{$k->id}}</td>
                        <td>{{$k->tenkhu}}</td>
                        <td>{{$k->giaphong}}</td>
                        <td><a href="{{route('student_chonphong',$k->id)}}"><button>Xem</button></a></td>
                    </tr>
                @endforeach
            </table>
    </div>
    </div>
    @endif
@endsection

@extends('master')
@section('content')
    <h3 style="">
        <i class="fa fa-arrow-circle-o-right"></i>
        Lịch sử đăng ký
    </h3>
    @if(count($lsdk)!=0)
        <div class="lsdk">
            <table class="table table-bordered table-striped datatable" id="table_export">
                <thead>
                <tr>
                    <th>Phòng đã đăng ký</th>
                    <th>Năm đăng ký</th>
                    <th>Trạng thái đăng ký</th>
                    <th>Ngày đăng ký</th>
                    <th>Ngày duyệt</th>
                    <th>Lệ phí ở</th>
                    <th>Mã số cán bộ xác nhận</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lsdk as $l)
                    <tr>
                        <td>
                            @foreach($ttphong as $t)
                                @if($t->id == $l->id_phong)
                                    @foreach($ttkhu as $k)
                                        @if($k->id == $t->id_khu)
                                            {{$k->tenkhu."-".$t->sophong}}
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </td>
                        <td>{{$l->nam}}</td>
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
                        <td>{{$l->ngaydk}}</td>
                        <td>{{$l->updated_at}}</td>
                        <td>{{$l->lephi}}</td>
                        <td>{{$l->mscb}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </div>
    @else
        <div>
            <h4 class="thongbaoNull">Lịch sử đăng ký trống</h4>
        </div>
    @endif
@endsection

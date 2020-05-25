@extends('master')
@section('content')
<h3 style="">
    <i class="fa fa-arrow-circle-o-right"></i>
    Thông tin sinh viên
</h3>
﻿<div class="row">
        <div class="col-xs-6 col-left"></div>
        <div class="col-xs-6 col-right">
            <div class="dataTables_filter" id="table_export_filter">
                <form action="{{url('post_cbql_ttsv')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }} ">
                    <label>Nhập mã số sinh viên: <input type="text" name="mssv" required=""></label>
                    <button type="submit">Tìm kiếm</button>
                    @if(Session::has('flag'))
                        <div class="error"><p>{{Session::get('message')}}</p></div>
                    @endif
                </form>
            </div>
        </div>
    <div class="col-md-12">
        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-user"></i>
                    Thông tin sinh viên
                </a>
            </li>
        </ul>
        </div>
        <!------CONTROL TABS END------>
        @if(isset($ttsv))
        <div class="tab-content">
            <!----EDITING FORM STARTS-->
            <div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
                    <form action="" method="post" class="form-horizontal form-groups-bordered validate" target="_top" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tên</label>
                            <div class="col-sm-5">
                                <label class=" control-label">{{$name}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">E-mail</label>
                            <div class="col-sm-5">
                                <label class=" control-label">{{$ttsv->email}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Mã số sinh viên</label>
                            <div class="col-sm-5">
                                <label class=" control-label">{{$ttsv->mssv}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Số điện thoại</label>
                            <div class="col-sm-3">
                                <label class=" control-label">{{$ttsv->sdt}}</label>
                            </div>
                            <label class="col-sm-2 control-label">Ngày sinh</label>
                            <div class="col-sm-3">
                                <label class=" control-label">{{$ttsv->nssv}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Giới tính</label>
                            <div class="col-sm-3">
                                <label class=" control-label">
                                    @if($ttsv->gtsv=="nam") {{"Nam"}}
                                    @else {{"Nữ"}}
                                    @endif</label>
                            </div>
                            <label class="col-sm-2 control-label">Quê Quán</label>
                            <div class="col-sm-3">
                                <label class=" control-label">{{$ttsv->qqsv}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Lớp</label>
                            <div class="col-sm-3">
                                <label class=" control-label">{{$ttsv->lop}}</label>
                            </div>
                            <label class="col-sm-2 control-label">Khóa</label>
                            <div class="col-sm-3">
                                <label class=" control-label">{{$ttsv->khoa}}</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <h3 style="">
            <i class="fa fa-arrow-circle-o-right"></i>
                Lịch sử đăng ký
        </h3>
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
                            {{$t->sophong}}
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
        </div>
        @endif
    </div>

</div>
@endsection

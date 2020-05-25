@extends('master')
@section('content')
<h3 style="">
    <i class="fa fa-arrow-circle-o-right"></i>
    Thống kê chỗ ở
</h3>
﻿<div class="row">
    <div class="col-md-12">
        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-user"></i>
                    Chọn năm
                </a>
            </li>
        </ul>
        <div class="col-sm-3">
            <form action="{{url('post_cbql_thongke')}}" method="post" class="form-horizontal form-groups-bordered validate" target="_top" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }} ">
                <select name="nam" class="form-control required">
                    @if(isset($year))
                        @foreach($list_nam as $l)
                        @if($year==$l->nam)
                            <option selected value="{{$l->nam}}">{{$year}}</option>
                        @else
                            <option value="{{$l->nam}}">{{$l->nam}}</option>
                        @endif
                        @endforeach
                    @else
                        <option value="">Chọn năm</option>
                        @foreach($list_nam as $l)
                            <option value="{{$l->nam}}">{{$l->nam}}</option>
                        @endforeach
                    @endif
                </select>
                <div class="col-sm-offset-3 col-sm-5">
                    <button type="submit" class="btn btn-info">Xem thống kê</button>
                </div>
            </form>
        </div>
        @if(isset($year))
        <div class="tab-content">
            <!----EDITING FORM STARTS-->
            <div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
                    <h3><i class="fa fa-arrow-circle-o-right"></i>Thống kê năm {{$year}}</h3>
                    <form action="" method="post" class="form-horizontal form-groups-bordered validate" target="_top" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tống số chỗ ở nam</label>
                            <div class="col-sm-3">
                                <label class=" control-label">{{$nam}}</label>
                            </div>
                            <label class="col-sm-2 control-label">Tống số chỗ ở nữ</label>
                            <div class="col-sm-3">
                                <label class=" control-label">{{$nu}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Số chỗ ở nam chưa có người đăng ký</label>
                            <div class="col-sm-3">
                                <label class=" control-label">{{$nam-$nam_dkcur}}</label>
                            </div>
                            <label class="col-sm-2 control-label">Số chỗ ở nữ chưa có người đăng ký</label>
                            <div class="col-sm-3">
                                <label class=" control-label">{{$nu-$nu_dkcur}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Số sinh viên lưu trú trong năm</label>
                            <div class="col-sm-3">
                                <label class=" control-label">{{$total_student}}</label>
                            </div>
                            <label class="col-sm-2 control-label">Số lệ phí sinh viên đã nộp</label>
                            <div class="col-sm-3">
                                <label class=" control-label">{{$total_money}}</label>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection

@extends('master')
@section('title','Thông tin cán bộ')
@section('content')
<h3 style="">
    <i class="fa fa-arrow-circle-o-right"></i>
    Tìm kiếm cán bộ           
</h3>
﻿<div class="row">
        <div class="col-xs-6 col-left"></div>
        <div class="col-xs-6 col-right">
            <div class="dataTables_filter" id="table_export_filter">
                <form action="{{url('info')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }} ">
                    <label>Nhập mã số cán bộ: <input type="text" name="mscb" required=""></label>
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
                    Thông tin cán bộ
                </a>
            </li>
        </ul>
        </div>
        <!------CONTROL TABS END------>
        @if(Session::has('flag2'))
                    <div class="error"><p>{{Session::get('message')}}</p></div>
                @endif
        @if(isset($ttcb))
        <div class="tab-content">
            <!----EDITING FORM STARTS-->
            <div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
                    <form action="{{url('update',$ttcb->mscb)}}" method="post" class="form-horizontal form-groups-bordered validate" target="_top" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }} ">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Cán bộ quản lý</label>
                            <div class="col-sm-5">
                                <select name="tenkhu" class="form-control required">
                                    <option value="">Chọn</option>
                                    @if($tenkhu!=null)
                                        <option value="{{$tenkhu}}" selected="">{{$tenkhu}}</option>
                                    @endif
                                    @foreach($ttkhu as $t)
                                        @if($t->tenkhu != $tenkhu)
                                            <option value="{{$t->tenkhu}}">{{$t->tenkhu}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tên</label>
                            <div class="col-sm-5">
                                <label class=" control-label">{{$name}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">E-mail</label>
                            <div class="col-sm-5">
                                <label class=" control-label">{{$ttcb->email}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Mã số cán bộ</label>
                            <div class="col-sm-5">
                                <label class=" control-label">{{$ttcb->mscb}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Số điện thoại</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="phone" value="{{$ttcb->sdt}}" required/>
                            </div>
                            <label class="col-sm-2 control-label">Ngày sinh</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control datepicker " name="birthday" data-format="dd/mm/yyyy" value="{{$ttcb->nscb}}" data-start-view="2" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Giới tính</label>
                            <div class="col-sm-3">
                                <select name="gtcb" class="form-control required">
                                    @if($ttcb->gtcb=="nam")
                                        <option value="">Chọn</option>
                                        <option value="nam" selected>Nam</option>
                                        <option value="nu">Nữ</option>
                                    @elseif($ttcb->gtcb=="nu")
                                        <option value="">Chọn</option>
                                        <option value="nam">Nam</option>
                                        <option value="nu" selected="">Nữ</option>
                                    @else
                                        <option value="">Chọn</option>
                                        <option value="nam">Nam</option>
                                        <option value="nu">Nữ</option>
                                    @endif
                              </select>
                            </div>
                            <label class="col-sm-2 control-label">Quê Quán</label>
                            <div class="col-sm-3">
                                 <input type="text" class="form-control" name="quequan" value="{{$ttcb->qqcb}}" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info">Cập nhật thông tin</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        @endif
</div>
@endsection
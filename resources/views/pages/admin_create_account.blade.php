@extends('master')
@section('title','Tạo tài khoản')
@section('content')
﻿<div class="row">
    <div class="col-md-12">
        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-user"></i>
                    Tài khoản
                </a>
            </li>
        </ul>
        </div>
        <!------CONTROL TABS END------>
        <div class="tab-content">
            <!----EDITING FORM STARTS-->
            <div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
                    @if($errors->has('password'))
                    <div class="error"><p>{{$errors->first('password')}}</p></div>
                @endif
                @if($errors->has('mssv'))
                    <div class="error"><p>{{$errors->first('mssv')}}</p></div>
                @endif
                    <form action="{{url('create')}}" method="post" class="form-horizontal form-groups-bordered validate" target="_top" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }} ">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Mã số cán bộ</label>
                            <div class="col-sm-5">
                                <label class=" control-label">{{$mscb}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                            <label class="col-sm-3 control-label">Tên</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="name" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">E-mail</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="email" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Mật khẩu</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="password" required maxlength="30">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Xác nhận mật khẩu</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="password_confirmation" required maxlength="30">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info">Tạo tài khoản</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
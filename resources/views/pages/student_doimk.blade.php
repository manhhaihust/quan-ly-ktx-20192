@extends('master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-lock"></i>
                    Thay đổi mật khẩu                       
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------>
        <div class="tab-content">
            <!----EDITING FORM STARTS---->
            <div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content padded">
                    <form action="{{url('changePassword')}}" class="form-horizontal form-groups-bordered validate" target="_top" method="post">
                    	<input type="hidden" name="_token" value="{{ csrf_token() }} ">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Mật khẩu hiện tại</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="password_cur" value="" required maxlength="30">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Mật khẩu mới</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="password" required maxlength="30">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Xác nhận mật khẩu mới</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="password_confirmation" required maxlength="30">
                            </div>
                        </div>
                        @if($errors->has('password'))
                        <div class="form-group">
							<div class="error"><label class="col-sm-3 control-label"><p>{{$errors->first('password')}}</p></label></div>
                        </div>
						@endif
							@if(Session::has('flag'))
								<div class="form-group"><div class="error"><label class="col-sm-3 control-label"><p>{{Session::get('message')}}</p></label></div></div>
							@endif
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info">Thay đổi mật khẩu</button>
                            </div>
                         </div>
                    </form>
                </div>                    
            </div>
        </div>
    </div>		
@endsection
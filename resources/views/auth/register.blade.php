@extends('dangnhap_master')
@section('title','Register')
@section('content')
	<form method="post" class="form_login"
        action="{{url('register')}}">
		<div class="form-group">
			<input type="hidden" name="_token" value="{{ csrf_token() }} ">
			<input type="text" class="form-control" name="mssv" placeholder="Mã số sinh viên" maxlength="8">
        </div>
        <div class="form-group">
			<input type="text" class="form-control" name="name" placeholder="Họ tên" maxlength="30">
        </div>
        <div class="form-group">
			<input type="email" class="form-control" name="email" placeholder="Email" maxlength="30">
        </div>
        <div class="form-group">
			<input type="Password" class="form-control" name="password" placeholder="Mật khẩu"
            	required maxlength="30">
        </div>
        <div class="form-group">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Xác nhận mật khẩu" required maxlength="30">
        </div>
        <div class="form-check">
			<button type="submit" class="btn btn-primary">Đăng ký</button>
			@if($errors->has('password'))
				<span id="msg" class="errorMsg">{{$errors->first('password')}}</span>
			@endif
			@if($errors->has('mssv'))
				<span id="msg" class="errorMsg">{{$errors->first('mssv')}}</span>
			@endif
			@if(Session::has('flag'))
				<span id="msg" class="errorMsg">{{Session::get('message')}}</span>
			@endif
		</div>
	</form>
@endsection
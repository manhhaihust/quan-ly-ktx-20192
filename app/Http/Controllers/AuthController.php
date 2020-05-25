<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use App\users;
use App\User;
use Hash;
use App\sinhvien;
use App\canboquanly;

class AuthController extends Controller
{
    public function getLogin() {
        if(Auth::check()){
            return redirect()->back();
        } else {
    	   return view('auth.login');
        }
    }
    public function postLogin(Request $request) {
    	$rules = [
    		'email' =>'required|email',
    		'password' => 'required|min:6'
    	];
    	$messages = [
    		'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
    	];
    	$validator = Validator::make($request->all(), $rules, $messages);

    	if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	} else {
    		$email = $request->input('email');
    		$password = $request->input('password');

    		if( Auth::attempt(['email' => $email, 'password' =>$password])) {
    			return redirect()->intended('/');
    		} else {
    			return redirect()->back()->with(['flag'=>'danger','message'=>'Tài khoản hoặc mật khẩu không chính xác']);
    		}
    	}
	}
	public function logout(){
		Auth::logout();
		return redirect('login');
	}
    public function getRegister() {
        return view('auth.register');
    }
    public function postRegister(Request $request){
        $rules = [
            'email' =>'required|email',
            'password' => 'required|min:6|confirmed',
            'mssv' => 'required|min:8'
        ];
        $messages = [
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không đúng',
            'mssv.min' => 'Mã số sinh viên có độ dài là 8 ký tự'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $email = $request->input('email');
            $count = users::where('email',$email)->count();
            if($count>0){
                return redirect()->back()->with(['flag'=>'danger','message'=>'Email đã được sử dụng']);   
            }
            else{
                $mssv = $request->input(('mssv'));
                $count1 = sinhvien::where('mssv',$mssv)->count();
                if($count1>0){
                    return redirect()->back()->with(['flag'=>'danger','message'=>'Mssv đã được sử dụng']);    
                }
                else{
                    $user = new User();
                    sinhvien::insert(['mssv'=>$mssv,'email'=>$email]);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = Hash::make($request->password);
                    $user->image = "user.jpg";
                    $user->ltk = "sinhvien";
                    $user->save();
                    return redirect()->route('login')->with(['flag'=>'danger','message'=>'Tạo thành khoản thành công, mời bạn đăng nhập']);
                }   
            }
        }
    }
    public function getForgot() {
        return view('auth.forgot');
    }

    public function admin_create_account(Request $request){
         $rules = [
            'email' =>'required|email',
            'password' => 'required|min:6|confirmed'
        ];
        $messages = [
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không đúng'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $email = $request->input('email');
            $count = users::where('email',$email)->count();
            if($count>0){
                return redirect()->back()->with(['flag'=>'danger','message'=>'Email đã được sử dụng']);   
            }
            else{
                $mscb = canboquanly::max('mscb') + 1;
                $user = new User();
                canboquanly::insert(['mscb'=>$mscb,'email'=>$email]);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->image = "user.jpg";
                $user->ltk = "quanly";
                $user->save();
                $id = users::where('email',$email)->value('id');
                return redirect()->route('admin_details_cb',$id)->with(['flag2'=>'danger','message'=>'Tạo thành khoản thành công, mời cập nhật thông tin cán bộ']);

            }
        }
    }
}

?>
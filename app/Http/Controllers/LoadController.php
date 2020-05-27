<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\phieudangky;
use App\canboquanly;
use App\sinhvien;
use Illuminate\Support\Facades\Auth;
use App\phong;
use App\khuktx;
use App\users;
use DB;
use Validator;

use Illuminate\Support\MessageBag;

class LoadController extends Controller
{
    #============================================CBQL===================================================================
    #-----------Xét duyệt đăng kí---------------------------------------------------------------------------------------
    public function get_cbql_duyetdk($mssv){
         $mscb = canboquanly::where('email',Auth::user()->email)->value('mscb');
         phieudangky::where([
            ['mssv',$mssv],
            ['nam',date('Y')],
         ])->update(['trangthaidk'=>"success",'mscb'=>$mscb]);
         return redirect()->back();
      }

      public function get_cbql_huydk($mssv){
         $mscb = canboquanly::where('email',Auth::user()->email)->value('mscb');
         $id_phong = phieudangky::where([
            ['mssv',$mssv],
            ['nam',date('Y')],
         ])->value('id_phong');
         $sncur = phong::where('id',$id_phong)->value('sncur');
         $sncur = $sncur-1;
         phieudangky::where([
            ['mssv',$mssv],
            ['nam',date('Y')],
         ])->update(['trangthaidk'=>"cancelled",'mscb'=>$mscb]);
         phong::where('id',$id_phong)->update(['sncur'=>$sncur]);
         return redirect()->back();
      }

    #-----------Xem thông tin phòng-------------------------------------------------------------------------------------
    public function cbql_ttphong($id){
        $list = phieudangky::where([
            ['id_phong',$id],
            ['nam',date('Y')],
            ['trangthaidk','!=','cancelled']
        ])->get();
        return view('pages.cbql_ttphong',['list'=>$list]);
    }

    #-----------Xoa SV trong phòng--------------------------------------------------------------------------------------
    public function get_cbql_xoasv($mssv){
        $id_phong = phieudangky::where([
            ['mssv',$mssv],
            ['nam',date('Y')],
        ])->value('id_phong');
        $sncur = phong::where('id',$id_phong)->value('sncur');
        $sncur = $sncur-1;
        phieudangky::where([
            ['mssv',$mssv],
            ['nam',date('Y')],
        ])->update(['trangthaidk'=>"cancelled"]);
        phong::where('id',$id_phong)->update(['sncur'=>$sncur]);
        return redirect()->back();
    }

    #--------Tim kiếm SV theo MSSV--------------------------------------------------------------------------------------
    public function get_cbql_ttsv($mssv){
        $id_khu = canboquanly::where('email',Auth::user()->email)->value('id_khu');
        $max = phong::where('id_khu',$id_khu)->max('id');
        $count = phong::where('id_khu',$id_khu)->count();
        $countsv = sinhvien::where('mssv',$mssv)->count();
        $list_phong = phong::where('id_khu',$id_khu)->pluck('id');
        $countdk = phieudangky::where([
            ['mssv',$mssv],
            ['trangthaidk','!=','cancelled']
        ])->whereIn('id_phong',$list_phong)->count();
        $lsdk = phieudangky::where([
            ['mssv',$mssv],
            ['trangthaidk','!=','cancelled']
        ])->whereIn('id_phong',$list_phong)->orderBy('nam','desc')->get();
        $countdk = count($lsdk);
        $ttphong = phong::all();
        if ($countsv!=1) {
            return redirect('cbql_ttsv')->with(['flag'=>'danger','message'=>'Không tồn tại sinh viên']);
        }
        elseif($countdk==0){
            return redirect('cbql_ttsv')->with(['flag'=>'danger','message'=>'Sinh viên chưa đăng ký ở khu này']);
        }
        else{
            $ttsv = sinhvien::where('mssv',$mssv)->first();
            $name = users::where('email',$ttsv->email)->value('name');
            return view('pages.cbql_ttsv',['ttsv'=>$ttsv,'name'=>$name,'ttphong'=>$ttphong,'lsdk'=>$lsdk]);
        }
    }

    public function post_cbql_ttsv(Request $request){
        $id_khu = canboquanly::where('email',Auth::user()->email)->value('id_khu');
        $mssv = $request->input('mssv');
        $list_phong = phong::where('id_khu',$id_khu)->pluck('id');
        $countsv = sinhvien::where('mssv',$mssv)->count();
        $countdk = phieudangky::where([
            ['mssv',$mssv],
            ['trangthaidk','!=','cancelled']
        ])->whereIn('id_phong',$list_phong)->count();
        $lsdk = phieudangky::where([
            ['mssv',$mssv],
            ['trangthaidk','!=','cancelled']
        ])->whereIn('id_phong',$list_phong)->orderBy('nam','desc')->get();
        $ttphong = phong::all();
        if ($countsv!=1) {
            return redirect('cbql_ttsv')->with(['flag'=>'danger','message'=>'Không tồn tại sinh viên']);
        }
        elseif($countdk==0){
            return redirect('cbql_ttsv')->with(['flag'=>'danger','message'=>'Sinh viên chưa đăng ký ở khu này']);
        }
        else{
            $ttsv = sinhvien::where('mssv',$mssv)->first();
            $name = users::where('email',$ttsv->email)->value('name');
            return view('pages.cbql_ttsv',['ttsv'=>$ttsv,'name'=>$name,'ttphong'=>$ttphong,'lsdk'=>$lsdk]);
        }
    }



    public function post_cbql_thongke(Request $request){
        $data = DB::table('sinhvien')->join('phieudangky','phieudangky.mssv','=','sinhvien.mssv')->join('phong','phieudangky.id_phong','=','phong.id')->get();
        $year = $request->input('nam');
        $list_nam = phieudangky::select('nam')->groupBy('nam')->get();
        $id_khu = canboquanly::where('email',Auth::user()->email)->value('id_khu');
        $list_phong = phong::where('id_khu',$id_khu)->pluck('id');
        $nam = phong::where([
            ['id_khu',$id_khu],
            ['gioitinh','nam'],
        ])->sum('snmax');
        $nu = phong::where([
            ['id_khu',$id_khu],
            ['gioitinh','nu']
        ])->sum('snmax');
        $nam_dkcur=0;
        $nu_dkcur=0;
        foreach ($data as $d) {
            if (($d->nam==$year)&&($d->id_khu==$id_khu)&&($d->trangthaidk!='cancelled')) {
                if($d->gtsv=='nam'){$nam_dkcur = $nam_dkcur+1;}
                else{$nu_dkcur = $nu_dkcur+1;}
            }
        }
        $total_student = phieudangky::where([
            ['nam',$year],
            ['trangthaidk','!=','cancelled'],
            ['trangthaidk','!=','registered']
        ])->whereIn('id_phong',$list_phong)->count();
        $total_money = phieudangky::where([
            ['nam',$year],
            ['trangthaidk','!=','cancelled'],
            ['trangthaidk','!=','registered']
        ])->whereIn('id_phong',$list_phong)->sum('lephi');
        return view('pages.cbql_thongke',['nam'=>$nam,'nu'=>$nu,'nam_dkcur'=>$nam_dkcur,'nu_dkcur'=>$nu_dkcur,'total_student'=>$total_student,'total_money'=>$total_money,'list_nam'=>$list_nam,'year'=>$year]);
    }


#=======================================================================================================================

#============================================STUDENT====================================================================
#-------Sinh viên đăng kí phòng-----------------------------------------------------------------------------------------

#----------Đăng_kí_phòng_ở------------------------------------------------------------------------------------------

    public function get_student_dkphong($id){
        $ttsv = sinhvien::where('email',Auth::user()->email)->first();
        $ttphong = phong::where('id',$id)->first();
        $id_khu = $ttphong->id_khu;
        $giaphong = khuktx::where('id',$id_khu)->value('giaphong');
        $mssv = $ttsv->mssv;
        $gtsv = $ttsv->gtsv;
        $sncur = $ttphong->sncur;
        $snmax = $ttphong->snmax;
        $gioitinh = $ttphong->gioitinh;
        $count = phieudangky::where([
            ['mssv',$mssv],
            ['nam',date('Y')],
            ['trangthaidk','!=','cancelled']
        ])->count();
        $count1 = phieudangky::where([
            ['mssv',$mssv],
            ['nam',date('Y')],
            ['trangthaidk','=','cancelled']
        ])->count();
        if($gtsv==""){
            return redirect()->back()->with(['flag'=>'danger','message'=>'Vui lòng cập nhật thông tin cá nhân  ']);
        }
        else{
            if($count!=0){
                return redirect()->back()->with(['flag'=>'danger','message'=>'Sinh viên đã đăng ký ở năm nay']);
            }
            elseif($gtsv!=$gioitinh){
                return redirect()->back()->with(['flag'=>'danger','message'=>'Giới tính không đúng']);
            }
            elseif ($sncur>=$snmax) {
                return redirect()->back()->with(['flag'=>'danger','message'=>'Phòng đã đầy']);
            }
            else{
                if($count1==0){
                    phieudangky::insert(['id_phong'=>$id,'mssv'=>$mssv,'nam'=>date('Y'),'trangthaidk'=>'registered','ngaydk'=>date('Y-m-d'),'lephi'=>$giaphong*(13-date('m')),'name'=>Auth::user()->name]);
                    $sncur=$sncur+1;
                    DB::table('phong')->where('id',$id)->update(['sncur'=>$sncur]);
                    return redirect('student_xemdk');
                }
                else{
                    phieudangky::where([
                        ['mssv',$mssv],
                        ['nam',date('Y')]
                    ])->update(['trangthaidk'=>'registered']);
                    $sncur=$sncur+1;
                    DB::table('phong')->where('id',$id)->update(['sncur'=>$sncur]);
                    return redirect('student_xemdk');
                }
            }}
    }

    #-------Sinh viên sửa thông tin-------------------------------------------------------------------------------------
    #----------Thay đổi thông tin cá nhân-------------------------------------------------------------------------------

    public function getStudent_chinhsua(){
        return view('pages.Student_chinhsua');
    }

    public function student_suatt(Request $request){
        $nssv = $request->input('birthday');
        $gtsv = $request->input('gtsv');
        $lop = $request->input('lop');
        $khoa = $request->input('khoa');
        $qqsv = $request->input('qqsv');
        $sdt = $request->input('phone');
        $mssv = sinhvien::where('email',Auth::user()->email)->value('mssv');
        $count = phieudangky::where('mssv',$mssv)->count();
        if($count!=0){
            sinhvien::where('email',Auth::user()->email)->update(['nssv'=>$nssv,'lop'=>$lop,'khoa'=>$khoa,'qqsv'=>$qqsv,'sdt'=>$sdt]);
            return redirect()->back()->with(['flag2'=>'danger','message'=>'Cập nhật thông tin thành công']);
        }
        else{
            sinhvien::where('email',Auth::user()->email)->update(['nssv'=>$nssv,'gtsv'=>$gtsv,'lop'=>$lop,'khoa'=>$khoa,'qqsv'=>$qqsv,'sdt'=>$sdt]);
            return redirect()->back()->with(['flag2'=>'danger','message'=>'Cập nhật thông tin thành công']);
        }
    }

    #----------Sinh viên đổi mật khẩu-----------------------------------------------------------------------------------
    #----------Thay đổi mật khẩu----------------------------------------------------------------------------------------
    public function changePassword(Request $request){
        $rules = [
            'password' => 'required|min:6|confirmed'
        ];
        $messages = [
            'password.min' => 'Mật khẩu mới phải chứa ít nhất 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không đúng'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else {
            $email = Auth::user()->email;
            $password = $request->input('password_cur');
            $password_new = $request->input('password');

            if( Auth::attempt(['email' => $email, 'password' =>$password])) {
                users::where('email',$email)->update(['password'=>bcrypt($password_new)]);
                return redirect()->back()->with(['flag'=>'success','message'=>'Đổi mật khẩu thành công']);;
            }
            else {
                return redirect()->back()->with(['flag'=>'danger','message'=>'Mật khẩu không chính xác']);
            }
        }
    }
  

    #-----------------------------Admin-------------------------------------------
        public function admin_details_cb($id){
            $email = users::where('id',$id)->value('email');
            $name = users::where('id',$id)->value('name');
            $ttcb = canboquanly::where('email',$email)->first();
            $ttkhu = khuktx::all();
            $tenkhu = khuktx::where('id',$ttcb->id_khu)->value('tenkhu');
            return view('pages.admin_info_cb',['ttcb'=>$ttcb,'tenkhu'=>$tenkhu,'name'=>$name,'ttkhu'=>$ttkhu]);
        }
        public function admin_delete_cb($id){
            $email = users::where('id',$id)->value('email');
            canboquanly::where('email',$email)->delete();
            users::where('email',$email)->delete();
            return redirect()->back();
        }
        public function post_admin_info_cb(Request $request){
            $mscb = $request->input('mscb');
            $count = canboquanly::where('mscb',$mscb)->count();
            if($count!=1){
                return redirect('info')->with(['flag'=>'danger','message'=>'Mã số cán bộ quản lý không tồn tại']);
            }
            else{
                $ttcb = canboquanly::where('mscb',$mscb)->first();
                $name = users::where('email',$ttcb->email)->value('name');
                $ttkhu = khuktx::all();
                $tenkhu = khuktx::where('id',$ttcb->id_khu)->value('tenkhu');
                return view('pages.admin_info_cb',['ttcb'=>$ttcb,'tenkhu'=>$tenkhu,'name'=>$name,'ttkhu'=>$ttkhu]);
            }
        }

        public function admin_update_cb(Request $request,$mscb){
            $tenkhu = $request->input('tenkhu');
            $sdt = $request->input('phone');
            $nscb = $request->input('birthday');
            $gtcb = $request->input('gtcb');
            $quequan = $request->input('quequan');
            $id_khu = khuktx::where('tenkhu',$tenkhu)->value('id');
            canboquanly::where('mscb',$mscb)->update(['nscb'=>$nscb,'gtcb'=>$gtcb,'qqcb'=>$quequan,'sdt'=>$sdt,'id_khu'=>$id_khu]);
            $email = canboquanly::where('mscb',$mscb)->value('email');
            $id = users::where('email',$email)->value('id');
            return redirect()->route('admin_details_cb',$id)->with(['flag2'=>'danger','message'=>'Cập nhật thông tin thành công']);;
        }
        public function post_admin_statics(Request $request){
            $data = DB::table('sinhvien')->join('phieudangky','phieudangky.mssv','=','sinhvien.mssv')->join('phong','phieudangky.id_phong','=','phong.id')->get();
            $year = $request->input('nam');
            $id_khu = $request->input('mskhu');
            $list_phong = phong::where('id_khu',$id_khu)->pluck('id');
            if (isset($year)&&isset($id_khu)){
                $list_nam = phieudangky::select('nam')->groupBy('nam')->get();
                $nam = phong::where([
                    ['id_khu',$id_khu],
                    ['gioitinh','nam'],
                ])->sum('snmax');
                $nu = phong::where([
                    ['id_khu',$id_khu],
                    ['gioitinh','nu']
                ])->sum('snmax');
                $nam_dkcur=0;
                $nu_dkcur=0;
                foreach ($data as $d) {
                    if (($d->nam==$year)&&($d->id_khu==$id_khu)&&($d->trangthaidk!='cancelled')) {
                        if($d->gtsv=='nam'){$nam_dkcur = $nam_dkcur+1;}
                        else{$nu_dkcur = $nu_dkcur+1;}
                    }
                }
                $total_student = phieudangky::where([
                    ['nam',$year],
                    ['trangthaidk','!=','cancelled'],
                    ['trangthaidk','!=','registered']
                ])->whereIn('id_phong',$list_phong)->count();
                $total_money = phieudangky::where([
                    ['nam',$year],
                    ['trangthaidk','!=','cancelled'],
                    ['trangthaidk','!=','registered']
                ])->whereIn('id_phong',$list_phong)->sum('lephi');
                $list_khu = khuktx::all();
                $khu = khuktx::where('id',$request->input('mskhu'))->value('tenkhu'); 
                return view('pages.admin_statics',['nam'=>$nam,'nu'=>$nu,'nam_dkcur'=>$nam_dkcur,'nu_dkcur'=>$nu_dkcur,'total_student'=>$total_student,'total_money'=>$total_money,'list_nam'=>$list_nam,'year'=>$year,'list_khu'=>$list_khu,'khu'=>$khu]);
            } else {
                return redirect('statics');
            }
            
        }

    #-----------------------------------------------------------------------------
}


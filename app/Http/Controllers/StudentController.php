<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\phong;
use App\khuktx;
use App\sinhvien;
use App\phieudangky;
use App\canboquanly;
use App\users;
use DB;

use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    #----------Đăng_kí_phòng_ở------------------------------------------------------------------------------------------
    public function student_dkphong(){
        $ttkhu = khuktx::ALL();
        return view('pages.Student_dkphong', ['ttkhu' => $ttkhu]);
    }

    public function student_chonphong($id){
        $ttphong = phong::where('id_khu', '=', $id)->paginate(7);
        return view('pages.Student_dkphong', ['ttphong' => $ttphong]);
    }

    #----------Xem_trạng thái đăng_kí-----------------------------------------------------------------------------------
    public function student_xemdk(){
        $mssv = sinhvien::where('email',Auth::user()->email)->value('mssv');
        $lsdk = phieudangky::where('mssv','=',$mssv)->get();
        $ttphong = phong::all();
        $ttkhu = khuktx::all();
        return view('pages.Student_xemdk',['lsdk'=>$lsdk,'ttphong'=>$ttphong,'ttkhu'=>$ttkhu]);
    }

    #----------Thông_tin_cá_nhân----------------------------------------------------------------------------------------
    public function student_ttcn(){
        $ttsv = sinhvien::where('email', Auth::user()->email)->first();
        return view('pages.Student_ttcn', ['ttsv' => $ttsv]);
    }

    #----------Thành_viên_cùng_phòng------------------------------------------------------------------------------------
    public function student_bancp(){
        $mssv = sinhvien::where('email',Auth::user()->email)->value('mssv');
        $id_phong = phieudangky::where([
            ['mssv',$mssv],
            ['nam',date('Y')],
            ['trangthaidk','success']
        ])->value('id_phong');
        $list = phieudangky::where([
            ['nam',date('Y')],
            ['trangthaidk','success'],
            ['id_phong',$id_phong]
        ])->get();
        $ttsv = sinhvien::all();
        return view('pages.Student_bancp',['list'=>$list,'ttsv'=>$ttsv]);
    }
    #----------Đổi mật khẩu---------------------------------------------------------------------------------------------
    public function student_doimk(){
        return view('pages.Student_doimk');
    }

    #----------Cán_bộ_quản_lý-------------------------------------------------------------------------------------------
    public function student_cbql(){
        $cbql = users::where('ltk', 'quanly')->get();
        return view('pages.Student_cbql', ['cbql' => $cbql]);
    }
}



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

class CanboController extends Controller
{

    #----------------Xem Danh sách phòng--------------------------------------------------------------------------------
    public function ql_phong(){
        $id_khu = canboquanly::where('email',Auth::user()->email)->value('id_khu');
        $ttphong = phong::where('id_khu',$id_khu)->orderBy('id', 'desc')->paginate(7);
        return view('pages.cbql_phong', ['ttphong' => $ttphong]);
    }
    #----------------Thêm phòng--------------------------------------------------------------------------------
    public function them_phong(Request $request){
        $id_khu = canboquanly::where('email',Auth::user()->email)->value('id_khu');
        $phong = new phong();
        $phong->sophong = $request->sophong;
        $phong->id_khu = $id_khu;
        $phong->snmax = $request->snmax;
        $phong->gioitinh = $request->gioitinh;
        $phong->save();
        return redirect()->back();
    }
    #-------------Xem thông tin Sinh viên ------------------------------------------------------------------------------
    public function cbql_ttsv(){
        return view('pages.cbql_ttsv');
    }
    public function cbql_cpsv(){
        return view('pages.cbql_cpsv');
    }

    #---------------Duyệt ĐK--------------------------------------------------------------------------------------------
    public function cbql_duyetdk(){
        $id_khu = canboquanly::where('email',Auth::user()->email)->value('id_khu');
        $ttphong = phong::where('id_khu',$id_khu)->get();
        $list_phong = phong::where('id_khu',$id_khu)->pluck('id');
        $list = phieudangky::where([
            'nam' => date('Y'),
            'trangthaidk' => 'registered',
        ])->whereIn('id_phong',$list_phong)->get();
        return view('pages.cbql_duyetdk',['list'=>$list,'ttphong'=>$ttphong]);
    }

    public function cbql_thongke(){
        $list_nam = phieudangky::select('nam')->groupBy('nam')->get();
        $year = Date('Y');
        $id_khu = canboquanly::where('email',Auth::user()->email)->value('id_khu');
        $list_phong = phong::where('id_khu',$id_khu)->pluck('id');
        $max = phong::where('id_khu',$id_khu)->max('id');
        $count = phong::where('id_khu',$id_khu)->count();
        $nam = phong::where([
            ['id_khu',$id_khu],
            ['gioitinh','nam']
        ])->sum('snmax');
        $nu = phong::where([
            ['id_khu',$id_khu],
            ['gioitinh','nu']
        ])->sum('snmax');
        $nam_dkcur = phong::where([
            ['id_khu',$id_khu],
            ['gioitinh','nam']
        ])->sum('sncur');
        $nu_dkcur = phong::where([
            ['id_khu',$id_khu],
            ['gioitinh','nu']
        ])->sum('sncur');
        $total_student = phieudangky::where([
            ['nam',date('Y')],
            ['trangthaidk','!=','cancelled'],
            ['trangthaidk','!=','registered']
        ])->whereIn('id_phong',$list_phong)->count();
        $total_money = phieudangky::where([
            ['nam',date('Y')],
            ['trangthaidk','!=','cancelled'],
            ['trangthaidk','!=','registered']
        ])->whereIn('id_phong',$list_phong)->sum('lephi');

        return view('pages.cbql_thongke',['nam'=>$nam,'nu'=>$nu,'nam_dkcur'=>$nam_dkcur,'nu_dkcur'=>$nu_dkcur,'total_student'=>$total_student,'total_money'=>$total_money,'list_nam'=>$list_nam,'year'=>$year]);
    }
}

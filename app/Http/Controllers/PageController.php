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

class PageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        if(Auth::check()){
            view()->share('user',Auth::user());
            return view('pages.trangchu');
        }
    }
    public function admin_list_cb(){
        $manager = users::where('ltk','quanly')->get();
        return view('pages.admin_list_cb',['manager'=>$manager]);
    }
    public function admin_info_cb(){
        return view('pages.admin_info_cb');
    }
    public function admin_statics(){
        $list_nam = phieudangky::select('nam')->groupBy('nam')->get();
        $list_khu = khuktx::all();
        return view('pages.admin_statics',['list_nam'=>$list_nam,'list_khu'=>$list_khu]);
    }
    public function admin_add_cb(){
        $mscb = canboquanly::max('mscb');
        $mscb = $mscb + 1;
        return view('pages.admin_create_account',['mscb'=>$mscb]);
    }
}
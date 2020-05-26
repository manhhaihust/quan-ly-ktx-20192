<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#=============================================AUTH======================================================================

Route::get('','PageController@index')->name('trangchu');
Route::get('login','AuthController@getLogin')->name('login');
Route::post('login','AuthController@postLogin');
Route::get('logout','AuthController@logout')->name('logout');
Route::get('register','AuthController@getRegister')->name('register');
Route::post('register','AuthController@postRegister');
Route::get('forgot','AuthController@getForgot')->name('forgot');
Route::post('changePassword','LoadController@changePassword');


#=======================================================================================================================

#============================================CBQL=======================================================================
#------------Xem thông tin phòng----------------------------------------------------------------------------------------
Route::get('cbql_phong','CanboController@ql_phong')->name('cbql_phong');
Route::get('cbql_ttphong/{id}','LoadController@cbql_ttphong')->name('cbql_ttphong');
Route::post('cbql_them_phong','CanboController@them_phong')->name('cbql_them_phong');

#------------Xem thông tin sinh viên trong phòng------------------------------------------------------------------------
Route::get('cbql_ttsv','CanboController@cbql_ttsv')->name('cbql_ttsv');
Route::get('cbql_cpsv','CanboController@cbql_cpsv')->name('cbql_cpsv');
Route::get('get_cbql_xoasv/{mssv}','LoadController@get_cbql_xoasv')->name('get_cbql_xoasv');

#-----------Duyệt đăng kí-----------------------------------------------------------------------------------------------

Route::get('cbql_duyetdk','CanboController@cbql_duyetdk')->name('cbql_duyetdk');
Route::get('get_cbql_duyetdk/{mssv}','LoadController@get_cbql_duyetdk')->name('get_cbql_duyetdk');
Route::get('get_cbql_huydk/{mssv}','LoadController@get_cbql_huydk')->name('get_cbql_huydk');
Route::get('get_cbql_ttsv/{mssv}','LoadController@get_cbql_ttsv')->name('get_cbql_ttsv');

#------------Tìm và xem thông tin SV theo MSSV--------------------------------------------------------------------------
Route::get('get_cbql_ttsv/{mssv}','LoadController@get_cbql_ttsv')->name('get_cbql_ttsv');
Route::post('post_cbql_ttsv','LoadController@post_cbql_ttsv')->name('post_cbql_ttsv');

#-----------Thống kê----------------------------------------------------------------------------------------------------
Route::get('cbql_thongke','CanboController@cbql_thongke')->name('cbql_thongke');
Route::post('post_cbql_thongke','LoadController@post_cbql_thongke')->name('post_cbql_thongke');



#=======================================================================================================================

#============================================STUDENT====================================================================

#-------------Đăng_kí_phòng_ở-------------------------------------------------------------------------------------------
Route::get('student_dkphong','StudentController@student_dkphong')->name('student_dkphong');
Route::get('get_student_dkphong/{id}','LoadController@get_student_dkphong')->name('get_student_dkphong');
Route::get('student_chonphong/{id}','StudentController@student_chonphong')->name('student_chonphong');

#-----------Xem trạng thái đăng kí--------------------------------------------------------------------------------------
Route::get('student_xemdk','StudentController@student_xemdk')->name('student_xemdk');

#----------Thông_tin_cá_nhân--------------------------------------------------------------------------------------------
Route::get('student_ttcn','StudentController@student_ttcn')->name('student_ttcn');
Route::get('student_chinhsua','LoadController@getStudent_chinhsua')->name('student_chinhsua');
Route::post('student_chinhsua','LoadController@postStudent_chinhsua')->name('student_chinhsua');
Route::post('student_suatt','LoadController@student_suatt')->name('student_suatt');

#----------Thành_viên_cùng_phòng----------------------------------------------------------------------------------------
Route::get('student_bancp','StudentController@student_bancp')->name('student_bancp');

#---------Thông_tin_cán_bộ----------------------------------------------------------------------------------------------
Route::get('student_cbql','StudentController@student_cbql')->name('student_cbql');

#----------Đổi_mật_khẩu-------------------------------------------------------------------------------------------------
Route::get('student_doimk','StudentController@student_doimk')->name('student_doimk');

#-----------------Admin---------------------
#--------------Danh-sách-cán-bộ-------------
Route::get('list','PageController@admin_list_cb')->name('admin_list_cb');

#--------------Thông-tin-cán-bộ-------------
Route::get('info','PageController@admin_info_cb')->name('admin_info_cb');
Route::post('info','LoadController@post_admin_info_cb');
Route::get('details/{id}','LoadController@admin_details_cb')->name('admin_details_cb');

#--------------Thêm-sửa-xoá-cán-bộ----------
Route::get('add','PageController@admin_add_cb')->name('admin_add_cb');
Route::post('create','AuthController@admin_create_account');
Route::post('update/{mscb}','LoadController@admin_update_cb')->name('admin_update_cb');
Route::get('delete/{id}','LoadController@admin_delete_cb')->name('admin_delete_cb');

#----------------Thống-kê-------------------
Route::get('statics','PageController@admin_statics')->name('admin_statics');
Route::post('statics','LoadController@post_admin_statics');
#-------------------------------------------




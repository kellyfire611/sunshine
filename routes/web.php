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


Route::resource('test', 'TestController');
Route::get('/testa/carbon', function() {
    $value = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', '13/12/2031 23:11:23');
    return $value;
    dd($value);
});

/*
use App\Loai;
Route::get('/danhsachloai', function() {
    // Eloquent Model de lay du lieu
    //$ds_loai = Loai::all(); // SELECT * FROM cusc_loai
    
    // Query Builder
    $ds_loai = DB::table('cusc_loai')->get();

    $json    = json_encode($ds_loai);
    return $json;
});
*/

// Admin routes
$router->group(['middleware' => ['auth'], 'prefix' => 'admin'], function($router)
{
    // route Loai
    $router->get('/danhsachloai', 'LoaiController@index')->name('danhsachloai.index');
    $router->get('/danhsachloai/{id}', 'LoaiController@edit')->name('danhsachloai.edit');
    $router->put('/danhsachloai/{id}', 'LoaiController@update')->name('danhsachloai.update');
    $router->delete('/danhsachloai/{id}', 'LoaiController@destroy')->name('danhsachloai.destroy');
});

// tencontroller@action


// route Danh mục Sản phẩm
Route::get('/admin/danhsachsanpham/excel', 'SanPhamController@excel')->name('danhsachsanpham.excel');
Route::get('/admin/danhsachsanpham/pdf', 'SanPhamController@pdf')->name('danhsachsanpham.pdf');
Route::get('/admin/danhsachsanpham/print', 'SanPhamController@print')->name('danhsachsanpham.print');
Route::resource('/admin/danhsachsanpham', 'SanPhamController');
Auth::routes();

Route::get('/', 'FrontendController@index')->name('frontend.home');
Route::get('/gioi-thieu', 'FrontendController@about')->name('frontend.about');
Route::get('/lien-he', 'FrontendController@contact')->name('frontend.contact');
Route::post('/lien-he/goi-loi-nhan', 'FrontendController@sendMailContactForm')->name('frontend.contact.sendMailContactForm');
Route::get('/san-pham', 'FrontendController@product')->name('frontend.product');
Route::get('/san-pham/{id}', 'FrontendController@productDetail')->name('frontend.productDetail');
Route::get('/gio-hang', 'FrontendController@cart')->name('frontend.cart');
Route::post('/dat-hang', 'FrontendController@order')->name('frontend.order');
Route::get('/dat-hang/hoan-tat', 'FrontendController@orderFinish')->name('frontend.orderFinish');

// Tạo route Báo cáo Đơn hàng
Route::get('/admin/baocao/donhang', 'BaoCaoController@donhang')->name('baocao.donhang');
Route::get('/admin/baocao/donhang/data', 'BaoCaoController@donhangData')->name('baocao.donhang.data'); 
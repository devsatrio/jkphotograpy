<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.index');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
  ]);
Route::get('/home', 'backend\HomeController@index')->name('home');
Route::get('/edit-profile', 'backend\HomeController@editprofile')->name('editprofile');
Route::post('/edit-profile/{id}', 'backend\HomeController@aksieditprofile');

//===================================================================================
Route::get('/data-admin','backend\AdminController@listdata');
Route::resource('/admin','backend\AdminController');

//===================================================================================
Route::get('/data-pricelist','backend\priceListController@listdata');
Route::resource('/pricelist','backend\priceListController');

//===================================================================================
Route::get('/cari-data-pricelist','backend\transaksiController@caripricelist');
Route::post('/add-detail-transaksi','backend\transaksiController@tambahdetail');
Route::post('/bayar-transaksi','backend\transaksiController@bayartransaksi');
Route::post('/hapus-detail-transaksi','backend\transaksiController@hapusdetail');
Route::get('/detail-transaksi/{kode}','backend\transaksiController@datatransaksi');
Route::get('/data-detail-transaksi/{kode}','backend\transaksiController@detailtransaksi');
Route::get('/data-cetak-transaksi/{kode}','backend\transaksiController@datacetaktransaksi');
Route::get('/cari-detail-pricelist/{kode}','backend\transaksiController@caridetailpricelist');
Route::resource('/transaksi','backend\transaksiController');

//===================================================================================
Route::get('/laporan-transaksi','backend\laporanTransaksiController@index');
Route::get('/laporan-transaksi/tampil','backend\laporanTransaksiController@show');
Route::get('/laporan-transaksi/export','backend\laporanTransaksiController@exportdata');

//===================================================================================
Route::get('/laporan-labarugi','backend\laporanLabaRugiController@index');
Route::get('/laporan-labarugi/tampil','backend\laporanLabaRugiController@show');
Route::get('/laporan-labarugi/export','backend\laporanLabaRugiController@exportdata');

//===================================================================================
Route::get('/setting','backend\settingWebController@index');
Route::post('/setting','backend\settingWebController@update');
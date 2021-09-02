<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
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
Route::get('/cari-data-pricelist','backend\transaksicontroller@caripricelist');
Route::post('/add-detail-transaksi','backend\transaksicontroller@tambahdetail');
Route::post('/bayar-transaksi','backend\transaksicontroller@bayartransaksi');
Route::post('/hapus-detail-transaksi','backend\transaksicontroller@hapusdetail');
Route::get('/detail-transaksi/{kode}','backend\transaksicontroller@datatransaksi');
Route::get('/data-detail-transaksi/{kode}','backend\transaksicontroller@detailtransaksi');
Route::get('/cari-detail-pricelist/{kode}','backend\transaksicontroller@caridetailpricelist');
Route::resource('/transaksi','backend\transaksicontroller');

//===================================================================================
Route::get('/laporan-transaksi','backend\laporanTransaksiController@index');
Route::get('/laporan-transaksi/tampil','backend\laporanTransaksiController@show');
Route::get('/laporan-transaksi/export','backend\laporanTransaksiController@exportdata');
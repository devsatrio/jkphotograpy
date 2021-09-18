<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class frontendController extends Controller
{
    public function index($kode)
    {
        $newkode = base64_decode($kode);
        $data = DB::table('transaksi')->where('kode',$newkode)->get();
        return view('frontend.transaksi',compact('data'));
    }

}

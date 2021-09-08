<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\laporanLabaExport;
use DataTables;
use Excel;
use DB;
use Auth;

class laporanLabaRugiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        return view('backend.laporanlabarugi.index');
    }

    //=================================================================
    public function show(Request $request)
    {
        $tgl = $request->tanggal;
        $status=$request->status;
        $tanggal = explode(' to ',$request->tanggal);
        if($request->status!='Semua'){
            $data = DB::table('transaksi')
            ->where('status',$request->status)
            ->whereBetween('tgl_buat',[$tanggal[0],$tanggal[1]])
            ->get();
        }else{
            $data = DB::table('transaksi')
            ->whereBetween('tgl_buat',[$tanggal[0],$tanggal[1]])
            ->get();
        }
        return view('backend.laporanlabarugi.show',compact('data','tgl','status'));  
    }

    //=================================================================
    public function exportdata(Request $request)
    {
        $tgl = $request->tanggal;
        $status=$request->status;
        $namafile='laporan laba rugi '.$tgl.' '.$status.'.xlsx';
        return Excel::download(new laporanLabaExport($tgl,$status),$namafile);
    }
}

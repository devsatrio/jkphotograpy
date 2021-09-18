<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;
use QrCode;

class transaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index(Request $request)
    {
        if($request->has('tanggal')){
            $tanggal = explode(' to ',$request->tanggal);
            if(count($tanggal)<2){
                $tglsatu = $tanggal[0];
                $tgldua = $tanggal[0];
            }else{
                $tglsatu = $tanggal[0];
                $tgldua = $tanggal[1];
            }
        }
        if ($request->has('search') ||$request->has('status') ||$request->has('tanggal')) {
            if($request->search!=''){
                if($request->status!=''){
                    if($request->tanggal!=''){
                        $data = DB::table('transaksi')
                        ->where([['kode','like','%'.$request->search.'%'],['status','=',$request->status]])
                        ->orwhere([['nama_customer','like','%'.$request->search.'%'],['status','=',$request->status]])
                        ->whereBetween('tgl_buat', [$tglsatu, $tgldua])
                        ->orderby('id','desc')
                        ->paginate(100);
                        $hasilpencarian = true;
                    }else{
                        $data = DB::table('transaksi')
                        ->where([['kode','like','%'.$request->search.'%'],['status','=',$request->status]])
                        ->orwhere([['nama_customer','like','%'.$request->search.'%'],['status','=',$request->status]])
                        ->orderby('id','desc')
                        ->paginate(100);
                        $hasilpencarian = true;
                    }
                }else{
                    if($request->tanggal!=''){
                        $tanggal = explode(' to ',$request->tanggal);
                        $data = DB::table('transaksi')
                        ->where('kode','like','%'.$request->search.'%')
                        ->orwhere('nama_customer','like','%'.$request->search.'%')
                        ->whereBetween('tgl_buat', [$tglsatu, $tgldua])
                        ->orderby('id','desc')
                        ->paginate(100);
                        $hasilpencarian = true;
                    }else{
                        $data = DB::table('transaksi')
                        ->where('kode','like','%'.$request->search.'%')
                        ->orwhere('nama_customer','like','%'.$request->search.'%')
                        ->orderby('id','desc')
                        ->paginate(100);
                        $hasilpencarian = true;
                    } 
                }
            }else{
                if($request->status!=''){
                    if($request->tanggal!=''){
                        $tanggal = explode(' to ',$request->tanggal);
                        $data = DB::table('transaksi')
                        ->where('status','=',$request->status)
                        ->whereBetween('tgl_buat', [$tglsatu, $tgldua])
                        ->orderby('id','desc')
                        ->paginate(100);
                        $hasilpencarian = true;
                    }else{
                        $data = DB::table('transaksi')
                        ->where('status','=',$request->status)
                        ->orderby('id','desc')
                        ->paginate(100);
                        $hasilpencarian = true;
                    }
                }else{
                    if($request->tanggal!=''){
                        $tanggal = explode(' to ',$request->tanggal);
                        $data = DB::table('transaksi')
                        ->whereBetween('tgl_buat', [$tglsatu, $tgldua])
                        ->orderby('id','desc')
                        ->paginate(100);
                        $hasilpencarian = true;
                    }else{
                        $data = DB::table('transaksi')->orderby('id','desc')->paginate(100);
                        $hasilpencarian = false;
                    } 
                }
            }
        }else{
            $data = DB::table('transaksi')->orderby('id','desc')->paginate(100);
            $hasilpencarian = false;
        }
        return view('backend.transaksi.index',compact('data','hasilpencarian'));
    }

    //=================================================================
    public function create()
    {
        
        DB::table('transaksi_detail_thumb')->where('pembuat',Auth::user()->id)->delete();
        $kode = $this->carikode();
        return view('backend.transaksi.create',compact('kode'));
    }

    //=================================================================
    public function caripricelist(Request $request)
    {
        if($request->has('q')){
            $cari = $request->q;
            $data = DB::table('pricelist')
            ->where('nama','like','%'.$cari.'%')
            ->get();
            return response()->json($data);
        }
    }

    //=================================================================
    public function detailtransaksi($kode){
        $data = DB::table('transaksi_detail_thumb')->where('kode_transaksi',$kode)->get();
        return response()->json($data);
    }

    //=================================================================
    public function tambahdetail(Request $request)
    {
        $laba = 0;
        $datapricelist = DB::table('pricelist')->where('id',$request->pricelist)->get();
        foreach($datapricelist as $dtp){
            $laba = $dtp->laba;
        }
        DB::table('transaksi_detail_thumb')
        ->insert([
            'kode_transaksi'=>$request->kode,
            'id_pricelist'=>$request->pricelist,
            'nama_pricelist'=>$request->nama_prc,
            'harga'=>str_replace('.','',$request->harga_prc),
            'diskon'=>$request->diskon_prc,
            'jumlah'=>1,
            'total'=>str_replace('.','',$request->subtotal_prc),
            'laba'=>$laba,
            'tgl_eksekusi'=>$request->tgl_acara,
            'lokasi'=>$request->lokasi,
            'pembuat'=>Auth::user()->id,
        ]);
    }

    //=================================================================
    public function caridetailpricelist($kode)
    {
        $data = DB::table('pricelist')
        ->where('id',$kode)
        ->get();
        return response()->json($data);
    }

    //=================================================================
    public function datatransaksi($kode)
    {
        $data = DB::table('transaksi')
        ->where('id',$kode)
        ->get();
        foreach($data as $row){
            $totalangsuran = DB::table('pembayaran')->where('kode_transaksi',$row->kode)->count();
        }
        $print=[
            'transaksi'=>$data,
            'totalangsuran'=>$totalangsuran,
        ];
        return response()->json($print);
    }

    //=================================================================
    public function bayartransaksi(Request $request)
    {
        if(($request->terbayar+str_replace('.','',$request->dibayar))>=$request->total){
            $status = 'Lunas';
            $dibayar = $request->total;
        }else{
            $status = 'Belum Lunas';
            $dibayar = $request->terbayar+str_replace('.','',$request->dibayar);
        }
        $jumlahangsur = $request->angsuran+1;
        DB::table('transaksi')
        ->where('kode',$request->kode)
        ->update([
            'dibayar'=>$dibayar,
            'angsur'=>$jumlahangsur,
            'status'=>$status,
        ]);
        DB::table('transaksi_log')
        ->insert([
            'kode_transaksi'=>$request->kode,
            'aksi'=>'pay',
            'keterangan'=>'Menambahkan data pembayaran transaksi ke-'.$jumlahangsur,
            'admin'=>Auth::user()->id,
            'tgl'=>date('Y-m-d H:i:s')
        ]);

        $finalname ='gambar_kosong';
        if($request->hasFile('bts')){
            $nameland=$request->file('bts')->getClientOriginalname();
            $lower_file_name=strtolower($nameland);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $finalname=time().'-'.$replace_space;
            $destination=public_path('img/buktibayar');
            $request->file('bts')->move($destination,$finalname);
        }

        DB::table('pembayaran')
        ->insert([
            'kode_transaksi'=>$request->kode,
            'jumlah'=>$dibayar,
            'keterangan'=>$request->keterangan,
            'tgl_bayar'=>$request->tglbayar,
            'gambar'=>$finalname,
            'metode'=>$request->metode_bayar,
            'created_at'=>date('Y-m-d H:i:s'),
            'created_by'=>Auth::user()->id,
        ]);
        return redirect('transaksi')->with('status','Sukses menambahkan data pembayaran');
    }

    //=================================================================
    public function carikode()
    {
        $tahun = date('y');
        $bulan = date('m');
        $bulanromawi = '';
        switch ($bulan) {
            case '02':
                $bulanromawi='II';
                break;
            case '03':
                $bulanromawi='III';
                break;
            case '04':
                $bulanromawi='IV';
                break;
            case '05':
                $bulanromawi='V';
                break;
            case '06':
                $bulanromawi='VI';
                break;
            case '07':
                $bulanromawi='VII';
                break;
            case '08':
                $bulanromawi='VIII';
                break;
            case '09':
                $bulanromawi='IX';
                break;
            case '10':
                $bulanromawi='X';
                break;
            case '11':
                $bulanromawi='XI';
                break;
            case '12':
                $bulanromawi='XII';
                break;
            default:
                $bulanromawi='I';
                break;
        }

        $kode = 'TRX-'.$bulanromawi.'-'.$tahun;
        $carikode = DB::table('transaksi')
        ->where('kode','like','%'.$kode.'-%')
        ->max('kode');

        if(!$carikode){
            $finalkode = 'TRX-'.$bulanromawi.'-'.$tahun.'-001';
        }else{
            $newkode    = explode("-", $carikode);
            $nomer      = sprintf("%03s",$newkode[3]+1);
            $finalkode = 'TRX-'.$bulanromawi.'-'.$tahun.'-'.$nomer;
        }
        return $finalkode;
    }

    //=================================================================
    public function store(Request $request)
    {
        $totallaba = 0;
        $data = [];
        $datadetail = DB::table('transaksi_detail_thumb')->where('kode_transaksi',$request->kode)->get();
        foreach($datadetail as $row){
            $totallaba = $totallaba+$row->laba;
            $data[]=[
                'kode_transaksi'=>$row->kode_transaksi,
                'id_pricelist'=>$row->id_pricelist,
                'nama_pricelist'=>$row->nama_pricelist,
                'harga'=>$row->harga,
                'diskon'=>$row->diskon,
                'jumlah'=>$row->jumlah,
                'total'=>$row->total,
                'laba'=>$row->laba,
                'tgl_eksekusi'=>$row->tgl_eksekusi,
                'lokasi'=>$row->lokasi,
            ];
        }
        $finalname ='gambar_kosong';
        if($request->hasFile('bts')){
            $nameland=$request->file('bts')->getClientOriginalname();
            $lower_file_name=strtolower($nameland);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $finalname=time().'-'.$replace_space;
            $destination=public_path('img/buktibayar');
            $request->file('bts')->move($destination,$finalname);
        }
        if(str_replace('.','',$request->detail_dibayar)>=$request->detail_grand_total){
            $status = 'Lunas';
            $dibayar = $request->detail_grand_total;
            $diangsur = 1;
            DB::table('transaksi_log')
            ->insert([
                'kode_transaksi'=>$request->kode,
                'aksi'=>'pay',
                'keterangan'=>'Menambahkan data pembayaran transaksi ke-1 Sekaligus Pelunasan',
                'admin'=>Auth::user()->id,
                'tgl'=>date('Y-m-d H:i:s')
            ]);
            DB::table('pembayaran')
            ->insert([
                'kode_transaksi'=>$request->kode,
                'jumlah'=>$dibayar,
                'keterangan'=>'Pembayaran pertama Sekaligus Pelunasan',
                'tgl_bayar'=>date('Y-m-d H:i:s'),
                'gambar'=>$finalname,
                'metode'=>$request->metode_bayar,
                'created_at'=>date('Y-m-d H:i:s'),
                'created_by'=>Auth::user()->id,
            ]);
        }else{
            $status = 'Belum Lunas';
            $dibayar = str_replace('.','',$request->detail_dibayar);
            $diangsur = $request->angsur;
            DB::table('transaksi_log')
            ->insert([
                'kode_transaksi'=>$request->kode,
                'aksi'=>'pay',
                'keterangan'=>'Menambahkan data pembayaran transaksi ke-1 / DP',
                'admin'=>Auth::user()->id,
                'tgl'=>date('Y-m-d H:i:s')
            ]);
            DB::table('pembayaran')
            ->insert([
                'kode_transaksi'=>$request->kode,
                'jumlah'=>$dibayar,
                'keterangan'=>'Pembayaran pertama / DP',
                'tgl_bayar'=>date('Y-m-d H:i:s'),
                'gambar'=>$finalname,
                'metode'=>$request->metode_bayar,
                'created_at'=>date('Y-m-d H:i:s'),
                'created_by'=>Auth::user()->id,
            ]);
        }
        DB::table('transaksi')
        ->insert([
            'kode'=>$request->kode,
            'nama_customer'=>$request->nama,
            'alamat_customer'=>$request->alamat,
            'telp_customer'=>$request->telp,
            'subtotal'=>$request->detail_subtotal,
            'potongan'=>str_replace('.','',$request->detail_potongan),
            'ppn'=>str_replace('.','',$request->detail_ppn),
            'charge'=>str_replace('.','',$request->detail_charge),
            'ket_charge'=>$request->ket_charge,
            'dibayar'=>$dibayar,
            'total'=>$request->detail_grand_total,
            'status'=>$status,
            'laba'=>$totallaba,
            'angsur'=>$diangsur,
            'tgl_buat'=>$request->tgl,
            'created_at'=>date('Y-m-d H:i:s'),
            'created_by'=>Auth::user()->id,
        ]);
        DB::table('transaksi_log')
        ->insert([
            'kode_transaksi'=>$request->kode,
            'aksi'=>'add',
            'keterangan'=>'Menambahkan data transaksi',
            'admin'=>Auth::user()->id,
            'tgl'=>date('Y-m-d H:i:s')
        ]);
        
        
        DB::table('transaksi_detail')->insert($data);
        DB::table('transaksi_detail_thumb')->where('pembuat',Auth::user()->id)->delete();
    }

    //=================================================================
    public function hapusdetail(Request $request)
    {
        DB::table('transaksi_detail_thumb')->where('id',$request->kode)->delete();
    }

    //=================================================================
    public function show($id)
    {
        $data = DB::table('transaksi')->where('id',$id)->get();
        return view('backend.transaksi.show',compact('data'));
    }

    //=================================================================
    public function edit($id)
    {
        DB::table('transaksi_detail_thumb')->where('pembuat',Auth::user()->id)->delete();
        $datatransaksi = DB::table('transaksi')->where('id',$id)->get();
        $data = [];
        foreach($datatransaksi as $row){
            $datadetail = DB::table('transaksi_detail')->where('kode_transaksi',$row->kode)->get();
            foreach($datadetail as $rowdetail){
                $data[]=[
                    'kode_transaksi'=>$rowdetail->kode_transaksi,
                    'id_pricelist'=>$rowdetail->id_pricelist,
                    'nama_pricelist'=>$rowdetail->nama_pricelist,
                    'harga'=>$rowdetail->harga,
                    'diskon'=>$rowdetail->diskon,
                    'jumlah'=>$rowdetail->jumlah,
                    'total'=>$rowdetail->total,
                    'laba'=>$rowdetail->laba,
                    'tgl_eksekusi'=>$rowdetail->tgl_eksekusi,
                    'lokasi'=>$rowdetail->lokasi,
                    'pembuat'=>Auth::user()->id
                ];
            }
        }
        DB::table('transaksi_detail_thumb')->insert($data);

        return view('backend.transaksi.edit',compact('datatransaksi'));
    }

    //=================================================================
    public function update(Request $request, $id)
    {
        DB::table('transaksi_detail')->where('kode_transaksi',$request->kode)->delete();
        $totallaba = 0;
        $data = [];
        $datadetail = DB::table('transaksi_detail_thumb')->where('kode_transaksi',$request->kode)->get();
        foreach($datadetail as $row){
            $totallaba = $totallaba+$row->laba;
            $data[]=[
                'kode_transaksi'=>$row->kode_transaksi,
                'id_pricelist'=>$row->id_pricelist,
                'nama_pricelist'=>$row->nama_pricelist,
                'harga'=>$row->harga,
                'diskon'=>$row->diskon,
                'jumlah'=>$row->jumlah,
                'total'=>$row->total,
                'laba'=>$row->laba,
                'tgl_eksekusi'=>$row->tgl_eksekusi,
                'lokasi'=>$row->lokasi,
            ];
        }
        if(str_replace('.','',$request->detail_dibayar)>=$request->detail_grand_total){
            $status = 'Lunas';
        }else{
            $status = 'Belum Lunas';
        }
        DB::table('transaksi')
        ->where('id',$request->kodenya)
        ->update([
            'nama_customer'=>$request->nama,
            'alamat_customer'=>$request->alamat,
            'telp_customer'=>$request->telp,
            'subtotal'=>$request->detail_subtotal,
            'potongan'=>str_replace('.','',$request->detail_potongan),
            'ppn'=>str_replace('.','',$request->detail_ppn),
            'charge'=>str_replace('.','',$request->detail_charge),
            'ket_charge'=>$request->ket_charge,
            'dibayar'=>str_replace('.','',$request->detail_dibayar),
            'total'=>$request->detail_grand_total,
            'status'=>$status,
            'laba'=>$totallaba,
            'angsur'=>$request->angsur,
            'tgl_buat'=>$request->tgl,
            'updated_at'=>date('Y-m-d H:i:s'),
            'updated_by'=>Auth::user()->id,
        ]);
        DB::table('transaksi_log')
        ->insert([
            'kode_transaksi'=>$request->kode,
            'aksi'=>'edit',
            'keterangan'=>'Mengubah data transaksi',
            'admin'=>Auth::user()->id,
            'tgl'=>date('Y-m-d H:i:s')
        ]);
        DB::table('transaksi_detail')->insert($data);
        DB::table('transaksi_detail_thumb')->where('pembuat',Auth::user()->id)->delete();
    }

    //=================================================================
    public function destroy($id)
    {
        $data = DB::table('transaksi')->where('id',$id)->get();
        foreach($data as $row){
            DB::table('transaksi_detail')->where('kode_transaksi',$row->kode)->delete();
            DB::table('transaksi_log')->where('kode_transaksi',$row->kode)->delete();
            DB::table('pembayaran')->where('kode_transaksi',$row->kode)->delete();
        }
        DB::table('transaksi')->where('id',$id)->delete();
        return redirect('transaksi')->with('status','Sukses menghapus data');
    }

    //=================================================================
    public function datacetaktransaksi($kode)
    {
        $trx = DB::table('transaksi')->where('kode',$kode)->get();
        $detail_trx = DB::table('transaksi_detail')->where('kode_transaksi',$kode)->get();
        $pembayaran = DB::table('pembayaran')->where('kode_transaksi',$kode)->get();
        $print = [
            'trx'=>$trx,
            'detail'=>$detail_trx,
            'pembayaran'=>$pembayaran,
        ];
        return response()->json($print);
    }
}
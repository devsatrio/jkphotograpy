<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Auth;

class priceListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //=================================================================
    public function listdata(){
        return Datatables::of(
            DB::table('pricelist')
            ->select(DB::raw('pricelist.*,users.name'))
            ->leftjoin('users','users.id','=','pricelist.updated_by')
            ->orderby('pricelist.id','desc')
            ->get()
            )->make(true);
    }

    //=================================================================
    public function index()
    {
        return view('backend.pricelist.index');
    }

    //=================================================================
    public function create()
    {
        return view('backend.pricelist.create');
    }

    //=================================================================
    public function store(Request $request)
    {
        DB::table('pricelist')
        ->insert([
            'nama'=>$request->nama,
            'deskripsi'=>$request->deskripsi,
            'diskon'=>$request->diskon,
            'harga_paket'=>str_replace('.','',$request->harga_paket),
            'album'=>str_replace('.','',$request->album),
            'cetak'=>str_replace('.','',$request->cetak),
            'flashdisk'=>str_replace('.','',$request->flashdisk),
            'box'=>str_replace('.','',$request->box),
            'duavg'=>str_replace('.','',$request->duavg),
            'satuvg'=>str_replace('.','',$request->satuvg),
            'asisten'=>str_replace('.','',$request->asisten),
            'editor'=>str_replace('.','',$request->editor),
            'transport'=>str_replace('.','',$request->transport),
            'total_biaya_produksi'=>str_replace('.','',$request->total),
            'laba'=>str_replace('.','',$request->laba_bersih),
            'created_at'=>date('Y-m-d H:i:s'),
            'created_by'=>Auth::user()->id,
        ]);

        return redirect('/pricelist')->with('status','Sukses menyimpan data');
    }

    //=================================================================
    public function show($id)
    {
        $data = DB::table('pricelist')->where('id',$id)->get();
        return view('backend.pricelist.show',compact('data'));
    }

    //=================================================================
    public function edit($id)
    {
        $data = DB::table('pricelist')->where('id',$id)->get();
        return view('backend.pricelist.edit',compact('data'));
    }

    //=================================================================
    public function update(Request $request, $id)
    {
        DB::table('pricelist')
        ->where('id',$id)
        ->update([
            'nama'=>$request->nama,
            'deskripsi'=>$request->deskripsi,
            'diskon'=>$request->diskon,
            'harga_paket'=>str_replace('.','',$request->harga_paket),
            'album'=>str_replace('.','',$request->album),
            'cetak'=>str_replace('.','',$request->cetak),
            'flashdisk'=>str_replace('.','',$request->flashdisk),
            'box'=>str_replace('.','',$request->box),
            'duavg'=>str_replace('.','',$request->duavg),
            'satuvg'=>str_replace('.','',$request->satuvg),
            'asisten'=>str_replace('.','',$request->asisten),
            'editor'=>str_replace('.','',$request->editor),
            'transport'=>str_replace('.','',$request->transport),
            'total_biaya_produksi'=>str_replace('.','',$request->total),
            'laba'=>str_replace('.','',$request->laba_bersih),
            'updated_at'=>date('Y-m-d H:i:s'),
            'updated_by'=>Auth::user()->id,
        ]);

        return redirect('/pricelist')->with('status','Sukses memperbarui data');
    }

    //=================================================================
    public function destroy($id)
    {
        DB::table('pricelist')->where('id',$id)->delete();
    }
}

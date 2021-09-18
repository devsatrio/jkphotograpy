<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use File;

class settingWebController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        $data = DB::table('setting')->orderby('id','desc')->limit(1)->get();
        return view('backend.setting.index',compact('data'));
    }

    //=================================================================
    public function update(Request $request)
    {
        if($request->hasFile('logo')){
            File::delete('img/setting/'.$request->logo_lama);
            $nameland=$request->file('logo')->getClientOriginalname();
            $lower_file_name=strtolower($nameland);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $finalname=time().'-'.$replace_space;
            $destination=public_path('img/setting');
            $request->file('logo')->move($destination,$finalname);
            
            DB::table('setting')
            ->where('id',$request->kode)
            ->update([
                'owner'=>$request->owner,
                'nama_apps'=>$request->namaapps,
                'nama_company'=>$request->bisnis,
                'meta'=>$request->meta,
                'alamat'=>$request->alamat,
                'rekening'=>$request->rekening,
                'instagram'=>$request->ig,
                'cp'=>$request->telp,
                'email'=>$request->email,
                'note_invoice'=>$request->note_invoice,
                'logo'=>$finalname,
            ]);
        }else{
            DB::table('setting')
            ->where('id',$request->kode)
            ->update([
                'owner'=>$request->owner,
                'nama_apps'=>$request->namaapps,
                'nama_company'=>$request->bisnis,
                'meta'=>$request->meta,
                'alamat'=>$request->alamat,
                'rekening'=>$request->rekening,
                'instagram'=>$request->ig,
                'cp'=>$request->telp,
                'email'=>$request->email,
                'note_invoice'=>$request->note_invoice,
            ]);
        }
        return redirect('setting')->with('status','Setting web berhasil diperbarui');
    }
}

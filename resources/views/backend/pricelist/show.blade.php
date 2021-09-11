@extends('layouts/base')

@section('customcss')
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-1">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark">Price List</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                @if (session('status'))
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4>Info!</h4>
                        {{ session('status') }}
                    </div>
                </div>
                @endif
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Detail Data</h3>
                        </div>
                        @foreach($data as $row)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Detail Pricelist</h5>
                                        <hr>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Price List</label>
                                            <p>{{$row->nama}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Diskon</label>
                                            <p>{{$row->diskon}} %</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Harga Paket</label>
                                            <p>Rp {{number_format($row->harga_paket,0,',','.')}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Deskripsi</label>
                                            <p>{{$row->deskripsi}}</p>
                                        </div>
                                    </div>
                                </div>
                                @if(Auth::user(0)->level=='Super Admin')
                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <h5>Biaya Produksi</h5>
                                        <hr>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Album</label>
                                            <p>Rp {{number_format($row->album,0,',','.')}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Cetak</label>
                                            <p>Rp {{number_format($row->cetak,0,',','.')}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Flashdisk</label>
                                            <p>Rp {{number_format($row->flashdisk,0,',','.')}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Box</label>
                                            <p>Rp {{number_format($row->box,0,',','.')}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Jumlah Videographer</label>
                                            <p>{{$row->jumlah_vg}} Orang</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Jumlah Photographer</label>
                                            <p>{{$row->jumlah_pg}} Orang</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Jumlah Asisten</label>
                                            <p>{{$row->jumlah_as}} Orang</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Biaya Videographer</label>
                                            <p>Rp {{number_format($row->duavg,0,',','.')}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Biaya Photographer</label>
                                            <p>Rp {{number_format($row->satuvg,0,',','.')}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Biaya Asisten</label>
                                            <p>Rp {{number_format($row->asisten,0,',','.')}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Editor</label>
                                            <p>Rp {{number_format($row->editor,0,',','.')}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Transport</label>
                                            <p>Rp {{number_format($row->transport,0,',','.')}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Total Biaya Produksi</label>
                                            <p>Rp {{number_format($row->total_biaya_produksi,0,',','.')}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Laba Bersih</label>
                                            <p>Rp {{number_format($row->laba,0,',','.')}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Pembuat</label>
                                            @php
                                            $datapembuat = DB::table('users')->where('id',$row->created_by)->get();
                                            @endphp
                                            @foreach($datapembuat as $rowpembuat)
                                            <p>{{$rowpembuat->name}} - {{$row->created_at}}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Terakhir Update</label>
                                            @php
                                            $datapengubah = DB::table('users')->where('id',$row->updated_by)->get();
                                            @endphp
                                            @foreach($datapengubah as $rowpengubah)
                                            <p>{{$rowpengubah->name}} - {{$row->updated_at}}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                </div>
                                @endif
                            </div>

                            <div class="card-footer">
                                <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                              
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customjs')
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
@endsection
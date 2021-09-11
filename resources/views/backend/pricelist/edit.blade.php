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
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data</h3>
                        </div>
                        @foreach($data as $row)
                        <form method="POST" role="form" enctype="multipart/form-data"
                            action="{{url('/pricelist/'.$row->id)}}">
                            <input type="hidden" name="_method" value="put">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5>Detail Pricelist</h5>
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Price List</label>
                                            <input type="text" class="form-control" value="{{$row->nama}}" name="nama" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" rows="4">{{$row->deskripsi}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Diskon</label>
                                            <div class="input-group mb-3">
                                                <input type="number" min="0" value="{{$row->diskon}}" max="99" class="form-control" name="diskon" id="diskon" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Harga Paket</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                                </div>
                                                <input type="text" class="form-control" name="harga_paket" value="{{number_format($row->harga_paket,0,',','.')}}" id="harga_paket"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <h5>Biaya Produksi</h5>
                                        <hr>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Album</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                                </div>
                                                <input type="text" class="form-control" name="album" value="{{number_format($row->album,0,',','.')}}" id="album"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Cetak</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                                </div>
                                                <input type="text" class="form-control" name="cetak" value="{{number_format($row->cetak,0,',','.')}}" id="cetak"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Flashdisk</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                                </div>
                                                <input type="text" class="form-control" name="flashdisk" value="{{number_format($row->flashdisk,0,',','.')}}" id="flashdisk"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Box</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                                </div>
                                                <input type="text" class="form-control" name="box" id="box" value="{{number_format($row->box,0,',','.')}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Jumlah Videographer</label>
                                            <div class="input-group mb-3">
                                                <input type="number" min="0" class="form-control" value="{{$row->jumlah_vg}}" name="jml_vg"
                                                    id="jml_vg" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">orang</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Jumlah Photographer</label>
                                            <div class="input-group mb-3">
                                                <input type="number" min="0" class="form-control" value="{{$row->jumlah_pg}}" name="jml_pg"
                                                    id="jml_pg" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">orang</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Jumlah Asisten</label>
                                            <div class="input-group mb-3">
                                                <input type="number" min="0" class="form-control" value="{{$row->jumlah_as}}" name="jml_as"
                                                    id="jml_as" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">orang</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Biaya Vidiographer</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                                </div>
                                                <input type="text" class="form-control" name="duavg" id="2vg" value="{{number_format($row->duavg,0,',','.')}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Biaya Photographer</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                                </div>
                                                <input type="text" class="form-control" name="satuvg" id="1vg" value="{{number_format($row->satuvg,0,',','.')}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Biaya Asisten</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                                </div>
                                                <input type="text" class="form-control" name="asisten" value="{{number_format($row->asisten,0,',','.')}}" id="asisten"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Editor</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                                </div>
                                                <input type="text" class="form-control" name="editor" value="{{number_format($row->editor,0,',','.')}}" id="editor"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Transport</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                                </div>
                                                <input type="text" class="form-control" name="transport" value="{{number_format($row->transport,0,',','.')}}" id="transport"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Total Biaya Produksi</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                                </div>
                                                <input type="text" class="form-control" name="total" id="total" value="{{number_format($row->total_biaya_produksi,0,',','.')}}" readonly
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Laba Bersih</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                                </div>
                                                <input type="text" class="form-control" name="laba_bersih" value="{{number_format($row->laba,0,',','.')}}"
                                                    id="laba_bersih" readonly required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                                <button type="submit" class="btn btn-primary float-right">Simpan</button>
                            </div>
                        </form>
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

@section('customscripts')
<script src="{{asset('customjs/backend/pricelist_input.js')}}"></script>
@endsection
@extends('layouts/base')

@section('customcss')
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<link rel="stylesheet" href="{{asset('customjs/backend/flatpickr.min.css')}}">
<link href="{{asset('customjs/backend/loading.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-1">
                <div class="col-sm-12 text-center">
                    <h1 class="m-0 text-dark">Update Transaksi</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluit">
            @foreach($datatransaksi as $row)
            <div class="row pl-5 pr-5">
                <div class="col-md-4">
                    <div class="loading-div" id="panelsatu">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Cari Pricelist</h3>
                            </div>
                            <form method="POST" role="form" enctype="multipart/form-data"
                                action="{{url('/peralatan')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Cari Pricelist</label>
                                                <select class="form-control select2" id="pricelist" name="pricelist"
                                                    required>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama</label>
                                                <input type="text" class="form-control" name="nama_prc" id="nama_prc"
                                                    readonly required>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">harga</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="harga_prc"
                                                        id="harga_prc" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">diskon</label>
                                                <input type="text" class="form-control" name="diskon_prc"
                                                    id="diskon_prc" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Tanggal Acara</label>
                                                <input type="text" class="form-control" name="tgl_acara" id="tgl_acara"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Lokasi</label>
                                                <textarea name="lokasi" id="lokasi" rows="2"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Subtotal</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="subtotal_prc"
                                                        id="subtotal_prc" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="reset" onclick="history.go(-1)"
                                        class="btn btn-danger">Kembali</button>
                                    <button type="button" id="tambahbtn"
                                        class="btn btn-primary float-right">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="loading-div" id="paneldua">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Detail Transaksi</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Kode Transaksi</label>
                                            <input type="text" class="form-control" value="{{$row->kode}}" name="kode"
                                                id="kode" required readonly>
                                                <input type="hidden" value="{{$row->id}}" name="kodenya" id="kodenya">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tanggal Pembuatan</label>
                                            <input type="text" class="form-control" value="{{$row->tgl_buat}}" name="tgl" id="tgl" required>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Customer</label>
                                            <input type="text" class="form-control" value="{{$row->nama_customer}}" name="nama" id="nama" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Telp Customer</label>
                                            <input type="text" class="form-control" value="{{$row->telp_customer}}" name="telp" id="telp" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat Customer</label>
                                    <textarea name="alamat" id="alamat" class="form-control">{{$row->alamat_customer}}</textarea>
                                </div>
                                <div class="table-responsive mb-5">
                                    <table class="table table-bordered table-striped mt-5">
                                        <thead>
                                            <tr>
                                                <th>Paket</th>
                                                <th>Tanggal Acara</th>
                                                <th>Lokasi</th>
                                                <th class="text-right">Harga</th>
                                                <th class="text-center">Diskon</th>
                                                <th class="text-right">Total Harga</th>
                                                <th class="text-center">#</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tubuhnya">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 offset-md-8">
                                        <table width="100%5">
                                            <tr>
                                                <td>
                                                    <h5>Subtotal</h5>
                                                </td>
                                                <td></td>
                                                <td class="text-right">
                                                    <h5><b><span id="tampil_subtotal"></span></b></h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Charge</h5>
                                                </td>
                                                <td></td>
                                                <td class="text-right">
                                                    <h5><b><span id="tampil_charge"></span></b></h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>Potongan</h5>
                                                </td>
                                                <td></td>
                                                <td class="text-right">
                                                    <h5><b><span id="tampil_potongan"></span></b></h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>PPN</h5>
                                                </td>
                                                <td></td>
                                                <td class="text-right">
                                                    <h5><b><span id="tampil_ppn"></span></b></h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4>Grand Total</h4>
                                                </td>
                                                <td></td>
                                                <td class="text-right">
                                                    <h5><b><span id="tampil_grand_total"></span></b></h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4>Dibayar</h4>
                                                </td>
                                                <td></td>
                                                <td class="text-right">
                                                    <h5><b><span id="tampil_dibayar"></span></b></h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h4>Kekurangan</h4>
                                                </td>
                                                <td></td>
                                                <td class="text-right">
                                                    <h5><b><span id="tampil_kekurangan"></span></b></h5>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="hidden" name="detail_subtotal" id="detail_subtotal">
                                        <input type="hidden" name="detail_grand_total" id="detail_grand_total">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Potongan</label>
                                            <input type="text" class="form-control" value="{{number_format($row->potongan,0,',','.')}}" name="detail_potongan"
                                                id="detail_potongan" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">PPN</label>
                                            <input type="text" class="form-control" value="{{number_format($row->ppn,0,',','.')}}" name="detail_ppn" id="detail_ppn"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Charge</label>
                                            <input type="text" class="form-control" value="{{number_format($row->charge,0,',','.')}}" name="detail_charge"
                                                id="detail_charge" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Dibayar</label>
                                            <input type="text" class="form-control" name="detail_dibayar"
                                                id="detail_dibayar" value="{{number_format($row->dibayar,0,',','.')}}" required>
                                            <span class="text-danger" id="presentase_error"></span>
                                            <span class="text-success" id="presentase_info"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Diangsur</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="angsur" id="angsur"
                                                value="{{$row->angsur}}" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Kali</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Keterangan Charge</label>
                                            <textarea name="ket_charge" id="ket_charge" class="form-control">{{$row->ket_charge}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                    <button type="reset" onclick="history.go(-1)"
                                        class="btn btn-danger">Kembali</button>
                                <button type="button" id="simpanbtn" class="btn btn-success float-right">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('customjs')
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('customjs/backend/flatpickr')}}"></script>
<script src="{{asset('customjs/backend/loading.js')}}"></script>
@endsection

@section('customscripts')
<script src="{{asset('customjs/backend/transaksi_edit.js')}}"></script>
@endsection
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
                    <h1 class="m-0 text-dark">Input Transaksi</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluit">
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
                                                    id="diskon_prc" required readonly>
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
                            <form id="addtransaksi" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Kode Transaksi</label>
                                                <input type="text" class="form-control" value="{{$kode}}" name="kode"
                                                    id="kode" value="" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Tanggal Pembuatan</label>
                                                <input type="text" class="form-control" name="tgl" id="tgl" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Customer</label>
                                                <input type="text" class="form-control" name="nama" id="nama" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Telp Customer</label>
                                                <input type="text" class="form-control" name="telp" id="telp" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Alamat Customer</label>
                                        <textarea name="alamat" id="alamat" class="form-control"></textarea>
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
                                                <input type="text" class="form-control" name="detail_potongan"
                                                    id="detail_potongan" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">PPN</label>
                                                <input type="text" class="form-control" name="detail_ppn"
                                                    id="detail_ppn" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Charge</label>
                                                <input type="text" class="form-control" name="detail_charge"
                                                    id="detail_charge" required>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Dibayar</label>
                                                <input type="text" class="form-control" name="detail_dibayar"
                                                    id="detail_dibayar" required>
                                                <span class="text-danger" id="presentase_error"></span>
                                                <span class="text-success" id="presentase_info"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Jumlah Pembayaran</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="angsur" id="angsur"
                                                        value="1" required>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Kali</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Keterangan Charge</label>
                                                <textarea name="ket_charge" id="ket_charge"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Metode Pembayaran</label>
                                                <select name="metode_bayar" id="metode_bayar" class="form-control">
                                                    <option value="Transfer">Transfer</option>
                                                    <option value="Cash">Cash</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Bukti Transfer/Pembayaran</label>
                                                <input type="file" class="form-control" name="bts" id="bts"
                                                    accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" onclick="cetaktransaksi('TRX-IX-21-003')">test</button>
                                    <button type="submit" id="simpanbtn"
                                        class="btn btn-success float-right">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php
$datasetting = DB::table('setting')->orderby('id','desc')->limit(1)->get();
@endphp
<div id="printdiv">
    <table width="100%">
        <tr>
            <td width="13%" align="center">
                @foreach($datasetting as $rowset)
                <img src="{{asset('img/setting/'.$rowset->logo)}}" alt="logo" width="150px;">
                @endforeach
            </td>
            <td align="left">
                <div>
                    @foreach($datasetting as $rowset)
                    <h5><b>{{$rowset->nama_company}}</b></h5>
                    <span>{{$rowset->owner}}</span><br>
                    <span>{{$rowset->alamat}}</span><br>
                    <span>{{$rowset->cp}}</span><br>
                    <span>{{$rowset->instagram}}</span><br>
                    <span>{{$rowset->email}}</span><br>
                    @endforeach
                </div>
            </td>
            <td align="right">
                <div>
                    <span><b>FAKTUR</b></span><br>
                    <span>{{$kode}}</span>
                    <br>
                    <span><b>TANGGAL TRANSAKSI</b></span><br>
                    <span id="print_tgl_transaksi">-</span>
                    <br>
                    <span><b>TANGGAL BAYAR</b></span><br>
                    <span id="print_tgl_bayar">-</span>
                </div>
            </td>
        </tr>
    </table>
    <hr>
    <span>UNTUK</span><br>
    <span><b id="print_pembeli">Pembeli</b></span><br>
    <span id="print_alamat_pembeli">alamat</span><br>
    <span id="print_wa_pembeli">wa</span>
    <table width="100%" style="border-collapse:collapse;border: 1px solid black; font-size: 10;">
        <thead>
            <tr>
                <td style="border: 1px solid black; font-size: 10;" width="60%">Deskripsi</td>
                <td style="border: 1px solid black; font-size: 10;" width="10%">Diskon</td>
                <td style="border: 1px solid black; font-size: 10;" width="30%">Jumlah</td>
            </tr>
        </thead>
        <tbody id="print_item_transaksi">

        </tbody>
        <tfoot>
            <tr>
                <td style="border: 1px solid black; font-size: 10;" colspan="2" align="right">Potongan</td>
                <td style="border: 1px solid black; font-size: 10;" align="right"><b id="print_potongan">Rp. 0</b></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; font-size: 10;" colspan="2" align="right">PPN</td>
                <td style="border: 1px solid black; font-size: 10;" align="right"><b id="print_ppn">Rp. 0</b></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; font-size: 10;" colspan="2" align="right">Charge</td>
                <td style="border: 1px solid black; font-size: 10;" align="right"><b id="print_charge">Rp. 0</b></td>
            </tr>
        </tfoot>
    </table>
    <table width="100%" border="0">
        <tr>
            <td width="70%" rowspan="2">
                <h5><b>Instruksi Pembayaran</b></h5>
                @foreach($datasetting as $rowset)
                <div>
                    {!!$rowset->note_invoice!!}
                </div>
                @endforeach
            </td>
            <td>
                <table width="100%">
                    <tr>
                        <td>Total</td>
                        <td align="right"><b id="print_total">Rp. 0</b></td>
                    </tr>
                    <tr>
                        <td>Dibayar</td>
                        <td align="right"><b id="print_dibayar">Rp. 0</b></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>Total Akhir</span>
                        </td>
                        <td align="right"><b id="print_total_akhir">Rp. 0</b></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center">
                <br>
                @php
                $newkode = base64_encode($kode);
                @endphp
                {!! QrCode::size(150)->generate(url('/dokumen/transaksi/'.$newkode)); !!}
                <br><br><span><b>TANGGAL DITANDATANGANI</b></span><br>
                <span id="print_tgl_ttd"></span>
            </td>
        </tr>
    </table>
    <hr>
    <b><span>Bukti Transfer / Pembayaran</span></b>
    <table width="100%">
        <tr id="print_bukti_tf">
        </tr>
    </table>
</div>
<br><br><br>
@endsection

@section('customjs')
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('customjs/backend/flatpickr')}}"></script>
<script src="{{asset('customjs/backend/loading.js')}}"></script>
@endsection

@section('customscripts')
<script src="{{asset('customjs/backend/transaksi_input.js')}}"></script>
@endsection
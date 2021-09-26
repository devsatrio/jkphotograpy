@extends('layouts/base')

@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('customcss')
<link rel="stylesheet" href="{{asset('customjs/backend/flatpickr.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<link href="{{asset('customjs/backend/loading.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-1">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark">Transaksi</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">List Data</h3>
                            <div class="card-tools">
                                <a href="{{url('/transaksi/create')}}">
                                    <button type="button" class="btn btn-default btn-sm"><i class="fas fa-plus"></i>
                                        Tambah
                                        Data
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="loading-div" id="panelsatu">
                                <label for="">Cari Data Berdasarkan</label><br>
                                <form action="" method="get">
                                    <div class="row mb-3">
                                        <div class="col-md-4 mt-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search"
                                                    placeholder="Cari Berdasarkan Kode / customer">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="input-group">
                                                <select name="status" class="form-control">
                                                    <option value="" selected>Pilih Status</option>
                                                    <option value="Belum Lunas">Belum Lunas</option>
                                                    <option value="Lunas">Lunas</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5 mt-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="tanggal" id="tanggal">
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" type="submit"><i
                                                            class="fa fa-search"></i></button>
                                                    <a href="{{url('transaksi')}}" class="btn btn-secondary"><i
                                                            class="fas fa-sync"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                @if($hasilpencarian)
                                <span>Hasil pencarian @if(Request::get('search')!='') dari Kode/customer
                                    "<b>{{Request::get('search')}}</b>" @endif @if(Request::get('status')!='') dengan
                                    status
                                    "<b>{{Request::get('status')}}</b>" @endif @if(Request::get('tanggal')!='') dari
                                    tanggal
                                    "<b>{{str_replace('to','sampai',Request::get('tanggal'))}}</b>" @endif</span>
                                @else
                                @endif
                                <div class="table-responsive mt-2">
                                    <table id="list-data" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode</th>
                                                <th>Customer</th>
                                                <th>Telp</th>
                                                <th>Tgl Input</th>
                                                <th>Total Tagihan</th>
                                                <th>Terbayar</th>
                                                <th>Kekurangan</th>
                                                <th class="text-center">Status Bayar</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i=1; @endphp
                                            @foreach($data as $row)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>
                                                    <a href="{{url('transaksi/'.$row->id)}}">{{$row->kode}}</a>
                                                </td>
                                                <td>{{$row->nama_customer}}</td>
                                                <td>{{$row->telp_customer}}</td>
                                                <td>{{$row->tgl_buat}}</td>
                                                <td class="text-right">{{"Rp " . number_format($row->total,0,',','.')}}
                                                </td>
                                                <td class="text-right">
                                                    {{"Rp " . number_format($row->dibayar,0,',','.')}}
                                                <td class="text-right">
                                                    {{"Rp " . number_format($row->total-$row->dibayar,0,',','.')}}
                                                </td>
                                                <td class="text-center">
                                                    @if($row->status=='Lunas')
                                                    <span class="badge badge-primary">{{$row->status}}</span>
                                                    @else
                                                    <span class="badge badge-danger">{{$row->status}}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <form action="{{url('transaksi/'.$row->id)}}" id="deleteform{{$i}}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="delete">
                                                        @if($row->status!='Lunas')
                                                        <button type="button" onclick="pembayaran('{{$row->id}}')"
                                                            class="btn btn-warning btn-sm m-1"><i
                                                                class="fa fa-money-bill"></i></button>
                                                        @endif
                                                        <a href="{{url('transaksi/'.$row->id.'/edit')}}"
                                                            class="btn btn-success btn-sm m-1"><i
                                                                class="fa fa-wrench"></i></a>
                                                        <button type="button" onclick="hapusdata('deleteform{{$i}}')"
                                                            class="btn btn-danger btn-sm m-1"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode</th>
                                                <th>Customer</th>
                                                <th>Telp</th>
                                                <th>Tgl Input</th>
                                                <th>Total Tagihan</th>
                                                <th>Terbayar</th>
                                                <th>Kekurangan</th>
                                                <th class="text-center">Status Bayar</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    {{ $data->appends($_GET)->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modalbayar">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pembayaran Transaksi <span id="tampil_kode"></span></h5>
            </div>
            <div class="loading-div" id="panelmodal">
                <form action="{{url('bayar-transaksi')}}" id="pembayaranform" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Dibayar</label>
                                    <p id="tampil_dibayar"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kekurangan</label>
                                    <p id="tampil_kekurangan"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pembayaran Ke</label>
                                    <p id="tampil_angsuran"></p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Dibayar</label>
                            <input type="text" class="form-control" name="dibayar" id="dibayar" required>
                            <input type="hidden" name="kode" id="kode">
                            <input type="hidden" name="terbayar" id="terbayar">
                            <input type="hidden" name="angsuran" id="angsuran">
                            <input type="hidden" name="total" id="total">
                            <span class="text-muted">*Jangan menginputkan lebih dari jumlah kekurangan</span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Metode Pembayaran</label>
                            <select name="metode_bayar" id="metode_bayar" class="form-control">
                                <option value="Transfer">Transfer</option>
                                <option value="Cash">Cash</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Bukti Transfer/Pembayaran</label>
                            <input type="file" class="form-control" name="bts" id="bts" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tgl Bayar</label>
                            <input type="text" class="form-control" value="{{date('Y-m-d H:i:s')}}" name="tglbayar"
                                id="tglbayar" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="simpanpembayaran">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customjs')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('customjs/backend/loading.js')}}"></script>
@endsection

@section('customscripts')
<script src="{{asset('customjs/backend/transaksi.js')}}"></script>
@endsection
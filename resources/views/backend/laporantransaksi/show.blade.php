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
                    <h1 class="m-0 text-dark">Laporan Transaksi</h1>
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
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="loading-div" id="panelsatu">
                                <label for="">Cari Data Berdasarkan</label><br>
                                <form action="" method="get">
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <select name="status" class="form-control">
                                                    <option value="Semua" @if($status=='Semua') selected @endif>Semua</option>
                                                    <option value="Lunas" @if($status=='Lunas') selected @endif>Lunas</option>
                                                    <option value="Belum Lunas" @if($status=='Belum Lunas') selected @endif>Belum Lunas</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="tanggal" value="{{$tgl}}"
                                                    id="tanggal">
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" type="submit"><i
                                                            class="fa fa-search"></i></button>
                                                    <a class="btn btn-secondary"
                                                        href="{{url('/laporan-transaksi/export?tanggal='.$tgl.'&status='.$status)}}"><i
                                                            class="fa fa-download"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <span>Hasil pencarian @if($status!='') dengan
                                    status
                                    "<b>{{$status}}</b>" @endif @if($tgl!='') dari
                                    tanggal
                                    "<b>{{str_replace('to','sampai',$tgl)}}</b>" @endif</span>
                                <div class="table-responsive mt-2">
                                    <table id="list-data" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode</th>
                                                <th>Customer</th>
                                                <th>Telp</th>
                                                <th>Tgl Input</th>
                                                <th class="text-center">Status Bayar</th>
                                                <th>Total Tagihan</th>
                                                <th>Terbayar</th>
                                                <th>Kekurangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $i=1;
                                            $totaltagihan = 0;
                                            $totalterbayar = 0;
                                            $totalkekurangan= 0;
                                            @endphp
                                            @foreach($data as $row)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>
                                                    <a href="{{url('transaksi/'.$row->id)}}">{{$row->kode}}</a>
                                                </td>
                                                <td>{{$row->nama_customer}}</td>
                                                <td>{{$row->telp_customer}}</td>
                                                <td>{{$row->tgl_buat}}</td>
                                                <td class="text-center">
                                                    @if($row->status=='Lunas')
                                                    <span class="badge badge-primary">{{$row->status}}</span>
                                                    @else
                                                    <span class="badge badge-danger">{{$row->status}}</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">{{"Rp " . number_format($row->total,0,',','.')}}
                                                </td>
                                                <td class="text-right">
                                                    {{"Rp " . number_format($row->dibayar,0,',','.')}}
                                                <td class="text-right">
                                                    {{"Rp " . number_format($row->total-$row->dibayar,0,',','.')}}
                                                </td>
                                            </tr>
                                            @php
                                            $totaltagihan += $row->total;
                                            $totalterbayar += $row->dibayar;
                                            $totalkekurangan+=$row->total-$row->dibayar;
                                            @endphp
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="text-right">
                                                <th colspan="6">Total</th>
                                                <th>{{"Rp " . number_format($totaltagihan,0,',','.')}}</th>
                                                <th>{{"Rp " . number_format($totalterbayar,0,',','.')}}</th>
                                                <th>{{"Rp " . number_format($totalkekurangan,0,',','.')}}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
<script>
$(function() {
    flatpickr("#tanggal", {
        enableTime: false,
        dateFormat: "Y-m-d",
        mode: "range"
    });
});
</script>
@endsection
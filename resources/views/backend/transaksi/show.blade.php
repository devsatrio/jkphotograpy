@extends('layouts/base')

@section('customcss')
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-1">
                <div class="col-sm-12 text-center">
                    <h1 class="m-0 text-dark">Transaksi</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="pr-4 pl-4">
            @foreach($data as $row)
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Detail Data</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>{{$row->kode}}</h5>
                                    <hr>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal Buat</label>
                                        <p>{{$row->tgl_buat}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Status</label>
                                        <p>{{$row->status}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Angsuran Pembayaran</label>
                                        <p>{{$row->angsur}} Kali</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Customer</label>
                                        <p>{{$row->nama_customer}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Telp</label>
                                        <p>{{$row->telp_customer}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Alamat</label>
                                        <p>{{$row->alamat_customer}}</p>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <td>#</td>
                                                    <td>Nama Paket</td>
                                                    <td>Lokasi</td>
                                                    <td>Tgl Acara</td>
                                                    <td>Harga</td>
                                                    <td>Diskon</td>
                                                    <td>Total</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $i=1;
                                                $datadetail
                                                =DB::table('transaksi_detail')->where('kode_transaksi',$row->kode)->orderby('id','desc')->get();
                                                @endphp
                                                @foreach($datadetail as $rowdetail)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$rowdetail->nama_pricelist}}</td>
                                                    <td>{{$rowdetail->lokasi}}</td>
                                                    <td>{{$rowdetail->tgl_eksekusi}}</td>
                                                    <td class="text-right">
                                                        {{"Rp " . number_format($rowdetail->harga,0,',','.')}}</td>
                                                    <td>{{$rowdetail->diskon}}</td>
                                                    <td class="text-right">
                                                        {{"Rp " . number_format($rowdetail->total,0,',','.')}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 offset-md-6">
                                    <table width="100%5">
                                        <tr>
                                            <td>
                                                <h5>Subtotal</h5>
                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                                <h5><b>{{"Rp " . number_format($row->subtotal,0,',','.')}}</b></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Charge</h5>
                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                                <h5><b>{{"Rp " . number_format($row->charge,0,',','.')}}</b></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Potongan</h5>
                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                                <h5><b>{{"Rp " . number_format($row->potongan,0,',','.')}}</b></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>PPN</h5>
                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                                <h5><b>{{"Rp " . number_format($row->ppn,0,',','.')}}</b></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h4>Grand Total</h4>
                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                                <h5><b>{{"Rp " . number_format($row->total,0,',','.')}}</b></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h4>Dibayar</h4>
                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                                <h5><b>{{"Rp " . number_format($row->dibayar,0,',','.')}}</b></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h4>Kekurangan</h4>
                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                                <h5><b>{{"Rp " . number_format($row->total-$row->dibayar,0,',','.')}}</b>
                                                </h5>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">History Transaksi</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <!-- The time line -->
                                <div class="timeline">
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-red">History Transaksi</span>
                                    </div>
                                    @php
                                    $datalog = DB::table('transaksi_log')
                                    ->select(DB::raw('transaksi_log.*,users.name'))
                                    ->leftjoin('users','users.id','=','transaksi_log.admin')
                                    ->where('transaksi_log.kode_transaksi',$row->kode)
                                    ->orderby('transaksi_log.id','asc')
                                    ->get();
                                    @endphp
                                    @foreach($datalog as $dl)
                                    <div>
                                        @if($dl->aksi=='add')
                                        <i class="fas fa-pen bg-blue"></i>
                                        @elseif($dl->aksi=='pay')
                                        <i class="fas fa-money-bill bg-success"></i>
                                        @else
                                        <i class="fas fa-wrench bg-warning"></i>
                                        @endif
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> {{$dl->tgl}}</span>
                                            <h3 class="timeline-header"><b>{{$dl->name}}</b>
                                            </h3>

                                            <div class="timeline-body">
                                                {{$dl->keterangan}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>

                        </div>
                    </div>
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Pembayaran Transaksi</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>keterangan</th>
                                            <th>Jumlah</th>
                                            <th>Pembuat</th>
                                            <th>Tgl Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $pembayaran =DB::table('pembayaran')
                                        ->select(DB::raw('pembayaran.*,users.name'))
                                        ->leftjoin('users','users.id','=','pembayaran.created_by')
                                        ->where('pembayaran.kode_transaksi',$row->kode)
                                        ->orderby('pembayaran.id','asc')
                                        ->get();
                                        @endphp
                                        @foreach($pembayaran as $pm)
                                        <tr>
                                            <td>{{$pm->keterangan}}</td>
                                            <td class="text-right">
                                                {{"Rp " . number_format($pm->jumlah,0,',','.')}}</td>
                                            <td>{{$pm->name}}</td>
                                            <td>{{$pm->tgl_bayar}}</td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>

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
@endsection
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIM LAB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
    <div class="content">
        <div class="content-header">
            <div class="container">
                <div class="row mb-1">
                    <div class="col-sm-12 text-center">
                        <h1 class="m-0 text-dark">Data Transaksi</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="pr-4 pl-4">
                @foreach($data as $row)
                <div class="row">
                    <div class="col-md-7">
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
                                            <label for="exampleInputEmail1">Jumlah Pembayaran</label>
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
                        </div>
                    </div>
                    <div class="col-md-5">
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
                                                <th>Metode</th>
                                                <th>Jumlah</th>
                                                <th>Pembuat</th>
                                                <th>Tgl Bayar</th>
                                                <th>#</th>
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
                                                <td>{{$pm->metode}}</td>
                                                <td class="text-right">
                                                    {{"Rp " . number_format($pm->jumlah,0,',','.')}}</td>
                                                <td>{{$pm->name}}</td>
                                                <td>{{$pm->tgl_bayar}}</td>
                                                <td class="text-center">
                                                    @if($pm->gambar!='gambar_kosong')
                                                    <a href="{{asset('img/buktibayar/'.$pm->gambar)}}" target="blank()"
                                                        class="btn btn-sm btn-secondary"><i
                                                            class="fas fa-image"></i></a>
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>
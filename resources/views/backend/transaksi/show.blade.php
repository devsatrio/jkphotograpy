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
                        <div class="card-footer">
                            <button type="button" class="btn btn-info" onclick="cetaktransaksi('{{$row->kode}}')">Cetak
                                Transaksi</button>
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>

                        </div>
                    </div>
                </div>
                <div class="col-md-5">
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
                                                    class="btn btn-sm btn-secondary"><i class="fas fa-image"></i></a>
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

                        <div class="card-footer">
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>

                        </div>
                    </div>
                </div>
            </div>

            @php
            $datasetting = DB::table('setting')->orderby('id','desc')->limit(1)->get();
            @endphp
            <div id="printdiv" style="display:none;">
                <div style="font-size:12px;font-family: Arial, Helvetica, sans-serif;">
                    <table border="0" width="100%" style="vertical-align: top;">
                        <tr>
                            <td width="15%" align="center">
                                @foreach($datasetting as $rowset)
                                <img src="{{asset('img/setting/'.$rowset->logo)}}" alt="logo" width="150px;">
                                @endforeach
                            </td>
                            <td width="85%" style="padding-right:15px;padding-left:15px;">
                                @foreach($datasetting as $rowset)
                                <p style="font-size:20px;margin-top:10px;margin-bottom:5px;font-color:#0066ff;">
                                    <b>{{$rowset->nama_company}}</b>
                                </p>
                                <p style="margin-top:5px;margin-bottom:0px;">{{$rowset->owner}}</p>
                                <p style="margin-top:5px;margin-bottom:0px;">{{$rowset->alamat}}</p>
                                <p style="margin-top:5px;margin-bottom:0px;">{{$rowset->cp}}</p>
                                <p style="margin-top:5px;margin-bottom:0px;color:#3a5c84;"><img
                                        src="{{asset('img/nota/instagram.png')}}" alt=""
                                        width="12px;">&nbsp;{{$rowset->instagram}}&nbsp;<img
                                        src="{{asset('img/nota/envelope.png')}}" alt=""
                                        width="12px;">&nbsp;{{$rowset->email}}</p>
                                <p style="margin-top:5px;margin-bottom:0px;"></p>
                                @endforeach
                            </td>
                            <!-- <td width="30%" style="padding-right:15px;padding-left:15px;" align="right">
                                
                            </td> -->
                        </tr>
                    </table>
                    <hr style="margin-bottom:15px;border-top: 2px solid #3a5c84;border-radius: 2px;">
                    <table width="100%">
                        <tr>
                            <td width="60%">
                                <p style="margin-top:5px;margin-bottom:8px;"><span
                                        style="background-color:#3a5c84;color:white;padding:5px;"><b>UNTUK</b></span>
                                </p>
                                <p style="margin-top:0px;margin-bottom:0px;"><b id="print_pembeli">Penbeli Jasa</b></p>
                                <p style="margin-top:0px;margin-bottom:0px;" id="print_alamat_pembeli">Alamat pembeli
                                </p>
                                <p style="margin-top:0px;margin-bottom:0px;" id="print_wa_pembeli">039489028302</p>
                            </td>
                            <td width="40%" align="right">
                                <p style="margin-top:5px;margin-bottom:5px;"><span style="background-color:#3a5c84;color:white;padding:5px;"><b>Faktur</b></span></p>
                                <p style="margin-top:5px;margin-bottom:8px;">{{$row->kode}}</p>
                                <p style="margin-top:12px;margin-bottom:5px;"><span
                                        style="background-color:#3a5c84;color:white;padding:5px;"><b>Tanggal</b></span></p>
                                <p style="margin-top:5px;margin-bottom:8px;" id="print_tgl_transaksi"></p>
                            </td>
                        </tr>
                    </table>

                    <table border="1" width="100%" style="border-collapse: collapse;margin-top:10px;">
                        <thead style="background-color: #3a5c84;">
                            <tr>
                                <td width="50%"
                                    style="border: 0px 0px 0px 1px solid black;padding-top:7px;padding-bottom:7px;padding-right:15px;padding-left:15px;color:white;">
                                    <b> DESKRIPSI</b>
                                </td>
                                <td width="5%"
                                    style="border: 0px 0px 0px 1px solid black;padding-top:7px;padding-bottom:7px;padding-right:15px;padding-left:15px;color:white;">
                                    <b>DISKON</b>
                                </td>
                                <td width="20%"
                                    style="border: 0px 0px 0px 1px solid black;padding-top:7px;padding-bottom:7px;padding-right:15px;padding-left:15px;color:white;"
                                    align="center">
                                    <b>HARGA</b>
                                </td>
                                <td width="25%"
                                    style="border: 0px 0px 0px 1px solid black;padding-top:7px;padding-bottom:7px;padding-right:15px;padding-left:15px;color:white;"
                                    align="center">
                                    <b>JUMLAH</b>
                                </td>
                            </tr>
                        </thead>
                        <tbody id="print_item_transaksi">
                        </tbody>
                        <tfoot>
                            <tr>
                                <td style="border: 0px 0px 0px 1px solid black;padding-right:15px;padding-left:15px;"
                                    colspan="3" align="right">Potongan</td>
                                <td style="border: 0px 0px 0px 1px solid black;padding-right:15px;padding-left:15px;"
                                    align="right">
                                    <b id="print_potongan">Rp. 0</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 0px 0px 0px 1px solid black;padding-right:15px;padding-left:15px;"
                                    colspan="3" align="right">PPN</td>
                                <td style="border: 0px 0px 0px 1px solid black;padding-right:15px;padding-left:15px;"
                                    align="right">
                                    <b id="print_ppn">Rp. 0</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 0px 0px 0px 1px solid black;padding-right:15px;padding-left:15px;"
                                    colspan="3" align="right">Charge</td>
                                <td style="border: 0px 0px 0px 1px solid black;padding-right:15px;padding-left:15px;"
                                    align="right">
                                    <b id="print_charge">Rp. 0</b>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <table border="0" width="100%" style="vertical-align:top;">
                        <tr>
                            <td width="55%" rowspan="2" style="vertical-align:top;padding-top:10px;padding-right:20px;">
                                <h5 style="margin-bottom:0px;"><b>Instruksi Pembayaran</b></h5>
                                <hr style="margin-top:3px;border-top: 2px solid #3a5c84;border-radius: 2px;">
                                @foreach($datasetting as $rowset)
                                <div style=" font-size: 12;">
                                    {!!$rowset->note_invoice!!}
                                </div>
                                @endforeach
                            </td>
                            <td width="45%" style="vertical-align:top;">
                                <table width="100%" border="0"
                                    style="font-size:15px;border-collapse: collapse;margin-top:10px;">
                                    <tr>
                                        <td style="padding-right:15px;padding-left:15px;">
                                            <b>TOTAL</b>
                                        </td>
                                        <td style="padding-right:15px;padding-left:15px;" align="right">
                                            <b id="print_total"></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-right:15px;padding-left:15px;"><b>DIBAYAR</b></td>
                                        <td style="padding-right:15px;padding-left:15px;" align="right">
                                            <b id="print_dibayar"></b>
                                        </td>
                                    </tr>
                                    <td style="padding-top:15px;padding-right:15px;padding-left:15px;"><b>GRAND
                                            TOTAL</b>
                                    </td>
                                    <td style="padding-top:15px;padding-right:15px;padding-left:15px;" align="right">
                                        <span
                                            style="padding-top:15px;background-color:#3a5c84;color:white;padding:5px;"><b
                                                id="print_total_akhir"></b></span>
                                    </td>
                                </table>
                        </tr>
                        <tr>
                            <td width="45%" align="right" colspan="2">
                                <br>
                                @php
                                $newkode = base64_encode($row->kode);
                                @endphp
                                {!! QrCode::size(100)->generate(url('/dokumen/transaksi/'.$newkode)); !!}
                                <br><br>
                                <span><b>TANGGAL DITANDATANGANI</b></span><br>
                                <span id="print_tgl_ttd"></span>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <div style="page-break-before: always;"></div>
                    <br><br>
                    <span style="background-color:#3a5c84;color:white;padding:5px;"><b>Bukti Transfer / Pembayaran
                            :</b></span>
                    <hr>
                    <table border="0" width="100%">
                        <tr id="print_bukti_tf">
                        </tr>
                    </table>
                </div>
            </div>
            @endforeach
            <br><br><br>
            <br><br><br>
        </div>
    </div>
</div>
@endsection

@section('customjs')
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
function cetaktransaksi(kode) {
    $.ajax({
        type: 'GET',
        url: '/data-cetak-transaksi/' + kode,
        success: function(data) {
            $.each(data.trx, function(key, value) {
                $('#print_pembeli').html(value.nama_customer);
                $('#print_alamat_pembeli').html(value.alamat_customer);
                $('#print_wa_pembeli').html(value.telp_customer);
                $('#print_tgl_transaksi').html(value.tgl_buat);
                $('#print_tgl_ttd').html(value.tgl_buat);
                $('#print_potongan').html('Rp ' + rupiah(value.potongan));
                $('#print_ppn').html('Rp ' + rupiah(value.ppn));
                $('#print_charge').html('Rp ' + rupiah(value.charge));
                $('#print_total').html('Rp ' + rupiah(value.total));
                $('#print_dibayar').html('Rp ' + rupiah(value.dibayar));
                $('#print_total_akhir').html('Rp ' + rupiah(parseInt(value.total) - parseInt(value
                    .dibayar)));
            });

            var rows = '';
            $.each(data.detail, function(key, value) {
                rows = rows + '<tr>';
                rows = rows +
                    '<td style="font-size:14px;border: 0px 0px 0px 1px solid black;padding-right:15px;padding-left:15px;">' +
                    value.nama_pricelist + '</td>';
                rows = rows +
                    '<td style="font-size:14px;border: 0px 0px 0px 1px solid black;padding-right:15px;padding-left:15px;">' +
                    value.diskon + '% </td>';
                rows = rows +
                    '<td style="font-size:14px;border: 0px 0px 0px 1px solid black;padding-right:15px;padding-left:15px;" align="right">Rp ' +
                    rupiah(value.harga) + '</td>';
                rows = rows +
                    '<td style="font-size:14px;border: 0px 0px 0px 1px solid black;padding-right:15px;padding-left:15px;" align="right"> Rp ' +
                    rupiah(value.total) + '</td>';
                rows = rows + '</tr>';
            });
            $('#print_item_transaksi').html(rows);

            var rowstf = '';
            var tgbayar = '';
            $.each(data.pembayaran, function(key, value) {
                tgbayar = tgbayar + ', ' + value.tgl_bayar;
                if (value.gambar != 'gambar_kosong') {
                    rowstf = rowstf + '<td widht="20%"><img src="/img/buktibayar/' + value.gambar +
                        '" width="180px;"></td>';
                }
            });
            $('#print_tgl_bayar').html(tgbayar.substr(1));
            $('#print_bukti_tf').html(rowstf);
        },
        complete: function() {
            var divToPrint = document.getElementById('printdiv');
            var newWin = window.open('', 'Print-Window');
            newWin.document.open();
            newWin.document.write('<html><body onload="window.print();window.close()">' + divToPrint
                .innerHTML + '</body></html>');
            newWin.document.close();
        }
    });
}
//===============================================================================================
function rupiah(bilangan) {
    var number_string = bilangan.toString(),
        sisa = number_string.length % 3,
        rupiah = number_string.substr(0, sisa),
        ribuan = number_string.substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    return rupiah;
}
</script>
@endsection
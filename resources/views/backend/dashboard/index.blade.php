@extends('layouts/base')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-1">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark"> Dashboard</h1>
                    <p>Welcome back {{Auth::user()->level}} {{Auth::user()->name}}</p>
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
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            @php
                            $jumlah_pricelist = DB::table('pricelist')->count();
                            @endphp
                            <h3>150</h3>

                            <p>Pricelist</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-th-large"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            @php
                            $jumlahadmin = DB::table('users')->count();
                            @endphp
                            <h3>{{$jumlahadmin}}</h3>

                            <p>Admin</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-child"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            @php
                            $transaksilunas = DB::table('transaksi')->where('status','Lunas')->count();
                            @endphp
                            <h3>{{$transaksilunas}}</h3>
                            <p>Transaksi Lunas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tags"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->

                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            @php
                            $transaksiblmlunas = DB::table('transaksi')->where('status','Belum Lunas')->count();
                            @endphp
                            <h3>{{$transaksiblmlunas}}</h3>

                            <p>Transaksi Belum Lunas</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-frown"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Transaksi Mingguan</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Transaksi Tahunan</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="lineChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                To Do List
                            </h3>
                        </div>
                        <div class="card-body">
                            <ul class="todo-list ui-sortable" data-widget="todo-list">
                                @php
                                $todo = DB::table('transaksi_detail')
                                ->select(DB::raw('transaksi_detail.*,transaksi.nama_customer,transaksi.telp_customer'))
                                ->leftjoin('transaksi','transaksi.kode','=','transaksi_detail.kode_transaksi')
                                ->whereDate('transaksi_detail.tgl_eksekusi','>=',date('Y-m-d H:i:s'))
                                ->orderby('tgl_eksekusi','asc')
                                ->get();
                                @endphp
                                @foreach($todo as $tds)
                                <li>
                                    <span>
                                        <i class="fas fa-circle"></i>
                                    </span>
                                    <span class="text">{{$tds->nama_pricelist}} - {{$tds->lokasi}}
                                        ({{$tds->nama_customer}} || {{$tds->telp_customer}}) </span>
                                    <small class="badge badge-danger"><i class="far fa-clock"></i>
                                        {{$tds->tgl_eksekusi}}</small>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Pricelist Favorit {{date('Y')}}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@php
$linelabelmgn = '';
$linevaluemgn = '';
for ($x=0; $x <= 7; $x++) { $day=date('Y-m-d',strtotime(date('Y-m-d') . "-" .$x." days"));
    $linelabelmgn=$linelabelmgn."'".$day."',"; $jmlminggu=DB::table('transaksi')->where('tgl_buat',$day)->count();
    $linevaluemgn = $linevaluemgn."".$jmlminggu.",";
    }
    @endphp
    {{$linelabelmgn}}

    @php
    $linelabel = '';
    $linevalue = '';
    for ($i=1; $i <= 12; $i++) { $month=sprintf("%02s",$i); $newbln=date("F", mktime(0, 0, 0, $month, 10));
        $linelabel=$linelabel."'".$newbln."',"; $jumlah=DB::table('transaksi') ->whereMonth('tgl_buat', '=',
        date($month))
        ->count();
        $linevalue=$linevalue."".$jumlah.",";
        }
        @endphp

        @php
        $grappricelist = DB::table('transaksi_detail')
        ->select(DB::raw('transaksi_detail.*,count(id) as total'))
        ->whereYear('tgl_eksekusi', '=', date('Y'))
        ->groupby('id_pricelist')
        ->get();
        $labelpie = '';
        $valuelabelpie = '';
        $warnapie='';
        @endphp

        @foreach($grappricelist as $grp)
        @php
        $labelpie=$labelpie."'".$grp->nama_pricelist."',";
        $valuelabelpie = $valuelabelpie."".$grp->total.",";
        $warnapie =$warnapie."'#". str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT)."',";
        @endphp
        @endforeach
        @endsection

        @section('customjs')
        <script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
        @endsection

        @section('customscripts')
        <script>
        $(function() {
            var donutData = {
                labels: [{!!substr($labelpie, 0, -1) !!}],
                datasets: [{
                    data: [{!!substr($valuelabelpie, 0, -1)!!}],
                    backgroundColor: [{!!substr($warnapie, 0, -1)!!}],
                }]
            }

            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = donutData;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })

            var barChartCanvas = $('#lineChart').get(0).getContext('2d')
            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            var barChart = new Chart(barChartCanvas, {
                type: 'line',
                data: {
                    labels: [{!!$linelabel!!}],
                    datasets: [{
                        label: 'Transaksi',
                        data: [{!!$linevalue!!}],
                        borderColor: "#17a2b8",
                        backgroundColor: "#17a2b8",
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    datasetFill: false
                }
            })

            //-------------
            //- LINE CHART -
            //--------------
            var lineChartCanvas = $('#barChart').get(0).getContext('2d')

            var lineChart = new Chart(lineChartCanvas, {
                type: 'bar',
                data: {
                    labels: [{!!$linelabelmgn!!}],
                    datasets: [{
                        label: 'Transaksi Mingguan',
                        data: [{!!$linevaluemgn!!}],
                        borderColor: "#28a745",
                        backgroundColor: "#28a745",
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    datasetFill: false
                },
            })
        })
        </script>
        @endsection
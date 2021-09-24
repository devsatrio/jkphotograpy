@extends('layouts/base')

@section('customcss')
<link rel="stylesheet" href="{{asset('customjs/backend/flatpickr.min.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-1">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark">Laporan Laba Rugi</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Pilih Data</h3>
                        </div>
                        <form method="get" role="form" action="{{url('/laporan-labarugi/tampil')}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pilih Tanggal</label>
                                    <input type="text" class="form-control" name="tanggal" id="tgl" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pilih Status</label>
                                    <select name="status" class="form-control">
                                        <option value="Semua">Semua</option>
                                        <option value="Lunas">Lunas</option>
                                        <option value="Belum Lunas">Belum Lunas</option>
                                    </select>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                                <button type="submit" class="btn btn-primary float-right">Tampilkan Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customjs')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection

@section('customscripts')
<script>
$(function() {
    flatpickr("#tgl", { 
        mode: "range",
        allowInput: false,
        dateFormat: 'Y-m-d',
        defaultDate: ['today', new Date().fp_incr(1)]
    });
});
</script>
@endsection
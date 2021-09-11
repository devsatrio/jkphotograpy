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
                    <h1 class="m-0 text-dark">Setting Web</h1>
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
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data</h3>
                        </div>
                        @foreach($data as $row)
                        <form method="POST" role="form" enctype="multipart/form-data" action="{{url('/setting')}}">
                            @csrf
                            <div class="card-body">
                                <h5>Setting Program</h5>
                                <hr>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Owner</label>
                                            <input type="text" class="form-control" value="{{$row->owner}}" name="owner"
                                                required autofocus>
                                            <input type="hidden" name="kode" value="{{$row->id}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Bisnis</label>
                                            <input type="text" class="form-control" name="bisnis"
                                                value="{{$row->nama_company}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Aplikasi</label>
                                            <input type="text" class="form-control" name="namaapps"
                                                value="{{$row->nama_apps}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Meta</label>
                                            <input type="text" class="form-control" name="meta" value="{{$row->meta}}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Instagram</label>
                                            <input type="text" class="form-control" name="ig"
                                                value="{{$row->instagram}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nomor Telpon</label>
                                            <input type="text" class="form-control" name="telp" value="{{$row->cp}}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Alamat</label>
                                            <textarea name="alamat" id="alamat" rows="4"
                                                class="form-control">{{$row->alamat}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Rekening</label>
                                            <textarea name="rekening" id="rekening" rows="4"
                                                class="form-control">{{$row->rekening}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Logo</label>
                                            <input type="file" class="form-control" name="logo" id="logo" accept="image/*">
                                            <input type="hidden" name="logo_lama" id="logo_lama" value="{{$row->logo}}">
                                            @if($row->logo!='')
                                            <a href="{{asset('img/setting/'.$row->logo)}}" target="blank()">Lihat Logo</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <h5>Setting Cetak Invoice</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Note Invoice</label>
                                            <textarea name="note_invoice" id="note_invoice" rows="5"
                                                class="form-control">{{$row->note_invoice}}</textarea>
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
<script src="{{asset('customjs/backend/ckeditor.js')}}"></script>
@endsection

@section('customscripts')
<script>
const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: true
})
//========================================================================================
$('#logo').on('change', function() {
    var imageSizeArr = 0;
    var imageSize = document.getElementById('logo');
    var jumlah = 0;
    for (var i = 0; i < imageSize.files.length; i++) {
        jumlah += 1;
        var imageSiz = imageSize.files[i].size;
        var imagename = imageSize.files[i].name;
        if (imageSiz > 1300000) {
            var imageSizeArr = 1;
        }
        if (imageSizeArr == 1) {
            Swal.fire({
                title: 'Maaf',
                text: 'Maaf, File "' + imagename + '" terlalu besar / memiliki ukuran lebih dari 1MB'
            })
            $('#logo').val('');
        }
    }
});
ClassicEditor.create( document.querySelector('#note_invoice'),{
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            ]
        }
    }
    )
</script>
@endsection
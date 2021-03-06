const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: true
})
var dibayar = document.getElementById('dibayar');

//===============================================================================================
$(function() {
    flatpickr("#tanggal", {
        enableTime: false,
        dateFormat: "Y-m-d",
        mode: "range"
    });
    flatpickr("#tglbayar", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
    $('#pembayaranform').on('submit', function () {
        $('#simpanpembayaran').attr('disabled', 'disabled');
    });
});

//===============================================================================================
function hapusdata(kode) {
    swalWithBootstrapButtons.fire({
        title: 'Hapus Data ?',
        text: "Data tidak dapat di pulihkan kembali!",
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Tidak',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $('#' + kode).submit();
        }
    });
}

//===============================================================================================
$('#metode_bayar').on('change', function() {
    if(this.value=='Cash'){
        $("#bts").prop('required',false);
    }else{
        $("#bts").prop('required',true);
    }
  });

//===============================================================================================
function pembayaran(kode) {
    $('#panelsatu').loading('toggle');
    $.ajax({
        type: 'GET',
        url: '/detail-transaksi/' + kode,
        success: function(data) {
            $.each(data.transaksi, function(key, value) {
                $('#tampil_kode').html(value.kode);
                $('#tampil_kekurangan').html('Rp '+rupiah(parseInt(value.total)-parseInt(value.dibayar)));
                $('#tampil_dibayar').html('Rp '+rupiah(value.dibayar));
                $('#tampil_angsuran').html(data.totalangsuran+1+'/'+value.angsur);
                $('#kode').val(value.kode);
                $('#terbayar').val(value.dibayar);
                $('#total').val(value.total);
                $('#angsuran').val(data.totalangsuran);
            });
        },
        complete: function() {
            $('#panelsatu').loading('stop');
            $('#modalbayar').modal('show');
        }
    });
}

//========================================================================================
dibayar.addEventListener('keyup', function (e) {
    dibayar.value = formatRupiahkeyup(this.value);
});

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

//===============================================================================================
function formatRupiahkeyup(angka) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return rupiah;
}

//========================================================================================
$('#bts').on('change', function () {
    var imageSizeArr = 0;
    var imageSize = document.getElementById('bts');
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
            $('#bts').val('');
        }
    }
});
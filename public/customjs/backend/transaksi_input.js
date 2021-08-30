const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: true
});
var harga_prc = document.getElementById('harga_prc');
var diskon_prc = document.getElementById('diskon_prc');
var detail_charge = document.getElementById('detail_charge');
var detail_ppn = document.getElementById('detail_ppn');
var detail_potongan = document.getElementById('detail_potongan');
var detail_dibayar = document.getElementById('detail_dibayar');

//========================================================================================
$(function () {
    getdata();
    flatpickr("#tgl_acara", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
    flatpickr("#tgl", {
        enableTime: false,
        dateFormat: "Y-m-d",
    });
    $('#pricelist').select2({
        placeholder: "Cari berdasarkan nama pricelist",
        minimumInputLength: 2,
        ajax: {
            url: '/cari-data-pricelist',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.id,
                            text: item.nama + '- Rp ' + rupiah(item.harga_paket)
                        }
                    })
                }
            },
            cache: true
        }
    });
});

//========================================================================================
harga_prc.addEventListener('keyup', function (e) {
    harga_prc.value = formatRupiahkeyup(this.value);
    hitungsubtotal();
});

//========================================================================================
diskon_prc.addEventListener('keyup', function (e) {
    hitungsubtotal();
});

//========================================================================================
$('#pricelist').on('select2:select', function (e) {
    $('#panelsatu').loading('toggle');
    var kode = $(this).val();
    var url = '/cari-detail-pricelist/' + kode;
    $.ajax({
        type: 'GET',
        url: url,
        success: function (data) {
            $.each(data, function (key, value) {
                $('#nama_prc').val(value.nama);
                $('#diskon_prc').val(value.diskon);
                $('#harga_prc').val(rupiah(value.harga_paket));
            });
        }, complete: function () {
            hitungsubtotal();
            $('#panelsatu').loading('stop');
        }
    });
});

//===============================================================================================
function hitungsubtotal() {
    var harga_prc = '';
    var diskon_prc = '';

    if ($('#harga_prc').val() != '') {
        harga_prc = $('#harga_prc').val().replace(/\./g, '');
    } else {
        harga_prc = 0;
    }

    if ($('#diskon_prc').val() != '') {
        diskon_prc = $('#diskon_prc').val().replace(/\./g, '');
    } else {
        diskon_prc = 0;
    }

    var jumlahdiskon = (parseInt(harga_prc) * parseInt(diskon_prc)) / 100;
    var finaltotal = parseInt(harga_prc) - parseInt(jumlahdiskon);
    $('#subtotal_prc').val(rupiah(finaltotal));
}


//===============================================================================================
function getdata() {
    $('#paneldua').loading('toggle');
    var kode = $('#kode').val();
    $('#tubuhnya').html('');
    $.ajax({
        type: 'GET',
        url: '/data-detail-transaksi/' + kode,
        success: function (data) {
            var rows = '';
            var no = 0;
            var subtotal = 0;
            $.each(data, function (key, value) {
                no += 1;
                rows = rows + '<tr>';
                rows = rows + '<td>' + value.nama_pricelist + '</td>';
                rows = rows + '<td>' + value.tgl_eksekusi + '</td>';
                rows = rows + '<td class="text-center">' + value.lokasi + '</td>';
                rows = rows + '<td class="text-right"> Rp ' + rupiah(value.harga) + '</td>';
                rows = rows + '<td class="text-center">' + value.diskon + '</td>';
                rows = rows + '<td class="text-right"> Rp ' + rupiah(value.total) + '</td>';
                rows = rows + '<td class="text-center"><button type="button" onclick="hapusdetail(' + value.id + ')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></td>';
                rows = rows + '</tr>';
                subtotal += parseInt(value.total);
            });
            $('#detail_subtotal').val(subtotal);
            $('#tubuhnya').html(rows);
        }, complete: function () {
            hitungtotaldetail();
            $('#paneldua').loading('stop');
        }
    });
}

//========================================================================================
$('#tambahbtn').on('click', function (e) {
    if ($('#pricelist').val() == '' || $('#nama_prc').val() == '' || $('#harga_prc').val() == '' || $('#diskon_prc').val() == '' || $('#tgl_acara').val() == '' || $('#lokasi').val() == '' || $('#subtotal_prc').val() == '') {
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Data tidak boleh kosog',
            confirmButtonText: 'OK'
        });
    } else {
        $('#panelsatu').loading('toggle');
        $.ajax({
            type: 'POST',
            url: '/add-detail-transaksi',
            data: {
                '_token': $('input[name=_token]').val(),
                'kode': $('#kode').val(),
                'pricelist': $('#pricelist').val(),
                'nama_prc': $('#nama_prc').val(),
                'harga_prc': $('#harga_prc').val(),
                'diskon_prc': $('#diskon_prc').val(),
                'tgl_acara': $('#tgl_acara').val(),
                'lokasi': $('#lokasi').val(),
                'subtotal_prc': $('#subtotal_prc').val(),
            },
            success: function () {
            }, complete: function () {
                getdata();
                $('#nama_prc').val('')
                $('#harga_prc').val('');
                $('#diskon_prc').val('');
                $('#tgl_acara').val('');
                $('#lokasi').val('');
                $('#subtotal_prc').val('');
                $('#pricelist').val(null).trigger('change');
                $('#panelsatu').loading('stop');
            }
        });
    }
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

//===============================================================================================
function hapusdetail(id){
    $('#paneldua').loading('toggle');
    $.ajax({
        type: 'POST',
        url: '/hapus-detail-transaksi',
        data: {
            '_token': $('input[name=_token]').val(),
            'kode':id,
        },
        success: function () {
            getdata();
        }, complete: function () {
            $('#paneldua').loading('stop');
        }
    });
}

//========================================================================================
detail_charge.addEventListener('keyup', function (e) {
    detail_charge.value = formatRupiahkeyup(this.value);
    hitungtotaldetail();
});

//========================================================================================
detail_ppn.addEventListener('keyup', function (e) {
    detail_ppn.value = formatRupiahkeyup(this.value);
    hitungtotaldetail();
});

//========================================================================================
detail_potongan.addEventListener('keyup', function (e) {
    detail_potongan.value = formatRupiahkeyup(this.value);
    hitungtotaldetail();
});

//========================================================================================
detail_dibayar.addEventListener('keyup', function (e) {
    detail_dibayar.value = formatRupiahkeyup(this.value);
    hitungtotaldetail();
});

//===============================================================================================
function hitungtotaldetail(){
    if($('#detail_subtotal').val()==''){
        var detail_subtotal =0;
    }else{
        var detail_subtotal=parseInt($('#detail_subtotal').val());
    }
    if($('#detail_charge').val()==''){
        var detail_charge =0;
    }else{
        var detail_charge=parseInt($('#detail_charge').val().replace(/\./g, ''));
    }
    if($('#detail_potongan').val()==''){
        var detail_potongan =0;
    }else{
        var detail_potongan=parseInt($('#detail_potongan').val().replace(/\./g, ''));
    }
    if($('#detail_ppn').val()==''){
        var detail_ppn =0;
    }else{
        var detail_ppn=parseInt($('#detail_ppn').val().replace(/\./g, ''));
    }

    if($('#detail_dibayar').val()==''){
        var detail_dibayar =0;
    }else{
        var detail_dibayar=parseInt($('#detail_dibayar').val().replace(/\./g, ''));
    }
    var totalnya =parseInt(detail_subtotal)+parseInt(detail_charge)-parseInt(detail_potongan)+parseInt(detail_ppn);
    var presentase = Math.round((parseInt(detail_dibayar)/parseInt(totalnya))*100);
    if($('#detail_dibayar').val()!=''){
        if(presentase<20){
            $('#presentase_error').html('Maaf, pembayaran pertama minimal 20%');
            $('#presentase_info').html('');
        }else{
            $('#presentase_info').html('Dibayar sebanyak '+presentase+'%');
            $('#presentase_error').html('');
        }
    }else{
        $('#presentase_info').html('');
        $('#presentase_error').html('');
    }
    $('#detail_grand_total').val(parseInt(detail_subtotal)+parseInt(detail_charge)-parseInt(detail_potongan)+parseInt(detail_ppn));
    $('#tampil_subtotal').html('Rp '+rupiah(detail_subtotal));
    $('#tampil_charge').html('Rp '+rupiah(detail_charge));
    $('#tampil_potongan').html('Rp '+rupiah(detail_potongan));
    $('#tampil_ppn').html('Rp '+rupiah(detail_ppn));
    $('#tampil_grand_total').html('Rp '+rupiah(parseInt(detail_subtotal)+parseInt(detail_charge)-parseInt(detail_potongan)+parseInt(detail_ppn)));
    $('#tampil_dibayar').html('Rp '+rupiah(detail_dibayar));
    $('#tampil_kekurangan').html('Rp '+rupiah((parseInt(detail_subtotal)+parseInt(detail_charge)-parseInt(detail_potongan)+parseInt(detail_ppn))-parseInt(detail_dibayar)));
}

//========================================================================================
$('#simpanbtn').on('click',function(e){
    if($('#kode').val()==''||$('#tgl').val()==''||$('#nama').val()==''||$('#telp').val()==''||$('#alamat').val()==''||$('#detail_potongan').val()==''||$('#detail_ppn').val()==''||$('#detail_charge').val()==''||$('#detail_dibayar').val()==''||$('#angsur').val()==''||$('#tubuhnya').html()==''){
        swalWithBootstrapButtons.fire({
            title: 'Oops',
            text: 'Detail permintaan tidak boleh kosog',
            confirmButtonText: 'OK'
          });
    }else{
        $('#paneldua').loading('toggle');
        $.ajax({
            type: 'POST',
            url: '/transaksi',
            data: {
                '_token': $('input[name=_token]').val(),
                'kode':$('#kode').val(),
                'tgl':$('#tgl').val(),
                'nama':$('#nama').val(),
                'telp':$('#telp').val(),
                'alamat':$('#alamat').val(),
                'detail_subtotal':$('#detail_subtotal').val(),
                'detail_potongan':$('#detail_potongan').val(),
                'detail_ppn':$('#detail_ppn').val(),
                'detail_charge':$('#detail_charge').val(),
                'detail_dibayar':$('#detail_dibayar').val(),
                'detail_grand_total':$('#detail_grand_total').val(),
                'angsur':$('#angsur').val(),
                'ket_charge':$('#ket_charge').val(),
            },
            success: function () {
                swalWithBootstrapButtons.fire({
                    title: 'Info',
                    text: 'Data Berhasil disimpan',
                    confirmButtonText: 'OK'
                  }).then((result) => {
                    if (result.value) {
                        window.location.replace('/transaksi');
                    }
                });
            }, complete: function () {
                $('#paneldua').loading('stop');
            }
        });
    }
});
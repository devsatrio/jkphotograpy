    
var album = document.getElementById('album');
var cetak = document.getElementById('cetak');
var flashdisk = document.getElementById('flashdisk');
var box = document.getElementById('box');
var duavg = document.getElementById('2vg');
var satuvg = document.getElementById('1vg');
var asisten = document.getElementById('asisten');
var editor = document.getElementById('editor');
var transport = document.getElementById('transport');
var laba_bersih = document.getElementById('laba_bersih');
var harga_paket = document.getElementById('harga_paket');
var diskon = document.getElementById('diskon');

harga_paket.addEventListener('keyup', function(e) {
    harga_paket.value = formatRupiah(this.value);
    hitungtotal();
});
laba_bersih.addEventListener('keyup', function(e) {
    laba_bersih.value = formatRupiah(this.value);
    hitungtotal();
});
transport.addEventListener('keyup', function(e) {
    transport.value = formatRupiah(this.value);
    hitungtotal();
});
editor.addEventListener('keyup', function(e) {
    editor.value = formatRupiah(this.value);
    hitungtotal();
});
asisten.addEventListener('keyup', function(e) {
    asisten.value = formatRupiah(this.value);
    hitungtotal();
});
satuvg.addEventListener('keyup', function(e) {
    satuvg.value = formatRupiah(this.value);
});
duavg.addEventListener('keyup', function(e) {
    duavg.value = formatRupiah(this.value);
    hitungtotal();
});
box.addEventListener('keyup', function(e) {
    box.value = formatRupiah(this.value);
    hitungtotal();
});
flashdisk.addEventListener('keyup', function(e) {
    flashdisk.value = formatRupiah(this.value);
    hitungtotal();
});
cetak.addEventListener('keyup', function(e) {
    cetak.value = formatRupiah(this.value);
    hitungtotal();
});
album.addEventListener('keyup', function(e) {
    album.value = formatRupiah(this.value);
    hitungtotal();
});

diskon.addEventListener('keyup', function(e) {
    hitungtotal();
});

function formatRupiah(angka) {
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

function hitungtotal(){
    var album = '';
    var cetak = '';
    var flashdisk = '';
    var box = '';
    var duavg = '';
    var satuvg = '';
    var asisten = '';
    var editor = '';
    var transport = '';
    var laba_bersih = '';
    var harga_paket ='';
    var diskon='';

    if($('#album').val()!=''){
        album = $('#album').val().replace(/\./g,'');
    }else{
        album= 0;
    }

    if($('#cetak').val()!=''){
        cetak = $('#cetak').val().replace(/\./g,'');  
    }else{
        cetak= 0;
    }

    if($('#flashdisk').val()!=''){
        flashdisk = $('#flashdisk').val().replace(/\./g,'');  
    }else{
        flashdisk= 0;
    }

    if($('#box').val()!=''){
        box = $('#box').val().replace(/\./g,'');  
    }else{
        box= 0;
    }

    if($('#2vg').val()!=''){
        duavg = $('#2vg').val().replace(/\./g,'');  
    }else{
        duavg= 0;
    }

    if($('#1vg').val()!=''){
        satuvg = $('#1vg').val().replace(/\./g,'');  
    }else{
        satuvg= 0;
    }

    if($('#asisten').val()!=''){
        asisten = $('#asisten').val().replace(/\./g,'');  
    }else{
        asisten= 0;
    }

    if($('#editor').val()!=''){
        editor = $('#editor').val().replace(/\./g,'');  
    }else{
        editor= 0;
    }

    if($('#transport').val()!=''){
        transport = $('#transport').val().replace(/\./g,'');  
    }else{
        transport= 0;
    }

    if($('#laba_bersih').val()!=''){
        laba_bersih = $('#laba_bersih').val().replace(/\./g,'');  
    }else{
        laba_bersih= 0;
    }

    if($('#harga_paket').val()!=''){
        harga_paket = $('#harga_paket').val().replace(/\./g,'');  
    }else{
        harga_paket= 0;
    }

    if($('#diskon').val()!=''){
        diskon = $('#diskon').val();  
    }else{
        diskon= 0;
    }
    
    var jumlahdiskon = harga_paket*diskon/100;
    var hargafinal = parseInt(harga_paket)-jumlahdiskon;
    var total=parseInt(album)+parseInt(cetak)+parseInt(flashdisk)+parseInt(box)+parseInt(duavg)+parseInt(satuvg)+parseInt(asisten)+parseInt(editor)+parseInt(transport);
    if(parseInt(hargafinal)>total){
        var laba = parseInt(hargafinal) - total;
    }else{
        var laba=0;
    }
    $('#total').val(formatRupiah(total.toString()));
    $('#laba_bersih').val(formatRupiah(laba.toString()));
}
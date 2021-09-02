<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;

class laporanTransaksiExport implements FromCollection,WithHeadings,ShouldAutoSize
{
    public function __construct(string $tgl, string $status)
    {
        $this->tgl = $tgl;
        $this->status = $status;
    }

    public function collection()
    {
        $tanggal = explode('to',$this->tgl);

        return DB::table('transaksi')
        ->select('kode','nama_customer','telp_customer','tgl_buat','status','total','dibayar','dibayar')
        ->where('status',$this->status)
        ->whereBetween('tgl_buat',[$tanggal[0],$tanggal[1]])
        ->get();
    }

    public function headings(): array
    {
        return [
            'Kode',
            'Customer',
            'Telp',
            'Tgl Input',
            'Status Bayar',
            'Total Tagihan',
            'Terbayar',
            'Kekurangan',
        ];
    }
}

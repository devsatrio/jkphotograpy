<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;

class laporanLabaExport implements FromCollection,WithHeadings,ShouldAutoSize
{
    public function __construct(string $tgl, string $status)
    {
        $this->tgl = $tgl;
        $this->status = $status;
    }

    public function collection()
    {
        $tanggal = explode(' to ',$this->tgl);
        if($this->status=='Semua'){
            return DB::table('transaksi')
            ->select(DB::raw('kode,nama_customer,telp_customer,tgl_buat,status,total,dibayar,dibayar,total-dibayar,charge,laba+charge'))
            ->whereBetween('tgl_buat',[$tanggal[0],$tanggal[1]])
            ->get();
        }else{
            return DB::table('transaksi')
            ->select(DB::raw('kode,nama_customer,telp_customer,tgl_buat,status,total,dibayar,dibayar,total-dibayar,charge,laba+charge'))
            ->where('status','=',$this->status)
            ->whereBetween('tgl_buat',[$tanggal[0],$tanggal[1]])
            ->get();
        }
        
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
            'Charge',
            'Laba',
        ];
    }
}

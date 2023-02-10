<?php

namespace App\Exports;
use App\Models\LeavesAdmin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeavesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LeavesAdmin::select(
            "user_id",
            "leave_type",
            "from_date",
            "to_date",
            "day",
            "leave_reason")->get();
    }

    public function headings(): array {
        return [
            "NIK",
            "Jenis Izin",
            "Start Izin",
            "Izin Sampai",
            "Lama Izin",
            "Alasan Izin"
        ];
    }
}

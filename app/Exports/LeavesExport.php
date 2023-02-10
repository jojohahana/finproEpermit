<?php

namespace App\Exports;
use App\Models\LeavesAdmin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class LeavesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return LeavesAdmin::select(
    //         "user_id",
    //         "leave_type",
    //         "from_date",
    //         "to_date",
    //         "day",
    //         "leave_reason")
    //         ->where('leaves_admin.data_status','=','ACTIVE')
    //         ->get();
    // }

    public function collection() {
        return DB::table('leaves_admin')
                ->join('employee','employee.employee_id','=','leaves_admin.user_id')
                ->select('leaves_admin.user_id',
                        'employee.name',
                        'employee.department',
                        'leaves_admin.leave_type',
                        'leaves_admin.from_date',
                        'leaves_admin.to_date',
                        'leaves_admin.day',
                        'leaves_admin.leave_reason')
                ->where('leaves_admin.data_status','=','ACTIVE')
                ->get();
    }

    public function headings(): array {
        return [
            "NIK",
            "Nama",
            "Dept",
            "Jenis Izin",
            "Start Izin",
            "Izin Sampai",
            "Lama Izin",
            "Alasan Izin"
        ];
    }
}

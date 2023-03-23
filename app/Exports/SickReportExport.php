<?php

namespace App\Exports;
use App\Models\LeavesSick;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class SickReportExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection() {
        return DB::table('leaves_sick')
                ->join('employee','employee.employee_id','=','leaves_sick.user_id')
                ->select('leaves_admin.user_id',
                        'employee.name',
                        'employee.department',
                        'leaves_sick.sick_id',
                        'leaves_sick.sick_type',
                        'leaves_sick.from_date',
                        'leaves_sick.to_date',
                        'leaves_sick.day',
                        'leaves_sick.stat_app3')
                ->where('leaves_admin.data_status','=','ACTIVE')
                ->get();
    }

    public function headings(): array {
        return [
            "NIK",
            "Nama",
            "Dept",
            "Id Izin",
            "Jenis Sakit",
            "Start Izin",
            "Izin Sampai",
            "Lama Izin",
            "Status"
        ];
    }
}

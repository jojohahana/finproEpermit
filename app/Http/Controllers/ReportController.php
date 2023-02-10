<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeavesAdmin;
use App\Models\LeavesSick;
use App\Exports\LeavesExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use DateTime;
use PDF;

class ReportController extends Controller
{
    public function indexExcel() {
        $leaves = DB::table('leaves_admin')
                    ->join('employee', 'employee.employee_id', '=', 'leaves_admin.user_id')
                    ->select('leaves_admin.*', 'employee.position','employee.name','employee.department')
                    ->where('leaves_admin.data_status','=','ACTIVE')
                    ->get();

        return view('form.reportExcel',compact('leaves'));
        // return view('form.reportPDF');
    }

    public function indexPDF() {
        $leaves = DB::table('leaves_admin')
                    ->join('employee', 'employee.employee_id', '=', 'leaves_admin.user_id')
                    ->select('leaves_admin.*', 'employee.position','employee.name','employee.department')
                    ->where('leaves_admin.data_status','=','ACTIVE')
                    ->get();

        return view('form.reportPDF',compact('leaves'));
    }

    public function reportPDF() {
        $getCuti = DB::table('leaves_admin')
                ->join('employee', 'employee.employee_id', '=', 'leaves_admin.user_id')
                ->select('leaves_admin.*', 'employee.position','employee.name','employee.department')
                ->where('leaves_admin.data_status','=','ACTIVE')
                ->get();
        // $getCuti = LeavesAdmin::get();

        $data = [
            'title' => 'Laporan Izin Cuti',
            'date'  => date('d/m/Y'),
            'getCuti'   => $getCuti
        ];

        $pdf = PDF::loadView('form.formatPDF', $data)->setPaper('a4','landscape');
        return $pdf->download('testReportCuti.pdf');
    }

    public function reportExcel() {
        return Excel::download(new LeavesExport, 'testExcel.xlsx');
    }
}

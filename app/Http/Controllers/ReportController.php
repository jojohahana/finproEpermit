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
    // =========== REPORT EXCEL ===============
    public function indexReportSick() {
        $leaves = DB::table('leaves_sick')
                    ->join('employee', 'employee.employee_id', '=', 'leaves_sick.user_id')
                    ->select('leaves_sick.*', 'employee.position','employee.name','employee.department')
                    ->where('leaves_sick.data_status','=','ACTIVE')
                    ->get();

        return view('form.reportSickLeave',compact('leaves'));
    }



    // ============ REPORT LEAVES / CUTI ================
    public function indexReportLeave() {
        $leaves = DB::table('leaves_admin')
        ->join('employee', 'employee.employee_id', '=', 'leaves_admin.user_id')
        ->select('leaves_admin.*', 'employee.position','employee.name','employee.department')
        ->where('leaves_admin.data_status','=','ACTIVE')
        ->get();

        return view('form.reportLeaves',compact('leaves'));
    }

    public function reportExcel() {
        return Excel::download(new LeavesExport, 'testExcel.xlsx');
    }

    public function reportPDF() {
        $getCuti = DB::table('leaves_admin')
                ->join('employee', 'employee.employee_id', '=', 'leaves_admin.user_id')
                ->select('leaves_admin.*', 'employee.position','employee.name','employee.department')
                ->where('leaves_admin.data_status','=','ACTIVE')
                ->get();

        $data = [
            'title' => 'Laporan Izin Cuti',
            'date'  => date('d/m/Y'),
            'getCuti'   => $getCuti
        ];

        $pdf = PDF::loadView('form.formatPDF', $data)->setPaper('a4','landscape');
        return $pdf->download('testReportCuti.pdf');
    }

    public function filterByNik(Request $request) {
        if($request->employee_id) {
            $findNik = DB::table('leaves_admin')
                    ->join('employee', 'employee.employee_id', '=', 'leaves_admin.user_id')
                    ->select('leaves_admin.*', 'employee.position','employee.name','employee.department')
                    ->where('leaves_admin.data_status','=','ACTIVE')
                    ->where('leaves_admin.user_id','='.$request->user_id)
                    ->get();
        }

    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\LeavesAdmin;
use App\Models\LeavesSick;
use App\Models\StatusApprove;
use DB;
use DateTime;
use DataTables;

class LeavesController extends Controller
{
    // ++++++ LEAVES PERMIT | CUTI ++++++
    // 1. INDEX CUTI KARYAWAN
    public function leaves()
    {
        $leaves = DB::table('leaves_admin')
                    ->join('employee', 'employee.employee_id', '=', 'leaves_admin.user_id')
                    ->select('leaves_admin.*', 'employee.position','employee.name','employee.department')
                    ->where('leaves_admin.data_status','=','ACTIVE')
                    ->get();

        return view('form.leaves',compact('leaves'));
    }


    // +++++++ SICK LEAVES PERMIT +++++++
    // 1. INDEX SAKIT KARYAWAN
    public function sick_leaves() {
        $sick = DB::table('leaves_sick')
                ->join('employee', 'employee.employee_id', '=', 'leaves_sick.user_id')
                ->select('leaves_sick.*', 'employee.position', 'employee.name', 'employee.department')
                ->where('leaves_sick.data_status','=','ACTIVE')
                ->get();
        return view('form.leavesSick',compact('sick'));
    }

    // ++++++ APPROVAL LEAVES PERMIT +++++++
    // 1. INDEX APPROVAL CUTI - LEVEL 1 - SUPERVISOR
    public function leavesApprove1() {
        $leaves = DB::table('leaves_admin')
                    ->join('employee', 'employee.employee_id', '=', 'leaves_admin.user_id')
                    ->select('leaves_admin.*', 'employee.position','employee.name',
                        'employee.department','leaves_admin.stat_app1','leaves_admin.stat_app2',
                        'leaves_admin.stat_app3')
                    ->where('leaves_admin.data_status','=','ACTIVE')
                    ->where('leaves_admin.stat_app1','=','NEW')
                    ->where('leaves_admin.stat_app2','=','Wait')
                    ->get();

        return view('form.leavesapprove', compact('leaves'));
    }

    // 2. APPROVE LEVEL 1
    public function approveOne($employee_id) {
        // DB::beginTransaction();
        try{
            LeavesAdmin::where('id',$employee_id)
                ->update(['stat_app2' => 'Approve']);

            // DB::commit();
            Toastr::success('Decline Permit Success :)','Success');
            return redirect()->route('form/leavesApprove');
        }catch(\Exception $e){
            // DB::rollback();
            Toastr::error('Decline Permit Fail :)','Error');
            return redirect()->back();
        }
    }

    // 3. DECLINE LEVEL 1
    public function declineOne($employee_id) {
        // DB::beginTransaction();
        try{
            LeavesAdmin::where('id',$employee_id)
                ->update(['data_status' => 'NOT ACTIVE']);

            // DB::commit();
            Toastr::success('Decline Permit Success :)','Success');
            return redirect()->route('form/leavesApprove');
        }catch(\Exception $e){
            // DB::rollback();
            Toastr::error('Decline Permit Fail :)','Error');
            return redirect()->back();
        }
    }

    // 2. INDEX APPROVAL CUTI - LEVEL 2 - MANAGER
    public function leavesApprove2() {
        $leaves = DB::table('leaves_admin')
                    ->join('employee', 'employee.employee_id', '=', 'leaves_admin.user_id')
                    ->select('leaves_admin.*', 'employee.position','employee.name',
                        'employee.department','leaves_admin.stat_app1','leaves_admin.stat_app2',
                        'leaves_admin.stat_app3')
                    ->where('leaves_admin.data_status','=','ACTIVE')
                    ->where('leaves_admin.stat_app2','=','Approve')
                    // ->where('leaves_admin.stat_app3','=','Wait')
                    ->get();

        return view('form.leavesapprove2', compact('leaves'));
    }



    // 2.1. APPROVAL LEVEL 2
    public function approveTwo($employee_id) {
        // DB::beginTransaction();
        try{
            LeavesAdmin::where('id',$employee_id)
                ->update(['stat_app3' => 'Approve']);

            // DB::commit();
            Toastr::success('Decline Permit Success :)','Success');
            return redirect()->route('form/leavesApprove2');
        }catch(\Exception $e){
            // DB::rollback();
            Toastr::error('Decline Permit Fail :)','Error');
            return redirect()->back();
        }
    }

    // 2.2 DECLINE LEVEL 2
    public function declineTwo($employee_id) {
        // DB::beginTransaction();
        try{
            LeavesAdmin::where('id',$employee_id)
                ->update(['data_status' => 'NOT ACTIVE']);

            // DB::commit();
            Toastr::success('Decline Permit Success :)','Success');
            return redirect()->route('form/leavesApprove2');
        }catch(\Exception $e){
            // DB::rollback();
            Toastr::error('Decline Permit Fail :)','Error');
            return redirect()->back();
        }
    }





    // ++++++ APPROVAL SICK LEAVES PERMIT ++++++
    // 1. INDEX APPROVAL IZIN SAKIT
    public function sickApprove() {
        $leaves = DB::table('leaves_admin')
                    ->join('employee', 'employee.employee_id', '=', 'leaves_admin.user_id')
                    ->select('leaves_admin.*', 'employee.position','employee.name','employee.department')
                    ->where('leaves_admin.data_status','=','ACTIVE')
                    ->get();

        return view('form.leavesickapprove', compact('leaves'));
    }

    // public function filterType(Request $request) {
    //     if ($request->ajax()) {
    //         $data = LeavesAdmin::select(*);
    //         return
    //     }
    // }
    // save record
    // public function saveRecord(Request $request)
    // {
    //     $request->validate([
    //         'leave_type'   => 'required|string|max:255',
    //         'from_date'    => 'required|string|max:255',
    //         'to_date'      => 'required|string|max:255',
    //         'leave_reason' => 'required|string|max:255',
    //     ]);

    //     DB::beginTransaction();
    //     try {

    //         $from_date = new DateTime($request->from_date);
    //         $to_date = new DateTime($request->to_date);
    //         $day     = $from_date->diff($to_date);
    //         $days    = $day->d;

    //         $leaves = new LeavesAdmin;
    //         $leaves->user_id        = $request->user_id;
    //         $leaves->leave_type    = $request->leave_type;
    //         $leaves->from_date     = $request->from_date;
    //         $leaves->to_date       = $request->to_date;
    //         $leaves->day           = $days;
    //         $leaves->leave_reason  = $request->leave_reason;
    //         $leaves->save();

    //         DB::commit();
    //         Toastr::success('Create new Leaves successfully :)','Success');
    //         return redirect()->back();
    //     } catch(\Exception $e) {
    //         DB::rollback();
    //         Toastr::error('Add Leaves fail :)','Error');
    //         return redirect()->back();
    //     }
    // }

    // edit record
    // public function editRecordLeave(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {

    //         $from_date = new DateTime($request->from_date);
    //         $to_date = new DateTime($request->to_date);
    //         $day     = $from_date->diff($to_date);
    //         $days    = $day->d;

    //         $update = [
    //             'id'           => $request->id,
    //             'leave_type'   => $request->leave_type,
    //             'from_date'    => $request->from_date,
    //             'to_date'      => $request->to_date,
    //             'day'          => $days,
    //             'leave_reason' => $request->leave_reason,
    //         ];

    //         LeavesAdmin::where('id',$request->id)->update($update);
    //         DB::commit();
    //         Toastr::success('Updated Leaves successfully :)','Success');
    //         return redirect()->back();
    //     } catch(\Exception $e) {
    //         DB::rollback();
    //         Toastr::error('Update Leaves fail :)','Error');
    //         return redirect()->back();
    //     }
    // }

    // delete record
    // public function deleteLeave(Request $request)
    // {
    //     try {

    //         LeavesAdmin::destroy($request->id);
    //         Toastr::success('Leaves admin deleted successfully :)','Success');
    //         return redirect()->back();

    //     } catch(\Exception $e) {

    //         DB::rollback();
    //         Toastr::error('Leaves admin delete fail :)','Error');
    //         return redirect()->back();
    //     }
    // }

    // leaveSettings
    public function leaveSettings()
    {
        return view('form.leavesettings');
    }

    // attendance admin
    public function attendanceIndex()
    {
        return view('form.attendance');
    }

    // attendance employee
    public function AttendanceEmployee()
    {
        return view('form.attendanceemployee');
    }

    // leaves Employee
    public function leavesEmployee()
    {
        return view('form.leavesemployee');
    }

    // shiftscheduling
    public function shiftScheduLing()
    {
        return view('form.shiftscheduling');
    }

    // shiftList
    public function shiftList()
    {
        return view('form.shiftlist');
    }
}

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
            Toastr::success('Approve Permit Success :)','Success');
            return redirect()->route('form/leavesApprove');
        }catch(\Exception $e){
            // DB::rollback();
            Toastr::error('Approve Permit Fail :)','Error');
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
                    ->where('leaves_admin.stat_app3','=','Wait')
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
            Toastr::success('Approve Permit Success :)','Success');
            return redirect()->route('form/leavesApprove2');
        }catch(\Exception $e){
            // DB::rollback();
            Toastr::error('Approve Permit Fail :)','Error');
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
    // 2. INDEX APPROVAL CUTI - LEVEL 3 - DIREKSI
    public function leavesApprove3() {
        $leaves = DB::table('leaves_admin')
                    ->join('employee', 'employee.employee_id', '=', 'leaves_admin.user_id')
                    ->select('leaves_admin.*', 'employee.position','employee.name',
                        'employee.department','leaves_admin.stat_app1','leaves_admin.stat_app2',
                        'leaves_admin.stat_app3')
                    ->where('leaves_admin.data_status','=','ACTIVE')
                    ->where('leaves_admin.stat_app2','=','Approve')
                    ->where('leaves_admin.stat_app3','=','Wait')
                    ->get();

        return view('form.leavesapprove3', compact('leaves'));
    }



    // 2.1. APPROVAL LEVEL 3
    public function approveThree($employee_id) {
        // DB::beginTransaction();
        try{
            LeavesAdmin::where('id',$employee_id)
                ->update(['stat_app3' => 'Approve']);

            // DB::commit();
            Toastr::success('Approve Permit Success :)','Success');
            return redirect()->route('form/leavesApprove3');
        }catch(\Exception $e){
            // DB::rollback();
            Toastr::error('Approve Permit Fail :)','Error');
            return redirect()->back();
        }
    }

    // 2.2 DECLINE LEVEL 3
    public function declineThree($employee_id) {
        // DB::beginTransaction();
        try{
            LeavesAdmin::where('id',$employee_id)
                ->update(['data_status' => 'NOT ACTIVE']);

            // DB::commit();
            Toastr::success('Decline Permit Success :)','Success');
            return redirect()->route('form/leavesApprove3');
        }catch(\Exception $e){
            // DB::rollback();
            Toastr::error('Decline Permit Fail :)','Error');
            return redirect()->back();
        }
    }




    // ++++++ APPROVAL SICK LEAVES PERMIT ++++++
    // 1. INDEX APPROVAL IZIN SAKIT LEVEL 1
    public function sickApprove() {
        $leaves = DB::table('leaves_sick')
                    ->join('employee', 'employee.employee_id', '=', 'leaves_sick.user_id')
                    ->select('leaves_sick.*', 'employee.position','employee.name','employee.department',
                        'leaves_sick.stat_app1','leaves_sick.stat_app2','leaves_sick.stat_app3')
                    ->where('leaves_sick.data_status','=','ACTIVE')
                    ->where('leaves_sick.stat_app1','=','NEW')
                    ->where('leaves_sick.stat_app2','=','Wait')
                    ->get();

        return view('form.leavesickapprove', compact('leaves'));
    }

    public function approveSickOne($employee_id) {
        try{
            LeavesSick::where('id',$employee_id)
                ->update(['stat_app2' => 'Approve']);

            Toastr::success('Approve Permit Success :)', 'Success');
            return redirect()->route('form/sickApprove');
        }catch(\Exception $e) {
            Toastr::error('Approve Permit Fail :)','Error');
            return redirect()->back();
        }
    }

    public function declineSickOne($employee_id) {
        try{
            LeavesSick::where('id',$employee_id)
                ->update(['data_status' => 'NOT ACTIVE']);

            // DB::commit();
            Toastr::success('Decline Permit Success :)','Success');
            return redirect()->route('form/sickApprove');
        }catch(\Exception $e){
            // DB::rollback();
            Toastr::error('Decline Permit Fail :)','Error');
            return redirect()->back();
        }
    }

    // 2. INDE APPROVAL IZIN SAKIT LEVEL 2
    public function sickApprove2() {
        $leaves = DB::table('leaves_sick')
                    ->join('employee', 'employee.employee_id', '=', 'leaves_sick.user_id')
                    ->select('leaves_sick.*', 'employee.position','employee.name','employee.department','leaves_sick.stat_app1',
                        'leaves_sick.stat_app2','leaves_sick.stat_app3')
                    ->where('leaves_sick.data_status','=','ACTIVE')
                    ->where('leaves_sick.stat_app2','=','Approve')
                    ->where('leaves_sick.stat_app3','=','Wait')
                    ->get();

        return view('form.leavesickapprove2', compact('leaves'));
    }

    public function approveSickTwo($employee_id) {
        // DB::beginTransaction();
        try{
            LeavesSick::where('id',$employee_id)
                ->update(['stat_app3' => 'Approve']);

            // DB::commit();
            Toastr::success('Approve Permit Success :)','Success');
            return redirect()->route('form/sickApprove2');
        }catch(\Exception $e){
            // DB::rollback();
            Toastr::error('Approve Permit Fail :)','Error');
            return redirect()->back();
        }
    }

    public function declineSickTwo($employee_id) {
        // DB::beginTransaction();
        try{
            LeavesSick::where('id',$employee_id)
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

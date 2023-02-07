<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\department;
use App\Models\User;
use App\Models\module_permission;
use App\Models\Subdept;
use App\Models\roleTypeUser;
// YOHANA NAMBAHIN SENDIRI TRIAL DAFTAR ALL EMPLOYEE
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /* ++++ FIX CONTROLLER ++++ */

        // ===== REGISTER USERS E-PERMIT | KARYAWAN =====

    // 1. INDEX PAGE REGISTER USERS
    public function daftarAllEmployee() {
        $employee = DB::table('employee')
        ->where('data_status', '=','ACTIVE')
        ->where('role_type','=',null)
        ->get();
        $userList = DB::table('users')->get();
        $deptList = DB::table('departments')->get();
        $permission_lists = DB::table('permission_lists')->get();
        return view('form.regisemployee',compact('employee','userList','permission_lists','deptList'));
    }

    // 2. SAVE DATA REGISTER USERS
    public function saveRecord(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email',
            'department'    => 'required|string|max:255',
            'position'      => 'required|string|max:255',
            'join_date'     => 'required|string|max:255',
            'phone_number'  => 'required|string|max:255',
            'employee_id'   => 'required|string|max:255',
            'rfid_tag'      => 'required|string|max:255',
        ]);


            $employee = Employee::where('employee_id', '=',$request->employee_id)->first();
            // $employee = Employee::where('email', '=',$request->email)->first();
            if ($employee === null)
            {
                $employee = new Employee;
                $employee->name         = $request->name;
                $employee->email        = $request->email;
                $employee->department   = $request->department;
                $employee->position     = $request->position;
                $joindate = $request->join_date;
                $employee->join_date    = Carbon::parse($joindate)->format('Y-m-d');
                $employee->phone_number = $request->phone_number;
                $employee->employee_id  = $request->employee_id;
                $employee->rfid_tag     = $request->rfid_tag;
                $employee->save();

                // DB::commit();
                Toastr::success('Add new employee successfully :)','Success');
                return redirect()->route('all/employee/regist'); //ketiksa save rollback nya ke employee card
            } else {
                // DB::rollback();
                Toastr::error('Add new employee exits :)','Error');
                return redirect()->back();
            }
    }

    // 3. EDIT & UPDATA USERS
    public function updateRecord( Request $request)
    {
        DB::beginTransaction();
        try{
            // update table Employee
            $updateEmployee = [
                'name'=>$request->name_edit,
                'position'=>$request->position_edit,
                'department'=>$request->department_edit,
                'rfid_tag'=>$request->rfid_tag_edit,
                'email'=>$request->email_edit,
                'phone_number'=>$request->phone_number_edit,
            ];

            Employee::where('id',$request->id_edit)->update($updateEmployee);

            DB::commit();
            Toastr::success('Updated Employee successfully :)','Success');
            return redirect()->route('all/employee/regist');
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Updated Employee Fail :(','Error');
            return redirect()->back();
        }
    }

    // 4. DELETE & NON ACTIVE USERS
    public function deleteRecord($employee_id)
    {
        DB::beginTransaction();
        try{

            Employee::where('id',$employee_id)
            ->update(['data_status' => 'NOT ACTIVE']);

            DB::commit();
            Toastr::success('Delete record successfully :)','Success');
            return redirect()->route('all/employee/regist');

        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Delete record fail :)','Error');
            return redirect()->back();
        }
    }

    //  5. VIEW DATA USERS
    public function viewRecord(Request $request) {
        DB::beginTranscation();
        try{
            $viewEmployee = [
                'name' =>$request->name_edit,
                'position'=>$request->position_edit,
                'department'=>$request->department_edit,
                'rfid_tag'=>$request->rfid_tag_edit,
                'email'=>$request->email_edit,
                'phone_number'=>$request->phone_number_edit,
            ];
            Employee::where('id',$request->id_edit)->update($updateEmployee);

            DB::commit();
            Toastr::success('Updated Employee successfully :)','Success');
            return redirect()->route('all/employee/regist');
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Updated Employee Fail :(','Error');
            return redirect()->back();
        }
    }

        // ===== REGISTER USERS E-PERMIT | KARYAWAN =====

    // 1. INDEX PAGE REGIS ADMIN
   public function indexRegAdmin() {
    $employee = DB::table('employee')
        ->where('data_status', '=','ACTIVE')
        ->where('role_type','!=','') //only view having role_type
        ->get();
        $userList = DB::table('users')->get();
        $deptList = DB::table('departments')->get();
        $roleList = DB::table('role_type_users')->get();
        // $permission_lists = DB::table('permission_lists')->get();
        return view('form.regisadmin',compact('employee','userList','deptList','roleList'));
   }

    //  2. ADD + SAVE REGIS ADMIN
   public function saveAdmin(Request $request) {
    DB::beginTransaction();

    $request->validate([
        'employee_id'   => 'required|string|max:4',
        'name'          => 'required|string|max:100',
        'department'    => 'required|string|max:100',
        'position'      => 'required|string|max:100',
        'join_date'     => 'required|string|max:100',
        'phone_number'  => 'required|string|max:100',
        'email'         => 'required|string|email',
        'role_type'     => 'required|string|max:100',
        'rfid_tag'      => 'required|string|max:100',
    ]);

    $admin = Employee::where('employee_id', '=',$request->employee_id)->first();
    if ($admin === null) {
        $admin = new Employee;
        $admin->employee_id     = $request->employee_id;
        $admin->name            = $request->name;
        $admin->department      = $request->department;
        $admin->position        = $request->position;
        $joindate               = $request->join_date;
        $admin->join_date       = Carbon::parse($joindate)->format('Y-m-d');
        $admin->phone_number    = $request->phone_number;
        $admin->email           = $request->email;
        $admin->role_type       = $request->role_type;
        $admin->rfid_tag        = $request->rfid_tag;
        $admin->save();

        DB::commit();
        Toastr::success('Add new Administrator successfully :)','Success');
        return redirect()->route('all/employee/admin_reg');
    } else {
        DB::rollback();
        Toastr::error('Add new Administrator exits :)','Error');
        return redirect()->back();
    }

   }

    //3. EDIT & UPDATE ADMIN
    public function updateAdmin(Request $request) {
        DB::beginTransaction();
        try{
            $updateAdmin = [
                'name'=>$request->nameAdmin_edit,
                'email'=>$request->emailAdmin_edit,
                'department'=>$request->deptAdmin_edit,
                'position'=>$request->positionAdmin_edit,
                'join_date'=>$request->joindateAdm_edit,
                'phone_number'=>$request->phoneNum_edit,
                // 'employee_id'=>$request->employeeid_edit,
                'role_type'=>$request->role_type_edit,
                'rfid_tag'=>$request->rfidTag_edit,
            ];

            Employee::where('id',$request->id_edit)->update($updateAdmin);

            DB::commit();
            Toastr::success('Updated Admin Successfully :)','Success');
            return redirect()->route('all/employee/admin_reg');
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Updated Admin Fail :(','Error');
            return redirect()->back();
        }
    }

    // 4 DELETE & NON ACTIVE ADMIN
    public function deleteAdmin($employee_id) {
        DB::beginTransaction();
        try{
            Employee::where('id',$employee_id)
            ->update(['data_status' => 'NOT ACTIVE']);

            DB::commit();
            Toastr::success('Delete Admin Successfully :)','Success');
            return redirect()->route('all/employee/admin_reg');
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Delete Admin Fail :)','Error');
            return redirect()->back();
        }
    }

    // 5. VIEW DATA ADMIN
    public function viewAdmin(Request $request) {
        DB::beginTransaction();
        try{
            $updateAdmin = [
                'name'=>$request->nameAdmin_edit,
                'email'=>$request->emailAdmin_edit,
                'department'=>$request->deptAdmin_edit,
                'position'=>$request->positionAdmin_edit,
                'join_date'=>$request->joindateAdm_edit,
                'phone_number'=>$request->phoneNum_edit,
                // 'employee_id'=>$request->employeeid_edit,
                'role_type'=>$request->role_type_edit,
                'rfid_tag'=>$request->rfidTag_edit,
            ];

            Employee::where('id',$request->id_edit)->update($updateAdmin);

            DB::commit();
            Toastr::success('Updated Admin Successfully :)','Success');
            return redirect()->route('all/employee/admin_reg');
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Updated Admin Fail :(','Error');
            return redirect()->back();
        }
    }



    // employee search
    public function employeeearch(Request $request)
    {
        $users = DB::table('users')
                    ->join('employee', 'users.user_id', '=', 'employee.employee_id')
                    ->select('users.*', 'employee.birth_date', 'employee.gender', 'employee.company')
                    ->get();
        $permission_lists = DB::table('permission_lists')->get();
        $userList = DB::table('users')->get();

        // search by id
        if($request->employee_id)
        {
            $users = DB::table('users')
                        ->join('employee', 'users.user_id', '=', 'employee.employee_id')
                        ->select('users.*', 'employee.birth_date', 'employee.gender', 'employee.company')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->get();
        }
        // search by name
        if($request->name)
        {
            $users = DB::table('users')
                        ->join('employee', 'users.user_id', '=', 'employee.employee_id')
                        ->select('users.*', 'employee.birth_date', 'employee.gender', 'employee.company')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->get();
        }
        // search by name
        if($request->position)
        {
            $users = DB::table('users')
                        ->join('employee', 'users.user_id', '=', 'employee.employee_id')
                        ->select('users.*', 'employee.birth_date', 'employee.gender', 'employee.company')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }

        // search by name and id
        if($request->employee_id && $request->name)
        {
            $users = DB::table('users')
                        ->join('employee', 'users.user_id', '=', 'employee.employee_id')
                        ->select('users.*', 'employee.birth_date', 'employee.gender', 'employee.company')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->get();
        }
        // search by position and id
        if($request->employee_id && $request->position)
        {
            $users = DB::table('users')
                        ->join('employee', 'users.user_id', '=', 'employee.employee_id')
                        ->select('users.*', 'employee.birth_date', 'employee.gender', 'employee.company')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }
        // search by name and position
        if($request->name && $request->position)
        {
            $users = DB::table('users')
                        ->join('employee', 'users.user_id', '=', 'employee.employee_id')
                        ->select('users.*', 'employee.birth_date', 'employee.gender', 'employee.company')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }
         // search by name and position and id
         if($request->employee_id && $request->name && $request->position)
         {
             $users = DB::table('users')
                         ->join('employee', 'users.user_id', '=', 'employee.employee_id')
                         ->select('users.*', 'employee.birth_date', 'employee.gender', 'employee.company')
                         ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                         ->where('users.name','LIKE','%'.$request->name.'%')
                         ->where('users.position','LIKE','%'.$request->position.'%')
                         ->get();
         }
        return view('form.allemployeecard',compact('users','userList','permission_lists'));
    }
    public function employeeListSearch(Request $request)
    {
        $users = DB::table('employee')
                    ->join('employee', 'users.user_id', '=', 'employee.employee_id')
                    ->select('users.*', 'employee.birth_date', 'employee.gender', 'employee.company')
                    ->get();
        $permission_lists = DB::table('permission_lists')->get();
        $userList = DB::table('users')->get();

        // search by id
        if($request->employee_id)
        {
            $users = DB::table('users')
                        ->join('employee', 'users.user_id', '=', 'employee.employee_id')
                        ->select('users.*', 'employee.birth_date', 'employee.gender', 'employee.company')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->get();
        }
        // search by name
        if($request->name)
        {
            $users = DB::table('users')
                        ->join('employee', 'users.user_id', '=', 'employee.employee_id')
                        ->select('users.*', 'employee.birth_date', 'employee.gender', 'employee.company')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->get();
        }
        // search by name
        if($request->position)
        {
            $users = DB::table('users')
                        ->join('employee', 'users.user_id', '=', 'employee.employee_id')
                        ->select('users.*', 'employee.birth_date', 'employee.gender', 'employee.company')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }

        // search by name and id
        if($request->employee_id && $request->name)
        {
            $users = DB::table('users')
                        ->join('employee', 'users.user_id', '=', 'employee.employee_id')
                        ->select('users.*', 'employee.birth_date', 'employee.gender', 'employee.company')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->get();
        }
        // search by position and id
        if($request->employee_id && $request->position)
        {
            $users = DB::table('users')
                        ->join('employee', 'users.user_id', '=', 'employee.employee_id')
                        ->select('users.*', 'employee.birth_date', 'employee.gender', 'employee.company')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }
        // search by name and position
        if($request->name && $request->position)
        {
            $users = DB::table('users')
                        ->join('employee', 'users.user_id', '=', 'employee.employee_id')
                        ->select('users.*', 'employee.birth_date', 'employee.gender', 'employee.company')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }
        // search by name and position and id
        if($request->employee_id && $request->name && $request->position)
        {
            $users = DB::table('users')
                        ->join('employee', 'users.user_id', '=', 'employee.employee_id')
                        ->select('users.*', 'employee.birth_date', 'employee.gender', 'employee.company')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')
                        ->get();
        }
        return view('form.employeelist',compact('users','userList','permission_lists'));
    }

    // employee profile with all controller user
    public function profileEmployee($user_id)
    {
        $users = DB::table('users')
                ->leftJoin('personal_information','personal_information.user_id','users.user_id')
                ->leftJoin('profile_information','profile_information.user_id','users.user_id')
                ->where('users.user_id',$user_id)
                ->first();
        $user = DB::table('users')
                ->leftJoin('personal_information','personal_information.user_id','users.user_id')
                ->leftJoin('profile_information','profile_information.user_id','users.user_id')
                ->where('users.user_id',$user_id)
                ->get();
        return view('form.employeeprofile',compact('user','users'));
    }

    /** page departments */
    public function index()
    {
        $departments = DB::table('departments')->get();
        return view('form.departments',compact('departments'));
    }

    /** save record department */
    public function saveRecordDepartment(Request $request)
    {
        $request->validate([
            'department'        => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try{

            $department = department::where('department',$request->department)->first();
            if ($department === null)
            {
                $department = new department;
                $department->department = $request->department;
                $department->save();

                DB::commit();
                Toastr::success('Add new department successfully :)','Success');
                return redirect()->route('form/departments/page');
            } else {
                DB::rollback();
                Toastr::error('Add new department exits :)','Error');
                return redirect()->back();
            }
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Add new department fail :)','Error');
            return redirect()->back();
        }
    }

    /** update record department */
    public function updateRecordDepartment(Request $request)
    {
        DB::beginTransaction();
        try{
            // update table departments
            $department = [
                'id'=>$request->id,
                'department'=>$request->department,
            ];
            department::where('id',$request->id)->update($department);

            DB::commit();
            Toastr::success('updated record successfully :)','Success');
            return redirect()->route('form/departments/page');
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('updated record fail :)','Error');
            return redirect()->back();
        }
    }

    /** delete record department */
    public function deleteRecordDepartment(Request $request)
    {
        try {

            department::destroy($request->id);
            Toastr::success('Department deleted successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {

            DB::rollback();
            Toastr::error('Department delete fail :)','Error');
            return redirect()->back();
        }
    }

    /** page designations - sub department */
    public function subdeptIndex()
    {
        $subdept = DB::table('subdept')->get();
        $deptList = DB::table('departments')->get();
        return view('form.designations', compact('subdept','deptList'));
    }

    public function saveSubdept(Request $request) {
        DB::beginTransaction();
        $request->validate([
            'subdept'      => 'required|string|max:255',
            'department'   => 'required|string|max:255',
        ]);
        try{
            $subdept = new Subdept;
            $subdept->subdept_name  = $request->subdept;
            $subdept->department    = $request->department;
            $subdept->save();

            DB::commit();
            Toastr::success('Create New Sub Dept Successfully :)','Success');
            return redirect()->route('form/designations/page');
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Add New Sub Dept Fail :)','Error');
            return redirect()->back();
        }
    }

    /** delete record sub department */
    public function deleteSubdept(Request $request)
    {
        DB::beginTransaction();
        try {

            Subdept::where('id',$request->id)
            ->update(['data_status' => 'NOT ACTIVE']);

            DB::commit();
            Toastr::success('Sub Department deleted successfully :)','Success');
            return redirect()->route('form/designations/page');

        } catch(\Exception $e) {

            DB::rollback();
            Toastr::error('Sub Department delete fail :)','Error');
            return redirect()->back();
        }
    }

    public function updateSubdept(Request $request) {
        DB::beginTransaction();
        try{
        $subdept=[
            'subdept_name'      => $request->subdept_name_edit,
            'department'   => $request->select_dept,
        ];

            Subdept::where('id',$request->id_edit)->update($subdept);

            DB::commit();
            Toastr::success('Update Sub Dept Successfully :)','Success');
            return redirect()->route('form/designations/page');
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Udpate Sub Dept Fail :)','Error');
            return redirect()->back();
        }
    }

    /** page time sheet */
    public function timeSheetIndex()
    {
        return view('form.timesheet');
    }

    /** page overtime */
    public function overTimeIndex()
    {
        return view('form.overtime');
    }

}

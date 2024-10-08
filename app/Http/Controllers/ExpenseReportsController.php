<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ExpenseReportsController extends Controller
{
    // view page
    public function index()
    {
        return view('reports.expensereport');
    }

    // view page
    public function invoiceReports()
    {
        return view('reports.invoicereports');
    }

    // daily report page
    public function dailyReport()
    {
        return view('reports.dailyreports');
    }

    // leave reports page
    public function leaveReport()
    {
        $leaves = DB::table('leaves_admin')
                    ->join('users', 'users.user_id', '=', 'leaves_admin.user_id')
                    ->select('leaves_admin.*', 'users.*')
                    ->get();
        return view('reports.leavereports',compact('leaves'));
    }
}

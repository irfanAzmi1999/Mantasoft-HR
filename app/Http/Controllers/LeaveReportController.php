<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\LeaveDetail;
use App\Models\Staff;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Datatables;

class LeaveReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function leaveReport()
    {
        $department = Department::where('delete_department', 0)->get();
        $hodDepartment = Staff::where('user_id', Auth::user()->id)->first();
        $currentYear = date('Y');
        $currentMonth = date('m');
        return view('leaveReport.mainLeaveReport', [
            'title' => 'Leave Report',
            'title_menu' => 'Leave Report',
            'department' => $department,
            'hodDepartment' => $hodDepartment,
            'currentYear' => $currentYear,
            'currentMonth' => $currentMonth
        ]);
    }

    public function generateLeave(Request $request)
    {
        $month = $request->input('monthLeave');
        switch ($month) {
            case 1: $monthTitle = 'January'; break;
            case 2: $monthTitle = 'February'; break;
            case 3: $monthTitle = 'March'; break;
            case 4: $monthTitle = 'April'; break;
            case 5: $monthTitle = 'May'; break;
            case 6: $monthTitle = 'June'; break;
            case 7: $monthTitle = 'July'; break;
            case 8: $monthTitle = 'August'; break;
            case 9: $monthTitle = 'September'; break;
            case 10: $monthTitle = 'October'; break;
            case 11: $monthTitle = 'November'; break;
            case 12: $monthTitle = 'December'; break;
        }
        $year = $request->input('yearLeave');
        $department = $request->input('departmentLeave');
        if ($department == 0) {
            $departmentTitle = 'ALL DEPARTMENTS';
            $list = LeaveDetail::select('leavedetails.*')
            ->join('staffs', 'staffs.id', '=', 'leavedetails.staff_id')
            //->where('leavedetails.start_date', 'like', $year.'-'.$month.'%')
            ->selectRaw(' year(leavedetails.start_date) = '.$year.' and month(leavedetails.start_date) ='.$month.'')
            ->whereIn('leavedetails.status_id', [1, 2])
            ->whereNot('staffs.user_id', 1)
            ->get();
        } else {
            $departmentTitle = Department::select('fullname')->where('id', $department)->first()->fullname.' DEPARTMENT';
            $list = LeaveDetail::select('leavedetails.*')
            ->join('staffs', 'staffs.id', '=', 'leavedetails.staff_id')
            ->selectRaw(' year(leavedetails.start_date) = '.$year.' and month(leavedetails.start_date) ='.$month.'')
            ->whereIn('leavedetails.status_id', [1, 2])
            ->whereNot('staffs.user_id', 1)
            ->where('staffs.department_id', $department)
            ->get();
        }

        $list_arr = [];
        foreach($list as $l){
            $list_arr[$l->getStaff->getUser->name][] = [
                'start_date' => $l->start_date ? $l->start_date : 'No Date',
                'end_date' => $l->end_date ?? 'No Date',
                'leave_type' => $l->getLeaveType->name ?? 'No Leave Type',
                'half_day' => $l->half_day == 0?'Full Day':'Half Day'
            ];
        }
        $data = [
            'title' => 'VN HR List Leave Report | ',
            'department' => $departmentTitle,
            'month' => $monthTitle,
            'year' => $year,
            'list' => $list_arr
        ];
        return Pdf::loadView('leaveReport.prints.leavereport', $data)->setPaper('a4', 'portrait')->stream();
    }

    public function generateStaff(Request $request)
    {
        $month = $request->input('monthStaff');
        switch ($month) {
            case 1: $monthTitle = 'January'; break;
            case 2: $monthTitle = 'February'; break;
            case 3: $monthTitle = 'March'; break;
            case 4: $monthTitle = 'April'; break;
            case 5: $monthTitle = 'May'; break;
            case 6: $monthTitle = 'June'; break;
            case 7: $monthTitle = 'July'; break;
            case 8: $monthTitle = 'August'; break;
            case 9: $monthTitle = 'September'; break;
            case 10: $monthTitle = 'October'; break;
            case 11: $monthTitle = 'November'; break;
            case 12: $monthTitle = 'December'; break;
        }
        $year = $request->input('yearStaff');
        $department = $request->input('departmentStaff');
        if ($department == 0) {
            $departmentTitle = 'ALL DEPARTMENTS';
            $list = User::select('users.*')
            ->join('staffs', 'staffs.user_id', '=', 'users.id')
            ->whereNot('users.id', 1)
            ->whereRaw('staffs.created_at >= ?', '2004-11-22 00:00:00')
            ->whereRaw('staffs.created_at <= ?', ''.$year.'-'.$month.'-28 23:59:59')
            ->where('staffs.deleted_at', null)
            ->get();
        } else {
            $departmentTitle = Department::select('fullname')->where('id', $department)->first()->fullname.' DEPARTMENT';
            $list = User::select('users.*')
            ->join('staffs', 'staffs.user_id', '=', 'users.id')
            ->whereNot('users.id', 1)
            ->whereRaw('staffs.created_at >= ?', '2004-11-22 00:00:00')
            ->whereRaw('staffs.created_at <= ?', ''.$year.'-'.$month.'-28 23:59:59')
            ->where('staffs.deleted_at', null)
            ->where('staffs.department_id', $department)
            ->get();
        }
        $data = [
            'title' => 'VN HR List Staff Report | ',
            'department' => $departmentTitle,
            'month' => $monthTitle,
            'year' => $year,
            'list' => $list
        ];
        return Pdf::loadView('leaveReport.prints.staffreport', $data)->setPaper('a4', 'portrait')->stream();
    }
}

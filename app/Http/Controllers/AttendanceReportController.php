<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\LeaveDetail;
use App\Models\Staff;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\DataTables;

class AttendanceReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function attendanceReport()
    {
      $department = Department::all();
      $hodDepartment = Staff::where('user_id', Auth::user()->id)->first();
      $currentYear = date('Y');
      $currentMonth = date('m');
      return view('report.mainAttendanceReport', [
          'title' => 'Attendance Report',
          'title_menu' => 'Attendance Report',
          'department' => $department,
          'hodDepartment' => $hodDepartment,
          'currentYear' => $currentYear,
          'currentMonth' => $currentMonth
      ]);
    }

    public function generateAttendance(Request $request)
    {
        $month = $request->input('month');
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
        $year = $request->input('year');
        $department = $request->input('department');
        if ($department == 0) {
            $departmentTitle = 'ALL DEPARTMENTS';
            $list = Attendance::select('attendances.*')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->selectRaw(' year(attendances.created_at) = '.$year.' and month(attendances.created_at) ='.$month.'')
            ->get();

        } else {
            $departmentTitle = Department::select('fullname')->where('id', $department)->first()->fullname.' DEPARTMENT';
            $list = Attendance::select('attendances.*')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->join('staffs', 'staffs.id', '=', 'attendances.user_id')
            ->selectRaw(' year(attendances.created_at) = '.$year.' and month(attendances.created_at) ='.$month.'')
            ->where('staffs.department_id', $department)
            ->get();
        }

        $list_arr = [];
        foreach($list as $l){
            $list_arr[$l->getUser->name][] = [
                'curentDate' => $l->curentDate?? 'No Date',
                'location_in' => $l->location_in ? $l->location_in : 'No location',
                'time_in' => $l->time_in ?? 'No Time',
                'location_out' => $l->location_out ? $l->location_out : 'No location',
                'time_out' => $l->time_out ?? 'No Time'
            ];
        }

        $data = [
            'title' => 'VN HR List Attendance Report | ',
            'department' => $departmentTitle,
            'month' => $monthTitle,
            'year' => $year,
            'list' => $list_arr
        ];

        // echo '<pre>';
        // print_r($list_arr);
        // echo '</pre>';
        // die();
        return Pdf::loadView('report.print.attendancereport', $data)->setPaper('a4', 'portrait')->stream();
    }
}
